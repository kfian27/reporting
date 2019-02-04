<?php
	class Mlaporan extends CI_Model {

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
    	function get_tgl_masuk(){
        	$sql = "select DISTINCT TO_CHAR(TGL_OL, 'YYYY') as tahunnya FROM DATA_PEMOHON WHERE TGL_OL NOT LIKE ' ' ORDER BY tahunnya ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
    	function get_dashboard_pending($tahun='',$uptd='',$ijin=''){
        	$sql = "SELECT no_bulan, Bulan, Tahun, COUNT( Bulan ) as total FROM ( SELECT TO_CHAR( DATA_PEMOHON.TGL_OL, 'Month' ) AS Bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'mm' ) AS no_bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'yyyy' ) AS Tahun, KD_SKPD, NM_HEADER FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE DATA_PEMOHON.KD_IJIN = MIJIN.KD_IJIN AND ONLINE_SIMTAP.NO_OL = DATA_PEMOHON.NO_OL AND KD_SKPD like '%$uptd%' AND KD_SKPD NOT LIKE '1$uptd' AND NM_HEADER LIKE '%$ijin%' AND ID_ALUR_PROSES = 9 ) WHERE Tahun = '$tahun' GROUP BY no_bulan, Bulan, Tahun ORDER BY no_bulan ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_dashboard_selesai($tahun='',$uptd='',$ijin=''){
        	$sql = "SELECT no_bulan, Bulan, Tahun, COUNT( Bulan ) as total FROM ( SELECT TO_CHAR( DATA_PEMOHON.TGL_OL, 'Month' ) AS Bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'mm' ) AS no_bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'yyyy' ) AS Tahun, KD_SKPD, NM_HEADER FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE DATA_PEMOHON.KD_IJIN = MIJIN.KD_IJIN AND ONLINE_SIMTAP.NO_OL = DATA_PEMOHON.NO_OL AND KD_SKPD like '%$uptd%' AND KD_SKPD NOT LIKE '1$uptd' AND NM_HEADER LIKE '%$ijin%' AND ID_ALUR_PROSES IN (5, 6) AND STS_TOLAK IS NULL ) WHERE Tahun = '$tahun' GROUP BY no_bulan, Bulan, Tahun ORDER BY no_bulan ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_dashboard_proses($tahun='',$uptd='',$ijin=''){
        	$sql = "SELECT no_bulan, Bulan, Tahun, COUNT( Bulan ) as total FROM ( SELECT TO_CHAR( DATA_PEMOHON.TGL_OL, 'Month' ) AS Bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'mm' ) AS no_bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'yyyy' ) AS Tahun, KD_SKPD, NM_HEADER FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE DATA_PEMOHON.KD_IJIN = MIJIN.KD_IJIN AND ONLINE_SIMTAP.NO_OL = DATA_PEMOHON.NO_OL AND KD_SKPD like '%$uptd%' AND KD_SKPD NOT LIKE '1$uptd' AND NM_HEADER LIKE '%$ijin%' AND ID_ALUR_PROSES NOT IN (5, 6, 9, 100)) WHERE Tahun = '$tahun' GROUP BY no_bulan, Bulan, Tahun ORDER BY no_bulan ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_dashboard_tolak($tahun='',$uptd='',$ijin=''){
        	$sql = "SELECT no_bulan, Bulan, Tahun, COUNT( Bulan ) as total FROM ( SELECT TO_CHAR( DATA_PEMOHON.TGL_OL, 'Month' ) AS Bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'mm' ) AS no_bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'yyyy' ) AS Tahun, KD_SKPD, NM_HEADER FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE DATA_PEMOHON.KD_IJIN = MIJIN.KD_IJIN AND ONLINE_SIMTAP.NO_OL = DATA_PEMOHON.NO_OL AND KD_SKPD like '%$uptd%' AND KD_SKPD NOT LIKE '1$uptd' AND NM_HEADER LIKE '%$ijin%' AND STS_TOLAK IS NOT NULL AND ID_ALUR_PROSES != 100 ) WHERE Tahun = '$tahun' GROUP BY no_bulan, Bulan, Tahun ORDER BY no_bulan ASC";

			$query = $this->db->query($sql);
			return $query->result();
        } 
        function get_nm_skpd(){
        	$sql = "SELECT * FROM M_SKPD WHERE NAMA_SKPD != ' '";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_nm_ijin($param1){
        	$sql = "SELECT NM_HEADER AS NAMA_HEADER from MIJIN WHERE KD_SKPD like '%$param1%' AND KD_SKPD NOT LIKE '1$param1' GROUP BY NM_HEADER ORDER BY NM_HEADER";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_tanggal($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT NM_HEADER, COUNT(NM_HEADER) AS jumlahnya FROM (SELECT NM_HEADER, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND KD_SKPD LIKE '%$param1' AND KD_SKPD NOT LIKE '1$param1' AND ID_ALUR_PROSES != 100 ) where NM_HEADER!=' ' GROUP BY NM_HEADER ORDER BY NM_HEADER";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_details_tanggal($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as jumlahnya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND ID_ALUR_PROSES != 100) GROUP BY NAMA_IJIN,ID ORDER BY ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_pending($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as pendingnya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND ID_ALUR_PROSES = 9) where ID = '$param2' GROUP BY NAMA_IJIN,ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_proses($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as prosesnya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND ID_ALUR_PROSES NOT IN (5, 6, 9, 100)) where ID = '$param2' GROUP BY NAMA_IJIN,ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_tolak($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as tolaknya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND STS_TOLAK IS NOT NULL AND ID_ALUR_PROSES != 100) where ID = '$param2' GROUP BY NAMA_IJIN,ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_selesai($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as selesainya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND ID_ALUR_PROSES IN (5, 6) AND STS_TOLAK IS NULL ) where ID = '$param2' GROUP BY NAMA_IJIN,ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_pending_details($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT MIJIN.KD_IJIN as ID, NAMA_IJIN, DATA_PEMOHON.NO_OL, DATA_PEMOHON.TGL_OL, NAMAPEMOHON, NAMA_ALUR_PROSES, ALAMATPEMOHON, NAMA_PT,ALAMAT_PT, WAKTU, NO_SK FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP, TEMPLATE_M_ALUR_PROSES WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND ONLINE_SIMTAP.ID_ALUR_PROSES = TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND MIJIN.KD_IJIN = '$param1' AND ONLINE_SIMTAP.ID_ALUR_PROSES = 9";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_proses_details($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT MIJIN.KD_IJIN as ID, NAMA_IJIN, DATA_PEMOHON.NO_OL, DATA_PEMOHON.TGL_OL, NAMAPEMOHON, NAMA_ALUR_PROSES, ALAMATPEMOHON, NAMA_PT,ALAMAT_PT, WAKTU, NO_SK FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP, TEMPLATE_M_ALUR_PROSES WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND ONLINE_SIMTAP.ID_ALUR_PROSES = TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND MIJIN.KD_IJIN = '$param1' AND ONLINE_SIMTAP.ID_ALUR_PROSES NOT IN (5, 6, 9, 100)";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_tolak_details($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT MIJIN.KD_IJIN as ID, NAMA_IJIN, DATA_PEMOHON.NO_OL, DATA_PEMOHON.TGL_OL, NAMAPEMOHON, NAMA_ALUR_PROSES, ALAMATPEMOHON, NAMA_PT,ALAMAT_PT, WAKTU, NO_SK FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP, TEMPLATE_M_ALUR_PROSES WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND ONLINE_SIMTAP.ID_ALUR_PROSES = TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND MIJIN.KD_IJIN = '$param1' AND STS_TOLAK IS NOT NULL AND ONLINE_SIMTAP.ID_ALUR_PROSES != 100";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_selesai_details($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT MIJIN.KD_IJIN as ID, NAMA_IJIN, DATA_PEMOHON.NO_OL, DATA_PEMOHON.TGL_OL, NAMAPEMOHON, NAMA_ALUR_PROSES, ALAMATPEMOHON, NAMA_PT,ALAMAT_PT, WAKTU, NO_SK FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP, TEMPLATE_M_ALUR_PROSES WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND ONLINE_SIMTAP.ID_ALUR_PROSES = TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND MIJIN.KD_IJIN = '$param1' AND ONLINE_SIMTAP.ID_ALUR_PROSES IN (5, 6) AND STS_TOLAK IS NULL";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_histori_details($param1=''){
        	$sql = "SELECT ONLINE_SIMTAP.NO_OL, ONLINE_SIMTAP.NAMAPEMOHON, TEMPLATE_T_ALUR_PROSES.ID_USER, TEMPLATE_M_PETUGAS_LOKAL.NAMA, TEMPLATE_T_ALUR_PROSES.TGL_PROSES, TEMPLATE_T_ALUR_PROSES.KETERANGAN, TEMPLATE_T_ALUR_PROSES.ID_TUJUAN_ALUR_PROSES, TEMPLATE_M_ALUR_PROSES.NAMA_ALUR_PROSES, TEMPLATE_T_ALUR_PROSES.TGL_DISPOSISI, TEMPLATE_T_ALUR_PROSES.STATUS_PROSES FROM ONLINE_SIMTAP, TEMPLATE_T_ALUR_PROSES, TEMPLATE_M_ALUR_PROSES, TEMPLATE_M_PETUGAS_LOKAL WHERE ONLINE_SIMTAP.NO_OL = TEMPLATE_T_ALUR_PROSES.NO_OL AND TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES = TEMPLATE_T_ALUR_PROSES.ID_TUJUAN_ALUR_PROSES AND TEMPLATE_T_ALUR_PROSES.ID_USER = TEMPLATE_M_PETUGAS_LOKAL.ID_PETUGAS AND TEMPLATE_T_ALUR_PROSES.NO_OL = '$param1' ORDER BY TGL_PROSES DESC";

			$query = $this->db->query($sql);
			return $query->result();
        }
	}
?>
