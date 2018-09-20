<?php 

	class Dashboard extends CI_Controller {

		function __construct() {
            parent::__construct();
            check_level_admin();
            check_session();
            $this->load->model('M_dashboard', 'd');
		}

		function index() {
			$data['ilmiah'] = $this->d->viewCabang('ilmiah');
			$data['olahraga'] = $this->d->viewCabang('olahraga');
			$data['seni'] = $this->d->viewCabang('seni');
			$data['riset'] = $this->d->viewCabang('riset');
			$this->template->load('template','v_dashboard', $data);
		}

		function pilihCabang() {
			if (isset($_POST['submit'])) {
				$cabang = $_POST['cabang'];
				$cabang = implode($cabang, ', ');
				$cek = $this->d->cekRowCabang();
				if ($cek == 1) {
					$data = array
							('id_cabang'=> $cabang,
							'tgl_submit'=> date('Y-m-d'));
					$this->d->editCabang($data, $this->session->userdata('id_ptkin'));
					redirect('Pendaftaran');
				}
				else {
					$data = array
							('id_ptkin'=>$this->session->userdata('id_ptkin'),
							'id_cabang'=> $cabang,
							'tgl_submit'=> date('Y-m-d'));
					$this->d->inputCabang($data);
					redirect('Pendaftaran');
				}
			}
		}


	}

 ?>