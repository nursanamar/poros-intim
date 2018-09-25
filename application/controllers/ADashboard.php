<?php

class ADashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_level_super();
        check_session();
        $this->load->model('MA_dashboard', 'd');
        $this->load->library('datatables', null, 'dt');
    }

    public function index()
    {
        $this->template->load('template', 'va_dashboard');
    }

    public function listPeserta()
    {
        // $data['peserta'] = $this->d->listPeserta($idPtkin);
        $this->template->load('template', 'va_list');
	}
	
	public function user()
	{
		$this->template->load('template','userAccount');
    }

    public function seed()
    {
       $res['cabang'] = $this->d->dataReport();
       $res['ptkin'] = $this->d->ptkinReport();
       $this->sendResponse($res);

        // var_dump();
    }
    
    public function userTable()
    {
        $this->dt->select("admin.username,admin.id_admin,ptkin.nama_ptkin");
        $this->dt->from('admin');
        $this->dt->join('ptkin','admin.id_ptkin=ptkin.id_ptkin','inner');

        $result = json_decode($this->dt->generate('json'),true);
        $data = array();

        foreach ($result['data'] as $value) {
            $value['aksi'] = "<a class='label label-info' href='".base_url()."ADashboard/resetPassword/".$value['id_admin']."' >Reset Password</a>";
            unset($value['id_admin']);
            $data[] = $value;
        }

        $result['data'] = $data;

        $this->sendResponse($result);
    }

    public function resetPassword($idAdmin)
    {
        $this->template->load('template','resetPassword',array("id" => $idAdmin));
    }

    public function passReset()
    {
        $req = $this->input->post();
        $newPass = md5($req['password']);
        $this->d->updatePass($req['id'],$newPass);
        redirect('ADashboard/user');
    }

    public function tabelPeserta($idPtkin)
    {
        $this->dt->select("peserta.nim,peserta.nama,peserta.jurusan,peserta.fakultas,peserta.ktm,peserta.surat_aktif,peserta.rekomendasi,peserta.foto,peserta.dikti, cabang.nama_cabang,cabang.jenis");
        $this->dt->from('peserta');
        $this->dt->join('cabang', "peserta.id_cabang=cabang.id_cabang", 'inner');
        $this->dt->where('peserta.id_ptkin', $idPtkin);
        $dt = json_decode($this->dt->generate('json'),true);
        // var_dump($dt);
		$data = array();
		$no = 1;
        foreach ($dt['data'] as $value) {
            $value['dokumen'] = "<a href='" . base_url() . "assets/upload/ktm/" . $value['ktm'] . "' class='btn btn-xs btn-primary' target='_blank'>Ktm</a>
                            	<a href='" . base_url() . "assets/upload/foto/" . $value['foto'] . "' class='btn btn-xs btn-default' target='_blank'>Foto</a>
                            	<a href='" . base_url() . "assets/upload/rekomendasi/" . $value['rekomendasi'] . "' class='btn btn-xs btn-info' target='_blank'>Rekomendasi</a>
                            	<a href='" . base_url() . "assets/upload/aktif/" . $value['surat_aktif'] . "' class='btn btn-xs btn-success' target='_blank'>Surat Aktif</a>
								<a href='" . base_url() . "assets/upload/dikti/" . $value['dikti'] . "' class='btn btn-xs btn-warning' target='_blank'>Bukti Dikti</a>";
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

    public function excelPeserta()
    {
        $nama = $this->db->get_where('ptkin', array('id_ptkin' => $this->uri->segment(3)))->row_array();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=" . $nama['nama_ptkin'] . ".xls"); //File name extension was wrong
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $data['peserta'] = $this->d->listPeserta($this->uri->segment(3));
        $this->load->view('v_excel', $data);
    }
}
