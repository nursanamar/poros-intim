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

		public function seedPeserta()
		{
			$example = $this->db->get('peserta')->result_array();
			$ids_cabang = $this->db->select('id_cabang')->get('cabang')->result_array();
			$ids_ptkin = $this->db->select('id_ptkin')->get('ptkin')->result_array();

			$result = array();
			// var_dump($example,$ids_cabang,$ids_ptkin);
			for ($i=1; $i <= 500 ; $i++) {
				$ptkin_key = array_rand($ids_ptkin); 
				$cabang_key = array_rand($ids_cabang);
				$temp = $example[0];
				$temp['nim'] = $temp['nim'] + ($i + 100);
				$temp['id_ptkin'] = $ids_ptkin[$ptkin_key]['id_ptkin'];
				$temp['id_cabang'] = $ids_cabang[$cabang_key]['id_cabang'];
				$result[] = $temp;
			}

			$this->db->insert_batch('peserta',$result);

		}

		public function seedPtkinCabang()
		{
			$ptkin = $this->db->select('id_ptkin')->get('ptkin')->result_array();
			$result = array();
			foreach ($ptkin as $value) {
				$this->db->distinct('id_cabang');
				$this->db->select('id_cabang');
				$this->db->where('id_ptkin',$value['id_ptkin']);
				$cabang = $this->db->get('peserta')->result_array();
				
				foreach ($cabang as $valu) {
					$result[] = array(
						"id_ptkin" => $value['id_ptkin'],
						"id_cabang" => $valu['id_cabang']
					);

					// echo $value['id_ptkin']." - ".$valu['id_cabang']." , ";
				}
				// echo "<br>";
				// var_dump($cabang);
				// echo "<br>";
			}

			$this->db->insert_batch('ptkin_cabang',$result);
		}


		public function dataReport()
		{
			$cabang = $this->db->get('cabang')->result_array();

			$data['labels'] = array();
			$data['data'] = array();
			$data['colors'] = array();
			foreach ($cabang as $value) {
				$data['labels'][] = $value['nama_cabang'];
				$data['colors'][] = '#'.dechex(mt_rand(0,16777215));
				$data['data'][] = $this->db->where('id_cabang',$value['id_cabang'])->from('peserta')->count_all_results();
			}

			return $data;

		}

		public function ptkinReport()
		{
			$cabang = $this->db->get('ptkin')->result_array();

			$data['labels'] = array();
			$data['data'] = array();
			$data['colors'] = array();
			foreach ($cabang as $value) {
				$data['labels'][] = $value['nama_ptkin'];
				$data['colors'][] = '#'.dechex(mt_rand(0,16777215));
				$data['data'][] = $this->db->where('id_ptkin',$value['id_ptkin'])->from('peserta')->count_all_results();
			}

			return $data;

		}

	}

 ?>