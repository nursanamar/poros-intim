<?php 

	class MA_Dashboard extends CI_Model {

		function listPeserta($idptkin) {
			return $this->db->query("SELECT p.*, c.nama_cabang, c.jenis
						FROM peserta as p, cabang as c, ptkin as pt
						WHERE p.id_cabang = c.id_cabang AND p.id_ptkin = pt.id_ptkin AND pt.id_ptkin='$idptkin'");
		}

		
		public function generate()
		{
			$ptkin = $this->db->get('ptkin')->result_array();
			$result = array();
			foreach ($ptkin as  $value) {
				$temp['id_ptkin'] = $value['id_ptkin'];
				$temp['password'] = "5f4dcc3b5aa765d61d8327deb882cf99";
				$temp['level'] = "admin";
				$temp['username'] = strtolower(explode(" ",$value['nama_ptkin'])[1]);

				$result[] = $temp;
			}

			$this->db->insert_batch('admin',$result);
		}

		public function updatePass($id,$newPass)
		{
			$this->db->set('password',$newPass);
			$this->db->where('id_admin',$id);
			$this->db->update('admin');
		}

	}

 ?>