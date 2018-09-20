<?php

    function check_modul($url)
    {
        $CI= & get_instance();
        $session=$CI->session->userdata('username');
        $user = $CI->db->get_where('data_memberindra', array('userindra'=>$session))->row_array();
        $group = $CI->db->get_where('dp_grup', array('id_grup'=>$user['auth']))->row_array();
        $menu = $CI->db->query("SELECT * FROM dp_menu WHERE menu_id IN ($group[modul_grup])");
        $m = $CI->db->query("SELECT * FROM dp_menu WHERE menu_url='$url' AND menu_id IN ($group[modul_grup])");

        if ($m->num_rows()<1) {
            echo "<script>alert('Anda Tidak Dapat Membuka Menu Ini'); window.location.assign('".base_url()."Dashboard'); self.focus();</script>";
        }
        
    }

    function check_session()
    {
        $CI= & get_instance();
        $session=$CI->session->userdata('status_login');
        if($session!='oke')
        {
            redirect(base_url());
        }
    }


    function check_session_login()
    {
        $CI= & get_instance();
        $session=$CI->session->userdata('status_login');
        if($session=='oke')
        {
            redirect('Dashboard');
        }
    }

    function check_level_super()
    {
        $CI= & get_instance();
        $session=$CI->session->userdata('level');
        if($session!='super')
        {
            redirect('Dashboard');
        }
    }

    function check_level_admin()
    {
        $CI= & get_instance();
        $session=$CI->session->userdata('level');
        if($session!='admin')
        {
            redirect('ADashboard');
        }
    }

    function tgl_indo($tanggals){
        // 2014-08-24
        // 24-08-2014
        $tanggal=  substr($tanggals,8,2 );
        $bulan=  substr($tanggals, 5,2);
        $tahun=  substr($tanggals, 0,4);
        
        return $tanggal."-".  bulan($bulan)."-".$tahun;
    }

    function bulan($bulan)
    {
        switch ($bulan){
            
            case 1: return 'Januari';
                break;
            case 2: return 'Februari';
                break;
            case 3: return 'Maret';
                break;
            case 4: return 'April';
                break;
            case 5: return 'Mei';
                break;
            case 6: return 'Juni';
                break;
            case 7: return 'Juli';
                break;
            case 8: return 'Agustus';
                break;
            case 9: return 'September';
                break;
            case 10: return 'Oktober';
                break;
            case 11: return 'November';
                break;
            case 12: return 'Desember';
                break;
        }
    }

    function tgl($tanggals){
        // 2014-08-24
        // 24-08-2014
        $tanggal=  substr($tanggals,8,2 );
        $bulan=  substr($tanggals, 5,2);
        
        return $tanggal." ".  bln($bulan);
    }

    function bln($bulan)
    {
        switch ($bulan){
            
            case 1: return 'Jan';
                break;
            case 2: return 'Feb';
                break;
            case 3: return 'Mar';
                break;
            case 4: return 'Apr';
                break;
            case 5: return 'Mei';
                break;
            case 6: return 'Jun';
                break;
            case 7: return 'Jul';
                break;
            case 8: return 'Agu';
                break;
            case 9: return 'Sep';
                break;
            case 10: return 'Okt';
                break;
            case 11: return 'Nov';
                break;
            case 12: return 'Des';
                break;
        }
    }
?>
