<?php 

	class M_auth extends CI_Model {

		function login($username, $password) {
			$cek = $this->db->get_where('admin', array('username'=>$username, 'password'=>$password));
			if ($cek->num_rows()>0) {
				return 1;
			}
			else {
				return 0;
			}
		}

	}

 ?>