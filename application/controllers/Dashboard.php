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
			$selected = $this->input->post('cabang');
			if($selected){
				$data = array();
				$id_ptkin = $this->session->userdata('id_ptkin');
				foreach ($selected as $value) {
					$temp['id_ptkin'] = $id_ptkin;
					$temp['id_cabang'] = $value;
					$data[] = $temp;
				}

				$this->d->inputCabang($data);
				redirect('Pendaftaran');
			}else{
				redirect('Dashboard');
			}
		}


	}

 ?>