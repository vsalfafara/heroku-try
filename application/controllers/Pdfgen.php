<?php

class Pdfgen extends CI_Controller {

   public function __construct()
   {
      parent::__construct();
      $this->load->model('vessel_model');
      $this->load->model('route_model');
      $this->load->model('fare_model');
      $this->load->model('ticket_model');
      $this->load->model('table_model');
   }

   //print hello world
   public function helloworld(){
      $config=array('orientation'=>'P','size'=>'A4');
      // $this->load->library('mypdf',$config);
      $this->mypdf->AddPage();
      $this->mypdf->SetFont('Arial','B',16);
      $this->mypdf->Cell(40,10,'Hello World!');
      $this->mypdf->Output();                
   }

   //print hello world with rotation 
   public function rotateHelloworld(){
      $config=array('orientation'=>'P','size'=>'A4');
      $this->load->library('mypdf',$config);
      $this->mypdf->AddPage();
      $this->mypdf->SetFont('Arial','B',16);
      $this->mypdf->RotatedText(100,60,'Hello World!',45);
      $this->mypdf->Output();                
   }

   //print hello world as watermark 
   public function watermarkHelloworld(){
      $config=array('orientation'=>'P','size'=>'A4');
      $this->load->library('mypdf',$config);
      $this->mypdf->AddPage();
      $this->mypdf->SetFont('Arial','B',50);
      $this->mypdf->SetTextColor(255,192,203);
      $this->mypdf->RotatedText(35,190,'Hello World!',45);
      $this->mypdf->Output();                
   }

   //print html 
   public function printHTML(){
      $config=array('orientation'=>'P','size'=>'A4');
      $this->load->library('mypdf',$config);
      $this->mypdf->SetFont('Arial','',12);
      $this->mypdf->AddPage();
      $this->mypdf->WriteHTML('<font face="times">The </font><b><font color="#7070D0">FPDF</font></b><font face="times"> logo:</font>
<br><br><img src="http://www.fpdf.org/logo.gif" width="104">');
      $this->mypdf->Output();
   }

   //print basic table 
   public function basicTable(){
      $config=array('orientation'=>'P','size'=>'A4');
      $this->load->library('mypdf',$config);
      $header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
      $data   = array(array('Austria','Vienna','83859','8075'),array('Belgium','Brussels','30518','10192'));
      $this->mypdf->SetFont('Arial','',12);
      $this->mypdf->AddPage();
      $this->mypdf->BasicTable($header,$data);
      $this->mypdf->Output();
   }

   //print improved table 
   public function improvedTable(){
      $config=array('orientation'=>'P','size'=>'A4');
      $this->load->library('mypdf',$config);
      $header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
      $data   = array(array('Austria','Vienna','83859','8075'),array('Belgium','Brussels','30518','10192'));
      $this->mypdf->SetFont('Arial','',12);
      $this->mypdf->AddPage();
      $this->mypdf->ImprovedTable($header,$data);
      $this->mypdf->Output();
   }

   //print fancy table 
   public function fancyTable(){
      $config=array('orientation'=>'P','size'=>'A5');
      $this->load->library('mypdf',$config);
      $top_header = array('Port Destination	', 
                          'Series Ticket Stub No.', 
                          'Category', 
                          'No. of', 
                          'Ticket',
                          'TOTAL');
      $bot_header = array('Port From', 
                          'Port To', 
                          'From No.', 
                          'To No.', 
                          'Fare', 
                          'Passenger', 
                          'Price', 
                          'AMOUNT');
      $data   = array(array('Libertad',
                            'San Jose',
                            '1',
                            '---',
                            'Regular',
                            '1',
                            '625',
                            '625'
                           ));
      $this->mypdf->SetFont('Arial','',9);
      $this->mypdf->AddPage();
      $this->mypdf->FancyTable($top_header, $bot_header, $data);
      $this->mypdf->Output();
   }

   public function generateReport() {

      $config=array('orientation'=>'P','size'=>'A4');
      $this->load->library('mypdf',$config);
      $top_header = array('Port Destination	', 
                          'Series Ticket Stub No.', 
                          'Category', 
                          'No. of', 
                          'Ticket',
                          'TOTAL');
      $bot_header = array('Port From', 
                          'Port To', 
                          'From No.', 
                          'To No.', 
                          'Fare', 
                          'Passenger', 
                          'Price', 
                          'AMOUNT');
                          
		$data['data'] = $this->ticket_model->getReport($this->input->post());
		$data['report'] = [];
		$sum = 0;
		$passengers = 0;
		$totalSum = 0;
		$totalPassengers = 0;
		$count = 0;

		for ($i = 0; $i < sizeof($data['data']); $i++){ 
			$ref_num = $data['data'][$i]['ref_num'];
			$next_ref = $data['data'][$i]['next_ref'];
			$route = $data['data'][$i]['route_gid'];
			$next_route = $data['data'][$i]['next_route'];
			$sum += $data['data'][$i]['fair_price'];
			$passengers++;

			if (($ref_num + 1 != $next_ref || $next_ref == "null") || ($route != $next_route)) {
				$route = $this->route_model->getLoc(['route_gid' => $data['data'][$i]['route_gid'], 'port_gid' => $data['data'][$i]['port_gid']]);

				$data['report'][$count]['port_from'] = $route['source_location'];
				$data['report'][$count]['port_to'] = $route['dest_location'];
				$data['report'][$count]['from_no'] = $first_ref = $ref_num - ($passengers - 1);				
				$data['report'][$count]['to_no'] = $passengers - 1 == 0 ? "---" : $ref_num;
				$data['report'][$count]['passengers'] = $passengers;
				$data['report'][$count]['fare'] = $data['data'][$i]['fair_type'];				
				$data['report'][$count]['price'] = $data['data'][$i]['fair_price'];
				$data['report'][$count]['total'] = $sum;
				
				$totalSum += $sum;
				$totalPassengers += $passengers;
				$sum = 0;
				$passengers = 0;
				$count++;
			}
      }
      
      $this->mypdf->SetFont('Arial','',9);
      $this->mypdf->AddPage();
      $this->mypdf->FancyTable($top_header, $bot_header, $data['report'], $totalPassengers, $totalSum);
      $this->mypdf->Output();
   }

   //print EAN barcode
   public function eanBarcode(){
      $config=array('orientation'=>'P','size'=>'A4');
      $this->load->library('mypdf',$config);
      $this->mypdf->AddPage();
      $this->mypdf->EAN13(80,40,'123456789012');
      $this->mypdf->Output();                
   }

   //print Code39 barcode
   public function code39(){
      $config=array('orientation'=>'P','size'=>'A4');
      $this->load->library('mypdf',$config);
      $this->mypdf->AddPage();
      $this->mypdf->Code39(80,40,'CODE 39',1,10);
      $this->mypdf->Output();                
   }
}