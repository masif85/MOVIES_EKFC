<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	

public function index()
	{		
		$this->load->view('ktadmin/login');
	}
	
	public function check_login()
	{
		
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$data=array("username"=>$username,
				   "password"=>md5($password));
		$status=$this->Main_Model->check_login($data);
		
		redirect(base_url("Admin/dashboard"));
		//$this->load->view("ktadmin/$status[redirect]");
	}

	public function notactive()
	{
	$this->session->set_flashdata('msg', '<font color="red">Account still not active, kindly activate it first.</font>');
	redirect(base_url("Login"));
	//$this->load->view('my-account');
	}
	
	public function forgot_password()
	{
	$this->load->view('reset-password');	
	}

	
	public function reset_screen($email,$id)
	{
	$check=$this->db->query("SELECT * FROM tbl_temp where md5(email)='$email' and md5(userid)='$id'");	
	if ($check->num_rows() > 0) {
		$data['id']=$check->row('userid');
		$data['email']=$check->row('email');
		$this->load->view('reset-screen',$data);		
	 }	
	}
	
	public function change_password()
	{
		$password=md5($this->input->post("password"));
		$userid=$this->input->post("userid");
		$email=$this->input->post("email");
		$check=$this->db->query("SELECT * FROM tbl_temp where email='$email' and userid='$userid'");
		if ($check->num_rows() > 0) {
		$data=array("password"=>$password);			
		$this->Main_Model->update_data("tbl_users",$data,"id",$userid);	
		$data['msg']="Password reset successfully, kindly login with your new password.";
		$this->Main_Model->delete_query($userid,"tbl_temp","userid");		
	 }	
		else{
		//$data['msg']="Invalid entry, kindly reset the password again.";	
				$this->session->set_flashdata('msg', '<font color="red">Invalid Email provided, kindly contact our customer support if you forgot your email also.</font>');
		}
		redirect(base_url("Login"));
		//$this->load->view('my-account',$data);	
	}
public function logout()
	{
	$this->load->library('session');
	$this->session->sess_destroy();
    redirect(base_url());
	}
	
	
}
