<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PDF extends FPDF_Protection{
	function RotatedText($x,$y,$txt,$angle)
	{
	    //Text rotated around its origin
	    $this->Rotate($angle,$x,$y);
	    $this->Text($x,$y,$txt);
	    $this->Rotate(0);
	}

	function RotatedImage($file,$x,$y,$w,$h,$angle)
	{
	    //Image rotated around its upper-left corner
	    $this->Rotate($angle,$x,$y);
	    $this->Image($file,$x,$y,$w,$h);
	    $this->Rotate(0);
	}

	// Simple table
	function BasicTable($header, $data)
	{
	    // Header
	    foreach($header as $col)
	        $this->Cell(40,7,$col,1);
	    $this->Ln();
	    // Data
	    foreach($data as $row)
	    {
	        foreach($row as $col)
	        $this->Cell(40,6,$col,1);
	        $this->Ln();
	    }
	}

	// Better table
	function ImprovedTable($header, $data)
	{
	    // Column widths
	    $w = array(40, 35, 40, 45);
	    // Header
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],7,$header[$i],1,0,'C');
	    $this->Ln();
	    // Data
	    foreach($data as $row)
	    {
	        $this->Cell($w[0],6,$row[0],'LR');
	        $this->Cell($w[1],6,$row[1],'LR');
	        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
	        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
	        $this->Ln();
	    }
	    // Closing line
	    $this->Cell(array_sum($w),0,'','T');
	}

	// Colored table
	function FancyTable($top_header, $bot_header, $data, $totalPassengers, $totalSum)
	{
	    // Colors, line width and bold font
	    $this->SetFillColor(255,255,255);
	    $this->SetTextColor(0);
	    $this->SetDrawColor(0,0,0);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B');
	    // Header
	    $tw = array(38, 38, 28, 28, 28, 28);
	    for($i=0;$i<count($top_header);$i++)
			$this->Cell($tw[$i],7,$top_header[$i],1,0,'C',true);
		$bw = array(19, 19, 19, 19, 28, 28, 28, 28);
	    $this->Ln();
	    for($i=0;$i<count($bot_header);$i++)
			$this->Cell($bw[$i],7,$bot_header[$i],1,0,'C',true);
	    $this->Ln();
	    // Color and font restoration
	    $this->SetFillColor(219,223,228);
	    $this->SetTextColor(0);
	    $this->SetFont('');
	    // Data
	    $fill = false;
	    foreach($data as $row)
	    {
	        $this->Cell($bw[0],10,$row['port_from'],'LR',0,'C',$fill);
	        $this->Cell($bw[1],10,$row['port_to'],'LR',0,'C',$fill);
	        $this->Cell($bw[2],10,$row['from_no'],'LR',0,'C',$fill);
	        $this->Cell($bw[3],10,$row['to_no'],'LR',0,'C',$fill);
	        $this->Cell($bw[4],10,$row['passengers'],'LR',0,'C',$fill);
	        $this->Cell($bw[5],10,$row['fare'],'LR',0,'C',$fill);
	        $this->Cell($bw[6],10,$row['price'],'LR',0,'C',$fill);
	        $this->Cell($bw[7],10,$row['total'],'LR',0,'C',$fill);
	        $this->Ln();
	        $fill = !$fill;
		}
		
		// Total
		$this->Cell(104,15,"Total Ticketed Passengers",'LR',0,'C',false);
		$this->Cell(28,15,$totalPassengers,'LR',0,'C',false);
		$this->Cell(28,15,"Gross Sales: Php",'LR',0,'C',false);
		$this->Cell(28,15,$totalSum,'LR',0,'C',false);
		$this->Ln();
	    // Closing line
	    $this->Cell(array_sum($tw),0,'','T');
	}
}

?>