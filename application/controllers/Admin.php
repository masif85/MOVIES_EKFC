<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'/third_party/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
class Admin extends CI_Controller {
	public function index()
	{	
		$is_user_login = $this->session->userdata('id');	
		if($is_user_login!='')
		{
			redirect(base_url("Admin/dashboard"));
		}
		else
		{
			redirect(base_url("Login"));
		}
	}
	
	public function settings()
	{
		$this->load->view("ktadmin/settings");
	}
	
	public function add_movie()
	{
		$data["message"]="Add New Movie";
		$data["rows"]="";
		$data["id"]="";
		$this->load->view("ktadmin/add_movie",$data);
	}
		
	public function movies()
	{
		$data["search_page"]="false";
		$data["message"]="Contact Form(s) Queries";
		$data["rows"]=$this->Main_Model->fetch_rows_joins("v.title as 'Title',v.genere as 'Genre', r.rating as 'Rating',
		if(v.status=1,concat('<input type=checkbox name=status checked=checked class=update_status  id=',v.id,'>'),
		concat('<input type=checkbox name=status class=update_status  id=',v.id,'>')) as 'Status',		
		concat('<a href=''".base_url("Admin/movie_detail/")."',v.id,''' class=''fas fa-edit''  >
		</a>','&emsp;','<span type=button title=Delete class=''update_status fas fa-trash''  
		onClick=''return confirm(`Are you sure you want to Delete?`)'' but_type=disable id=',v.id,'></span>',
		'&nbsp;&nbsp;&nbsp;') as 'Action'
		","vr_movies v"," LEFT JOIN vr_ratings r on v.id=r.movie_id order by v.created_on DESC");
		
		$this->load->view("ktadmin/view_movies",$data);		
	}

	public function view_user_movies()
	{
		if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$data['page_no'] = $_GET['page_no'];
	} else {
		$data['page_no'] = 1;
        }
		
		
		$data['total_records_per_page'] = 3;
    $data['offset'] = ($data['page_no']-1) * $data['total_records_per_page'];
	$data['previous_page'] = $data['page_no'] - 1;
	$data['next_page'] = $data['page_no'] + 1;
	$data['adjacents']= "2"; 
		$data['movies']=$this->Main_Model->fetch_rows_joins("v.*,AVG(r.rating) as 'rating'","vr_movies v","LEFT JOIN vr_ratings r on v.id=r.movie_id WHERE status=1 
		
		
		GROUP BY v.id LIMIT ".$data['offset'].", ".$data['total_records_per_page']."");
		$data['total_records']=$this->Main_Model->fetch_row_counts("COUNT(*) As total_records",'vr_movies',"");
		

		$this->load->view("view_user_movies",$data);
	}
	
	public function movie_detail($id="")
	{		
		if($id):
		$data["type"]="update";
		$data["message"]="Update Movie Details";
		
		$data["rows"]=$this->Main_Model->fetch_row("vr_movies","where id='$id'");		
		$data["id"]=$id;
		$this->load->view("ktadmin/add_movie",$data);
	
		else:
			redirect(base_url("Admin/movies"));
		endif;		
	}
	
	public function sub_rating()
	{

		$rating= $this->input->post('rating');
		$movie_id= $this->input->post('movie_id');
		switch ($rating) {
  case "One Star":
    $rate =1;
    break;
  case "Two Stars":
    $rate =2;
    break;
  case "Three Stars":
   $rate =3;
    break;
      case "Four Stars":
    $rate =4;
    break;

  case "Five Stars":
   $rate =5;
    break;

  default:
    $rate =0;
}

$rating_data=array("rating"=>$rate,				 						
						"user_id"=>$this->session->userdata('id'),		 
						"movie_id"=>$movie_id,
						"ip"=>$this->input->ip_address()	
);
$this->Main_Model->insert_data("vr_ratings",$rating_data);
echo json_encode("success");

	}
	public function create_movie($comp_id="")
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
		
		if($comp_id!="")
		{	
			
			$cmp_data=$this->Main_Model->fetch_row("vr_movies"," where id='$comp_id'");
			if($cover_picture=="")
			{
			$comp_data["cover_picture"]=$cmp_data->cover_picture;
			
			}
			else
			{				
			$imagePath = '../public/editions/pics';
			unlink(realpath(APPPATH . $imagePath."/".$cmp_data->cover_picture));
			}	

			if($video_file=="")
			{
			$comp_data["video"]=$cmp_data->video;
			$comp_data["video_type"]=$cmp_data->video_type;
			}
			else
			{				
			$imagePaths = '../public/editions/assets';
			unlink(realpath(APPPATH . $imagePaths."/".$cmp_data->video));
			}
			
			$this->Main_Model->update_data("vr_movies",$comp_data,"id",$comp_id);	
$check=1;			
		}
		else
		{			
			$comp_id=$this->Main_Model->insert_data("vr_movies",$comp_data);
			
			$check=1;
		}
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
	
	public function update_settings()
	{
		$username=@$this->input->post("username");
		$password=@$this->input->post("password");
		if($username)
		{
		$data["username"]=$username;
		}
		if($password)
		{
		$data["password"]=md5($password);	
		}				   
		if($_FILES["profile_pic"]['name']!="")
		{
		$file=$this->upload_files("profile_pic","profile_pics");
		$data["profile_pic"]=$file;
		}		
		$check=$this->Main_Model->update_data("tbl_users",$data,"id",$this->session->userdata('id'));
		if($check)
		{
			$user_data['username'] = $username;
			if($file)
			{
			$user_data['profile_pic'] = $file;	
			$imagePath = '../public/profile_pics';
			unlink(realpath(APPPATH . $imagePath."/".$this->session->userdata('profile_pic')));
			}
		$this->session->set_userdata($user_data);	
		}		
		redirect($_SERVER['HTTP_REFERER']);		
	}
	
	public function change_status()
	{
		$id=$this->input->post("id");

$cmp_data=$this->Main_Model->fetch_row("vr_movies"," where id='$id'");
			
			$cover_picture=$cmp_data->cover_picture;
			$video=$cmp_data->video;					
			$imagePath = '../public/editions/pics';
			unlink(realpath(APPPATH . $imagePath."/".$cmp_data->cover_picture));
			$videopath = '../public/editions/assets';
			unlink(realpath(APPPATH . $videopath."/".$cmp_data->video));		
		$this->Main_Model->delete_query($id,"vr_movies","id");	
		
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
	
	public function manage_users()
	{
		$data["search_page"]="false";
		$data["message"]="Manage Users";
		$data["roles"]=$this->Main_Model->fetch_rows_joins("*","tbl_user_roles","where role_id <> 1");
		$data["rows"]=$this->Main_Model->fetch_rows_joins("full_name as 'Name',username as 'User Name',user_type as 'User Type',contactno as 'Contact No',default_page as 'Default Page',
		concat('<a href=''#'' class=''call_modal fas fa-edit'' data_page=''get_user'' data_id=''',id,'''></a>') as 'Action'	
		","tbl_users","where user_role <> 1");
		
		$this->load->view('ktadmin/manageusers',$data);
	}
	
	public function add_user()
	{
		$data=$this->input->post();
		$role_id=$this->input->post('user_role');
		$userdata=$this->Main_Model->fetch_row("tbl_user_roles"," where role_id='$role_id'");
		if($this->input->post("user_id")!=""):		
			$id=$this->input->post("user_id");
			$data["username"]=$this->input->post("user_email");
			if($this->input->post("password")!=""):
			$data["password"]=md5($this->input->post("password"));
				else:
			unset($data["password"]);
				endif;
			unset($data["user_id"]);		
			$data["user_type"]=$userdata->role_name;
		$this->Main_Model->update_data("tbl_users",$data,"id",$id);
		else:			
			$data["username"]=$this->input->post("user_email");
			$data["password"]=md5($this->input->post("password"));
			$data["contactno"]='1234678';
			$data["user_type"]=$userdata->role_name;
			$data["default_page"]='dashboard';
			$data["status"]='3';
			$comp_id=$this->Main_Model->insert_data("tbl_users",$data);
		endif;
		redirect($_SERVER['HTTP_REFERER']);		
		
		
	}
	
	public function get_user()
	{
		$id=$this->input->post('id');
		$data=$this->Main_Model->fetch_row("tbl_users"," where id='$id'");
		echo json_encode($data);
	}

	public function update_user_settings()
	{
		
	}
	
	public function dashboard()
	{	
	redirect(base_url('Admin/movies'));
	exit;
		$data['dashboard']=$this->Main_Model->fetch_rows_joins("count(id) as 'total_movies'
		
		","vr_movies "," group by genere");
		$this->load->view('ktadmin/view_movies',$data);
	}
		
	public function delete_pic($type="",$location="",$id)
	{
			$filename=$this->Main_Model->fetch_row("vr_editions","where id='$id'");
			$imagePath = '../public/editions/'.$location.'';
			unlink(realpath(APPPATH . $imagePath."/".$filename->cover_picture));
			$comp_data=array("cover_picture"=>"");
			$this->Main_Model->update_data("vr_editions",$comp_data,"id",$id);
			redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function delete_item($comp_id="",$type_id="")
	{
		
			$filename=$this->Main_Model->fetch_row("vr_assets","where id='$type_id'");
			$imagePath = '../public/editions/';
			unlink(realpath(APPPATH . $imagePath."/assets/".$filename->asset));
			unlink(realpath(APPPATH . $imagePath."/pics/".$filename->image));	
		
		$this->Main_Model->delete("vr_assets"," id='$type_id' and edition_id='$comp_id'");
		redirect($_SERVER['HTTP_REFERER']);
		//redirect(base_url("Admin/comp_detail/$comp_id"));
		//$this->comp_detail($comp_id);
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
	
}