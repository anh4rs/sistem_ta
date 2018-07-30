<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Judul extends CI_Model{
		private $id;
		private $id_mahasiswa;
		private $judul;
		private $pembimbing;
		private $penguji1;
		private $penguji2;
		private $status;
		private $keterangan;

		private $id_detail;
		private $ringkas_masalah;
		private $metode;
		private $deskripsi;

		
		function __construct(){
			parent::__construct();
		}

		function setID($id){ $this->id = $id; }
		function getID(){ return $this->id; }
		function setIDMahasiswa($id_mahasiswa){ $this->id_mahasiswa = $id_mahasiswa; }
		function getIDMahasiswa(){ return $this->id_mahasiswa; }
		function setJudul($judul){ $this->judul = $judul; }
		function getJudul(){ return $this->judul; }
		function setPembimbing($pembimbing){ $this->pembimbing = $pembimbing; }
		function getPembimbing(){ return $this->pembimbing; }
		function setPenguji1($penguji1){ $this->penguji1 = $penguji1; }
		function getPenguji1(){ return $this->penguji1; }
		function setPenguji2($penguji2){ $this->penguji2 = $penguji2; }
		function getPenguji2(){ return $this->penguji2; }
		function setStatus($status){ $this->status = $status; }
		function getStatus(){ return $this->status; }
		function setKeterangan($keterangan){ $this->keterangan = $keterangan; }
		function getKeterangan(){ return $this->keterangan; }

		function setIDDetail($id_detail){ $this->id_detail = $id_detail; }
		function getIDDetail(){ return $this->id_detail; }
		function setRingkasMasalah($ringkas_masalah){ $this->ringkas_masalah = $ringkas_masalah; }
		function getRingkasMasalah(){ return $this->ringkas_masalah; }
		function setMetode($metode){ $this->metode = $metode; }
		function getMetode(){ return $this->metode; }
		function setDeskripsi($deskripsi){ $this->deskripsi = $deskripsi; }
		function getDeskripsi(){ return $this->deskripsi; }

		function list_data_by_mahasiswa(){
			$this->db->select('id, judul, pembimbing, penguji1, penguji2, status, keterangan');
			$this->db->from('judul');
			$this->db->where('mhsid', $this->getIDMahasiswa());
			$this->db->order_by('status', 'desc');

			$result = $this->db->get();

			if($result->num_rows() > 0){
				return $result->result_array();
			}else{
				return NULL;
			}
		}

		function status_aktif_pengajuan_judul(){
			$this->db->select('id, nama_status, status');
			$this->db->where('id', 1);
			$this->db->from('pengaturan');
			$this->db->limit(1);

			$sql = $this->db->get();
			if($sql->num_rows() > 0){
				return  $sql->row_array();
			}else{
				return NULL;
			}
		}

		function list_data_by_akademik(){
			$this->db->select('
				judul.id,
				judul.judul,
				judul.pembimbing,
				dosen.nama_dosen,
				judul.penguji1,
				judul.penguji2,
				judul.status,
				judul_detail.metode
				');
			$this->db->from('judul');
			$this->db->join('judul_detail', 'judul_detail.id_judul = judul.id');
			$this->db->join('dosen', 'dosen.id = judul.pembimbing', 'left');
			$this->db->where('mhsid', $this->getIDMahasiswa());
			$this->db->group_start();
			$this->db->where('status', 2);
			$this->db->or_where('status', 3);
			$this->db->group_end();
			$this->db->order_by('status', 'desc');

			$result = $this->db->get();

			if($result->num_rows() > 0){
				return $result->result_array();
			}else{
				return NULL;
			}
		}

		function list_data_all(){
			$this->db->select('
				judul.id,
				mahasiswa.nim,
				mahasiswa.nama_mhs,
				jurusan.jurusan,
				judul.judul,
				judul.mhsid,
				judul.status,
				');
			$this->db->from('judul');
			$this->db->join('mahasiswa', 'mahasiswa.id = judul.mhsid');
			$this->db->join('jurusan', 'jurusan.id = mahasiswa.jurusan');
			$this->db->where('status', 2);
			$this->db->group_by('mhsid');
			$this->db->order_by('updated', 'desc');

			$result = $this->db->get();

			if($result->num_rows() > 0){
				// foreach ($result->result_array() as $key => $value) {
				// 	if($value['status'] == 3){
				// 		return NULL;
				// 		break;
				// 	}else{
				// 		$last = $this->db->last_query();
				// 		$new = $this->db->query($last . " GROUP BY mhsid");
				// 		return $new->result_array();
				// 	}
				// }
				return $result->result_array();
			}else{
				return NULL;
			}
		}

		function insert_data(){
			$data = array(
				'mhsid' => $this->getIDMahasiswa(),
				'judul' => $this->getJudul(),
				'status' => '1'
			);
			$this->db->insert('judul', $data);
			return $this->db->insert_id();
		}

		function insert_data_detail(){
			$data = array(
				'id_judul' => $this->getID(),
				'ringkas_masalah' => $this->getRingkasMasalah(),
				'metode' => $this->getMetode(),
				'deskripsi' => $this->getDeskripsi()
			);
			$this->db->insert('judul_detail', $data);
			return $this->db->insert_id();	
		}

		function get_data(){
			$this->db->select('
				judul.id,
				judul.judul,
				judul.mhsid,
				judul.status,
				judul.pembimbing,
				dosen.nama_dosen,
				judul.penguji1,
				judul.penguji2,
				judul.keterangan,
				judul_detail.id as id_detail,
				judul_detail.ringkas_masalah,
				judul_detail.metode,
				judul_detail.deskripsi
			');
			$this->db->from('judul');
			$this->db->join('judul_detail', 'judul_detail.id_judul = judul.id');
			$this->db->join('dosen', 'dosen.id = judul.pembimbing', 'left');
			$this->db->where('judul.id', $this->getID());

			$result = $this->db->get();

			if($result->num_rows() > 0){
				return $result->result_array();
			}else{
				return NULL;
			}
		}

		function respon_akademik(){
			$data = array('status' => $this->getStatus());
			$this->db->update('judul', $data, array('id'=>$this->getID()));
			return $this->db->affected_rows();
		}

		function edit_data(){
			$data = array(
				'judul' => $this->getJudul()
			);

			$this->db->update('judul', $data, array('id'=>$this->getID()));
			return $this->db->affected_rows();
		}

		function edit_data_detail(){
			$data = array(
				'ringkas_masalah' => $this->getRingkasMasalah(),
				'metode' => $this->getMetode(),
				'deskripsi' => $this->getDeskripsi()
			);

			$this->db->update('judul_detail', $data, array('id'=>$this->getIDDetail()));
			return $this->db->affected_rows();
		}

		function delete_data(){
			$this->db->delete('judul', array('id'=>$this->getID()));
			return $this->db->affected_rows();
		}

		function pengajuan_judul_mahasiswa(){
			$data = array(
				'status' => '2'
			);

			$where = array(
				'mhsid' => $this->getIDMahasiswa(),
				'status' => '1'
			);

			$this->db->update('judul', $data, $where);
			return $this->db->affected_rows();
		}

		function cek_jumlah_judul_ready(){
			$this->db->select('id, status');
			$this->db->from('judul');
			$this->db->where('mhsid', $this->getIDMahasiswa());
			$this->db->where('status', 1);

			$result = $this->db->get();
			return $result->num_rows();
		}

		function cek_pengajuan_judul(){
			$this->db->select('id, status');
			$this->db->from('judul');
			$this->db->where('mhsid', $this->getIDMahasiswa());
			$this->db->where('status', 2);

			$result = $this->db->get();
			
			if($result->num_rows() > 0){
				return $result->num_rows();
			}else{
				return NULL;
			}
		}

		function cek_acc_judul(){
			$this->db->select('id, status');
			$this->db->from('judul');
			$this->db->where('mhsid', $this->getIDMahasiswa());
			$this->db->where('status', 3);

			$result = $this->db->get();
			
			if($result->num_rows() > 0){
				return TRUE;
			}else{
				return FALSE;
			}	
		}

		function edit_pembimbing(){
			$data = array(
				'pembimbing' => $this->getPembimbing()
			);

			$this->db->update('judul', $data, array('id'=>$this->getID()));
			return $this->db->affected_rows();
		}

		function get_mahasiswa_bimbingan_dosen(){
			$this->db->select('
				judul.id,
				judul.judul,
				judul.mhsid,
				judul.status,
				judul.pembimbing,
				mahasiswa.nim,
				mahasiswa.nama_mhs,
				judul_detail.id as id_detail,
				judul_detail.ringkas_masalah,
				judul_detail.metode,
				judul_detail.deskripsi,
				seminar.status_pengajuan as pengajuan_seminar,
				sidang.status_pengajuan as pengajuan_sidang,
				seminar.tanggal as tanggal_seminar,
				sidang.tanggal as tanggal_sidang
			');
			$this->db->from('judul');
			$this->db->join('judul_detail', 'judul_detail.id_judul = judul.id');
			$this->db->join('mahasiswa', 'mahasiswa.id = judul.mhsid');
			$this->db->join('seminar', 'seminar.judulid = judul.id');
			$this->db->join('sidang', 'sidang.judulid = judul.id');
			$this->db->where('judul.pembimbing', $this->getPembimbing());

			$result = $this->db->get();

			if($result->num_rows() > 0){
				return $result->result_array();
			}else{
				return NULL;
			}
		}

		function get_mahasiswa_pengujian_dosen(){
			$this->db->select('
				judul.id,
				judul.judul,
				judul.mhsid,
				judul.status,
				judul.pembimbing,
				mahasiswa.nim,
				mahasiswa.nama_mhs,
				dosen.nama_dosen,
				judul_detail.id as id_detail,
				judul_detail.ringkas_masalah,
				judul_detail.metode,
				judul_detail.deskripsi,
				seminar.status_pengajuan as pengajuan_seminar,
				sidang.status_pengajuan as pengajuan_sidang,
				seminar.tanggal as tanggal_seminar,
				sidang.tanggal as tanggal_sidang
			');
			$this->db->from('judul');
			$this->db->join('judul_detail', 'judul_detail.id_judul = judul.id');
			$this->db->join('mahasiswa', 'mahasiswa.id = judul.mhsid');
			$this->db->join('dosen', 'dosen.id = judul.pembimbing');
			$this->db->join('seminar', 'seminar.judulid = judul.id');
			$this->db->join('sidang', 'sidang.judulid = judul.id');
			$this->db->where('judul.penguji1', $this->getPembimbing());
			$this->db->or_where('judul.penguji2', $this->getPembimbing());

			$result = $this->db->get();

			if($result->num_rows() > 0){
				return $result->result_array();
			}else{
				return NULL;
			}
		}
	}
?>