<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

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
	public function index()
	{
		// $this->cek_login();
		$this->load->model('mlaporan');
		$data['total_parsial'] = $this->mlaporan->get_total_parsial_now();
		$data['total_paket'] = $this->mlaporan->get_total_paket_now();
		$data['detail_parsial'] = $this->mlaporan->get_detail_parsial_now();
		$data['detail_paket'] = $this->mlaporan->get_detail_paket_now();
		$this->load->view('baseadmin/header.php');
		$this->load->view('baseadmin/home.php',$data);
		$this->load->view('baseadmin/footer.php');
		
	}
	public function laporan_mandiri_tahunan()
	{
		// $this->cek_login();
		$this->load->model('mlaporan');
		$data['nama_skpd'] = $this->mlaporan->get_nm_skpd();
		$data['tanggal'] = $this->mlaporan->get_tgl_masuk();
		// $data['grafiknya'] = $this->mlaporan->get_dashboard($this->input->post('tahun_masuk'),$this->input->post('uptd'),$this->input->post('ijinnya'));
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/dashboard.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function grafik()
	{
		// $this->cek_login();
		$this->load->model('mlaporan');
		$data['nama_skpd'] = $this->mlaporan->get_nm_skpd();
		$data['tanggal'] = $this->mlaporan->get_tgl_masuk();
		$data['tahunnya'] = $this->input->post('tahun_masuk');
		$data['judul_grafik'] = $this->input->post('ijinnya');
		$data['skpdnya'] = $this->input->post('uptd');
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/grafik.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function laporan_mandiri() {
		$this->load->model('mlaporan');
		$data['nama_skpd'] = $this->mlaporan->get_nm_skpd();
		$data['hasilnya'] = $this->mlaporan->get_tanggal($this->input->post('tgl_mulai'),$this->input->post('tgl_akhir'),$this->input->post('uptd'));
		$data['tgl_mulai'] = $this->input->post('tgl_mulai');
		$data['tgl_akhir'] = $this->input->post('tgl_akhir');
		$data['dinas'] = $this->input->post('uptd'); 
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/laporan.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function laporan_mandiri_hasil($mulainya,$akhirnya,$uptdnya){
		$this->load->model('mlaporan');
		$tgl_mulainya = date('Y-m-d', strtotime($mulainya));
		$tgl_akhirnya = date('Y-m-d', strtotime($akhirnya));
		$data['nama_skpd'] = $this->mlaporan->get_nm_skpd();
		$data['hasilnya'] = $this->mlaporan->get_tanggal($tgl_mulainya,$tgl_akhirnya,$uptdnya);
		$data['tgl_mulai'] = $mulainya;
		$data['tgl_akhir'] = $akhirnya;
		$data['dinas'] = $uptdnya; 
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/laporan.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function laporan_mandiri_detail($tgl_mulai,$tgl_akhir,$parameternya,$jumlah_total) {
		//$tanggal = date('Y-m');
		$this->load->model('mlaporan');
		$parameternya1 = str_replace('_', ' ', $parameternya);
		$parameternya1 = str_replace('.', '/', $parameternya1);
		$tgl_mulainya = date('Y-m-d', strtotime($tgl_mulai));
		$tgl_akhirnya = date('Y-m-d', strtotime($tgl_akhir));
		$data['hasilnya'] = $this->mlaporan->get_details_tanggal($tgl_mulainya,$tgl_akhirnya,$parameternya1);
		$data['hasilnya1'] = $this->mlaporan->get_pie_proses($tgl_mulainya,$tgl_akhirnya,$parameternya1);
		$data['judulnya'] = $parameternya1;
		$data['tgl_mulai'] = $tgl_mulainya;
		$data['tgl_akhir'] = $tgl_akhirnya;
		$data['jumlah_total'] = $jumlah_total;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/laporan_detail.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function proses_detail($tgl_mulai,$tgl_akhir,$parameternya,$kd_ijin,$jumlah_total){
		$this->load->model('mlaporan');
		$parameternya1 = str_replace('_', ' ', $parameternya);
		$parameternya1 = str_replace('.', '/', $parameternya1);
		$data['hasilnya'] = $this->mlaporan->get_proses_details($tgl_mulai,$tgl_akhir,$kd_ijin);
		$data['nama_proses'] = $this->mlaporan->get_nama_proses();
		$data['judulnya'] = $parameternya1;
		$data['tgl_mulai'] = $tgl_mulai;
		$data['tgl_akhir'] = $tgl_akhir;
		$data['jumlah_total'] = $jumlah_total;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/proses_detail.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function pending_detail($tgl_mulai,$tgl_akhir,$parameternya,$kd_ijin,$jumlah_total){
		$this->load->model('mlaporan');
		$parameternya1 = str_replace('_', ' ', $parameternya);
		$parameternya1 = str_replace('.', '/', $parameternya1);
		$data['hasilnya'] = $this->mlaporan->get_pending_details($tgl_mulai,$tgl_akhir,$kd_ijin);
		$data['judulnya'] = $parameternya1;
		$data['tgl_mulai'] = $tgl_mulai;
		$data['tgl_akhir'] = $tgl_akhir;
		$data['jumlah_total'] = $jumlah_total;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/pending_detail.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function tolak_detail($tgl_mulai,$tgl_akhir,$parameternya,$kd_ijin,$jumlah_total){
		$this->load->model('mlaporan');
		$parameternya1 = str_replace('_', ' ', $parameternya);
		$parameternya1 = str_replace('.', '/', $parameternya1);
		$data['hasilnya'] = $this->mlaporan->get_tolak_details($tgl_mulai,$tgl_akhir,$kd_ijin);
		$data['judulnya'] = $parameternya1;
		$data['tgl_mulai'] = $tgl_mulai;
		$data['tgl_akhir'] = $tgl_akhir;
		$data['jumlah_total'] = $jumlah_total;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/tolak_detail.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function selesai_detail($tgl_mulai,$tgl_akhir,$parameternya,$kd_ijin,$jumlah_total){
		$this->load->model('mlaporan');
		$parameternya1 = str_replace('_', ' ', $parameternya);
		$parameternya1 = str_replace('.', '/', $parameternya1);
		$data['hasilnya'] = $this->mlaporan->get_selesai_details($tgl_mulai,$tgl_akhir,$kd_ijin);
		$data['judulnya'] = $parameternya1;
		$data['tgl_mulai'] = $tgl_mulai;
		$data['tgl_akhir'] = $tgl_akhir;
		$data['jumlah_total'] = $jumlah_total;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/selesai_detail.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function histori_detail($tgl_mulai,$parameternya){
		$this->load->model('mlaporan');
		$data['hasilnya'] = $this->mlaporan->get_histori_details($tgl_mulai,$parameternya);
		$data['tanggalannya'] = $tgl_mulai;
		$data['nomer_ol'] = $parameternya;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/historical.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function laporan_paket() {
		// $tanggal = date('Y-m');
		$this->load->model('mlaporan_paket');
		$data['nama_paket'] = $this->mlaporan_paket->get_nm_paket();
		$data['hasilnya'] = $this->mlaporan_paket->get_tanggal($this->input->post('tgl_mulai'),$this->input->post('tgl_akhir'),$this->input->post('paket'));
		$data['tgl_mulai'] = $this->input->post('tgl_mulai');
		$data['tgl_akhir'] = $this->input->post('tgl_akhir');
		$data['paketnya'] = $this->input->post('paket'); 
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/laporan_paket.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function laporan_paket_hasil($mulainya,$akhirnya,$uptdnya) {
		// $tanggal = date('Y-m');
		$this->load->model('mlaporan_paket');
		$tgl_mulainya = date('Y-m-d', strtotime($mulainya));
		$tgl_akhirnya = date('Y-m-d', strtotime($akhirnya));
		$data['tgl_mulai'] = $mulainya;
		$data['tgl_akhir'] = $akhirnya;
			$data['hasilnya'] = $this->mlaporan_paket->get_tanggal($tgl_mulainya,$tgl_akhirnya,$uptdnya);
		$data['nama_paket'] = $this->mlaporan_paket->get_nm_paket();
		$data['tgl_mulai'] = $mulainya;
		$data['tgl_akhir'] = $akhirnya;
		$data['paketnya'] = $uptdnya; 
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/laporan_paket.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function laporan_paket_hasil_IMB($mulainya,$akhirnya,$uptdnya) {
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
		$this->load->view('laporan/laporan_paket_imb.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function selesai_paket_detail($mulainya,$akhirnya,$parameternya,$kd_ijin,$jumlah_total){
		$this->load->model('mlaporan_paket');
		$tgl_mulainya = date('Y-m-d', strtotime($mulainya));
		$tgl_akhirnya = date('Y-m-d', strtotime($akhirnya));
		$data['hasilnya'] = $this->mlaporan_paket->get_selesai_imb_skrk_detail($tgl_mulainya,$tgl_akhirnya,$parameternya,$kd_ijin);
		$data['judulnya'] = $kd_ijin;
		$data['tgl_mulai'] = $tgl_mulainya;
		$data['tgl_akhir'] = $tgl_akhirnya;
		$data['jumlah_total'] = $jumlah_total;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/selesai_detail.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function proses_paket_detail($mulainya,$akhirnya,$parameternya,$kd_ijin,$jumlah_total){
		$this->load->model('mlaporan_paket');
		$tgl_mulainya = date('Y-m-d', strtotime($mulainya));
		$tgl_akhirnya = date('Y-m-d', strtotime($akhirnya));
		$data['hasilnya'] = $this->mlaporan_paket->get_proses_imb_skrk_detail($tgl_mulainya,$tgl_akhirnya,$parameternya,$kd_ijin);
		$data['judulnya'] = $kd_ijin;
		$data['tgl_mulai'] = $tgl_mulainya;
		$data['tgl_akhir'] = $tgl_akhirnya;
		$data['jumlah_total'] = $jumlah_total;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/proses_detail.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function pending_paket_detail($mulainya,$akhirnya,$parameternya,$kd_ijin,$jumlah_total){
		$this->load->model('mlaporan_paket');
		$tgl_mulainya = date('Y-m-d', strtotime($mulainya));
		$tgl_akhirnya = date('Y-m-d', strtotime($akhirnya));
		$data['hasilnya'] = $this->mlaporan_paket->get_pending_imb_skrk_detail($tgl_mulainya,$tgl_akhirnya,$parameternya,$kd_ijin);
		$data['judulnya'] = $kd_ijin;
		$data['tgl_mulai'] = $tgl_mulainya;
		$data['tgl_akhir'] = $tgl_akhirnya;
		$data['jumlah_total'] = $jumlah_total;
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan_paket/pending_detail.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function login(){
		if ($this->session->userdata('name')==null){
			$this->load->view('baseadmin/login.php');
		}
		else{
			$this->index();
		}
	}
	public function cek_login(){
		if ($this->session->userdata('name')==null){
			redirect(base_url("admin/login"));
		}	
	}
}
?>