<?php 

	class MA_Dashboard extends CI_Model {

		function listPeserta($idptkin) {
			return $this->db->query("SELECT p.*, c.nama_cabang, c.jenis
						FROM peserta as p, cabang as c, ptkin as pt
						WHERE p.id_cabang = c.id_cabang AND p.id_ptkin = pt.id_ptkin AND pt.id_ptkin='$idptkin'");
		}

	}

 ?>