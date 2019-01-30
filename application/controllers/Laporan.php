<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* This is Example Controller
*/
class Laporan extends CI_Controller
{

	function __construct() {
		parent::__construct();
      	// $this->cek_login();
      	$this->load->model('mlaporan');
      	$this->load->library('Pdf');
	}

	public function getOrderList() {    
        $tglMulai = $this->input->post('tgl_mulai');
        $tglAkhir = $this->input->post('tgl_akhir')
        $uptd = $this->input->post('uptd')       
        $hasilnya] = $this->mlaporan->get_tanggal($tglMulai,$tglAkhir,$uptd);        
        $dataArray = array();
        foreach ($hasilnya as $element) {            
            $dataArray[] = array(
                $element['nm_header'],
                $element['jumlah_berkas'],
            );
        }
        echo json_encode(array("data" => $dataArray));
    }

	function pdf_bulan()
	{
		$where1 = $this->input->post('retailer_country');
		$where2 = $this->input->post('order_method_type');
		$where3 = $this->input->post('retailer_type');;
		$where4 = $this->input->post('product_line');;
		$where5 = $this->input->post('tahun');
		$harian = $this->mlaporan->harian($where1,$where2,$where3,$where4,$where5);
 		$data = array('Men' => 1510, 'Women' => 1610, 'Children' => 1400);
 		$pdf = new FPDF('l', 'mm', 'A4');
		$pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 7);
        $a=1; foreach ($harian as $row) {
        	$pdf->Cell(10,6,$a,1,0,'C');
			$pdf->Cell(30,6,$row->retailer_country,1,0);
			$pdf->Cell(30,6,$row->order_method_type,1,0);
			$pdf->Cell(30,6,$row->retailer_type,1,0);
			$pdf->Cell(30,6,$row->product_line,1,0);
			$pdf->Cell(30,6,$row->product_type,1,0);
			$pdf->Cell(40,6,$row->product,1,0);
			$pdf->Cell(30,6,$row->year,1,0);
			$pdf->Cell(30,6,$row->quantity,1,1);
		$a++;
        }
        $pdf->SetFont('Arial', 'BIU', 12);
		$pdf->Cell(0, 5, '2 - Bar diagram', 0, 1);
		$pdf->Ln(8);
		$valX = $pdf->GetX();
		$valY = $pdf->GetY();
		$pdf->BarDiagram(190, 70, $data, '%l : %v (%p)', array(255,175,100));
		$pdf->SetXY($valX, $valY + 80);
        
        $pdf->Output();

	}

	function tahunan() {
		$tanggal = date('Y');
		$data['harian'] = $this->mlaporan->harian($tanggal);
		$this->load->view('base/Menu');
		$this->load->view('base/Header');
		$this->load->view('laporan/Tahunan', $data);
		$this->load->view('base/Footer');
		
	}

	function pdf_tahun()
	{
		$tanggal = $this->input->post('tahun');
		$harian = $this->mlaporan->harian($tanggal);
 
 		$pdf = new FPDF('p', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B', 12);
        $pdf->Cell(190,7,'IKA KAIN KILOAN',0,1,'C');
        $pdf->Cell(190,7,'LAPORAN PENJUALAN KAIN TAHUN '.$this->input->post('tahun'),0,1,'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(30,6,'Tanggal',1,0);
        $pdf->Cell(30,6,'Tanggal Bayar',1,0);
        $pdf->Cell(30,6,'Kain',1,0);
        $pdf->Cell(10,6,'QTY',1,0);
        $pdf->Cell(13,6,'Harga',1,0);
        $pdf->Cell(28,6,'Pelanggan',1,0);
        $pdf->Cell(23,6,'Ekspedisi',1,0);
        $pdf->Cell(30,6,'Status',1,1);
        $pdf->SetFont('Arial', '', 7);
        foreach ($harian as $row) {
			$pdf->Cell(30,6,$row->TR_TGL,1,0);
			$pdf->Cell(30,6,$row->TR_TGLBYR,1,0);
			$pdf->Cell(30,6,$row->KN_NAMA,1,0);
			$pdf->Cell(10,6,$row->DT_QTY,1,0);
			$pdf->Cell(13,6,$row->DT_HARGA,1,0);
			$pdf->Cell(28,6,$row->PLG_NAMA,1,0);
			$pdf->Cell(23,6,$row->ESK_NAMA,1,0);
			if ($row->TR_STATUS == 1) {
            	$pdf->Cell(30,6,'Menunggu Pembayaran',1,1); 
			} elseif ($row->TR_STATUS == 2) {
				$pdf->Cell(30,6,'Terbayar',1,1);
			} elseif ($row->TR_STATUS == 3) {
				$pdf->Cell(30,6,'Proses Pengiriman',1,1);
			} elseif ($row->TR_STATUS == 4) {
				$pdf->Cell(30,6,'Terkirim',1,1);
			} elseif ($row->TR_STATUS == 5) {
        		$pdf->Cell(30,6,'Dibatalkan',1,1);
			}
        }
        
        $pdf->Output();

	}
}
?>
