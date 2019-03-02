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

		$column_chart_data = $this->ticket_model->getTotalFairByMonth();

		for ($i = 0; $i < sizeof($column_chart_data); $i++) {
			$monthNum  = $column_chart_data[$i]['month'];
			$dateObj   = DateTime::createFromFormat('!m', $monthNum);
			$column_chart_data[$i]['month'] = $dateObj->format('F');
		}

		$data['column_chart'] = json_encode($column_chart_data, JSON_NUMERIC_CHECK); 

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
}