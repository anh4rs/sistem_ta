<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuanjuduls extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('judul');
	}

	function index(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$this->judul->setIDMahasiswa($id_user);
		$result = $this->judul->list_data_by_mahasiswa();
		$data['result'] = $result;

		$cek_judul_ready = $this->judul->cek_jumlah_judul_ready();
		if($cek_judul_ready == 3){
			$data['ajukan_judul'] = TRUE;
		}else{
			$data['ajukan_judul'] = FALSE;
		}

		$cek_pengajuan_judul = $this->judul->cek_pengajuan_judul();
		if($cek_pengajuan_judul == 3){
			$data['pengajuan_judul'] = TRUE;
		}else{
			$data['pengajuan_judul'] = FALSE;
		}

		$data['aktif_pengajuan_judul'] = $this->judul->status_aktif_pengajuan_judul();

		$data['acc'] = $this->judul->cek_acc_judul();

		$this->load->view('layout/header', $data);
		$this->load->view('list', $data);
		$this->load->view('layout/footer');
	}

	function tambah_data(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$this->load->view('layout/header', $data);
		$this->load->view('add', $data);
		$this->load->view('layout/footer');
	}

	function simpan_data(){
		$this->form_validation->set_rules('txt_judul', 'Judul', 'trim|required', array('required'=>'Judul harus diisi'));
		$this->form_validation->set_rules('txt_ringkasan', 'Ringkasan Masalah', 'trim|required', array('required'=>'Ringkasan Masalah harus diisi'));
		$this->form_validation->set_rules('txt_metode', 'Metode', 'trim|required', array('required'=>'Metode harus diisi'));
		$this->form_validation->set_rules('txt_deskripsi', 'Deskripsi', 'trim|required', array('required'=>'Deskripsi harus diisi'));
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		if($this->form_validation->run() == FALSE) {
			$id_user = $this->session->userdata('id_user');
			$jenis_user = $this->session->userdata('jenis_user');
			$data['id_user'] = $id_user;
			$data['jenis_user'] = $jenis_user;

			$this->load->view('layout/header', $data);
			$this->load->view('add', $data);
			$this->load->view('layout/footer');
		}else{

			$this->db->trans_start();

			$this->judul->setIDMahasiswa($this->session->userdata('id_user'));
			$this->judul->setJudul($this->input->post('txt_judul'));
			$save = $this->judul->insert_data();

			if($save){
				$this->judul->setID($save);
				$this->judul->setRingkasMasalah($this->input->post('txt_ringkasan'));
				$this->judul->setMetode($this->input->post('txt_metode'));
				$this->judul->setDeskripsi($this->input->post('txt_deskripsi'));
				$save_detail = $this->judul->insert_data_detail();

				if($save_detail){
					$this->session->set_flashdata('success', 'Judul berhasil disimpan');
				}else {
					$this->session->set_flashdata('warning', 'terjadi kesalahan');
				}
			}

			$this->db->trans_complete();

			redirect('pengajuanjuduls','refresh');
		}
	}

	function edit_form(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$id_judul = $this->uri->segment(3);
		$this->judul->setID($id_judul);
		$data['result_detail'] = $this->judul->get_data();

		$this->load->view('layout/header', $data);
		$this->load->view('edit', $data);
		$this->load->view('layout/footer');
	}

	function ubah_data(){
		$this->form_validation->set_rules('txt_judul', 'Judul', 'trim|required', array('required'=>'Judul harus diisi'));
		$this->form_validation->set_rules('txt_ringkasan', 'Ringkasan Masalah', 'trim|required', array('required'=>'Ringkasan Masalah harus diisi'));
		$this->form_validation->set_rules('txt_metode', 'Metode', 'trim|required', array('required'=>'Metode harus diisi'));
		$this->form_validation->set_rules('txt_deskripsi', 'Deskripsi', 'trim|required', array('required'=>'Deskripsi harus diisi'));
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		if($this->form_validation->run() == FALSE) {
			$id_user = $this->session->userdata('id_user');
			$jenis_user = $this->session->userdata('jenis_user');
			$data['id_user'] = $id_user;
			$data['jenis_user'] = $jenis_user;

			$id_judul = $this->uri->segment(3);
			$this->judul->setID($id_judul);
			$data['result_detail'] = $this->judul->get_data();

			$this->load->view('layout/header', $data);
			$this->load->view('edit', $data);
			$this->load->view('layout/footer');
		}else{

			$this->db->trans_start();

			$this->judul->setID($this->input->post('txt_id'));
			$this->judul->setJudul($this->input->post('txt_judul'));
			$update = $this->judul->edit_data();

			$this->judul->setIDDetail($this->input->post('txt_id_detail'));
			$this->judul->setRingkasMasalah($this->input->post('txt_ringkasan'));
			$this->judul->setMetode($this->input->post('txt_metode'));
			$this->judul->setDeskripsi($this->input->post('txt_deskripsi'));
			$edit_detail = $this->judul->edit_data_detail();

			if($update || $edit_detail){
				$this->session->set_flashdata('success', 'Judul berhasil diedit');
			}else {
				$this->session->set_flashdata('warning', 'terjadi kesalahan');
			}

			$this->db->trans_complete();

			redirect('pengajuanjuduls','refresh');
		}
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

	function hapus_data(){
		$id_judul = $this->uri->segment(3);

		$this->judul->setID($id_judul);
		$delete = $this->judul->delete_data();

		if($delete){
			$this->session->set_flashdata('success', 'Judul berhasil dihapus');
		}else {
			$this->session->set_flashdata('warning', 'terjadi kesalahan');
		}
		redirect('pengajuanjuduls','refresh');
	}

	function pengajuan_judul(){
		$id_user = $this->session->userdata('id_user');

		$this->judul->setIDMahasiswa($id_user);
		$ajukan = $this->judul->pengajuan_judul_mahasiswa();

		if($ajukan){
			$this->session->set_flashdata('success', 'Judul berhasil diajukan');
		}else {
			$this->session->set_flashdata('warning', 'terjadi kesalahan');
		}
		redirect('pengajuanjuduls','refresh');
	}
}