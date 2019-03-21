<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_mandiri extends CI_Controller {

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
	public function index(){redirect(base_url("laporan_mandiri/search"));}
	public function tahunan()
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
	public function grafik_tahunan()
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
	public function search() {
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
	public function hasil($mulainya,$akhirnya,$uptdnya){
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
	public function detail($tgl_mulai,$tgl_akhir,$parameternya,$jumlah_total,$uptdnya) {
		//$tanggal = date('Y-m');
		$this->load->model('mlaporan');
		$parameternya1 = str_replace('_', ' ', $parameternya);
		$parameternya1 = str_replace('.', '/', $parameternya1);
		$parameternya1 = str_replace('1', '&', $parameternya1);
		$tgl_mulainya = date('Y-m-d', strtotime($tgl_mulai));
		$tgl_akhirnya = date('Y-m-d', strtotime($tgl_akhir));
		$data['hasilnya'] = $this->mlaporan->get_details_tanggal($tgl_mulainya,$tgl_akhirnya,$parameternya1,$uptdnya);
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
		$data['nama_proses'] = $this->mlaporan->get_nama_proses($kd_ijin);
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
	public function cek_login(){
		if ($this->session->userdata('name')==null){
			redirect(base_url("admin/login"));
		}	
	}
}
?>