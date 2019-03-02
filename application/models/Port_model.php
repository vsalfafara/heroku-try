<?php
class Port_model extends CI_Model {

   public function __construct()
   {
      $this->load->database();
   }

   public function getPorts() {
      $this->db->select('*');
      $this->db->from('public.port');

      $query = $this->db->get();

      return $query->result_array();
   }
}