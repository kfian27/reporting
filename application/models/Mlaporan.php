<?php
	class Mlaporan extends CI_Model {

		function __construct() {
			// Call the Model constructor
			parent:: __construct();
			$this->db = $this->load->database('report', TRUE);
			//set waktu yang digunakan ke zona jakarta
			//$this->db->query("SET time_zone='Asia/Jakarta'");
		}

        function get_nm_skpd(){
        	$sql = "SELECT * FROM M_SKPD WHERE NAMA_SKPD != ' '";

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
        	$sql = "SELECT ONLINE_SIMTAP.NO_OL, ONLINE_SIMTAP.NAMAPEMOHON, TEMPLATE_T_ALUR_PROSES.ID_USER, TEMPLATE_M_PETUGAS_LOKAL.NAMA, TEMPLATE_T_ALUR_PROSES.TGL_PROSES, TEMPLATE_T_ALUR_PROSES.KETERANGAN, TEMPLATE_T_ALUR_PROSES.ID_TUJUAN_ALUR_PROSES, TEMPLATE_M_ALUR_PROSES.NAMA_ALUR_PROSES, TEMPLATE_T_ALUR_PROSES.TGL_DISPOSISI, TEMPLATE_T_ALUR_PROSES.STATUS_PROSES FROM ONLINE_SIMTAP, TEMPLATE_T_ALUR_PROSES, TEMPLATE_M_ALUR_PROSES, TEMPLATE_M_PETUGAS_LOKAL WHERE ONLINE_SIMTAP.NO_OL = TEMPLATE_T_ALUR_PROSES.NO_OL AND TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES = TEMPLATE_T_ALUR_PROSES.ID_TUJUAN_ALUR_PROSES AND TEMPLATE_T_ALUR_PROSES.ID_USER = TEMPLATE_M_PETUGAS_LOKAL.ID_PETUGAS AND TEMPLATE_T_ALUR_PROSES.NO_OL = '$param1'";

			$query = $this->db->query($sql);
			return $query->result();
        }
	}
?>
