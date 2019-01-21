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
	}

	public function index()
	{
		if (sizeof($this->session->all_userdata()) > 1) {
			$data['vessels'] = $this->vessel_model->getVessels();
			$data['routes'] = $this->route_model->getRoutes($this->session->userdata('port_gid'));

			$this->load->view('extra/header');
			$this->load->view('agent/index', $data);
			$this->load->view('extra/footer');
		}
		else {
			redirect('login/index', 'refresh');
		}
	}

	public function getFares() {
		$array = array(
			'id' => 1,
			'name' => 'name',
			'email' => 'alfafara.vm@gmail.com'
		);

		print_r(json_encode($array, JSON_PRETTY_PRINT));
	}
} 
