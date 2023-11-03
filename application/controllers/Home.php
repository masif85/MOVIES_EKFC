<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
require_once APPPATH.'/third_party/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
class Home extends CI_Controller {	
    function __construct(){
        parent::__construct();
        $this->user_id = $this->session->userdata('id');
    }  
	
	public function login()
	{
		
	if($this->session->userdata('id'))
	{	
		//redirect(base_url().$this->CI->session->userdata('default_page').$cp_number);		
		redirect(base_url("Home"));
	}
		else
		{
			$this->load->view('login');
		}
	}
	
	private function get_agent()
	{
		if ($this->agent->is_mobile())
		{
				$agent = $this->agent->mobile();
		}
		else
		{
			
			$agent = "Desktop";
		}
		
		
		return $agent;
	}
	
	public function index()
	{			
			
		$is_user_login = $this->session->userdata('id');	
		if($this->user_id!='')
		{
			redirect(base_url("Admin/".$this->session->userdata('default_page')));
			//$this->load->view('ktadmin/dashboard');
		//redirect(base_url("competition"));

		}
		else
		{
			$this->load->view('login');
		}		
	}

		public function create_movie()
	{	
		

		$cover_picture="";
		if($_FILES["cover_picture"]['name'])
		{
			
			$cover_picture=$this->upload_files("cover_picture","editions/pics");
		}
		


	$video_file="";
	$video_type = "";
		if($_FILES["movie_file"]['name'])
		{	
	
			$video_file=$this->upload_file("movie_file","editions/assets");	
			$video_type = strtolower(pathinfo($_FILES["movie_file"]['name'], PATHINFO_EXTENSION));	
		}
		$title=$this->input->post("title");
		$topic=$this->input->post("topic");	
		$genere=$this->input->post("genere");		
				
		$comp_data=array("title"=>$title,						 						
						"video_type"=>$video_type,						 
						"cover_picture"=>$cover_picture,
						"video"=>$video_file,
						 "genere"=>$genere
						);
		
					
			$comp_id=$this->Main_Model->insert_data("vr_movies",$comp_data);
			
			$check=1;
		
		//$comp_id=1;
		
		
		if($check==1)
		{
			$data=array("msg"=>"success");
			echo json_encode($data);
		}
		else
		{
			$data=array("msg"=>"failure");
			echo json_encode($data);
		}		
	}
	
		private function upload_files($filename,$path)
	{	
	$imagePath = '../public/'.$path.'';
	$config['upload_path'] = realpath(APPPATH . $imagePath);
	//$config['allowed_types'] ='PDF|pdf|txt|TXT|doc|DOC|docx|DOCX|xlsx|XLSX|ppt|jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF|tif|TIF|bmp|BMP|pptx|ppsx|xls|XLS|RTF|rtf';
	$config['allowed_types'] ='heic|HEIC|jpg|JPG|jpeg|JPEG|png|PNG|x-png|X-PNG|gif|GIF|tif|TIF|bmp|BMP|mp4|MP4|avi|AVI|WEBP|webp|mov|MOV';	
	$config['max_size']	= 1024 * 100;
	$config['max_width']  = 0;
	$config['max_height']  = 0;
	$config['encrypt_name'] = true;
	$this->upload->initialize($config);	
	if ($this->upload->do_upload($filename)){
		$fileData = $this->upload->data();								
		$uploaded_file_name = $fileData['file_name'];
	}
		return $uploaded_file_name;
	}

