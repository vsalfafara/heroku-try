<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

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
		date_default_timezone_set('Asia/Manila');
	}

	public function index()
	{
		if (sizeof($this->session->all_userdata()) > 1) {
			$data['vessels'] = $this->vessel_model->getVessels();
			$data['routes'] = $this->route_model->getRoutes($this->session->userdata('port_gid'));
			$data['agent'] = $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name');
			$data['price'] = json_encode($this->fare_model->getFareByPort($this->session->userdata('port_gid')));
			$this->load->view('extra/header', $data);
			$this->load->view('agent/index', $data);
			$this->load->view('extra/footer');
			$this->load->view('extra/mainjs');
			$this->load->view('extra/sidebar');
			$this->load->view('extra/close');
		}
		else {
			redirect('login/index', 'refresh');
		}
	}

	public function history() {
		if (sizeof($this->session->all_userdata()) > 1) {
			$data['tickets'] = $this->ticket_model->getUserTickets($this->session->userdata('user_gid'));
			$data['agent'] = $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name');

			$this->load->view('extra/header', $data);
			$this->load->view('history', $data);
			$this->load->view('extra/footer');
			$this->load->view('extra/sidebar');
			$this->load->view('extra/footer');
		}
		else {
			redirect('login/index', 'refresh');
		}
	}

	public function insertTicket() {
		$vessel = $this->input->post('vessel');
		$number = $this->input->post('number');
		$date = $this->input->post('date');
		$agent = $this->input->post('ticketing-agent');
		$route = $this->input->post('route');
		$fare = $this->input->post('fare');
		$port = $this->session->userdata('port_gid');
		$insert_date = date('Y-m-d H:i:s', strtotime('now'));

		$price = $this->input->post('price');

		$this->ticket_model->setTicket($vessel, 
												 $number, 
												 date("F d, Y", strtotime($date)),
												 $agent,
												 $route,
												 $fare,
												 $price,
												 $port,
												 $this->session->userdata('user_gid'),
												 $insert_date);
												 
		redirect('agent/index', 'refresh');
	}

	public function getPrice() {
		$price = json_encode($this->fare_model->getFareByPort($this->session->userdata('port_gid')));

		echo json_encode($price);
	}
} 
