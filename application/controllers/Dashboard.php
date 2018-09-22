<?php 

	class Dashboard extends CI_Controller {

		function __construct() {
            parent::__construct();
            check_level_admin();
            check_session();
            $this->load->model('M_dashboard', 'd');
            $this->load->model('M_pendaftaran', 'p');
		}

		function index() {
			$cabang['Ilmiah'] = $this->d->viewCabang('ilmiah')->result_array();
			$cabang['Olahraga'] = $this->d->viewCabang('olahraga')->result_array();
			$cabang['Seni'] = $this->d->viewCabang('seni')->result_array();
			$cabang['Riset'] = $this->d->viewCabang('riset')->result_array();
			
			$data['selected'] = $this->p->selectedCabang() ;
			$data["cabang"] = $cabang;
			$this->template->load('template','v_dashboard', $data);
			// var_dump($data['selected']);
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
			// var_dump($this->input->post());
		}


	}

 ?>