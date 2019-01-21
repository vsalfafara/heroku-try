<?php
class Login_model extends CI_Model {

     public function __construct()
     {
          $this->load->database();
     }

     public function getUser($u, $p) {
          $this->db->select('login_gid, username');
          $this->db->from('public.login');
          $this->db->where(array(
               'username' => $u,
               'password' => $p
          ));

          $query = $this->db->get();

          return $query->row_array();
     }
}