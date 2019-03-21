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
        function get_total_parsial_now(){
            $sql = "SELECT COUNT (NM_HEADER) AS JUMLAHNYA FROM (SELECT NM_HEADER, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND TO_CHAR (DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR (ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE (TO_CHAR(SYSDATE,'yyyy-mm-dd'), 'yyyy-mm-dd')AND TO_DATE (TO_CHAR(SYSDATE,'yyyy-mm-dd'), 'yyyy-mm-dd')   AND KD_SKPD LIKE '%' AND ID_ALUR_PROSES != 100) WHERE NM_HEADER != ' '";

            $query = $this->db->query($sql);
            return $query->result();
        }
        function get_detail_parsial_now(){
            $sql = "SELECT NM_HEADER,COUNT (NM_HEADER) AS JUMLAHNYA FROM (SELECT NM_HEADER, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND TO_CHAR (DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR (ONLINE_SIMTAP.TGL_OL,'ddmmyyyy')AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE (TO_CHAR(SYSDATE,'yyyy-mm-dd'), 'yyyy-mm-dd')AND TO_DATE (TO_CHAR(SYSDATE,'yyyy-mm-dd'), 'yyyy-mm-dd')   AND KD_SKPD LIKE '%' AND ID_ALUR_PROSES != 100) WHERE NM_HEADER != ' ' GROUP BY NM_HEADER";

            $query = $this->db->query($sql);
            return $query->result();
        }
        function get_total_paket_now(){
            $sql = "SELECT COUNT (KETERANGAN) AS JUMLAHNYA FROM (SELECT M_PAKET.KETERANGAN,T_FO.TGL_REGISTRASI FROM M_PAKET,T_FO WHERE M_PAKET.ID_PAKET = T_FO.ID_PAKET  AND T_FO.TGL_REGISTRASI BETWEEN TO_DATE (TO_CHAR(SYSDATE,'yyyy-mm-dd'), 'yyyy-mm-dd') AND TO_DATE (TO_CHAR(SYSDATE,'yyyy-mm-dd'), 'yyyy-mm-dd') AND M_PAKET.AKTIF = '1')";

            $query = $this->db->query($sql);
            return $query->result();
        }
        function get_detail_paket_now(){
            $sql = "SELECT KETERANGAN,COUNT (KETERANGAN) AS JUMLAHNYA FROM (SELECT M_PAKET.KETERANGAN,T_FO.TGL_REGISTRASI FROM M_PAKET,T_FO WHERE M_PAKET.ID_PAKET = T_FO.ID_PAKET  AND T_FO.TGL_REGISTRASI BETWEEN TO_DATE (TO_CHAR(SYSDATE,'yyyy-mm-dd'), 'yyyy-mm-dd') AND TO_DATE (TO_CHAR(SYSDATE,'yyyy-mm-dd'), 'yyyy-mm-dd') AND M_PAKET.AKTIF = '1') GROUP BY KETERANGAN";

            $query = $this->db->query($sql);
            return $query->result();
        }
    	function get_tgl_masuk(){
        	$sql = "select DISTINCT TO_CHAR(TGL_OL, 'YYYY') as tahunnya FROM DATA_PEMOHON WHERE TGL_OL NOT LIKE ' ' ORDER BY tahunnya ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
    	function get_dashboard_pending($tahun='',$uptd='',$ijin='',$bulan=''){
        	$sql = "SELECT no_bulan, Bulan, Tahun, COUNT( Bulan ) as total FROM ( SELECT TO_CHAR( DATA_PEMOHON.TGL_OL, 'Month' ) AS Bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'mm' ) AS no_bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'yyyy' ) AS Tahun, KD_SKPD, NM_HEADER FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE DATA_PEMOHON.KD_IJIN = MIJIN.KD_IJIN AND ONLINE_SIMTAP.NO_OL = DATA_PEMOHON.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND KD_SKPD like '%$uptd%' AND KD_SKPD NOT LIKE '1$uptd' AND KD_SKPD NOT LIKE '2$uptd' AND NM_HEADER LIKE '%$ijin%' AND ID_ALUR_PROSES = 9 AND STS_TOLAK IS NULL) WHERE Tahun = '$tahun' AND no_bulan like '%$bulan' AND no_bulan NOT like '1$bulan' GROUP BY no_bulan, Bulan, Tahun ORDER BY no_bulan ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_dashboard_selesai($tahun='',$uptd='',$ijin='',$bulan=''){
        	$sql = "SELECT no_bulan, Bulan, Tahun, COUNT( Bulan ) as total FROM ( SELECT TO_CHAR( DATA_PEMOHON.TGL_OL, 'Month' ) AS Bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'mm' ) AS no_bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'yyyy' ) AS Tahun, KD_SKPD, NM_HEADER FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE DATA_PEMOHON.KD_IJIN = MIJIN.KD_IJIN AND ONLINE_SIMTAP.NO_OL = DATA_PEMOHON.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND KD_SKPD like '%$uptd%' AND KD_SKPD NOT LIKE '1$uptd' AND KD_SKPD NOT LIKE '2$uptd' AND NM_HEADER LIKE '%$ijin%' AND ID_ALUR_PROSES IN (5, 6) AND STS_TOLAK IS NULL ) WHERE Tahun = '$tahun' AND no_bulan like '%$bulan' AND no_bulan NOT like '1$bulan' GROUP BY no_bulan, Bulan, Tahun ORDER BY no_bulan ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_dashboard_proses($tahun='',$uptd='',$ijin='',$bulan=''){
        	$sql = "SELECT no_bulan, Bulan, Tahun, COUNT( Bulan ) as total FROM ( SELECT TO_CHAR( DATA_PEMOHON.TGL_OL, 'Month' ) AS Bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'mm' ) AS no_bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'yyyy' ) AS Tahun, KD_SKPD, NM_HEADER FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE DATA_PEMOHON.KD_IJIN = MIJIN.KD_IJIN AND ONLINE_SIMTAP.NO_OL = DATA_PEMOHON.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND KD_SKPD like '%$uptd%' AND KD_SKPD NOT LIKE '1$uptd' AND KD_SKPD NOT LIKE '2$uptd' AND NM_HEADER LIKE '%$ijin%' AND ID_ALUR_PROSES NOT IN (5, 6, 9, 100) AND STS_TOLAK IS NULL) WHERE Tahun = '$tahun' AND no_bulan like '%$bulan' AND no_bulan NOT like '1$bulan' GROUP BY no_bulan, Bulan, Tahun ORDER BY no_bulan ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_dashboard_tolak($tahun='',$uptd='',$ijin='',$bulan=''){
        	$sql = "SELECT no_bulan, Bulan, Tahun, COUNT( Bulan ) as total FROM ( SELECT TO_CHAR( DATA_PEMOHON.TGL_OL, 'Month' ) AS Bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'mm' ) AS no_bulan, TO_CHAR( DATA_PEMOHON.TGL_OL, 'yyyy' ) AS Tahun, KD_SKPD, NM_HEADER FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE DATA_PEMOHON.KD_IJIN = MIJIN.KD_IJIN AND ONLINE_SIMTAP.NO_OL = DATA_PEMOHON.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND KD_SKPD like '%$uptd%' AND KD_SKPD NOT LIKE '1$uptd' AND KD_SKPD NOT LIKE '2$uptd' AND NM_HEADER LIKE '%$ijin%' AND STS_TOLAK IS NOT NULL AND ID_ALUR_PROSES != 100 ) WHERE Tahun = '$tahun' AND no_bulan like '%$bulan' AND no_bulan NOT like '1$bulan' GROUP BY no_bulan, Bulan, Tahun ORDER BY no_bulan ASC";

			$query = $this->db->query($sql);
			return $query->result();
        } 
        function get_nm_skpd(){
        	$sql = "SELECT * FROM M_SKPD WHERE NAMA_SKPD != ' '";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_nm_ijin($param1){
        	$sql = "SELECT NM_HEADER AS NAMA_HEADER from MIJIN WHERE KD_SKPD like '%$param1%' AND KD_SKPD NOT LIKE '1$param1' AND KD_SKPD NOT LIKE '2$param1' GROUP BY NM_HEADER ORDER BY NM_HEADER";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_tanggal($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT NM_HEADER, COUNT(NM_HEADER) AS jumlahnya FROM (SELECT NM_HEADER, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND KD_SKPD LIKE '%$param1' AND KD_SKPD NOT LIKE '1$param1' AND KD_SKPD NOT LIKE '2$param1' AND ID_ALUR_PROSES != 100 ) where NM_HEADER!=' ' GROUP BY NM_HEADER ORDER BY NM_HEADER";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_details_tanggal($tgl1 ='',$tgl2 ='',$param1='',$param2){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as jumlahnya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND KD_SKPD LIKE '%$param2' AND KD_SKPD NOT LIKE '1$param2' AND KD_SKPD NOT LIKE '2$param2' AND ID_ALUR_PROSES != 100) GROUP BY NAMA_IJIN,ID ORDER BY ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_pie_proses($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT NAMA_ALUR_PROSES_DINAS, COUNT(NAMA_ALUR_PROSES_DINAS) AS Jumlah FROM (SELECT NAMA_ALUR_PROSES_DINAS FROM DATA_PEMOHON, ONLINE_SIMTAP, MIJIN, TEMPLATE_M_ALUR_PROSES WHERE DATA_PEMOHON.KD_IJIN = MIJIN.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND ONLINE_SIMTAP.ID_ALUR_PROSES = TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd' ) AND TO_DATE('$tgl2', 'yyyy-mm-dd' ) AND NM_HEADER LIKE '%$param1%' AND ONLINE_SIMTAP.ID_ALUR_PROSES NOT IN (100,5,6,9) AND STS_TOLAK IS NULL) GROUP BY NAMA_ALUR_PROSES_DINAS";

        	$query = $this->db->query($sql);
			return $query->result();
        }
        function get_pending($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as pendingnya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND ID_ALUR_PROSES = 9 AND STS_TOLAK IS NULL) where ID = '$param2' GROUP BY NAMA_IJIN,ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_proses($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as prosesnya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND ID_ALUR_PROSES NOT IN (5, 6, 9, 100) AND STS_TOLAK IS NULL) where ID = '$param2' GROUP BY NAMA_IJIN,ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_tolak($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as tolaknya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND STS_TOLAK IS NOT NULL AND ID_ALUR_PROSES != 100) where ID = '$param2' GROUP BY NAMA_IJIN,ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_selesai($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as selesainya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND ID_ALUR_PROSES IN (5, 6) AND STS_TOLAK IS NULL ) where ID = '$param2' GROUP BY NAMA_IJIN,ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_pending_details($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT MIJIN.KD_IJIN as ID, NAMA_IJIN, DATA_PEMOHON.NO_OL, DATA_PEMOHON.TGL_OL, NAMAPEMOHON, NAMA_ALUR_PROSES, ALAMATPEMOHON, NAMA_PT,ALAMAT_PT, WAKTU, NO_SK FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP, TEMPLATE_M_ALUR_PROSES WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND ONLINE_SIMTAP.ID_ALUR_PROSES = TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND MIJIN.KD_IJIN = '$param1' AND ONLINE_SIMTAP.ID_ALUR_PROSES = 9 AND STS_TOLAK IS NULL ORDER BY TGL_OL ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_nama_proses($param1=''){
        	$sql = "SELECT DISTINCT NAMA_ALUR_PROSES FROM TEMPLATE_D_ALUR_PROSES, TEMPLATE_M_ALUR_PROSES WHERE TEMPLATE_D_ALUR_PROSES.ID_ALUR_PROSES = TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES AND ID_PERIJINAN = '$param1' AND URUT >= 1 AND URUT <= ( SELECT MAX (URUT) - 2 FROM TEMPLATE_D_ALUR_PROSES, TEMPLATE_M_ALUR_PROSES WHERE TEMPLATE_D_ALUR_PROSES.ID_ALUR_PROSES = TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES AND ID_PERIJINAN = '$param1' ) ORDER BY NAMA_ALUR_PROSES ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_proses_details($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT MIJIN.KD_IJIN as ID, NAMA_IJIN, DATA_PEMOHON.NO_OL, DATA_PEMOHON.TGL_OL, NAMAPEMOHON, NAMA_ALUR_PROSES, ALAMATPEMOHON, NAMA_PT,ALAMAT_PT, WAKTU, NO_SK FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP, TEMPLATE_M_ALUR_PROSES WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND ONLINE_SIMTAP.ID_ALUR_PROSES = TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND MIJIN.KD_IJIN = '$param1' AND ONLINE_SIMTAP.ID_ALUR_PROSES NOT IN (5, 6, 9, 100) AND STS_TOLAK IS NULL ORDER BY TGL_OL ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_tolak_details($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT MIJIN.KD_IJIN as ID, NAMA_IJIN, DATA_PEMOHON.NO_OL, DATA_PEMOHON.TGL_OL, NAMAPEMOHON, NAMA_ALUR_PROSES, ALAMATPEMOHON, NAMA_PT,ALAMAT_PT, WAKTU, NO_SK FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP, TEMPLATE_M_ALUR_PROSES WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND ONLINE_SIMTAP.ID_ALUR_PROSES = TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND MIJIN.KD_IJIN = '$param1' AND STS_TOLAK IS NOT NULL AND ONLINE_SIMTAP.ID_ALUR_PROSES != 100 ORDER BY TGL_OL ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_selesai_details($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT MIJIN.KD_IJIN as ID, NAMA_IJIN, DATA_PEMOHON.NO_OL, DATA_PEMOHON.TGL_OL, NAMAPEMOHON, NAMA_ALUR_PROSES, ALAMATPEMOHON, NAMA_PT,ALAMAT_PT, WAKTU, NO_SK FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP, TEMPLATE_M_ALUR_PROSES WHERE MIJIN.KD_IJIN = DATA_PEMOHON.KD_IJIN AND DATA_PEMOHON.NO_OL = ONLINE_SIMTAP.NO_OL AND TO_CHAR(DATA_PEMOHON.TGL_OL,'ddmmyyyy') = TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') AND ONLINE_SIMTAP.ID_ALUR_PROSES = TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND MIJIN.KD_IJIN = '$param1' AND ONLINE_SIMTAP.ID_ALUR_PROSES IN (5, 6) AND STS_TOLAK IS NULL ORDER BY TGL_OL ASC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_histori_details($tgl1='',$param1=''){
        	$sql = "SELECT ONLINE_SIMTAP.NO_OL,	ONLINE_SIMTAP.NAMAPEMOHON, TEMPLATE_M_PETUGAS_LOKAL.NAMA, TEMPLATE_T_ALUR_PROSES.TGL_PROSES, TEMPLATE_M_ALUR_PROSES.NAMA_ALUR_PROSES, TEMPLATE_T_ALUR_PROSES.KETERANGAN FROM ONLINE_SIMTAP, TEMPLATE_T_ALUR_PROSES, TEMPLATE_M_ALUR_PROSES, TEMPLATE_M_PETUGAS_LOKAL WHERE ONLINE_SIMTAP.NO_OL = TEMPLATE_T_ALUR_PROSES.NO_OL AND TO_CHAR(ONLINE_SIMTAP.TGL_OL,'ddmmyyyy') = TO_CHAR(TEMPLATE_T_ALUR_PROSES.TGL_OL,'ddmmyyyy') AND TEMPLATE_M_ALUR_PROSES.ID_ALUR_PROSES = TEMPLATE_T_ALUR_PROSES.ID_TUJUAN_ALUR_PROSES AND TEMPLATE_T_ALUR_PROSES.ID_USER = TEMPLATE_M_PETUGAS_LOKAL.ID_PETUGAS AND TEMPLATE_T_ALUR_PROSES.TGL_OL = TO_DATE ('$tgl1', 'yyyy-mm-dd') AND TEMPLATE_T_ALUR_PROSES.NO_OL = '$param1' ORDER BY TGL_PROSES DESC";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_waktu_proses($tgl1='',$tgl2='',$param1=''){
        	$sql = "SELECT HARI - ( SELECT COUNT( TANGGAL ) FROM HARI_LIBUR WHERE TANGGAL BETWEEN TGL_PROSES AND SEKARANG ) AS TOTAL FROM (SELECT TGL_PROSES, SYSDATE AS SEKARANG, TO_DATE( TO_CHAR( SYSDATE, 'DD-MM-YYYY' ), 'DD-MM-YYYY' ) - TO_DATE( TO_CHAR( TGL_PROSES, 'DD-MM-YYYY' ), 'DD-MM-YYYY' ) AS HARI FROM TEMPLATE_T_ALUR_PROSES WHERE NO_OL = '$param1' AND TGL_PROSES = (SELECT * FROM ( SELECT TGL_PROSES FROM TEMPLATE_T_ALUR_PROSES WHERE NO_OL = '$param1' AND TGL_OL BETWEEN TO_DATE( '$tgl1', 'yyyy-mm-dd' ) AND TO_DATE( '$tgl2', 'yyyy-mm-dd' ) AND ID_TUJUAN_ALUR_PROSES = '2' ORDER BY TGL_PROSES DESC) WHERE ROWNUM = 1))";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_waktu_selesai($tgl1='',$tgl2='',$param1=''){
        	$sql = "SELECT TO_DATE( TO_CHAR( tgl_terbit, 'DD-MM-YYYY' ), 'DD-MM-YYYY' ) - TO_DATE( TO_CHAR( TGL_PROSES, 'DD-MM-YYYY' ), 'DD-MM-YYYY' ) - ( SELECT COUNT( TANGGAL ) FROM HARI_LIBUR WHERE TANGGAL BETWEEN TGL_PROSES AND tgl_terbit ) AS TOTAL FROM (SELECT TGL_PROSES, ( SELECT * FROM ( SELECT TGL_PROSES FROM TEMPLATE_T_ALUR_PROSES WHERE ID_TUJUAN_ALUR_PROSES = 5 AND NO_OL = '$param1' ORDER BY TGL_PROSES DESC ) WHERE ROWNUM = 1 ) AS tgl_terbit FROM TEMPLATE_T_ALUR_PROSES WHERE TEMPLATE_T_ALUR_PROSES.NO_OL = '$param1' AND TGL_PROSES = (SELECT * FROM (SELECT TGL_PROSES FROM TEMPLATE_T_ALUR_PROSES WHERE NO_OL = '$param1' AND TGL_OL BETWEEN TO_DATE( '$tgl1', 'yyyy-mm-dd' )AND TO_DATE( '$tgl2', 'yyyy-mm-dd' ) AND ID_TUJUAN_ALUR_PROSES = '2' ORDER BY TGL_PROSES DESC ) WHERE ROWNUM = 1))WHERE ROWNUM = 1";

			$query = $this->db->query($sql);
			return $query->result();
        }
	}
?>
