<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Seminar extends CI_Model{
		private $id;
		private $tanggal;
		private $judulid;
		private $mhsid;
		private $nilai_pembimbing;
		private $nilai_penguji1;
		private $nilai_penguji2;
		private $status;
		private $status_pengajuan;

		function __construct(){
			parent::__construct();
		}

		function setID($id){ $this->id = $id; }
		function getID(){ return $this->id; }
		function setTanggal($tanggal){ $this->tanggal = $tanggal; }
		function getTanggal(){ return $this->tanggal; }
	}
?>