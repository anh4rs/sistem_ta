<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjadwalanseminars extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('judul');
		$this->load->model('seminar');
		$this->load->model('mahasiswa');
		$this->load->model('dosen');
	}

	function index(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$result = $this->seminar->list_seminar_by_akademik();
		$data['result'] = $result;

		$this->load->view('layout/header', $data);
		$this->load->view('list_all', $data);
		$this->load->view('layout/footer');
	}

	function index_finish(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$result = $this->seminar->list_finish_seminar_by_akademik();
		$data['result'] = $result;

		$this->load->view('layout/header', $data);
		$this->load->view('list_finish', $data);
		$this->load->view('layout/footer');	
	}

	function tentukan_jadwal(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$id_seminar = $this->uri->segment(3);

		$this->seminar->setID($id_seminar);
		$data['result_detail'] = $this->seminar->get_jadwal_seminar_akademik();
		$data['list_dosen'] = $this->dosen->list_dosen();

		$this->load->view('layout/header', $data);
		$this->load->view('jadwal_seminar', $data);
		$this->load->view('layout/footer');
	}

	function judul_by(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');

		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$id_mahasiswa = $this->uri->segment(3);

		$this->judul->setIDMahasiswa($id_mahasiswa);
		$result = $this->judul->list_data_by_akademik();
		$data['result'] = $result;

		$data['acc'] = $this->judul->cek_acc_judul();

		$this->mahasiswa->setID($id_mahasiswa);
		$mhs = $this->mahasiswa->get_mahasiswa();
		foreach ($mhs as $key => $val) {
			$data['nim_mhs'] = $val['nim'];
			$data['nama_mhs'] = $val['nama_mhs'];
		}

		$this->load->view('layout/header', $data);
		$this->load->view('list_judul', $data);
		$this->load->view('layout/footer');
	}

	function detail_data(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$id_judul = $this->uri->segment(3);
		$this->judul->setID($id_judul);
		$data['result_detail'] = $this->judul->get_data();

		$this->load->view('layout/header', $data);
		$this->load->view('detail', $data);
		$this->load->view('layout/footer');
	}

	function respon_judul(){
		$id_judul = $this->uri->segment(3);
		$status = $this->uri->segment(4);
		$id_mhs = $this->uri->segment(5);

		$this->judul->setID($id_judul);
		$this->judul->setStatus($status);

		$respon = $this->judul->respon_akademik();
		if($respon){
			$this->session->set_flashdata('success', 'Judul berhasil ditanggapi');
		}else {
			$this->session->set_flashdata('warning', 'terjadi kesalahans');
		}

		redirect('judulmahasiswas/judul_by/'.$id_mhs,'refresh');
	}

	function form_pembimbing(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$id_judul = $this->uri->segment(3);
		$this->judul->setID($id_judul);
		$data['result_detail'] = $this->judul->get_data();

		$data['list_dosen'] = $this->dosen->list_dosen();

		$this->load->view('layout/header', $data);
		$this->load->view('pembimbing', $data);
		$this->load->view('layout/footer');
	}

	function set_jadwal_seminar(){
		$this->form_validation->set_rules('opt_penguji1', 'Penguji 1', 'trim|required', array('required'=>'Penguji 1 belum dipilih'));
		$this->form_validation->set_rules('opt_penguji2', 'Penguji 2', 'trim|required', array('required'=>'Penguji 2 belum dipilih'));
		$this->form_validation->set_rules('txt_tanggal', 'Tanggal', 'trim|required', array('required'=>'Tanggal belum diisi atau tidak sesuai format'));
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		if($this->form_validation->run() == FALSE) {
			$id_user = $this->session->userdata('id_user');
			$jenis_user = $this->session->userdata('jenis_user');
			$data['id_user'] = $id_user;
			$data['jenis_user'] = $jenis_user;

			$id_seminar = $this->input->post('txt_id');

			$this->seminar->setID($id_seminar);
			$data['result_detail'] = $this->seminar->get_jadwal_seminar_akademik();
			$data['list_dosen'] = $this->dosen->list_dosen();

			$this->load->view('layout/header', $data);
			$this->load->view('jadwal_seminar', $data);
			$this->load->view('layout/footer');
		}else{

			$this->db->trans_start();

			$this->seminar->setID($this->input->post('txt_id'));
			$this->seminar->setJudulID($this->input->post('txt_id_judul'));
			$this->seminar->setPenguji1($this->input->post('opt_penguji1'));
			$this->seminar->setPenguji2($this->input->post('opt_penguji2'));
			$this->seminar->setTanggal($this->input->post('txt_tanggal'));
			$this->seminar->setStatusPengajuan(3);
			$update_seminar = $this->seminar->edit_seminar();
			$update_judul = $this->seminar->edit_penguji_judul();

			if($update_seminar && $update_judul){
				$this->session->set_flashdata('success', 'Penjadwalan Seminar berhasil dilakukan');
			}else {
				$this->session->set_flashdata('warning', 'terjadi kesalahan');
			}

			$this->db->trans_complete();

			redirect('penjadwalanseminars');
		}
	}

}