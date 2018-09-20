<?php

    class Auth extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->load->model('M_Auth', 'a');
        }

        function login() {
            if (isset($_POST['submit'])) {
                $hasil = $this->a->login($this->input->post('username'), md5($this->input->post('password')));
                if ($hasil==1) {
                    $data = $this->db->get_where('admin', array('username'=>$this->input->post('username'), 'password'=>md5($this->input->post('password'))))->row_array();
                    $sess = array('username'=>$data['username'],
                                    'id_admin'=>$data['id_admin'],
                                    'id_ptkin'=>$data['id_ptkin'],
                                    'level'=>$data['level'],
                                    'status_login'=>'oke');
                    $this->session->set_userdata($sess);
                    $this->db->where('id_admin', $data['id_admin']);
                    $this->db->update('admin', array('last_login'=>date('Y-m-d')));
                    if ($data['level']=="admin") {

                        redirect('Dashboard');
                    }
                    else if ($data['level']=="super") {
                        redirect('ADashboard');
                    }
                    else {
                        echo "pengacau";
                    }
                }
                else {
                    echo "Maaf username dan password salah";
                }
            }
            else {
                check_session_login();
                $this->load->view('v_login');
            }
        }

        function logout() {
            session_destroy();	
            redirect('Auth/login');
        }
    }



?>