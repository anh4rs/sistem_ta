<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuansidangs extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('judul');
		$this->load->model('sidang');
	}

	function index(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$this->sidang->setMhsID($id_user);
		$result = $this->sidang->list_judul_acc_by_mahasiswa();
		$data['result'] = $result;

		$this->sidang->setMhsID($id_user);
		$cek_judul_acc = $this->sidang->cek_judul_acc();
		$cek_hasil_seminar = $this->sidang->cek_hasil_seminar();
		$data['cek_judul_acc'] = $cek_judul_acc;
		$data['cek_hasil_seminar'] = $cek_hasil_seminar;

		$detail_sidang = NULL;

		$status_sidang = $this->sidang->cek_status_sidang();
		$status = 0;
		if(count($status_sidang) > 0){
			foreach ($status_sidang as $key => $val) {
				$status = $val['status_pengajuan'];
			}

			if($status == 3){
				$this->sidang->setMhsID($id_user);
				$detail_sidang = $this->sidang->get_tanggal_sidang_mhs();
			}
		}

		$data['status'] = $status;
		$data['detail_sidang'] = $detail_sidang;

		$this->load->view('layout/header', $data);
		$this->load->view('list', $data);
		$this->load->view('layout/footer');
	}

	function pengajuan_sidang(){
		$id_user = $this->session->userdata('id_user');
		$id_judul = $this->uri->segment(3);

		$status_sidang = $this->sidang->cek_status_sidang();
		if(count($status_sidang) > 0){
			//jika data sidang sudah ada, maka edit status pengajuannya (pengajuan ulang)

		}else{
			$this->sidang->setMhsID($id_user);
			$this->sidang->setJudulID($id_judul);
			$add = $this->sidang->add_sidang_mhs();

			if($add){
				$this->session->set_flashdata('success', 'Pengajuan sidang berhasil dilakukan');
			}else {
				$this->session->set_flashdata('warning', 'terjadi kesalahan');
			}
		}

		redirect('pengajuansidangs','refresh');
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