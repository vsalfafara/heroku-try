<?php
class Table_model extends CI_Model {

   public function __construct()
   {
      $this->load->database();
   }

   public function getTables() {
      $data = array(
         'table_schema' => 'public'
      );

      $this->db->select("initcap(table_name) as table_name, CONCAT(table_schema, '.', table_name) as table_target");
      $this->db->from('information_schema.tables');
      $this->db->where($data);

      $query = $this->db->get();

      return $query->result_array();
   }

   public function getTableData($table) {
      
      $this->db->select('*');
      $this->db->from($table);

      $query = $this->db->get();

      return $query->result_array();
   }
}