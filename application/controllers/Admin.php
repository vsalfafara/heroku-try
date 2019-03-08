<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
		$this->load->model('vessel_model');
		$this->load->model('route_model');
		$this->load->model('fare_model');
		$this->load->model('ticket_model');
		$this->load->model('table_model');
		
		date_default_timezone_set('Asia/Manila');
		
		if (sizeof($this->session->all_userdata()) > 1){
			if ($this->session->role != 'SUPERADMIN') {
				echo "not allowed";
				exit;
			}
		}
   }

   public function index() {
		
		if (sizeof($this->session->all_userdata()) > 1) {
		$data['admin'] = $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name');
		$data['username'] = $this->session->userdata('user_gid');
		$data['tables'] = $this->table_model->getTables();
		$data['admin_link'] = 'active';
		$data['dashboard'] = '';

		$this->load->view('admin/header.php', $data);
      $this->load->view('admin/admin.php', $data);
      $this->load->view('admin/footer.php');
		}
		else {
			redirect('login/index', 'refresh');
		}
	}

	public function dashboard() {
		$data['admin'] = $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name');
		$data['username'] = $this->session->userdata('user_gid');
		$data['admin_link'] = '';
		$data['dashboard'] = 'active';
		$data['vessels'] = $this->vessel_model->getVessels();

		$column_chart_data = $this->ticket_model->getTotalFairByMonth();
		$pie_chart_data = $this->ticket_model->getTotalFairByType();

		for ($i = 0; $i < sizeof($column_chart_data); $i++) {
			$monthNum  = $column_chart_data[$i]['month'];
			$dateObj   = DateTime::createFromFormat('!m', $monthNum);
			$column_chart_data[$i]['month'] = $dateObj->format('F');
		}

		$data['column_chart'] = json_encode($column_chart_data, JSON_NUMERIC_CHECK); 
		$data['pie_chart'] = json_encode($pie_chart_data, JSON_NUMERIC_CHECK); 

		$this->load->view('admin/header.php', $data);
      $this->load->view('admin/dashboard.php', $data);
      $this->load->view('admin/footer.php');
	}
	
	public function fetchTableData() {
		$data['target'] = trim(file_get_contents("php://input"));
		$data['table'] = explode('.', $data['target'], 2)[1];

		if ($data['table'] == 'fair' || 
			 $data['table'] == 'ticket' ||
			 $data['table'] == 'user' ||
			 $data['table'] == 'login')
			$data['link']['edit'] = base_url() .  $data['table'] . '_action/edit/';
		
		if ($data['table'] == 'user' ||
			 $data['table'] == 'login') 
			$data['link']['delete'] = base_url() .  $data['table'] . '_action/delete/';

		$data['columns'] = $this->table_model->getColumns($data['table']);
		$data['table_values'] = $this->table_model->getTableData($data['target']);

		$data['table'] = ucfirst($data['table']);
		$view = $this->load->view('admin/selected_table.php', $data, true);

		echo $view;
	}

	public function filterTable() {
		$data['target'] = $this->input->post('table');
		$data['table'] = explode('.', $data['target'], 2)[1];
		$data['column'] = $this->input->post('column');
		$data['searchTerm'] = $this->input->post('searchTerm');
		$data['link']['delete'] = base_url() .  $data['table'] . 'action/delete/';
		$data['link']['edit'] = base_url() .  $data['table'] . 'action/edit/';

		$data['table'] = ucfirst(explode('.', $data['target'])[1]);
		$data['table_values'] = $this->table_model->filter($data);

		if ($data['table_values'])
			$view = $this->load->view('admin/search_table.php', $data, true);
		else 
			$view = '<tr><td>No Results Found</td></tr?';
		echo $view;
	}

	public function ajaxVoyage() {
		$data['options'] = $this->ticket_model->getVoyageByVessel($this->input->post());
		$data['select'] = "Voyage";

		$view = $this->load->view('admin/report_options_voyage.php', $data, true);

		echo $view;
	}

	public function ajaxDate() {
		$data['options'] = $this->ticket_model->getDateByVoyage($this->input->post());
		$data['select'] = "Date";

		$view = $this->load->view('admin/report_options_date.php', $data, true);

		echo $view;
	}

	public function ajaxReport() {

		$data['data'] = $this->ticket_model->getReport($this->input->post());
		$data['report'] = [];
		$sum = 0;
		$passengers = 0;
		$totalSum = 0;
		$totalPassengers = 0;
		$count = 0;

		for ($i = 0; $i < sizeof($data['data']); $i++){ 
			$ref_num = $data['data'][$i]['ref_num'];
			$next_ref = $data['data'][$i]['next_ref'];
			$route = $data['data'][$i]['route_gid'];
			$next_route = $data['data'][$i]['next_route'];
			$sum += $data['data'][$i]['fair_price'];
			$passengers++;

			if (($ref_num + 1 != $next_ref || $next_ref == "null") || ($route != $next_route)) {
				$route = $this->route_model->getLoc(['route_gid' => $data['data'][$i]['route_gid'], 'port_gid' => $data['data'][$i]['port_gid']]);

				$data['report'][$count]['port_from'] = $route['source_location'];
				$data['report'][$count]['port_to'] = $route['dest_location'];
				$data['report'][$count]['from_no'] = $first_ref = $ref_num - ($passengers - 1);				
				$data['report'][$count]['to_no'] = $passengers - 1 == 0 ? "---" : $ref_num;
				$data['report'][$count]['passengers'] = $passengers;
				$data['report'][$count]['fare'] = $data['data'][$i]['fair_type'];				
				$data['report'][$count]['price'] = $data['data'][$i]['fair_price'];
				$data['report'][$count]['total'] = $sum;
				
				$totalSum += $sum;
				$totalPassengers += $passengers;
				$sum = 0;
				$passengers = 0;
				$count++;
			}
		}

		$data['total_record']['total_passengers'] = $totalPassengers;
		$data['total_record']['total_sum'] = $totalSum;

		$view = $this->load->view('admin/report_table', $data, true);

		echo $view;
	}
}