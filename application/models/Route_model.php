<?php
class Route_model extends CI_Model {

   public function __construct()
   {
      $this->load->database();
   }

   public function getRoutes($id) {
      $data = array(
         'port_gid' => $id
      );

      $this->db->select('*');
      $this->db->from('public.route');
      $this->db->where($data);

      $query = $this->db->get();

      return $query->result_array();
   }

   public function getLoc($data) {
      $this->db->select('*');
      $this->db->from('public.route');
      $this->db->where($data);

      $query = $this->db->get();

      return $query->row_array();
   }
}