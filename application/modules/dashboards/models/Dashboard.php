<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Dashboard extends CI_Model{
		private $id_user;
		private $jenis_user;
		
		function __construct(){
			parent::__construct();
		}

		function setID($id){ $this->id = $id; }
		function getID(){ return $this->id; }
		function setIDUser($id_user){ $this->id_user = $id_user; }
		function getIDUser(){ return $this->id_user; }
		function setJenisUser($jenis_user){ $this->jenis_user = $jenis_user; }
		function getJenisUser(){ return $this->jenis_user; }


		function get_user(){
			$id_user = $this->getIDUser();
			$jenis_user = $this->getJenisUser();

			if($jenis_user == "mahasiswa"){
				$this->db->select('mahasiswa.nim, mahasiswa.nama_mhs, jurusan.jurusan');
				$this->db->from('mahasiswa');
				$this->db->join('jurusan', 'jurusan.id = mahasiswa.jurusan');
				$this->db->where('mahasiswa.id', $id_user);
			}else if($jenis_user == "akademik"){
				$this->db->select('nip, nama_akademik');
				$this->db->from('akademik');
				$this->db->where('id', $id_user);
			}else  if($jenis_user == "dosen"){
				$this->db->select('nip, nama_dosen');
				$this->db->from('dosen');
				$this->db->where('id', $id_user);
			}

			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $query->row_array();
			}else{
				return NULL;
			}
		}
	}
?>