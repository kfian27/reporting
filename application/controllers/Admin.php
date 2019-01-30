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
		$this->home();
		
	}
	public function home()
	{
		// $this->cek_login();
		$this->load->model('mlaporan');
		// $data['grafik1'] = $this->mlaporan->get_grafik1();
		// $data['grafik2'] = $this->mlaporan->get_grafik2();
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/utama.php');
		$this->load->view('baseadmin/footer.php');
	}
	public function pertama() {
		// $tanggal = date('Y-m');
		$this->load->model('mlaporan');
		$data['nama_skpd'] = $this->mlaporan->get_nm_skpd();
		// $data['order'] = $this->mlaporan->get_order_type();
		// $data['retailer1'] = $this->mlaporan->get_retailer_type();
		// $data['product'] = $this->mlaporan->get_product_line();
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/pertama.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function hasil1() {
		// $tanggal = date('Y-m');
		$this->load->model('mlaporan');
		$data['nama_skpd'] = $this->mlaporan->get_nm_skpd();
		$data['hasilnya'] = $this->mlaporan->get_tanggal($this->input->post('tgl_mulai'),$this->input->post('tgl_akhir'),$this->input->post('uptd'));
		$data['tgl_mulai'] = $this->input->post('tgl_mulai');
		$data['tgl_akhir'] = $this->input->post('tgl_akhir');
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/kelima.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function kedua() {
		$tanggal = date('Y-m');
		// $data['retailer'] = $this->mlaporan->get_retailer();
		// $data['order'] = $this->mlaporan->get_order_type();
		// $data['retailer1'] = $this->mlaporan->get_retailer_type();
		// $data['product'] = $this->mlaporan->get_product_line();
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/kedua.php');
		$this->load->view('baseadmin/footer.php');
	}
	public function ketiga() {
		$tanggal = date('Y-m');
		// $data['retailer'] = $this->mlaporan->get_retailer();
		// $data['order'] = $this->mlaporan->get_order_type();
		// $data['retailer1'] = $this->mlaporan->get_retailer_type();
		// $data['product'] = $this->mlaporan->get_product_line();
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/ketiga.php');
		$this->load->view('baseadmin/footer.php');
	}
	public function keempat() {
		$tanggal = date('Y-m');
		// $data['retailer'] = $this->mlaporan->get_retailer();
		// $data['order'] = $this->mlaporan->get_order_type();
		// $data['retailer1'] = $this->mlaporan->get_retailer_type();
		// $data['product'] = $this->mlaporan->get_product_line();
		$this->load->view('baseadmin/header.php');
		$this->load->view('laporan/keempat.php');
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