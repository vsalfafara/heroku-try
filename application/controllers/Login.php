<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->model('login_model');
	}

	public function index()
	{
		if (sizeof($this->session->all_userdata()) > 1){
			redirect('/agent/index', 'refresh');
		}
		else
			$this->load->view('login');
	}

	public function login() {
		$data = array();

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run()){
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$result = $this->login_model->getUser($username, $password);

			if ($result) {
				$this->session->set_userdata($result[0]);
				redirect('/agent/index', 'refresh');
			}
			else {
				$data['login_error'] ="Invalid Login";
				$this->load->view('login', $data);
			}
		}
		else
			$this->load->view('login');
	}

	public function logout() {
		$keys = array(
			'__ci_last_regenerate',
			'login_gid',
			'username',
			'password',
		);

		$this->session->unset_userdata('login_gid');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('password');
		$this->session->sess_destroy();
		redirect('login/index', 'refresh');
	}
} 
