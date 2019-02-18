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
        	$sql = "SELECT * FROM M_PAKET where AKTIF = 1 AND TIPE != 'PARSIAL'";

			$query = $this->db->query($sql);
			return $query->result();
        }
    	function get_tanggal($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT NAMA_IJIN, COUNT (NAMA_IJIN) AS JUMLAHNYA FROM(SELECT T_FO.TGL_REGISTRASI, T_FO.NO_REGISTRASI,T_FO_SUB_IJIN.KD_IJIN, MIJIN.NAMA_IJIN FROM T_FO,T_FO_SUB_IJIN,MIJIN WHERE T_FO.NO_REGISTRASI = T_FO_SUB_IJIN.NO_REGISTRASI AND T_FO.TGL_REGISTRASI = T_FO_SUB_IJIN.TGL_REGISTRASI AND T_FO_SUB_IJIN.KD_IJIN = MIJIN.KD_IJIN AND T_FO.TGL_REGISTRASI BETWEEN TO_DATE ('$tgl1', 'yyyy-mm-dd') AND TO_DATE ('$tgl2', 'yyyy-mm-dd') AND T_FO.ID_PAKET ='$param1') GROUP BY NAMA_IJIN";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_tanggal_imb($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT NAMA_IJIN, COUNT (NAMA_IJIN) AS JUMLAHNYA FROM(SELECT T_FO.TGL_REGISTRASI, T_FO.NO_REGISTRASI,T_FO_SUB_IJIN.KD_IJIN, MIJIN.NAMA_IJIN FROM T_FO,T_FO_SUB_IJIN,MIJIN WHERE T_FO.NO_REGISTRASI = T_FO_SUB_IJIN.NO_REGISTRASI AND T_FO.TGL_REGISTRASI = T_FO_SUB_IJIN.TGL_REGISTRASI AND T_FO_SUB_IJIN.KD_IJIN = MIJIN.KD_IJIN AND T_FO.TGL_REGISTRASI BETWEEN TO_DATE ('$tgl1', 'yyyy-mm-dd') AND TO_DATE ('$tgl2', 'yyyy-mm-dd') AND T_FO.ID_PAKET ='$param1' AND T_FO_SUB_IJIN.KD_IJIN != '020500') GROUP BY NAMA_IJIN ORDER BY NAMA_IJIN ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_selesai_imb_skrk($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT COUNT( VW_".$param2."_DETIL.NO_REGISTRASI ) AS jumlah FROM VW_".$param2."_DETIL,T_FO WHERE VW_".$param2."_DETIL.NO_REGISTRASI = T_FO.NO_REGISTRASI AND VW_".$param2."_DETIL.TGL_REGISTRASI = T_FO.TGL_REGISTRASI AND VW_".$param2."_DETIL.STATUS LIKE 'PENGESAHAN SK' AND VW_".$param2."_DETIL.TGL_REGISTRASI BETWEEN TO_DATE( '$tgl1', 'yyyy-mm-dd' ) AND TO_DATE( '$tgl2', 'yyyy-mm-dd' ) AND ID_PAKET = '$param1'";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_tolak_imb_skrk($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT COUNT( VW_".$param2."_DETIL.NO_REGISTRASI ) AS jumlah FROM VW_".$param2."_DETIL,T_FO WHERE VW_".$param2."_DETIL.NO_REGISTRASI = T_FO.NO_REGISTRASI AND VW_".$param2."_DETIL.TGL_REGISTRASI = T_FO.TGL_REGISTRASI AND VW_".$param2."_DETIL.STATUS LIKE 'DITOLAK' AND VW_".$param2."_DETIL.TGL_REGISTRASI BETWEEN TO_DATE( '$tgl1', 'yyyy-mm-dd' ) AND TO_DATE( '$tgl2', 'yyyy-mm-dd' ) AND ID_PAKET = '$param1'";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_proses_imb_skrk($tgl1 ='',$tgl2 ='',$param1='',$param2=""){
        	$sql = "SELECT COUNT( NO_REGISTRASI ) AS JUMLAH FROM (SELECT DISTINCT * FROM(SELECT ID_CKTR,REGISTER_ULANG.NO_REGISTRASI,NAMA FROM REGISTER_ULANG,T_FO_REG_ULANG,T_FO WHERE REGISTER_ULANG.NO_REGISTRASI = T_FO_REG_ULANG.NO_REGISTRASI AND REGISTER_ULANG.TGL_REG = T_FO_REG_ULANG.TGL_REGISTRASI AND REGISTER_ULANG.NO_REGISTRASI = T_FO.NO_REGISTRASI AND REGISTER_ULANG.TGL_REG = T_FO.TGL_REGISTRASI AND REGISTER_ULANG.REG_KE IN T_FO_REG_ULANG.REG_KE AND TGL_REG BETWEEN TO_DATE( '$tgl1', 'yyyy-mm-dd' ) AND TO_DATE( '$tgl2', 'yyyy-mm-dd' ) AND REGISTER_ULANG.PERIJINAN = '$param2' AND ID_PAKET = '$param1') a WHERE ID_CKTR = ( SELECT ID_CKTR FROM ( SELECT * FROM REGISTER_ULANG WHERE REGISTER_ULANG.NO_REGISTRASI = a.NO_REGISTRASI ORDER BY ID_CKTR DESC ) WHERE ROWNUM = 1 ) ORDER BY NO_REGISTRASI ASC)";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_pending_imb_skrk($tgl1 ='',$tgl2 ='',$param1='',$param2=""){
        	$sql = "SELECT COUNT( NO_REGISTRASI ) AS JUMLAH FROM (SELECT DISTINCT * FROM(SELECT ID_CKTR,REGISTER_ULANG.NO_REGISTRASI,NAMA FROM REGISTER_ULANG,T_FO_REG_ULANG,T_FO WHERE REGISTER_ULANG.NO_REGISTRASI = T_FO_REG_ULANG.NO_REGISTRASI AND REGISTER_ULANG.TGL_REG = T_FO_REG_ULANG.TGL_REGISTRASI AND REGISTER_ULANG.NO_REGISTRASI = T_FO.NO_REGISTRASI AND REGISTER_ULANG.TGL_REG = T_FO.TGL_REGISTRASI AND REGISTER_ULANG.REG_KE NOT IN T_FO_REG_ULANG.REG_KE AND TGL_REG BETWEEN TO_DATE( '$tgl1', 'yyyy-mm-dd' ) AND TO_DATE( '$tgl2', 'yyyy-mm-dd' ) AND REGISTER_ULANG.PERIJINAN = '$param2' AND ID_PAKET = '$param1') a WHERE ID_CKTR = ( SELECT ID_CKTR FROM ( SELECT * FROM REGISTER_ULANG WHERE REGISTER_ULANG.NO_REGISTRASI = a.NO_REGISTRASI ORDER BY ID_CKTR DESC ) WHERE ROWNUM = 1 ) ORDER BY NO_REGISTRASI ASC)";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_selesai_imb_skrk_detail($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT * FROM VW_".$param2."_DETIL,T_FO WHERE VW_".$param2."_DETIL.NO_REGISTRASI = T_FO.NO_REGISTRASI AND VW_".$param2."_DETIL.TGL_REGISTRASI = T_FO.TGL_REGISTRASI AND VW_".$param2."_DETIL.STATUS LIKE 'PENGESAHAN SK' AND VW_".$param2."_DETIL.TGL_REGISTRASI BETWEEN TO_DATE( '$tgl1', 'yyyy-mm-dd' ) AND TO_DATE( '$tgl2', 'yyyy-mm-dd' ) AND ID_PAKET = '$param1' ORDER BY T_FO.NO_REGISTRASI";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_proses_imb_skrk_detail($tgl1 ='',$tgl2 ='',$param1='',$param2=""){
        	$sql = "SELECT DISTINCT * FROM (SELECT REGISTER_ULANG.NO_REGISTRASI,T_FO.TGL_REGISTRASI,NAMA,ALAMAT,NAMA_PERUSAHAAN, ALAMAT_PT,ID_CKTR FROM REGISTER_ULANG, T_FO_REG_ULANG, T_FO WHERE REGISTER_ULANG.NO_REGISTRASI = T_FO_REG_ULANG.NO_REGISTRASI AND REGISTER_ULANG.TGL_REG = T_FO_REG_ULANG.TGL_REGISTRASI AND REGISTER_ULANG.NO_REGISTRASI = T_FO.NO_REGISTRASI AND REGISTER_ULANG.TGL_REG = T_FO.TGL_REGISTRASI AND REGISTER_ULANG.REG_KE IN T_FO_REG_ULANG.REG_KE AND TGL_REG BETWEEN TO_DATE( '$tgl1', 'yyyy-mm-dd' ) AND TO_DATE( '$tgl2', 'yyyy-mm-dd' ) AND REGISTER_ULANG.PERIJINAN = '$param2' AND ID_PAKET = '$param1') a WHERE ID_CKTR = ( SELECT ID_CKTR FROM ( SELECT * FROM REGISTER_ULANG WHERE REGISTER_ULANG.NO_REGISTRASI = a.NO_REGISTRASI ORDER BY ID_CKTR DESC ) WHERE ROWNUM = 1 ) ORDER BY a.NO_REGISTRASI ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_pending_imb_skrk_detail($tgl1 ='',$tgl2 ='',$param1='',$param2=""){
        	$sql = "SELECT DISTINCT * FROM (SELECT REGISTER_ULANG.NO_REGISTRASI,T_FO.TGL_REGISTRASI,NAMA,ALAMAT,NAMA_PERUSAHAAN, ALAMAT_PT,ID_CKTR FROM REGISTER_ULANG, T_FO_REG_ULANG, T_FO WHERE REGISTER_ULANG.NO_REGISTRASI = T_FO_REG_ULANG.NO_REGISTRASI AND REGISTER_ULANG.TGL_REG = T_FO_REG_ULANG.TGL_REGISTRASI AND REGISTER_ULANG.NO_REGISTRASI = T_FO.NO_REGISTRASI AND REGISTER_ULANG.TGL_REG = T_FO.TGL_REGISTRASI AND REGISTER_ULANG.REG_KE NOT IN T_FO_REG_ULANG.REG_KE AND TGL_REG BETWEEN TO_DATE( '$tgl1', 'yyyy-mm-dd' ) AND TO_DATE( '$tgl2', 'yyyy-mm-dd' ) AND REGISTER_ULANG.PERIJINAN = '$param2' AND ID_PAKET = '$param1') a WHERE ID_CKTR = ( SELECT ID_CKTR FROM ( SELECT * FROM REGISTER_ULANG WHERE REGISTER_ULANG.NO_REGISTRASI = a.NO_REGISTRASI ORDER BY ID_CKTR DESC ) WHERE ROWNUM = 1 ) ORDER BY a.NO_REGISTRASI ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
	}
?>