	private function upload_file($filename,$path)
	{
		if($_FILES["$filename"]['size'] > 1024 * 100){
		
		
		if($path=='editions/pics')
		{
			$accept = ["jpg", "png", "webp","jpeg","x-png","HEIC","heic"];
		}
		else
		{
			$accept = ["gif","mp4","avi","MOV","mov"];
		}
			$ext = strtolower(pathinfo($_FILES["$filename"]['name'], PATHINFO_EXTENSION));
			$imagePath = '../public/'.$path.'';
			$uploaddir = realpath(APPPATH . $imagePath);
			$filenamez= uniqid().time().".$ext";
			$uploadfile = $uploaddir ."/". $filenamez;
			if (in_array($ext, $accept)) { move_uploaded_file($_FILES["$filename"]['tmp_name'], $uploadfile); 
										 return $filenamez;
										 }
		else
		{
			return 0;
		}
		}
		else
		{
			
			return 0;
		}		
	}
	public function details($id="")
	{		
		$data['utag_data_details']='var utag_data = {
			"event_type"        : "page_view",            	
			"page_category"     : "listing",                 	
			"page_lang"         : "English",              	
			"page_section"      : "section_page",       	
			"page_type"         : "Homepage",             	
			"tealium_event"     : "Sub Page",             	
			"user_application"  : "'.$this->get_agent().'"             	 //This should capture dynamically desktop or mobile use
		};';
		
		if($this->user_id!=''):
			
		if($this->is_valid($id)==0 && $this->is_available($id)==1)
		{			
			$data['details']=$this->Main_Model->fetch_rows_joins("
			c.*,
			qt.id as 'type_id',
			qt.type,
			qt.type_title,
			qt.question_title,
			GROUP_CONCAT(q.id) AS 'q_id',
			GROUP_CONCAT(q.choice_text) AS 'choice_text',
			GROUP_CONCAT(q.is_correct) AS 'is_correct',
			GROUP_CONCAT(q.correct_text) AS 'correct_text'",
			"tbl_competition c","
			LEFT JOIN tbl_questions_type qt on c.id=qt.comp_id
			LEFT JOIN tbl_questions q on qt.id=q.type_id
			WHERE c.id='$id' AND c.is_published=1 AND c.status=1 GROUP BY qt.id
			");
			if($data['details']):
			$this->load->view('details',$data);
			else:
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('msg', 'Invalid Competition.');
			redirect(base_url("Home"));
			endif;
		}
		else
		{
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('msg', 'Your are trying to access expired or Already Completed competition.');
			redirect(base_url("Home"));
		}
		else:
		
			$this->load->view('login');	
		endif;
	}
	


	
	

	


	

	
	public function check_login()
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$data=array("username"=>$username,
				   "password"=>md5($password));
		$status=$this->Main_Model->check_login($data);		
		
		$this->session->set_userdata($user_dataz);

		
		redirect(base_url("home"));		
	}
	
	
		
	public function forgotpass()
	{
		$this->load->view('forgotpassword');
	}
		
	
	
	
	private function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
	
	
	public function reset_screen($email,$id,$encid)
	{
	$check=$this->db->query("SELECT * FROM tbl_temp where md5(email)='$email' and md5(userid)='$id' and encrypted_id='$encid'");	
	if ($check->num_rows() > 0) {
		$data['id']=md5($check->row('userid'));
		$data['email']=md5($check->row('email'));
		$data['encid']=$check->row('encrypted_id');
		$this->load->view('reset-screen',$data);		
	 }	
		else
		{
			$this->session->set_flashdata('type', 'danger');
		$this->session->set_flashdata('msg', 'Invalid service request called.');
			redirect(base_url("home"));
		}
	}
	
	public function change_password()
	{
		$password=md5($this->input->post("password"));
		$userid=$this->input->post("token");
		$email=$this->input->post("email");	
		$encid=$this->input->post("encid");	
		$check=$this->Main_Model->fetch_row("tbl_temp","where md5(email)='$email' and md5(userid)='$userid' and encrypted_id='$encid'");		
		if ($check->id > 0) {
		$data=array("password"=>$password);			
		$this->Main_Model->update_data("tbl_users",$data,"id",$check->userid);	
		$data['msg']="Password reset successfully, kindly login with your new password.";
		$this->Main_Model->delete_query($check->userid,"tbl_temp","userid");	
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('msg', 'Your Password has been updated successfully.');
	 	}	
		else{
		$this->session->set_flashdata('type', 'danger');
		//$data['msg']="Invalid entry, kindly reset the password again.";	
		$this->session->set_flashdata('msg', 'Invalid Email provided, kindly contact our customer support if you forgot your email also.');
		}
		redirect(base_url("Home"));
		//$this->load->view('my-account',$data);	
	}
}