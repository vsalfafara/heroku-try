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
   }

   public function index() {
		$data['admin'] = $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name');
		$data['username'] = $this->session->userdata('user_gid');
		$data['tables'] = $this->table_model->getTables();
		$data['admin_link'] = 'active';
		$data['dashboard'] = '';

		$this->load->view('admin/header.php', $data);
      $this->load->view('admin/admin.php', $data);
      $this->load->view('admin/footer.php');
	}
	
	public function fetchTableData() {
		$table = trim(file_get_contents("php://input"));

		$data['table'] = $this->table_model->getTableData($table);

		$view = $this->load->view('admin/selected_table.php', $data, true);

		echo $view;
	}
}