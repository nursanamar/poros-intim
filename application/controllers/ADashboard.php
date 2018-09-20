<?php 

	class ADashboard extends CI_Controller {

		function __construct() {
            parent::__construct();
            check_level_super();
            check_session();
            $this->load->model('MA_dashboard', 'd');
		}

		function index() {
			$this->template->load('template', 'va_dashboard');
		}

		function listPeserta() {
			$data['peserta'] = $this->d->listPeserta($this->uri->segment(3));
			$this->template->load('template', 'va_list', $data);
		}

		function excelPeserta() {
			$nama = $this->db->get_where('ptkin', array('id_ptkin'=>$this->uri->segment(3)))->row_array();
			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-Disposition: attachment; filename=".$nama['nama_ptkin'].".xls");  //File name extension was wrong
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private",false);
			$data['peserta'] = $this->d->listPeserta($this->uri->segment(3));
			$this->load->view('v_excel', $data);
		}
	}

 ?>