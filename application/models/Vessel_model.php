<?php
class Vessel_model extends CI_Model {

     public function __construct()
     {
          $this->load->database();
     }

     public function getVessels() {
          $this->db->select('*');
          $this->db->from('public.vessel');

          $query = $this->db->get();

          return $query->result_array();
     }
}