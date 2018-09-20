<?php 

	class Pendaftaran extends CI_Controller {

		function __construct() {
            parent::__construct();
            check_level_admin();
            check_session();
            $this->load->model('M_pendaftaran', 'p');
		}

		function index() {
			$cek = $this->p->cekRowCabang();
			if ($cek == 1) {
				$data['cabang'] = $this->p->tampilCabang()->row_array();
				$this->template->load('template', 'v_pendaftaran', $data);
			}
			else {
				echo "<script>alert('Anda belum memilih cabang perlombaan yang akan diikuti');window.location.assign('Dashboard');self.focus();</script>";
			}
			
		}

		function lihatPendaftar() {
			$data['cabang'] = $this->p->namaCabang($this->uri->segment(3))->row_array();
			$data['peserta'] = $this->p->tampilPeserta($this->session->userdata('id_ptkin'), $this->uri->segment(3));
			$this->template->load('template', 'v_listPendaftar', $data);
		}

		function tambahPeserta() {
			if (isset($_POST['submit'])) {
				$data = array(
							'nim'=>$this->input->post('nim'),
							'nama'=>$this->input->post('nama'),
							'jurusan'=>$this->input->post('jurusan'),
							'fakultas'=>$this->input->post('fakultas'),
							'id_cabang'=>$this->input->post('id_cabang'),
							'id_ptkin'=>$this->session->userdata('id_ptkin')
							);
				$this->load->library('upload');

				if (!empty($_FILES['foto']['name']))
		        {
		            // Specify configuration for File 1
		            $foto_name = $this->input->post('nim')."-foto";
		            $config['file_name'] = $foto_name;
		            $config['upload_path'] = APPPATH. '../assets/upload/foto/';
					$config['allowed_types'] = 'jpg|png';
					$config['max_size'] = 200000;       

		            // Initialize config for File 1
		            $this->upload->initialize($config);
		            $filename= $_FILES["foto"]["name"];
					$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
					$data['foto'] = $foto_name.".".$file_ext;

		            // Upload file 1
		            if ($this->upload->do_upload('foto'))
		            {
		                $datas = $this->upload->data();
		            }
		            else
		            {
		                echo "foto gagal di upload";
		            }

		        }
		        if (!empty($_FILES['ktm']['name']))
		        {
		            // Specify configuration for File 1
		            $ktm_name = $this->input->post('nim')."-ktm";
		            $config['file_name'] = $ktm_name;
		            $config['upload_path'] = APPPATH. '../assets/upload/ktm/';
					$config['allowed_types'] = 'jpg|png|pdf';
					$config['max_size'] = 200000;       

		            // Initialize config for File 1
		            $this->upload->initialize($config);
		            $filename= $_FILES["ktm"]["name"];
					$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
					$data['ktm'] = $ktm_name.".".$file_ext;

		            // Upload file 1
		            if ($this->upload->do_upload('ktm'))
		            {
		                $datas = $this->upload->data();
		            }
		            else
		            {
		                echo "ktm gagal di upload";
		            }

		        }
		        if (!empty($_FILES['rekomendasi']['name']))
		        {
		            // Specify configuration for File 1
		            $rekomendasi_name = $this->input->post('nim')."-rekomendasi";
		            $config['file_name'] = $rekomendasi_name;
		            $config['upload_path'] = APPPATH. '../assets/upload/rekomendasi/';
					$config['allowed_types'] = 'jpg|png|pdf';
					$config['max_size'] = 200000;       

		            // Initialize config for File 1
		            $this->upload->initialize($config);
		            $filename= $_FILES["rekomendasi"]["name"];
					$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
					$data['rekomendasi'] = $rekomendasi_name.".".$file_ext ;

		            // Upload file 1
		            if ($this->upload->do_upload('rekomendasi'))
		            {
		                $datas = $this->upload->data();
		            }
		            else
		            {
		                echo "rekomendasi gagal di upload";
		            }

		        }
		        if (!empty($_FILES['surat_aktif']['name']))
		        {
		            // Specify configuration for File 1
		            $aktif_name = $this->input->post('nim')."-surat_aktif";
		            $config['file_name'] = $aktif_name;
		            $config['upload_path'] = APPPATH. '../assets/upload/aktif/';
					$config['allowed_types'] = 'jpg|png|pdf';
					$config['max_size'] = 200000;       

		            // Initialize config for File 1
		            $this->upload->initialize($config);
		            $filename= $_FILES["surat_aktif"]["name"];
					$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
					$data['surat_aktif'] = $aktif_name.".".$file_ext;


		            // Upload file 1
		            if ($this->upload->do_upload('surat_aktif'))
		            {
		                $datas = $this->upload->data();
		            }
		            else
		            {
		                echo "surat aktif gagal di upload";
		            }

		        }
		        if (!empty($_FILES['dikti']['name']))
		        {
		            // Specify configuration for File 1
		            $aktif_name = $this->input->post('nim')."-dikti";
		            $config['file_name'] = $aktif_name;
		            $config['upload_path'] = APPPATH. '../assets/upload/dikti/';
					$config['allowed_types'] = 'jpg|png|pdf';
					$config['max_size'] = 200000;       

		            // Initialize config for File 1
		            $this->upload->initialize($config);
		            $filename= $_FILES["dikti"]["name"];
					$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
					$data['dikti'] = $aktif_name.".".$file_ext;


		            // Upload file 1
		            if ($this->upload->do_upload('dikti'))
		            {
		                $datas = $this->upload->data();
		            }
		            else
		            {
		                echo "surat aktif gagal di upload";
		            }

		        }
				
				$this->p->tambahPeserta($data);
				redirect('Pendaftaran/lihatPendaftar/'.$this->input->post('id_cabang'));
			}
			else {
				$this->template->load('template', 'v_tambahPendaftar');

			}
		}

		function hapusPeserta() {
			$data = $this->p->getOne($this->uri->segment(3))->row_array();
			unlink(APPPATH. '../assets/upload/foto/'.$data['foto']);
			unlink(APPPATH. '../assets/upload/ktm/'.$data['ktm']);
			unlink(APPPATH. '../assets/upload/rekomendasi/'.$data['rekomendasi']);
			unlink(APPPATH. '../assets/upload/aktif/'.$data['surat_aktif']);
			unlink(APPPATH. '../assets/upload/dikti/'.$data['dikti']);
			$this->p->hapusPeserta($this->uri->segment(3));
			redirect('Pendaftaran');
		}

		function ubahPeserta() {
			if (isset($_POST['submit'])) {
				$data = array(
							'nim'=>$this->input->post('nim'),
							'nama'=>$this->input->post('nama'),
							'jurusan'=>$this->input->post('jurusan'),
							'fakultas'=>$this->input->post('fakultas')
							);
				$this->load->library('upload');
				$fileLama = $this->p->getOne($this->input->post('nim'))->row_array();
				if (!empty($_FILES['foto']['name']))
		        {
		            // Specify configuration for File 1
		            unlink(APPPATH. '../assets/upload/foto/'.$fileLama['foto']);
		            $foto_name = $this->input->post('nim')."-foto";
		            $config['file_name'] = $foto_name;
		            $config['upload_path'] = APPPATH. '../assets/upload/foto/';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['max_size'] = 200000;       

		            // Initialize config for File 1
		            $this->upload->initialize($config);
		            $filename= $_FILES["foto"]["name"];
					$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
					$data['foto'] = $foto_name.".".$file_ext;

		            // Upload file 1
		            if ($this->upload->do_upload('foto'))
		            {
		                $datas = $this->upload->data();
		            }
		            else
		            {
		                echo "foto gagal di upload";
		            }

		        }
		        if (!empty($_FILES['ktm']['name']))
		        {
		            // Specify configuration for File 1
		            unlink(APPPATH. '../assets/upload/ktm/'.$fileLama['ktm']);
		            $ktm_name = $this->input->post('nim')."-ktm";
		            $config['file_name'] = $ktm_name;
		            $config['upload_path'] = APPPATH. '../assets/upload/ktm/';
					$config['allowed_types'] = 'jpg|png|jpeg|pdf';
					$config['max_size'] = 200000;       

		            // Initialize config for File 1
		            $this->upload->initialize($config);
		            $filename= $_FILES["ktm"]["name"];
					$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
					$data['ktm'] = $ktm_name.".".$file_ext;

		            // Upload file 1
		            if ($this->upload->do_upload('ktm'))
		            {
		                $datas = $this->upload->data();
		            }
		            else
		            {
		                echo "ktm gagal di upload";
		            }

		        }
		        if (!empty($_FILES['rekomendasi']['name']))
		        {
		            // Specify configuration for File 1
		            unlink(APPPATH. '../assets/upload/rekomendasi/'.$fileLama['rekomendasi']);
		            $rekomendasi_name = $this->input->post('nim')."-rekomendasi";
		            $config['file_name'] = $rekomendasi_name;
		            $config['upload_path'] = APPPATH. '../assets/upload/rekomendasi/';
					$config['allowed_types'] = 'jpg|png|pdf';
					$config['max_size'] = 200000;       

		            // Initialize config for File 1
		            $this->upload->initialize($config);
		            $filename= $_FILES["rekomendasi"]["name"];
					$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
					$data['rekomendasi'] = $rekomendasi_name.".".$file_ext ;

		            // Upload file 1
		            if ($this->upload->do_upload('rekomendasi'))
		            {
		                $datas = $this->upload->data();
		            }
		            else
		            {
		                echo "rekomendasi gagal di upload";
		            }

		        }
		        if (!empty($_FILES['surat_aktif']['name']))
		        {
		            // Specify configuration for File 1
		            unlink(APPPATH. '../assets/upload/aktif/'.$fileLama['surat_aktif']);
		            $aktif_name = $this->input->post('nim')."-surat_aktif";
		            $config['file_name'] = $aktif_name;
		            $config['upload_path'] = APPPATH. '../assets/upload/aktif/';
					$config['allowed_types'] = 'jpg|png|pdf';
					$config['max_size'] = 200000;       

		            // Initialize config for File 1
		            $this->upload->initialize($config);
		            $filename= $_FILES["surat_aktif"]["name"];
					$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
					$data['surat_aktif'] = $aktif_name.".".$file_ext;


		            // Upload file 1
		            if ($this->upload->do_upload('surat_aktif'))
		            {
		                $datas = $this->upload->data();
		            }
		            else
		            {
		                echo "surat aktif gagal di upload";
		            }

		        }
		        if (!empty($_FILES['dikti']['name']))
		        {
		            // Specify configuration for File 1
		            unlink(APPPATH. '../assets/upload/dikti/'.$fileLama['dikti']);
		            $aktif_name = $this->input->post('nim')."-dikti";
		            $config['file_name'] = $aktif_name;
		            $config['upload_path'] = APPPATH. '../assets/upload/dikti/';
					$config['allowed_types'] = 'jpg|png|pdf';
					$config['max_size'] = 200000;       

		            // Initialize config for File 1
		            $this->upload->initialize($config);
		            $filename= $_FILES["dikti"]["name"];
					$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
					$data['dikti'] = $aktif_name.".".$file_ext;


		            // Upload file 1
		            if ($this->upload->do_upload('dikti'))
		            {
		                $datas = $this->upload->data();
		            }
		            else
		            {
		                echo "surat aktif gagal di upload";
		            }

		        }
				
				$this->p->ubahPeserta($this->input->post('nim_awal'), $data);
				redirect('Pendaftaran/lihatPendaftar/'.$this->input->post('id_cabang'));
			}
			else {
				$data['row'] = $this->p->getOne($this->uri->segment(3))->row_array();
				$this->template->load('template', 'v_ubahPendaftar', $data);

			}
		}

	}

 ?>