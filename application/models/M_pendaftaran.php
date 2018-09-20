<?php
	
	class M_pendaftaran extends CI_Model {

		function cekRowCabang() {
			$cek = $this->db->get_where('ptkin_cabang', array('id_ptkin'=>$this->session->userdata('id_ptkin')));
			if ($cek->row_array()>0) {
				return 1;
			}
			else {
				return 0;
			}
		}

		function tampilCabang() {
			return $this->db->get_where('ptkin_cabang', array('id_ptkin'=>$this->session->userdata('id_ptkin')));
		}

		function tambahPeserta($data) {
			$this->db->insert('peserta', $data);
		}

		function tampilPeserta($ptkin, $cabang) {
			return $this->db->get_where('peserta', array('id_ptkin'=>$ptkin, 'id_cabang'=>$cabang));
		}

		function namaCabang($cabang) {
			return $this->db->get_where('cabang', array('id_cabang'=>$cabang));
		}

		function getOne($id) {
			return $this->db->get_where('peserta', array('nim'=>$id));
		}

		function hapusPeserta($id) {
			$this->db->where('nim', $id);
			$this->db->delete('peserta');
		}

		function ubahPeserta($id, $data) {
			$this->db->where('nim', $id);
			$this->db->update('peserta', $data);
		}

	}

?>