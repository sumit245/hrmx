<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Login_model extends CI_Model
	{
     public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	// get setting info
	public function read_setting_info($id) {
		try {
			$sql = 'SELECT * FROM xin_system_setting WHERE setting_id = ?';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			if ($query && $query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		} catch (Exception $e) {
			return null;
		}
	}
	
	// Read data using username and password
	public function login($data) {
		try {
			$system = $this->read_setting_info(1);
			if (!$system || !isset($system[0])) {
				log_message('error', 'Login: System settings not found');
				return false;
			}
			
			if($system[0]->employee_login_id=='username'):		
				$sql = 'SELECT * FROM xin_employees WHERE username = ? AND is_active = ?';
				$binds = array($data['username'],1);
				$query = $this->db->query($sql, $binds);
				
			else:
				$sql = 'SELECT * FROM xin_employees WHERE email = ? AND is_active = ?';
				$binds = array($data['username'],1);
				$query = $this->db->query($sql, $binds);
				
			endif;		
			
			if ($query && $query->num_rows() > 0) {
				$rw_password = $query->result();
				if(isset($rw_password[0]->password) && password_verify($data['password'],$rw_password[0]->password)){
					log_message('info', 'Login: Successful login for ' . $data['username']);
					return true;
				} else {
					log_message('error', 'Login: Password verification failed for ' . $data['username']);
					return false;
				}
			} else {
				log_message('error', 'Login: User not found or inactive: ' . $data['username']);
				return false;
			}
		} catch (Exception $e) {
			// Database error
			log_message('error', 'Login: Exception - ' . $e->getMessage());
			return false;
		}
	}
	
	// Read data using email and password > frontend user
	public function frontend_user_login($data) {
	
		$sql = 'SELECT * FROM xin_users WHERE email = ? and password = ? and is_active = ?';
		$binds = array($data['email'],$data['password'],1);
		$query = $this->db->query($sql, $binds);
	
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	// Read data from database to show data in admin page
	public function read_user_information($username) {
		try {
			$system = $this->read_setting_info(1);
			if (!$system || !isset($system[0])) {
				return false;
			}
			
			if($system[0]->employee_login_id=='username'):
				$sql = 'SELECT * FROM xin_employees WHERE username = ?';
				$binds = array($username);
				$query = $this->db->query($sql, $binds);
			else:
				$sql = 'SELECT * FROM xin_employees WHERE email = ?';
				$binds = array($username);
				$query = $this->db->query($sql, $binds);
			endif;
			
			if ($query && $query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}
	
	// Read data from database to show data in admin page
	public function read_user_info_session_id($user_id) {
	
		$sql = 'SELECT * FROM xin_employees WHERE user_id = ?';
		$binds = array($user_id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// Read data from database to show data in admin page
	public function read_frontend_user_info_session($email) {
	
		$sql = 'SELECT * FROM xin_users WHERE email = ?';
		$binds = array($email);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	

}
?>