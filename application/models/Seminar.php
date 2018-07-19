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
		function setJudulID($judulid){ $this->judulid = $judulid; }
		function getJudulID(){ return $this->judulid; }
		function setMhsID($mhsid){ $this->mhsid = $mhsid; }
		function getMhsID(){ return $this->mhsid; }
		function setNilaiPembimbing($nilai_pembimbing){ $this->nilai_pembimbing = $nilai_pembimbing; }
		function getNilaiPembimbing(){ return $this->nilai_pembimbing; }
		function setNilaiPenguji1($nilai_penguji1){ $this->nilai_penguji1 = $nilai_penguji1; }
		function getNilaiPenguji1(){ return $this->nilai_penguji1; }
		function setNilaiPenguji2($nilai_penguji2){ $this->nilai_penguji2 = $nilai_penguji2; }
		function getNilaiPenguji2(){ return $this->nilai_penguji2; }
		function setStatus($status){ $this->status = $status; }
		function getStatus(){ return $this->status; }
		function setStatusPengajuan($status_pengajuan){ $this->status_pengajuan = $status_pengajuan; }
		function getStatusPengajuan(){ return $this->status_pengajuan; }

		// ## Cek judul yang telah di ACC untuk pengecekan pengajuan seminar
		function cek_judul_acc(){
			$this->db->select('id, mhsid, judul');
			$this->db->where('mhsid', $this->getMhsID());
			$this->db->where('status', 3);
			$this->db->from('judul');

			$result = $this->db->get();
			if($result->num_rows() > 0){
				return $result->result_array();
			}else{
				return NULL;
			}
		}

	}
?>