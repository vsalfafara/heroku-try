<?php
class LoginModel extends CI_Model {

     public function __construct()
     {
          $this->load->database();
     }

     public function getUser($u, $p) {
          $this->db->select('*');
          $this->db->from('login');
          $this->db->where(array(
               'username' => $u,
               'password' => $p
          ));

          $query = $this->db->get();

          return $query->result_array();
     }
}