<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    public function __construct() {
        
		parent::__construct();    
		$ci =& get_instance();
        $ci->load->helper('language');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('url_helper');
		$this->load->helper('html');
		$this->load->database();
		$this->load->helper('security');
		$this->load->library('form_validation');
		
		// set default timezone - with error handling for database connection
		try {
			$system = $this->read_setting_info(1);
			if ($system && isset($system[0])) {
				date_default_timezone_set($system[0]->system_timezone);
				$default_language = ($system[0]->default_language == '') ? 'english' : $system[0]->default_language;
			} else {
				date_default_timezone_set('UTC');
				$default_language = 'english';
			}
		} catch (Exception $e) {
			// Database not connected or table doesn't exist
			date_default_timezone_set('UTC');
			$default_language = 'english';
		}
		
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
            $ci->lang->load('hrsale',$siteLang);
        } else {
            $ci->lang->load('hrsale',$default_language);
        } 
    }
	
	// get setting info
	public function read_setting_info($id) {
		try {
			$condition = "setting_id =" . "'" . $id . "'";
			$this->db->select('*');
			$this->db->from('xin_system_setting');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		} catch (Exception $e) {
			// Database error - return null to allow application to continue
			return null;
		}
	}
}
?>