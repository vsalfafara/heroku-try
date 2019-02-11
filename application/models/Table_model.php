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

   public function getColumns($table) {
      $data = array(
         'table_schema' => 'public',
         'table_name' => $table
      );

      $this->db->select('column_name');
      $this->db->from('information_schema.columns');
      $this->db->where($data);

      $query = $this->db->get();

      return $query->result_array();
   }

   public function getTableData($target) {
      
      $this->db->select('*');
      $this->db->from($target);

      $query = $this->db->get();

      return $query->result_array();
   }

   public function filter($filter) {
      $data = array (
         $filter['column'] => $filter['searchTerm'],
      );
      
      $this->db->select('*');
      $this->db->from($filter['target']);
      // $this->db->where($data);
      $this->db->like($data);
      $query = $this->db->get();

      return $query->num_rows() ? $query->result_array() : false;
   }
}