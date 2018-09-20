<?php 

	class M_dashboard extends CI_Model {

		function viewCabang($jenis) {
			return $this->db->get_where('cabang', array('jenis'=>$jenis));
		}

		function inputCabang($data) {
			$this->db->insert('ptkin_cabang', $data);
		}

		function editCabang($data, $id) {
			$this->db->where('id_ptkin', $id);
			$this->db->update('ptkin_cabang', $data);
		}

		function cekRowCabang() {
			$cek = $this->db->get_where('ptkin_cabang', array('id_ptkin'=>$this->session->userdata('id_ptkin')));
			if ($cek->row_array()>0) {
				return 1;
			}
			else {
				return 0;
			}
		}
	}

 ?>