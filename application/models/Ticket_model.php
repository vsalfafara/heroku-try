<?php
class Ticket_model extends CI_Model {

   public function __construct()
   {
      $this->load->database();
   }

   public function setTicket($vessel, $number, $date, $agent, $route, $fare, $price, $port, $user, $insert_date, $ref) {
      $data = array(
         'voyage_num' => $number,
         'voyage_date' => $date,
         'port_gid' => $port,
         'route_gid' => $route,
         'vessel_gid' => $vessel,
         'user_gid' => $user,
         'fair_type' => $fare,
         'fair_price' => $price,
         'insert_date' => $insert_date,
         'ref_num' => $ref
      );

      $this->db->insert('public.ticket', $data);
   }

   public function getUserTickets($user_id) {
      $data = array(
         'user_gid' => $user_id 
      );

      $this->db->select('DISTINCT ON(public.ticket.ticket_gid) 
                        public.ticket.ticket_gid, 
                        public.vessel.vessel_name, 
                        public.ticket.voyage_num,
                        public.ticket.voyage_date,
                        CONCAT(public.route.source_location, \' - \', public.route.dest_location) as route,
                        public.ticket.fair_type,
                        public.ticket.fair_price,
                        public.ticket.insert_date');
      $this->db->from('public.ticket');
      $this->db->join('public.vessel', 'public.vessel.vessel_gid = public.ticket.vessel_gid');
      $this->db->join('public.route', 'public.route.route_gid = public.ticket.route_gid');
      $this->db->where($data);
      $this->db->order_by('public.ticket.ticket_gid', 'desc');
      $this->db->order_by('public.ticket.insert_date', 'desc');

      $query = $this->db->get();

      return $query->result_array();
   }

   public function getTicket($id) {
      $data = array(
         'ticket_gid' => $id
      );

      $this->db->select('*');
      $this->db->from('public.ticket');
      $this->db->where($data);

      $query = $this->db->get();

      return $query->row_array();
   }
   
   public function updateTicket($data) {
      unset($data['submit']);
      $this->db->set($data);
      $this->db->where('ticket_gid', $data['ticket_gid']);
      $this->db->update('public.ticket');
   }

   public function getTotalFairByMonth() {
      $sql = "SELECT date_part('month', voyage_date) as Month, 
               COALESCE(SUM(fair_price), 0) AS total 
               FROM public.ticket 
               WHERE date_part('year', voyage_date) = date_part('year', CURRENT_DATE)
               GROUP BY date_part('month', voyage_date);";

      $query = $this->db->query($sql);

      return $query->result_array();
   }

   public function getTotalFairByType() {
      $sql = "SELECT fair_type, SUM(fair_price) AS total
               FROM public.ticket
               GROUP BY fair_type";

      $query = $this->db->query($sql);

      return $query->result_array();
   }
}