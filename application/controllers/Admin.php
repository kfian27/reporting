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