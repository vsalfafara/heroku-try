<?php
class Ticket_model extends CI_Model {

   public function __construct()
   {
      $this->load->database();
   }

   public function setTicket($vessel, $number, $date, $agent, $route, $fare, $price, $port, $user) {
      $data = array(
         'ticket_gid' => 1,
         'voyage_num' => $number,
         'voyage_date' => $date,
         'port_gid' => $port,
         'route_gid' => $route,
         'vessel_gid' => $vessel,
         'user_gid' => $user,
         'fair_type' => $fare,
         'fair_price' => $price
      );

      $this->db->insert('public.ticket', $data);

   }
}