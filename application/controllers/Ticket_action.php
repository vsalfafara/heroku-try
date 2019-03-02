<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_action extends CI_Controller {

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
		$this->load->model('ticket_model');
		$this->load->model('table_model');
		$this->load->model('route_model');
		$this->load->model('fare_model');
		date_default_timezone_set('Asia/Manila');
   }
   
   public function edit($id = null) {
		$data['admin'] = $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name');
		$data['username'] = $this->session->userdata('user_gid');

		$data['id'] = $id;
		// $data['col'] = $this->table_model->getColumns('ticket');
		$data['data']= $this->ticket_model->getTicket($id);
		// $count = 0;
		// foreach($row as $value) {
		// 	$data['col'][$count]['value'] = $value;
		// 	$count++;
		// }

		$this->load->view('admin/header.php', $data);
      $this->load->view('admin/control/ticket/update.php', $data);
      $this->load->view('admin/footer.php');
	}
	
	public function update() {
		$this->ticket_model->updateTicket($this->input->post());
		redirect('/admin/index', 'refresh');
	}

   public function delete($id = null) {
      echo $id;
	}
	
	public function getRouteByPort(){
		$port = $this->input->post('port');
		$data['routes'] = $this->route_model->getRoutes($port);

		$options = $this->load->view('admin/control/ticket/route_options.php', $data, true);

		print_r($options);
	}

	public function getFare() {
		$port = $this->input->post('port');
		$route = $this->input->post('route');
		$type = $this->input->post('type');

		$fare = $this->fare_model->getFare($route, $port, $type);

		print_r($fare);
	}
} 
