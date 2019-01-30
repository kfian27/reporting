<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
     * @author Fian Hidayah
	 * Model untuk table
	 */
class login_model extends CI_Model {

	/**
	 * @author Fian Hidayah
	 * Constructor class
	 */
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->db_evin = $this->load->database('report', TRUE);
		//set waktu yang digunakan ke zona jakarta
		//$this->db_simpeg->query("SET time_zone='Asia/Jakarta'");
	}
	function cek_login($username,$password){
		$sql = "select * from user where name_usr = '$username' and pass_usr = '$password'";
		$query = $this->db_evin->query($sql);
		return $query->result();
		// return $this->db_evin->get_where($table,$username);
	}
}
?>