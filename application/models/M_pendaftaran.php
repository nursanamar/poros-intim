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

		function selectedCabang() {
			$data = $this->db->get_where('ptkin_cabang', array('id_ptkin'=>$this->session->userdata('id_ptkin')))->result_array();
			if($data){
				$result = array();
				foreach ($data as $value) {
					$result[] = $value['id_cabang'];
				}
				return $result;
			}else{
				return array();
			}

		}
		
		function tampilCabang() {
			$this->db->select('cabang.id_cabang,cabang.nama_cabang,cabang.jenis');
			$this->db->from('ptkin_cabang');
			$this->db->join('cabang','cabang.id_cabang=ptkin_cabang.id_cabang','inner');
			$this->db->where('id_ptkin',$this->session->userdata('id_ptkin'));
			
			return $this->db->get()->result_array();
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