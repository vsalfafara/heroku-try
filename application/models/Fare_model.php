<?php
class Fare_model extends CI_Model {

   public function __construct()
   {
      $this->load->database();
   }

   public function getFare($route, $port, $type) {
      $data = array(
         'route_gid' => $route,
         'port_gid' => $port,
         'fair_type' => $type
      );

      $this->db->select('price');
      $this->db->from('public.fair');
      $this->db->where($data);

      $query = $this->db->get();

      return $query->row_array()['price'];
   }

   public function getFareByPort($port) {
      $data = array(
         'port_gid' => $port
      );

      $this->db->select('*');
      $this->db->from('public.fair');
      $this->db->where($data);
      $this->db->order_by("fair_type", "asc");

      $query = $this->db->get();

      return $query->result_array();
   }
}