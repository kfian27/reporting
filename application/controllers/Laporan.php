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

	function getByDeviceId(){

	    $uptd = $this->input->post("uptdnya");

	    $datanya = $this->mlaporan->get_nm_ijin($uptd);
	    $keterangan = "<option value=''>--pilih--</option>";

	    foreach ($datanya as $key) {
	    	$keterangan .= "<option value='".$key->NAMA_HEADER."'>".$key->NAMA_HEADER."</option>";
	    }

	    $callback = array('list_ijin'=>$keterangan);
	    echo(json_encode($callback));
	}	
}
?>
