<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_paket extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 /**
     * @author Fian Hidayah
	 * Model untuk select data untuk home
	 */
	 public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url', 'file','download'));
    }
	public function index(){redirect(base_url("laporan_paket/search"));}
	public function tahunan()
	{
		// $this->cek_login();
		$this->load->model('mlaporan_paket');
		$data['nama_paket'] = $this->mlaporan_paket->get_nm_paket();
		$data['tanggal'] = $this->mlaporan_paket->get_tgl_masuk();
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/dashboard.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function grafik_tahunan($tahun_masuk,$paketnya)
	{
		// $this->cek_login();
		$this->load->model('mlaporan_paket');
		$data['nama_paket'] = $this->mlaporan_paket->get_nm_paket();
		$data['tanggal'] = $this->mlaporan_paket->get_tgl_masuk();
		$data['judul'] = $this->mlaporan_paket->get_nama_paket($paketnya);
		$data['tahunnya'] = $tahun_masuk;
		$data['judul_grafik'] = $paketnya;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/grafik.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function grafik_tahunan_gabungan($tahun_masuk,$paketnya)
	{
		// $this->cek_login();
		$this->load->model('mlaporan_paket');
		$data['nama_paket'] = $this->mlaporan_paket->get_nm_paket();
		$data['tanggal'] = $this->mlaporan_paket->get_tgl_masuk();
		$data['judul'] = $this->mlaporan_paket->get_nama_paket($paketnya);
		$data['tahunnya'] = $tahun_masuk;
		$data['judul_grafik'] = $paketnya;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/grafik_gabungan.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function grafik_tahunan_imb($tahun_masuk,$paketnya)
	{
		// $this->cek_login();
		$this->load->model('mlaporan_paket');
		$data['nama_paket'] = $this->mlaporan_paket->get_nm_paket();
		$data['tanggal'] = $this->mlaporan_paket->get_tgl_masuk();
		$data['judul'] = $this->mlaporan_paket->get_nama_paket($paketnya);
		$data['tahunnya'] = $tahun_masuk;
		$data['judul_grafik'] = $paketnya;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/grafik_imb.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function search() {
		// $tanggal = date('Y-m');
		$this->load->model('mlaporan_paket');
		$data['nama_paket'] = $this->mlaporan_paket->get_nm_paket();
		$data['hasilnya'] = $this->mlaporan_paket->get_tanggal($this->input->post('tgl_mulai'),$this->input->post('tgl_akhir'),$this->input->post('paket'));
		$data['tgl_mulai'] = $this->input->post('tgl_mulai');
		$data['tgl_akhir'] = $this->input->post('tgl_akhir');
		$data['paketnya'] = $this->input->post('paket'); 
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/laporan_paket.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function hasil($mulainya,$akhirnya,$uptdnya) {
		// $tanggal = date('Y-m');
		$this->load->model('mlaporan_paket');
		$tgl_mulainya = date('Y-m-d', strtotime($mulainya));
		$tgl_akhirnya = date('Y-m-d', strtotime($akhirnya));
		$data['tgl_mulai'] = $mulainya;
		$data['tgl_akhir'] = $akhirnya;
		$data['hasilnya'] = $this->mlaporan_paket->get_tanggal($tgl_mulainya,$tgl_akhirnya,$uptdnya);
		$data['nama_paket'] = $this->mlaporan_paket->get_nm_paket();
		$data['tgl_mulainya'] = $tgl_mulainya;
		$data['tgl_akhirnya'] = $tgl_akhirnya;
		$data['paketnya'] = $uptdnya; 
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/laporan_paket.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function hasil_IMB($mulainya,$akhirnya,$uptdnya) {
		// $tanggal = date('Y-m');
		$this->load->model('mlaporan_paket');
		$tgl_mulainya = date('Y-m-d', strtotime($mulainya));
		$tgl_akhirnya = date('Y-m-d', strtotime($akhirnya));
		$data['tgl_mulai'] = $mulainya;
		$data['tgl_akhir'] = $akhirnya;
		$data['hasilnya'] = $this->mlaporan_paket->get_tanggal_imb($tgl_mulainya,$tgl_akhirnya,$uptdnya);
		$data['skrknya'] = $this->mlaporan_paket->get_selesai_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'SKRK');
		$data['imbnya'] = $this->mlaporan_paket->get_selesai_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'IMB');
		$data['tolak_skrk'] = $this->mlaporan_paket->get_tolak_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'SKRK');
		$data['tolak_imb'] = $this->mlaporan_paket->get_tolak_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'IMB');
		$data['proses_imb'] = $this->mlaporan_paket->get_proses_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'IMB');
		$data['proses_skrk'] = $this->mlaporan_paket->get_proses_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'SKRK');
		$data['pending_imb'] = $this->mlaporan_paket->get_pending_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'IMB');
		$data['pending_skrk'] = $this->mlaporan_paket->get_pending_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'SKRK');
		$data['nama_paket'] = $this->mlaporan_paket->get_nm_paket();
		$data['tgl_mulai'] = $mulainya;
		$data['tgl_akhir'] = $akhirnya;
		$data['paketnya'] = $uptdnya; 
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/laporan_paket_imb.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function hasil_gabungan($mulainya,$akhirnya,$uptdnya) {
		// $tanggal = date('Y-m');
		$this->load->model('mlaporan_paket');
		$tgl_mulainya = date('Y-m-d', strtotime($mulainya));
		$tgl_akhirnya = date('Y-m-d', strtotime($akhirnya));
		$data['tgl_mulai'] = $mulainya;
		$data['tgl_akhir'] = $akhirnya;
		$data['skrknya'] = $this->mlaporan_paket->get_selesai_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'SKRK');
		$data['imbnya'] = $this->mlaporan_paket->get_selesai_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'IMB');
		$data['tolak_skrk'] = $this->mlaporan_paket->get_tolak_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'SKRK');
		$data['tolak_imb'] = $this->mlaporan_paket->get_tolak_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'IMB');
		$data['proses_imb'] = $this->mlaporan_paket->get_proses_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'IMB');
		$data['proses_skrk'] = $this->mlaporan_paket->get_proses_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'SKRK');
		$data['pending_imb'] = $this->mlaporan_paket->get_pending_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'IMB');
		$data['pending_skrk'] = $this->mlaporan_paket->get_pending_imb_skrk($tgl_mulainya,$tgl_akhirnya,$uptdnya,'SKRK');
		$data['hasilnya'] = $this->mlaporan_paket->get_tanggal_imb_gabungan($tgl_mulainya,$tgl_akhirnya,$uptdnya);
		$data['nama_paket'] = $this->mlaporan_paket->get_nm_paket();
		$data['tgl_mulainya'] = $tgl_mulainya;
		$data['tgl_akhirnya'] = $tgl_akhirnya;
		$data['paketnya'] = $uptdnya; 
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/laporan_paket_gabungan.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function selesai_detail($mulainya,$akhirnya,$parameternya,$kd_ijin,$jumlah_total){
		$this->load->model('mlaporan_paket');
		$parameternya1 = str_replace('_', ' ', $kd_ijin);
		$parameternya1 = str_replace('.', '/', $parameternya1);
		$tgl_mulainya = date('Y-m-d', strtotime($mulainya));
		$tgl_akhirnya = date('Y-m-d', strtotime($akhirnya));
		if($kd_ijin == 'IMB' || $kd_ijin =='SKRK'){
			$data['hasilnya'] = $this->mlaporan_paket->get_selesai_imb_skrk_detail($tgl_mulainya,$tgl_akhirnya,$parameternya,$kd_ijin);
		}
		else{
			$data['hasilnya'] = $this->mlaporan_paket->get_tanggal_selesai_detail($tgl_mulainya,$tgl_akhirnya,$parameternya,$parameternya1);
		}
		$data['judulnya'] = $parameternya1;
		$data['tgl_mulai'] = $tgl_mulainya;
		$data['tgl_akhir'] = $tgl_akhirnya;
		$data['jumlah_total'] = $jumlah_total;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/selesai_detail.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function proses_detail($mulainya,$akhirnya,$parameternya,$kd_ijin,$jumlah_total){
		$this->load->model('mlaporan_paket');
		$parameternya1 = str_replace('_', ' ', $kd_ijin);
		$parameternya1 = str_replace('.', '/', $parameternya1);
		$tgl_mulainya = date('Y-m-d', strtotime($mulainya));
		$tgl_akhirnya = date('Y-m-d', strtotime($akhirnya));
		if($kd_ijin == 'IMB' || $kd_ijin =='SKRK'){
			$data['hasilnya'] = $this->mlaporan_paket->get_proses_imb_skrk_detail($tgl_mulainya,$tgl_akhirnya,$parameternya,$kd_ijin);
		}
		else{
			$data['hasilnya'] = $this->mlaporan_paket->get_tanggal_proses_detail($tgl_mulainya,$tgl_akhirnya,$parameternya,$parameternya1);
		}
		$data['judulnya'] = $parameternya1;
		$data['tgl_mulai'] = $tgl_mulainya;
		$data['tgl_akhir'] = $tgl_akhirnya;
		$data['jumlah_total'] = $jumlah_total;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/proses_detail.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function pending_detail($mulainya,$akhirnya,$parameternya,$kd_ijin,$jumlah_total){
		$this->load->model('mlaporan_paket');
		$parameternya1 = str_replace('_', ' ', $kd_ijin);
		$parameternya1 = str_replace('.', '/', $parameternya1);
		$tgl_mulainya = date('Y-m-d', strtotime($mulainya));
		$tgl_akhirnya = date('Y-m-d', strtotime($akhirnya));
		if($kd_ijin == 'IMB' || $kd_ijin =='SKRK'){
			$data['hasilnya'] = $this->mlaporan_paket->get_pending_imb_skrk_detail($tgl_mulainya,$tgl_akhirnya,$parameternya,$kd_ijin);
		}
		else{
			$data['hasilnya'] = $this->mlaporan_paket->get_tanggal_pending_detail($tgl_mulainya,$tgl_akhirnya,$parameternya,$parameternya1);
		}
		$data['judulnya'] = $parameternya1;
		$data['tgl_mulai'] = $tgl_mulainya;
		$data['tgl_akhir'] = $tgl_akhirnya;
		$data['jumlah_total'] = $jumlah_total;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/pending_detail.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function tolak_detail($mulainya,$akhirnya,$parameternya,$kd_ijin,$jumlah_total){
		$this->load->model('mlaporan_paket');
		$parameternya1 = str_replace('_', ' ', $kd_ijin);
		$parameternya1 = str_replace('.', '/', $parameternya1);
		$tgl_mulainya = date('Y-m-d', strtotime($mulainya));
		$tgl_akhirnya = date('Y-m-d', strtotime($akhirnya));
		if($kd_ijin == 'IMB' || $kd_ijin =='SKRK'){
			$data['hasilnya'] = $this->mlaporan_paket->get_tolak_imb_skrk_detail($tgl_mulainya,$tgl_akhirnya,$parameternya,$kd_ijin);
		}
		else{
			$data['hasilnya'] = $this->mlaporan_paket->get_tanggal_tolak_detail($tgl_mulainya,$tgl_akhirnya,$parameternya,$parameternya1);
		}
		$data['judulnya'] = $parameternya1;
		$data['tgl_mulai'] = $tgl_mulainya;
		$data['tgl_akhir'] = $tgl_akhirnya;
		$data['jumlah_total'] = $jumlah_total;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/tolak_detail.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function histori_detail($tgl_mulai,$parameternya){
		$this->load->model('mlaporan_paket');
		$data['hasilnya'] = $this->mlaporan_paket->get_histori_details($tgl_mulai,$parameternya);
		$data['tanggalannya'] = $tgl_mulai;
		$data['nomer_ol'] = $parameternya;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/historical.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function histori_detail_imb($tgl_mulai,$parameternya,$kodenya){
		$this->load->model('mlaporan_paket');
		$data['hasilnya'] = $this->mlaporan_paket->get_histori_details_imb($tgl_mulai,$parameternya,$kodenya);
		$data['tanggalannya'] = $tgl_mulai;
		$data['nomer_ol'] = $parameternya;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/historical_imb.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function cek_login(){
		if ($this->session->userdata('name')==null){
			redirect(base_url("admin/login"));
		}	
	}
}
?>