<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Dosen extends CI_Model{

		private $id;
		private $nip;
		private $nama_dosen;
		private $email;
		private $no_hp;

		function setID($id){ $this->id = $id; }
		function getID(){ return $this->id; }
		function setNIP($nip){ $this->nip = $nip; }
		function getNIP(){ return $this->nip; }
		function setNamaDosen($nama_dosen){ $this->nama_dosen = $nama_dosen; }
		function getNamaDosen(){ return $this->nama_dosen; }
		function setEmail($email){ $this->email = $email; }
		function getEmail(){ return $this->email; }
		function setNoHP($no_hp){ $this->no_hp = $no_hp; }
		function getNoHP(){ return $this->no_hp; }

		function list_dosen(){
			$this->db->select('id, nip, nama_dosen, email, no_hp');
			$this->db->from('dosen');

			$result = $this->db->get();

			if($result->num_rows() > 0){
				return $result->result_array();
			}else{
				return NULL;
			}
		}

		function add_dosen(){
			$data = array(
				'nip' => $this->getNIP(),
				'nama_dosen' => $this->getNamaDosen(),
				'email' => $this->getEmail(),
				'no_hp' => $this->getNoHP()
			);
			$this->db->insert('dosen', $data);
			$inserted_id = $this->db->insert_id();
			$this->setID($inserted_id);

			return $inserted_id;
		}

		function add_user_dosen(){
			// add user dosen
			$data_user = array(
				'jenis_user' => 'dosen',
				'userid' => $this->getID(),
				'username' => $this->getNIP(),
				'password' => md5($this->getNIP())
			);
			$this->db->insert('user', $data_user);
			return $this->db->insert_id();
		}

		function get_data(){
			$this->db->select('
				id,
				nip,
				nama_dosen,
				email,
				no_hp
			');
			$this->db->from('dosen');
			$this->db->where('dosen.id', $this->getID());

			$result = $this->db->get();

			if($result->num_rows() > 0){
				return $result->result_array();
			}else{
				return NULL;
			}
		}

		function edit_data(){
			$data = array(
				'nip' => $this->getNIP(),
				'nama_dosen' => $this->getNamaDosen(),
				'email' => $this->getEmail(),
				'no_hp' => $this->getNoHP()
			);

			$this->db->update('dosen', $data, array('id'=>$this->getID()));
			return $this->db->affected_rows();
		}

		function delete_data(){
			$this->db->delete('dosen', array('id'=>$this->getID()));
			return $this->db->affected_rows();
		}
	}