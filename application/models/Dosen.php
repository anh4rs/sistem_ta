<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Dosen extends CI_Model{

		private $id;
		private $nip;
		private $nama_dosen;

		function setID($id){ $this->id = $id; }
		function getID(){ return $this->id; }
		function setnip($nip){ $this->nip = $nip; }
		function getnip(){ return $this->nip; }
		function setNamaDosen($nama_dosen){ $this->nama_dosen = $nama_dosen; }
		function getNamaDosen(){ return $this->nama_dosen; }

		function list_dosen(){
			$this->db->select('id, nip, nama_dosen');
			$this->db->from('dosen');

			$result = $this->db->get();

			if($result->num_rows() > 0){
				return $result->result_array();
			}else{
				return NULL;
			}
		}

	}