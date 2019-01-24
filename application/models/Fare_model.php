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
}