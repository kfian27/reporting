<?php

	class Muser_model extends CI_Model {

		/**
		 * @author Fian Hidayah
		 * Constructor class
		 */
		function __construct() {
			// Call the Model constructor
			parent::__construct();
			$this->db_evin = $this->load->database('report', TRUE);
		}

		/**
		 * @author Fian Hidayah
		 * method untuk generate select query dari database
		 */
		public function select($selectcolumn=true){
	    	if($selectcolumn){
		    	$this->db_evin->select('id_usr');
		    	$this->db_evin->select('name_usr');
		    	$this->db_evin->select('pass_usr');
		    	$this->db_evin->select('ft_usr');
		    	$this->db_evin->select('status_usr');
		    	$this->db_evin->select('last_used');
	    	}
            	$this->db_evin->from('user');
		}

		/**
         * @author Fian Hidayah
         * method untuk mendapatkan data dari tabel survei
         * @param type $limit jumlah yang mau diambil
         * @param type $offset mulai dari mana
         * @return type hasil query dari database
         */
        function get($where = "", $order = "id_usr asc", $limit=null, $offset=null, $selectcolumn = true){
  			 $this->select($selectcolumn);
  			 if($limit != null) $this->db_evin->limit($limit, $offset);
  			 if($where != "") $this->db_evin->where($where);
  			 $this->db_evin->order_by($order);
  			 $query = $this->db_evin->get();
  			 return $query->result();
        }
        function get_by_id($id_usr)
		 {
			if($id_usr == null || trim($id_usr) == "") return null;
			$result = $this->get("id_usr = '".$id_usr."'");
			return count($result) == 0?null:$result[0];
		 }

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk insert data ke tabel survei
		 */
		function insert($name_usr=false,$pass_usr=false,$ft_usr=false)
		{
			$data = array();
			if($name_usr !== false)$data['name_usr'] = trim($name_usr);
			if($pass_usr !== false)$data['pass_usr'] = trim($pass_usr);
			if($ft_usr !== false)$data['ft_usr'] = trim($ft_usr);
      		$data['status_usr']= STATUS_ACTIVE;
			$this->db_evin->insert('user', $data);
			return $this->db_evin->insert_id();
		}

		function update($id_usr=false,$name_usr=false,$pass_usr=false,$ft_usr=false)
		{
			$data = array();
			if($name_usr !== false)$data['name_usr'] = trim($name_usr);
			if($pass_usr !== false)$data['pass_usr'] = trim($pass_usr);
			if($ft_usr !== false)$data['ft_usr'] = trim($ft_usr);

			return $this->db_evin->update('user', $data, "id_usr = $id_usr");
		}

		 /* @author Fian Hidayah
		 * Fungsi untuk delete data dari tabel Survei
		 */
		function delete($id_usr)
		{
			$data = array();
			$data['status_usr'] = STATUS_DELETE;
			return $this->db_evin->update('user', $data, "id_usr = $id_usr");
		}

		function last_sign($user_id)
		{
			$data = array();
			$data['last_used'] = now();
			return $this->db_evin->update('user', $data, "name_usr = $user_id");
		}

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk menghitung jumlah row dari tabel survei
		 * @param type $where custome where
		 */
		function count_all($where = "")
		{
			if($where != null)$this->db_evin->where($where);
			return $this->db_evin->count_all_results('user');
		}
	}
?>