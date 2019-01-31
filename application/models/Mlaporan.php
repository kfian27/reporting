<?php
	class Mlaporan extends CI_Model {

		function __construct() {
			// Call the Model constructor
			parent:: __construct();
			$this->db = $this->load->database('report', TRUE);
			//set waktu yang digunakan ke zona jakarta
			//$this->db->query("SET time_zone='Asia/Jakarta'");
		}

		function harian($where1,$where2,$where3,$where4,$where5)
		{
			$sql = "select * from penjualan where retailer_country like '".$where1."%' and
			 order_method_type like '".$where2."%' AND retailer_type like '".$where3."%' and 
			 product_line like '".$where4."%' and year LIKE '".$where5."%' LIMIT 250";

			$query = $this->db->query($sql);
			return $query->result();
        }

        function get_nm_skpd(){
        	$sql = "SELECT * FROM M_SKPD WHERE NAMA_SKPD != ' '";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_tanggal($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT NM_HEADER, COUNT(NM_HEADER) AS jumlahnya FROM (SELECT NM_HEADER, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MONITORINGSSW.MIJIN.KD_IJIN = MONITORINGSSW.DATA_PEMOHON.KD_IJIN AND MONITORINGSSW.DATA_PEMOHON.NO_OL = MONITORINGSSW.ONLINE_SIMTAP.NO_OL AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND KD_SKPD LIKE '%$param1' AND KD_SKPD NOT LIKE '1$param1' AND ID_ALUR_PROSES != 100 ) where NM_HEADER!=' ' GROUP BY NM_HEADER ORDER BY NM_HEADER";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_details_tanggal($tgl1 ='',$tgl2 ='',$param1=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as jumlahnya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MONITORINGSSW.MIJIN.KD_IJIN = MONITORINGSSW.DATA_PEMOHON.KD_IJIN AND MONITORINGSSW.DATA_PEMOHON.NO_OL = MONITORINGSSW.ONLINE_SIMTAP.NO_OL AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND ID_ALUR_PROSES != 100) GROUP BY NAMA_IJIN,ID ORDER BY ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_pending($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as pendingnya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MONITORINGSSW.MIJIN.KD_IJIN = MONITORINGSSW.DATA_PEMOHON.KD_IJIN AND MONITORINGSSW.DATA_PEMOHON.NO_OL = MONITORINGSSW.ONLINE_SIMTAP.NO_OL AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND ID_ALUR_PROSES = 9) where ID = '$param2' GROUP BY NAMA_IJIN,ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_proses($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as prosesnya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MONITORINGSSW.MIJIN.KD_IJIN = MONITORINGSSW.DATA_PEMOHON.KD_IJIN AND MONITORINGSSW.DATA_PEMOHON.NO_OL = MONITORINGSSW.ONLINE_SIMTAP.NO_OL AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND ID_ALUR_PROSES NOT IN (5, 6, 9, 100)) where ID = '$param2' GROUP BY NAMA_IJIN,ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_tolak($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as tolaknya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MONITORINGSSW.MIJIN.KD_IJIN = MONITORINGSSW.DATA_PEMOHON.KD_IJIN AND MONITORINGSSW.DATA_PEMOHON.NO_OL = MONITORINGSSW.ONLINE_SIMTAP.NO_OL AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND STS_TOLAK IS NOT NULL AND ID_ALUR_PROSES != 100) where ID = '$param2' GROUP BY NAMA_IJIN,ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_selesai($tgl1 ='',$tgl2 ='',$param1='',$param2=''){
        	$sql = "SELECT ID,NAMA_IJIN, COUNT(NAMA_IJIN) as selesainya FROM (SELECT MIJIN.KD_IJIN as ID,DATA_PEMOHON.KD_IJIN, NAMA_IJIN, DATA_PEMOHON.TGL_OL, KD_SKPD FROM DATA_PEMOHON, MIJIN, ONLINE_SIMTAP WHERE MONITORINGSSW.MIJIN.KD_IJIN = MONITORINGSSW.DATA_PEMOHON.KD_IJIN AND MONITORINGSSW.DATA_PEMOHON.NO_OL = MONITORINGSSW.ONLINE_SIMTAP.NO_OL AND DATA_PEMOHON.TGL_OL BETWEEN TO_DATE('$tgl1', 'yyyy-mm-dd') AND TO_DATE('$tgl2', 'yyyy-mm-dd') AND NM_HEADER LIKE '%$param1%' AND ID_ALUR_PROSES IN (5, 6) AND STS_TOLAK IS NULL ) where ID = '$param2' GROUP BY NAMA_IJIN,ID";

			$query = $this->db->query($sql);
			return $query->result();
        }
        function get_hari($tanggal)
        {
        	$sql = "SELECT detail_transaksi.DT_ID,
			transaksi.TR_TGL,
			transaksi.TR_TGLBYR,
			kain.KN_NAMA,
			kain.KN_HARGA,
			ekspedisi.ESK_NAMA,
			karyawan.KRY_NAMA,
			pelanggan.PLG_NAMA,
			detail_transaksi.DT_QTY,
			detail_transaksi.DT_HARGA,
			transaksi.TR_ONGKIR,
			transaksi.TR_STATUS
			FROM
			detail_transaksi
			INNER JOIN transaksi ON detail_transaksi.TR_ID = transaksi.TR_ID
			INNER JOIN kain ON detail_transaksi.KN_ID = kain.KN_ID
			INNER JOIN ekspedisi ON transaksi.ESK_ID = ekspedisi.ESK_ID
			INNER JOIN karyawan ON transaksi.KRY_ID = karyawan.KRY_ID
			INNER JOIN pelanggan ON transaksi.PLG_ID = pelanggan.PLG_ID
			WHERE TR_TGL LIKE '".$tanggal."%' ORDER BY detail_transaksi.DT_ID ASC
			LIMIT 100";

			$query = $this->db->query($sql);
        	$output = '<tr></tr>';
			foreach ($query->result() as $row)
			{
				if ($row->TR_STATUS == 1) {
                    $output .= '<tr><td>'.$row->TR_TGL.'</td><td>'.$row->TR_TGLBYR.'</td><td>'.$row->KN_NAMA.'</td><td>'.$row->DT_QTY.'</td><td>'.$row->DT_HARGA.'</td><td>'.$row->KRY_NAMA.'</td><td>'.$row->PLG_NAMA.'</td><td>'.$row->ESK_NAMA.'</td><td>Menunggu Pembayaran</td></tr>';
                } elseif ($row->TR_STATUS == 2) {
					$output .= '<tr><td>'.$row->TR_TGL.'</td><td>'.$row->TR_TGLBYR.'</td><td>'.$row->KN_NAMA.'</td><td>'.$row->DT_QTY.'</td><td>'.$row->DT_HARGA.'</td><td>'.$row->KRY_NAMA.'</td><td>'.$row->PLG_NAMA.'</td><td>'.$row->ESK_NAMA.'</td><td>Terbayar</td></tr>';
				} elseif ($row->TR_STATUS == 3) {
					$output .= '<tr><td>'.$row->TR_TGL.'</td><td>'.$row->TR_TGLBYR.'</td><td>'.$row->KN_NAMA.'</td><td>'.$row->DT_QTY.'</td><td>'.$row->DT_HARGA.'</td><td>'.$row->KRY_NAMA.'</td><td>'.$row->PLG_NAMA.'</td><td>'.$row->ESK_NAMA.'</td><td>Proses Pengiriman</td></tr>';
				} elseif ($row->TR_STATUS == 4) {
					$output .= '<tr><td>'.$row->TR_TGL.'</td><td>'.$row->TR_TGLBYR.'</td><td>'.$row->KN_NAMA.'</td><td>'.$row->DT_QTY.'</td><td>'.$row->DT_HARGA.'</td><td>'.$row->KRY_NAMA.'</td><td>'.$row->PLG_NAMA.'</td><td>'.$row->ESK_NAMA.'</td><td>Terkirim</td></tr>';
				} elseif ($row->TR_STATUS == 5) {
					$output .= '<tr><td>'.$row->TR_TGL.'</td><td>'.$row->TR_TGLBYR.'</td><td>'.$row->KN_NAMA.'</td><td>'.$row->DT_QTY.'</td><td>'.$row->DT_HARGA.'</td><td>'.$row->KRY_NAMA.'</td><td>'.$row->PLG_NAMA.'</td><td>'.$row->ESK_NAMA.'</td><td>Dibatalkan</td></tr>';
				}
				
			}

			return $output;
        }

        function mingguan($parm1, $parm2)
		{
			$sql = "SELECT
			detail_transaksi.DT_ID,
			transaksi.TR_TGL,
			transaksi.TR_TGLBYR,
			kain.KN_NAMA,
			kain.KN_HARGA,
			ekspedisi.ESK_NAMA,
			karyawan.KRY_NAMA,
			pelanggan.PLG_NAMA,
			detail_transaksi.DT_QTY,
			detail_transaksi.DT_HARGA,
			transaksi.TR_ONGKIR,
			transaksi.TR_STATUS
			FROM
			detail_transaksi
			INNER JOIN transaksi ON detail_transaksi.TR_ID = transaksi.TR_ID
			INNER JOIN kain ON detail_transaksi.KN_ID = kain.KN_ID
			INNER JOIN ekspedisi ON transaksi.ESK_ID = ekspedisi.ESK_ID
			INNER JOIN karyawan ON transaksi.KRY_ID = karyawan.KRY_ID
			INNER JOIN pelanggan ON transaksi.PLG_ID = pelanggan.PLG_ID
			WHERE TR_TGL >= '".$parm1."' AND TR_TGL <= ".$parm2." 
			ORDER BY detail_transaksi.DT_ID ASC LIMIT 100";

			$query = $this->db->query($sql);
			return $query->result();
        }

        function get_minggu($parm1, $parm2)
        {
        	$sql = "SELECT
			detail_transaksi.DT_ID,
			transaksi.TR_TGL,
			transaksi.TR_TGLBYR,
			kain.KN_NAMA,
			kain.KN_HARGA,
			ekspedisi.ESK_NAMA,
			karyawan.KRY_NAMA,
			pelanggan.PLG_NAMA,
			detail_transaksi.DT_QTY,
			detail_transaksi.DT_HARGA,
			transaksi.TR_ONGKIR,
			transaksi.TR_STATUS
			FROM
			detail_transaksi
			INNER JOIN transaksi ON detail_transaksi.TR_ID = transaksi.TR_ID
			INNER JOIN kain ON detail_transaksi.KN_ID = kain.KN_ID
			INNER JOIN ekspedisi ON transaksi.ESK_ID = ekspedisi.ESK_ID
			INNER JOIN karyawan ON transaksi.KRY_ID = karyawan.KRY_ID
			INNER JOIN pelanggan ON transaksi.PLG_ID = pelanggan.PLG_ID
			WHERE TR_TGL >= '".$parm1."' AND TR_TGL <= ".$parm2." ORDER BY detail_transaksi.DT_ID ASC
			LIMIT 100";

			$query = $this->db->query($sql);
        	$output = '<tr></tr>';
			foreach ($query->result() as $row)
			{
				if ($row->TR_STATUS == 1) {
                    $output .= '<tr><td>'.$row->TR_TGL.'</td><td>'.$row->TR_TGLBYR.'</td><td>'.$row->KN_NAMA.'</td><td>'.$row->DT_QTY.'</td><td>'.$row->DT_HARGA.'</td><td>'.$row->KRY_NAMA.'</td><td>'.$row->PLG_NAMA.'</td><td>'.$row->ESK_NAMA.'</td><td>Menunggu Pembayaran</td></tr>';
                } elseif ($row->TR_STATUS == 2) {
					$output .= '<tr><td>'.$row->TR_TGL.'</td><td>'.$row->TR_TGLBYR.'</td><td>'.$row->KN_NAMA.'</td><td>'.$row->DT_QTY.'</td><td>'.$row->DT_HARGA.'</td><td>'.$row->KRY_NAMA.'</td><td>'.$row->PLG_NAMA.'</td><td>'.$row->ESK_NAMA.'</td><td>Terbayar</td></tr>';
				} elseif ($row->TR_STATUS == 3) {
					$output .= '<tr><td>'.$row->TR_TGL.'</td><td>'.$row->TR_TGLBYR.'</td><td>'.$row->KN_NAMA.'</td><td>'.$row->DT_QTY.'</td><td>'.$row->DT_HARGA.'</td><td>'.$row->KRY_NAMA.'</td><td>'.$row->PLG_NAMA.'</td><td>'.$row->ESK_NAMA.'</td><td>Proses Pengiriman</td></tr>';
				} elseif ($row->TR_STATUS == 4) {
					$output .= '<tr><td>'.$row->TR_TGL.'</td><td>'.$row->TR_TGLBYR.'</td><td>'.$row->KN_NAMA.'</td><td>'.$row->DT_QTY.'</td><td>'.$row->DT_HARGA.'</td><td>'.$row->KRY_NAMA.'</td><td>'.$row->PLG_NAMA.'</td><td>'.$row->ESK_NAMA.'</td><td>Terkirim</td></tr>';
				} elseif ($row->TR_STATUS == 5) {
					$output .= '<tr><td>'.$row->TR_TGL.'</td><td>'.$row->TR_TGLBYR.'</td><td>'.$row->KN_NAMA.'</td><td>'.$row->DT_QTY.'</td><td>'.$row->DT_HARGA.'</td><td>'.$row->KRY_NAMA.'</td><td>'.$row->PLG_NAMA.'</td><td>'.$row->ESK_NAMA.'</td><td>Dibatalkan</td></tr>';
				}
				
			}

			return $output;
        }

	}
?>
