<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penginputannilais extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('judul');
		$this->load->model('seminar');
		$this->load->model('sidang');
		$this->load->model('mahasiswa');
		$this->load->model('dosen');
	}

	function index(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$result = $this->seminar->list_ready_seminar_akademik();
		$data['result'] = $result;

		$result_sidang = $this->sidang->list_ready_sidang_akademik();
		$data['result_sidang'] = $result_sidang;

		$this->load->view('layout/header', $data);
		$this->load->view('list_all', $data);
		$this->load->view('layout/footer');
	}

	function input_nilai_seminar(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$id_seminar = $this->uri->segment(3);

		$this->seminar->setID($id_seminar);
		$data['result_detail'] = $this->seminar->get_jadwal_seminar_akademik();
		$data['list_dosen'] = $this->dosen->list_dosen();

		$this->load->view('layout/header', $data);
		$this->load->view('nilai_seminar', $data);
		$this->load->view('layout/footer');
	}

	function input_nilai_sidang(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$id_sidang = $this->uri->segment(3);

		$this->sidang->setID($id_sidang);
		$data['result_detail'] = $this->sidang->get_jadwal_sidang_akademik();
		$data['list_dosen'] = $this->dosen->list_dosen();

		$this->load->view('layout/header', $data);
		$this->load->view('nilai_sidang', $data);
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

	function set_nilai_seminar(){
		$this->form_validation->set_rules('txt_nilai_pembimbing', 'Nilai Pembimbing', 'trim|required', array('required'=>'Nilai Pembimbing belum diisi'));
		$this->form_validation->set_rules('txt_nilai_penguji1', 'Nilai Penguji 1', 'trim|required', array('required'=>'Nilai Penguji 1 belum diisi'));
		$this->form_validation->set_rules('txt_nilai_penguji2', 'Nilai Penguji 2', 'trim|required', array('required'=>'Nilai Penguji 2 belum diisi'));
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		if($this->form_validation->run() == FALSE) {
			$id_user = $this->session->userdata('id_user');
			$jenis_user = $this->session->userdata('jenis_user');
			$data['id_user'] = $id_user;
			$data['jenis_user'] = $jenis_user;

			$id_seminar = $this->input->post('txt_id');

			$this->seminar->setID($id_seminar);
			$data['result_detail'] = $this->seminar->get_jadwal_seminar_akademik();

			$this->load->view('layout/header', $data);
			$this->load->view('nilai_seminar', $data);
			$this->load->view('layout/footer');
		}else{

			$this->db->trans_start();

			$this->seminar->setID($this->input->post('txt_id'));
			$this->seminar->setJudulID($this->input->post('txt_id_judul'));
			$this->seminar->setNilaiPembimbing($this->input->post('txt_nilai_pembimbing'));
			$this->seminar->setNilaiPenguji1($this->input->post('txt_nilai_penguji1'));
			$this->seminar->setNilaiPenguji2($this->input->post('txt_nilai_penguji2'));

			$nilai0 = $this->input->post('txt_nilai_pembimbing');
			$nilai1 = $this->input->post('txt_nilai_penguji1');
			$nilai2 = $this->input->post('txt_nilai_penguji2');

			$avg_nilai = (30/100 * $nilai0) + (35/100 * $nilai1) + (35/100 * $nilai2);

			if($avg_nilai >= 75){
				$status_lulus = 1;
			}else{
				$status_lulus = 0;
			}

			$this->seminar->setStatus($status_lulus);

			$update_seminar = $this->seminar->edit_seminar_nilai();

			if($update_seminar){
				$this->session->set_flashdata('success', 'Penginputan nilai seminar berhasil');
			}else {
				$this->session->set_flashdata('warning', 'terjadi kesalahan');
			}

			$this->db->trans_complete();

			redirect('penginputannilais', 'refresh');
		}
	}

	function set_nilai_sidang(){
		$this->form_validation->set_rules('txt_nilai_pembimbing', 'Nilai Pembimbing', 'trim|required', array('required'=>'Nilai Pembimbing belum diisi'));
		$this->form_validation->set_rules('txt_nilai_penguji1', 'Nilai Penguji 1', 'trim|required', array('required'=>'Nilai Penguji 1 belum diisi'));
		$this->form_validation->set_rules('txt_nilai_penguji2', 'Nilai Penguji 2', 'trim|required', array('required'=>'Nilai Penguji 2 belum diisi'));
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		if($this->form_validation->run() == FALSE) {
			$id_user = $this->session->userdata('id_user');
			$jenis_user = $this->session->userdata('jenis_user');
			$data['id_user'] = $id_user;
			$data['jenis_user'] = $jenis_user;

			$id_sidang = $this->input->post('txt_id');

			$this->sidang->setID($id_sidang);
			$data['result_detail'] = $this->sidang->get_jadwal_sidang_akademik();

			$this->load->view('layout/header', $data);
			$this->load->view('nilai_sidang', $data);
			$this->load->view('layout/footer');
		}else{

			$this->db->trans_start();

			$this->sidang->setID($this->input->post('txt_id'));
			$this->sidang->setJudulID($this->input->post('txt_id_judul'));
			$this->sidang->setNilaiPembimbing($this->input->post('txt_nilai_pembimbing'));
			$this->sidang->setNilaiPenguji1($this->input->post('txt_nilai_penguji1'));
			$this->sidang->setNilaiPenguji2($this->input->post('txt_nilai_penguji2'));

			$nilai0 = $this->input->post('txt_nilai_pembimbing');
			$nilai1 = $this->input->post('txt_nilai_penguji1');
			$nilai2 = $this->input->post('txt_nilai_penguji2');

			$avg_nilai = (30/100 * $nilai0) + (35/100 * $nilai1) + (35/100 * $nilai2);

			if($avg_nilai >= 75){
				$status_lulus = 1;
			}else{
				$status_lulus = 0;
			}

			$this->sidang->setStatus($status_lulus);

			$update_sidang = $this->sidang->edit_sidang_nilai();

			if($update_sidang){
				$this->session->set_flashdata('success', 'Penginputan nilai sidang berhasil');
			}else {
				$this->session->set_flashdata('warning', 'terjadi kesalahan');
			}

			$this->db->trans_complete();

			redirect('penginputannilais', 'refresh');
		}
	}

}