<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Mahasiswa extends CI_Model{

		private $id;
		private $nim;
		private $nama_mhs;

		function setID($id){ $this->id = $id; }
		function getID(){ return $this->id; }
		function setNIM($nim){ $this->nim = $nim; }
		function getNIM(){ return $this->nim; }
		function setNamaMhs($nama_mhs){ $this->nama_mhs = $nama_mhs; }
		function getNamaMhs(){ return $this->nama_mhs; }

		function get_mahasiswa(){
			$this->db->select('id, nim, nama_mhs, jurusan, email');
			$this->db->from('mahasiswa');
			$this->db->where('id', $this->getID());

			$result = $this->db->get();

			if($result->num_rows() > 0){
				return $result->result_array();
			}else{
				return NULL;
			}
		}

	}