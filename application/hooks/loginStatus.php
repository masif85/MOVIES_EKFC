<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class LoginStatus {	
	var $CI;	
	private $allowed_controllers_array=array('home','login','');	
    public function __construct() {		
		$this->CI =& get_instance();
		$CI = & get_instance();		
		$browser=  $this->CI->agent->browser();			
		if($browser=='Internet Explorer')
		{		
			echo "<br /><br /><br /><div style='font-family:Arial;margin:0 auto 0; text-align:center;'><span style='color:red;font-size:24px;'>Internet Explorer is not supported for this platform, kindly use Google Chrome, Mozilla Firefox, Saffari, Opera or Microsoft Edge based browsers </span> <br /><br /><br />
			<img src='".base_url()."/public/images/browsers.png'><br /><br /><br />
			<span style='color:green;font-size:38px;text-align:center;border:1px solid green;padding:5px;'>Kindly use / download these above recommended Browsers</span>
			</div>
			";
			exit;
		//redirect(base_url("Myaccount"));	
		}		
    }

function set_back_from_login() {	
		$cp_number;
        $controller = strtolower($this->CI->uri->segment(1));	
        $method 	 = $this->CI->uri->segment(2);	
		$id = $this->CI->session->userdata('id');		
		$status = $this->CI->session->userdata('status');
		$user_access = $this->CI->session->userdata('permission');
		$store_status =$this->CI->session->userdata('store_status');//$this->CI->Admin_Model->fetch_row("tbl_store","");//	
		$user_type=$this->CI->session->userdata('user_type');		
	 	if (!in_array($controller,$this->allowed_controllers_array)) {	
		   $is_user_login = $this->CI->session->userdata('id');			
			$sts_array = array(0,1,2);
			$default_url = strtolower($this->CI->session->userdata('default_page'));
			$controller2 = explode('/',$default_url);
			$controller2=$controller2[0];			
			//If not login			
			/*echo $status;
			echo "<br />";
			print_r($sts_array);
			exit;*/
		   if ($is_user_login=='') {	
			  
			   //echo "- ".$controller; exit;
			   redirect(base_url().'home', 'refresh');
		   }
			else if(in_array($status,$sts_array) && $controller!=$controller2){				
				//echo "- ".$controller.$controller2; exit;
				 //redirect(base_url().'Login', 'refresh');
				
				redirect(base_url().$this->CI->session->userdata('default_page'));
				//redirect($actual_link);
			}			
		}
		/*******************************	Admin Panel Access Control	****************************/		
			$segment_1 = strtolower($this->CI->uri->segment(1));
			$invalid1 = false;
			$invalid2 = false;			
			if ($segment_1 != '' &&   ($method=='details')){				
				$is_member_login = $this->CI->session->userdata('id');
				$sess_user_role = $this->CI->session->userdata('sess_user_role');				
				if (!$this->CI->session->userdata('sess_user_role') || $this->CI->session->userdata('sess_user_role') == '') {					
					//$this->CI->session->set_userdata('back_from_login', full_url());
					$invalid1 = true;	
				}									
			}

			if($invalid1){		
				
				 $position=  strtolower($this->CI->uri->segment(3));
			  
				if(@$position)
				{
					//$cp_number="/".$position;
					$user_datas=array("cp_number"=>"/details/".$position);
					$this->CI->session->set_userdata($user_datas);
				}
				
				
				redirect(base_url("home/login"), 'refresh');
			}				
			if(!$invalid1 && $segment_1 != '' && $segment_1 != 'login' && $segment_1 != 'noAccess'  && @$this->CI->uri->segment(2) != 'logout' && $segment_1 != 'home' && $segment_1 != 'pages'){							
				$role_id = $this->CI->session->userdata('sess_user_role');	
			
				$user_id = $this->CI->session->userdata('id');
				$controller_slug = $segment_1;
				$method_slug = @$this->CI->uri->segment(2); if(!$method_slug) $method_slug = 'index';			
				$authentication = 0;
				//echo $controller_slug;exit;				
				$this->CI->db->select('t1.access_id');
				$this->CI->db->from('tbl_user_access_permissions t1');
				$this->CI->db->where("(t1.role_id = '$role_id' and t1.controller_slug = '$controller_slug' and t1.method_slug = '$method_slug')");
				$resultSet = $this->CI->db->get();
				//echo $this->CI->db->last_query();exit;
				if ($resultSet->num_rows() > 0) {
					$authentication = 1;
				}
				$resultSet->free_result();
				if(!$authentication){
					$this->CI->session->set_flashdata('msg', "unauthorized");					
					$this->CI->session->set_flashdata('type', "error");	
					$this->CI->session->set_flashdata('detail', "You are not Authorized to access this Module");	
					$this->CI->session->set_flashdata('close', " window.top.close();");
					//$this->CI->session->set_userdata('back_from_login', full_url());
					redirect($_SERVER['HTTP_REFERER']);
					//redirect(base_url().'noAccess', 'refresh');
				}
			}		
}
}