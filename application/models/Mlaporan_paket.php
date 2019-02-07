<?php
	class Mlaporan_paket extends CI_Model {

		function __construct() {
			// Call the Model constructor
			parent:: __construct();
			$this->db = $this->load->database('report', TRUE);
			//set waktu yang digunakan ke zona jakarta
			//$this->db->query("SET time_zone='Asia/Jakarta'");
		}
      	function tanggal_indo($tanggal){
	        $bulan = array (1 =>   'Januari',
	              'Februari',
	              'Maret',
	              'April',
	              'Mei',
	              'Juni',
	              'Juli',
	              'Agustus',
	              'September',
	              'Oktober',
	              'November',
	              'Desember'
	            );
	        $split = explode('-', $tanggal);
	        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    	}
    	function get_nm_paket(){
        	$sql = "SELECT * FROM M_PAKET where AKTIF = 1";

			$query = $this->db->query($sql);
			return $query->result();
        }
    	 function get_tanggal($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT NAMA_IJIN, COUNT (NAMA_IJIN) AS JUMLAHNYA FROM(SELECT T_FO.TGL_REGISTRASI, T_FO.NO_REGISTRASI,T_FO_SUB_IJIN.KD_IJIN, MIJIN.NAMA_IJIN FROM T_FO,T_FO_SUB_IJIN,MIJIN WHERE T_FO.NO_REGISTRASI = T_FO_SUB_IJIN.NO_REGISTRASI AND T_FO.TGL_REGISTRASI = T_FO_SUB_IJIN.TGL_REGISTRASI AND T_FO_SUB_IJIN.KD_IJIN = MIJIN.KD_IJIN AND T_FO.TGL_REGISTRASI BETWEEN TO_DATE ('$tgl1', 'yyyy-mm-dd') AND TO_DATE ('$tgl2', 'yyyy-mm-dd') AND T_FO.ID_PAKET ='$param1') GROUP BY NAMA_IJIN";

			$query = $this->db->query($sql);
			return $query->result();
        }
	}
?>
