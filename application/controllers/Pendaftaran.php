<?php

class Pendaftaran extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_level_admin();
        check_session();
		$this->load->model('M_pendaftaran', 'p');
  $this->load->library('datatables', null, 'dt');
		
    }

    public function index()
    {
        $cek = $this->p->cekRowCabang();
        if ($cek == 1) {
            $data['pilihan'] = $this->p->tampilCabang();
            $this->template->load('template', 'v_pendaftaran', $data);
        } else {
            echo "<script>alert('Anda belum memilih cabang perlombaan yang akan diikuti');window.location.assign('Dashboard');self.focus();</script>";
        }

    }

    public function lihatPendaftar()
    {
        $data['cabang'] = $this->p->namaCabang($this->uri->segment(3))->row_array();
        $this->template->load('template', 'v_listPendaftar', $data);
    }

    public function tabelPeserta($idCabang)
    {
		$idPtkin = $this->session->userdata('id_ptkin');
        $this->dt->select("peserta.nim,peserta.nama,peserta.jurusan,peserta.fakultas,peserta.ktm,peserta.surat_aktif,peserta.rekomendasi,peserta.foto,peserta.dikti, cabang.nama_cabang,cabang.jenis");
        $this->dt->from('peserta');
        $this->dt->join('cabang', "peserta.id_cabang=cabang.id_cabang", 'inner');
		$this->dt->where('peserta.id_ptkin', $idPtkin);
		$this->dt->where('peserta.id_cabang', $idCabang);		
        $dt = json_decode($this->dt->generate('json'), true);
        $data = array();
        $no = 1;
        foreach ($dt['data'] as $value) {
            $value['dokumen'] = "<a href='" . base_url() . "assets/upload/ktm/" . $value['ktm'] . "' class='btn btn-xs btn-primary' target='_blank'>Ktm</a>
                            	<a href='" . base_url() . "assets/upload/foto/" . $value['foto'] . "' class='btn btn-xs btn-default' target='_blank'>Foto</a>
                            	<a href='" . base_url() . "assets/upload/rekomendasi/" . $value['rekomendasi'] . "' class='btn btn-xs btn-info' target='_blank'>Rekomendasi</a>
                            	<a href='" . base_url() . "assets/upload/aktif/" . $value['surat_aktif'] . "' class='btn btn-xs btn-success' target='_blank'>Surat Aktif</a>
								<a href='" . base_url() . "assets/upload/dikti/" . $value['dikti'] . "' class='btn btn-xs btn-warning' target='_blank'>Bukti Dikti</a>";
			$value['action'] = "<a href='".base_url()."Pendaftaran/ubahPeserta/".$value['nim']."' class='btn btn-sm btn-link'  title='Ubah data'><span class='glyphicon glyphicon-pencil'></span></a>".
								"<a href='".base_url()."Pendaftaran/hapusPeserta/".$value['nim']."' class='btn btn-sm btn-link' onclick='return confirm(\"Apakah anda yakin menghapus data ini?\")' title='hapus data'><span class='glyphicon glyphicon-trash'></span></a>";
            unset($value['ktm']);
            unset($value['foto']);
            unset($value['rekomendasi']);
            unset($value['surat_aktif']);
            unset($value['dikti']);
            $value['no'] = $no;
            $no++;
            $data[] = $value;
        }
        $dt['data'] = $data;

        $this->sendResponse($dt);
    }

    public function tambahPeserta()
    {
        if (isset($_POST['submit'])) {
            $data = array(
                'nim' => $this->input->post('nim'),
                'nama' => $this->input->post('nama'),
                'jurusan' => $this->input->post('jurusan'),
                'fakultas' => $this->input->post('fakultas'),
                'id_cabang' => $this->input->post('id_cabang'),
                'id_ptkin' => $this->session->userdata('id_ptkin'),
            );
            $this->load->library('upload');

            if (!empty($_FILES['foto']['name'])) {
                // Specify configuration for File 1
                $foto_name = $this->input->post('nim') . "-foto";
                $config['file_name'] = $foto_name;
                $config['upload_path'] = APPPATH . '../assets/upload/foto/';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = 200000;

                // Initialize config for File 1
                $this->upload->initialize($config);
                $filename = $_FILES["foto"]["name"];
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data['foto'] = $foto_name . "." . $file_ext;

                // Upload file 1
                if ($this->upload->do_upload('foto')) {
                    $datas = $this->upload->data();
                } else {
                    echo "foto gagal di upload";
                }

            }
            if (!empty($_FILES['ktm']['name'])) {
                // Specify configuration for File 1
                $ktm_name = $this->input->post('nim') . "-ktm";
                $config['file_name'] = $ktm_name;
                $config['upload_path'] = APPPATH . '../assets/upload/ktm/';
                $config['allowed_types'] = 'jpg|png|pdf';
                $config['max_size'] = 200000;

                // Initialize config for File 1
                $this->upload->initialize($config);
                $filename = $_FILES["ktm"]["name"];
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data['ktm'] = $ktm_name . "." . $file_ext;

                // Upload file 1
                if ($this->upload->do_upload('ktm')) {
                    $datas = $this->upload->data();
                } else {
                    echo "ktm gagal di upload";
                }

            }
            if (!empty($_FILES['rekomendasi']['name'])) {
                // Specify configuration for File 1
                $rekomendasi_name = $this->input->post('nim') . "-rekomendasi";
                $config['file_name'] = $rekomendasi_name;
                $config['upload_path'] = APPPATH . '../assets/upload/rekomendasi/';
                $config['allowed_types'] = 'jpg|png|pdf';
                $config['max_size'] = 200000;

                // Initialize config for File 1
                $this->upload->initialize($config);
                $filename = $_FILES["rekomendasi"]["name"];
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data['rekomendasi'] = $rekomendasi_name . "." . $file_ext;

                // Upload file 1
                if ($this->upload->do_upload('rekomendasi')) {
                    $datas = $this->upload->data();
                } else {
                    echo "rekomendasi gagal di upload";
                }

            }
            if (!empty($_FILES['surat_aktif']['name'])) {
                // Specify configuration for File 1
                $aktif_name = $this->input->post('nim') . "-surat_aktif";
                $config['file_name'] = $aktif_name;
                $config['upload_path'] = APPPATH . '../assets/upload/aktif/';
                $config['allowed_types'] = 'jpg|png|pdf';
                $config['max_size'] = 200000;

                // Initialize config for File 1
                $this->upload->initialize($config);
                $filename = $_FILES["surat_aktif"]["name"];
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data['surat_aktif'] = $aktif_name . "." . $file_ext;

                // Upload file 1
                if ($this->upload->do_upload('surat_aktif')) {
                    $datas = $this->upload->data();
                } else {
                    echo "surat aktif gagal di upload";
                }

            }
            if (!empty($_FILES['dikti']['name'])) {
                // Specify configuration for File 1
                $aktif_name = $this->input->post('nim') . "-dikti";
                $config['file_name'] = $aktif_name;
                $config['upload_path'] = APPPATH . '../assets/upload/dikti/';
                $config['allowed_types'] = 'jpg|png|pdf';
                $config['max_size'] = 200000;

                // Initialize config for File 1
                $this->upload->initialize($config);
                $filename = $_FILES["dikti"]["name"];
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data['dikti'] = $aktif_name . "." . $file_ext;

                // Upload file 1
                if ($this->upload->do_upload('dikti')) {
                    $datas = $this->upload->data();
                } else {
                    echo "surat aktif gagal di upload";
                }

            }

            $this->p->tambahPeserta($data);
            redirect('Pendaftaran/lihatPendaftar/' . $this->input->post('id_cabang'));
        } else {
            $this->template->load('template', 'v_tambahPendaftar');

        }
    }

    public function hapusPeserta()
    {
        $data = $this->p->getOne($this->uri->segment(3))->row_array();
        unlink(APPPATH . '../assets/upload/foto/' . $data['foto']);
        unlink(APPPATH . '../assets/upload/ktm/' . $data['ktm']);
        unlink(APPPATH . '../assets/upload/rekomendasi/' . $data['rekomendasi']);
        unlink(APPPATH . '../assets/upload/aktif/' . $data['surat_aktif']);
        unlink(APPPATH . '../assets/upload/dikti/' . $data['dikti']);
        $this->p->hapusPeserta($this->uri->segment(3));
        redirect('Pendaftaran');
    }

    public function ubahPeserta()
    {
        if (isset($_POST['submit'])) {
            $data = array(
                'nim' => $this->input->post('nim'),
                'nama' => $this->input->post('nama'),
                'jurusan' => $this->input->post('jurusan'),
                'fakultas' => $this->input->post('fakultas'),
            );
            $this->load->library('upload');
            $fileLama = $this->p->getOne($this->input->post('nim'))->row_array();
            if (!empty($_FILES['foto']['name'])) {
                // Specify configuration for File 1
                unlink(APPPATH . '../assets/upload/foto/' . $fileLama['foto']);
                $foto_name = $this->input->post('nim') . "-foto";
                $config['file_name'] = $foto_name;
                $config['upload_path'] = APPPATH . '../assets/upload/foto/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = 200000;

                // Initialize config for File 1
                $this->upload->initialize($config);
                $filename = $_FILES["foto"]["name"];
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data['foto'] = $foto_name . "." . $file_ext;

                // Upload file 1
                if ($this->upload->do_upload('foto')) {
                    $datas = $this->upload->data();
                } else {
                    echo "foto gagal di upload";
                }

            }
            if (!empty($_FILES['ktm']['name'])) {
                // Specify configuration for File 1
                unlink(APPPATH . '../assets/upload/ktm/' . $fileLama['ktm']);
                $ktm_name = $this->input->post('nim') . "-ktm";
                $config['file_name'] = $ktm_name;
                $config['upload_path'] = APPPATH . '../assets/upload/ktm/';
                $config['allowed_types'] = 'jpg|png|jpeg|pdf';
                $config['max_size'] = 200000;

                // Initialize config for File 1
                $this->upload->initialize($config);
                $filename = $_FILES["ktm"]["name"];
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data['ktm'] = $ktm_name . "." . $file_ext;

                // Upload file 1
                if ($this->upload->do_upload('ktm')) {
                    $datas = $this->upload->data();
                } else {
                    echo "ktm gagal di upload";
                }

            }
            if (!empty($_FILES['rekomendasi']['name'])) {
                // Specify configuration for File 1
                unlink(APPPATH . '../assets/upload/rekomendasi/' . $fileLama['rekomendasi']);
                $rekomendasi_name = $this->input->post('nim') . "-rekomendasi";
                $config['file_name'] = $rekomendasi_name;
                $config['upload_path'] = APPPATH . '../assets/upload/rekomendasi/';
                $config['allowed_types'] = 'jpg|png|pdf';
                $config['max_size'] = 200000;

                // Initialize config for File 1
                $this->upload->initialize($config);
                $filename = $_FILES["rekomendasi"]["name"];
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data['rekomendasi'] = $rekomendasi_name . "." . $file_ext;

                // Upload file 1
                if ($this->upload->do_upload('rekomendasi')) {
                    $datas = $this->upload->data();
                } else {
                    echo "rekomendasi gagal di upload";
                }

            }
            if (!empty($_FILES['surat_aktif']['name'])) {
                // Specify configuration for File 1
                unlink(APPPATH . '../assets/upload/aktif/' . $fileLama['surat_aktif']);
                $aktif_name = $this->input->post('nim') . "-surat_aktif";
                $config['file_name'] = $aktif_name;
                $config['upload_path'] = APPPATH . '../assets/upload/aktif/';
                $config['allowed_types'] = 'jpg|png|pdf';
                $config['max_size'] = 200000;

                // Initialize config for File 1
                $this->upload->initialize($config);
                $filename = $_FILES["surat_aktif"]["name"];
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data['surat_aktif'] = $aktif_name . "." . $file_ext;

                // Upload file 1
                if ($this->upload->do_upload('surat_aktif')) {
                    $datas = $this->upload->data();
                } else {
                    echo "surat aktif gagal di upload";
                }

            }
            if (!empty($_FILES['dikti']['name'])) {
                // Specify configuration for File 1
                unlink(APPPATH . '../assets/upload/dikti/' . $fileLama['dikti']);
                $aktif_name = $this->input->post('nim') . "-dikti";
                $config['file_name'] = $aktif_name;
                $config['upload_path'] = APPPATH . '../assets/upload/dikti/';
                $config['allowed_types'] = 'jpg|png|pdf';
                $config['max_size'] = 200000;

                // Initialize config for File 1
                $this->upload->initialize($config);
                $filename = $_FILES["dikti"]["name"];
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                $data['dikti'] = $aktif_name . "." . $file_ext;

                // Upload file 1
                if ($this->upload->do_upload('dikti')) {
                    $datas = $this->upload->data();
                } else {
                    echo "surat aktif gagal di upload";
                }

            }

            $this->p->ubahPeserta($this->input->post('nim_awal'), $data);
            redirect('Pendaftaran/lihatPendaftar/' . $this->input->post('id_cabang'));
        } else {
            $data['row'] = $this->p->getOne($this->uri->segment(3))->row_array();
            $this->template->load('template', 'v_ubahPendaftar', $data);

        }
    }

}
