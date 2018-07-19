<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Login extends CI_Model{
		private $id;
		private $username;
		private $password;
		private $id_user;
		private $jenis_user;
		
		function __construct(){
			parent::__construct();
		}

		function setID($id){ $this->id = $id; }
		function getID(){ return $this->id; }
		function setUsername($username){ $this->username = $username; }
		function getUsername(){ return $this->username; }
		function setPassword($password){ $this->password = $password; }
		function getPassword(){ return $this->password; }
		function setIDUser($id_user){ $this->id_user = $id_user; }
		function getIDUser(){ return $this->id_user; }
		function setJenisUser($jenis_user){ $this->jenis_user = $jenis_user; }
		function getJenisUser(){ return $this->jenis_user; }

		function process_login(){
			$param = array(
				'username' => $this->getUsername(),
				'password' => $this->getPassword()
			);

			$this->db->select('id, userid, jenis_user');
			$this->db->from('user');
			$this->db->where($param);
			$this->db->limit(1);

			$result = $this->db->get();

			if($result->num_rows() > 0){
				foreach ($result->result() as $val) {
					$this->setID($val->id);
					$this->setIDUser($val->userid);
					$this->setJenisUser($val->jenis_user);
				}
				return "success";
			}else{
				return "failed";
			}
		}
	}
?>