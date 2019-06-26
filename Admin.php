<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Admin extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Core_Model');
    }
	
public function index()
{
 //    if($this->session->userdata("id"))
	// {	
 //     redirect("Admin/dashboard");
	// }
 //    else{
	// $data['front']=$this->Common_Model->getdata("front_setting",$where='',$sort='');
	// $cooki=$this->checkfirsttime();
 //    $data['cooki']=$cooki;	 
 //    $this->load->view("admin/Header",$data); 	
 //    // $this->load->view("admin/Signin",$data);
 //    $this->load->view("admin/Footer"); 	
 // //    }	

	   $this->load->view("admin/header"); 	
	   $this->load->view("admin/index"); 	
	   $this->load->view("admin/footer"); 	
}
public function widgets()
{	
	$this->load->view("admin/header"); 	
	$this->load->view("admin/pages/widgets"); 
	$this->load->view("admin/footer"); 	

	}
public function category_list()
{	
	$this->load->view("admin/header"); 	
	$this->load->view("admin/sidebar"); 	
	$this->load->view("admin/category_list"); 
	$this->load->view("admin/footer"); 	

	}




// public function dashboard()
// {
// 	$this->checkSessionAdmin();
		
// 	if($this->session->userdata('id'))
// 	{  
// 	$this->adminheader();	
// 	$data['results'] = $this->Core_Model->CountDetails('user',$value=1);
// 	$data['result'] = $this->Core_Model->CountDetails('rentourspace',$value=1);
// 	$data['res'] = $this->Core_Model->CountDetails('withdrawRequest',$value=2);
	
// 	$data['totalusers'] = $this->Core_Model->CountDetails('user',$value='');
// 	$data['todaybook'] = $this->Core_Model->CountDetails('booking',$value=3);
// 	$data['allbook'] = $this->Core_Model->CountDetails('booking',$value='');
	
// 	$data['todaycompletedbooking'] = $this->Core_Model->CountDetails('booking',$value=4);
// 	$data['todaypendingbooking'] = $this->Core_Model->CountDetails('booking',$value=6);
	
// 	$data['todaywithdrawlreq'] = $this->Core_Model->CountDetails('withdrawRequest',$value=3);
// 	$data['completedwithdrawlreq'] = $this->Core_Model->CountDetails('withdrawRequest',$value=4);
// 	$data['pendingwithdrawlreq'] = $this->Core_Model->CountDetails('withdrawRequest',$value=5);
	
// 	$data['todayearnedcomm'] = $this->Core_Model->Earning('`order`',$value=1);
// 	$data['earningthismonth'] = $this->Core_Model->Earning('transactions',$value=2);

// 	$data['parkingresult'] = $this->Common_Model->onejoindata($place1='user.id', $place2='rentourspace.uid', $WhereData='1=1', $Selectdata='user.id,rentourspace.uid', $TableName1='user', $TableName2='rentourspace', $orderby='');
// 	$data['parkingresult']=$this->my_array_unique($data['parkingresult']);
	
// 	$this->load->view("admin/Dashboard",$data);	
//     $this->adminfooter(); 
// 	}
//     else {	
// 	$this->session->set_flashdata('result', 1);
// 	$this->session->set_flashdata('class', 'danger');
// 	$this->session->set_flashdata('msg', "Invalid Email ID/Password");
// 	redirect("Admin");	
// 	}
// }

// public function my_array_unique($array, $keep_key_assoc = false){
//     $duplicate_keys = array();
//     $tmp = array();       

//     foreach ($array as $key => $val){
//         // convert objects to arrays, in_array() does not support objects
//         if (is_object($val))
//             $val = (array)$val;

//         if (!in_array($val, $tmp))
//             $tmp[] = $val;
//         else
//             $duplicate_keys[] = $key;
//     }

//     foreach ($duplicate_keys as $key)
//         unset($array[$key]);

//     return $keep_key_assoc ? $array : array_values($array);
// }

// public function checklogin()
// 	{		
// 		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
// 		$this->form_validation->set_rules('password', 'Password', 'required');

// 		if ($this->form_validation->run() == FALSE)
// 		{
// 			$this->index();
// 		}
// 		else
// 		{	
// 	      $data=$this->Login_Model->admin_login();
// 		  if($data)
//          {
// if($this->input->cookie('pass'))
// 		{
//      		 delete_cookie('pass'); 
// 		}		 	         
// 			redirect("Admin/dashboard");
//          }
//          else	
//          {  
//            $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'danger');
// 		   $this->session->set_flashdata('msg', "Invalid Email/Password. Please try again");
// 		   $cookie= array(
//            'name'   => 'pass',
//            'value'  => 'pass',                            
//            'expire' => '0'                 
//         );
// 		$this->input->set_cookie($cookie);
//            redirect("Admin"); 
// 	     }
// 		}		 
// 	}

// public function profile()
// {
//     $this->checkSessionAdmin();

//     $data['admin']=$this->Common_Model->getdata("admin_login",$where='',$sort='');
// 	$this->adminheader();	
//     $this->load->view("admin/Adminprofile",$data);	
//     $this->adminfooter();
// }

// public function updateadmin()
// {
// 	    $this->checkSessionAdmin();
// 		$id=$this->input->post('id');
//         $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[100]');
// 		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		
		
// 		if ($this->form_validation->run() == FALSE)
// 		{
// 			$this->profile($id);
// 		}
// 		else
// 		{	
// 	      if($this->input->post("photo"))
// 		  {
// 		  $this->unsetImage($id,'admin_login','photo','images/');		  		 
// 		  $photo=$this->savecropimage("photo","images/");		 	     
// 		  }
// 		  else{
// 			   $photo=$this->input->post('photo1');
//           }	
//           $where=array("id"=>$id);
// 	      $datas=array("photo"=>$photo,"name"=>$this->input->post("name"),"email"=>$this->input->post("email"));
// 		  $id=$this->Common_Model->update("admin_login",$datas,$where);		   
// 		 if($id)
//          { 	 
// 	       $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'success');
// 		   $this->session->set_flashdata('msg', "Profile updated successfully");
// 		   redirect("Admin/profile");
//          }
//          else	
//          {  
//            $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'danger');
// 		   $this->session->set_flashdata('msg', "Error to edit");
//            redirect("Admin/profile");
// 	     }
// 		}		
// }

// public function change()
// {	
//           $this->checkSessionAdmin();
//           $this->form_validation->set_rules('opassword', 'Current Password', 'required|min_length[5]|max_length[16]');
// 		  $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[16]');
// 		  $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|min_length[5]|max_length[16]|matches[password]');
	
// 		if ($this->form_validation->run() == FALSE)
// 		{
// 			$this->profile();
// 		}
// 		else
// 		{	
// 	      $id=$this->session->userdata('id');
// 	      $data=array('password'=>md5($this->input->post('password')));
// 		  $where=array("id"=>$id,"password"=>md5($this->input->post('opassword')));
// 		  if($this->session->userdata("type")=='Admin')
// 		  {
// 		  $tt=$this->Common_Model->update("admin_login",$data,$where);
// 		  }
// 		  else{
// 		  $tt=$this->Common_Model->update("user",$data,$where);  
// 		  }
	      
// 		  if($tt)
//          { 	 
// 	       $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'success');
// 		   $this->session->set_flashdata('msg', "Password changed successfully");
// 		   redirect("Admin/profile");
//          }
//          else	
//          {  
//            $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'danger');
// 		   $this->session->set_flashdata('msg', "Error to change");
//            redirect("Admin/profile");
// 	     }
// 		}		 	  
// }

// public function logout(){
// 	 session_start();
//      session_destroy();
//      $this->session->sess_destroy();
//      redirect('Admin/');
// 	}
    
//     public function Newsletter(){
//         $data['control']="Newsletter";
// 		$data['controlname']="Newsletter";	
// 		$data['controlnamehead']="Newsletter";
// 		$data['controlnamemsg']="Newsletter";
//         $data['results'] = $this->Core_Model->SelectRecord('newsletter',array(),array(),'id desc');
//         $this->adminheader();	
//         $this->load->view("admin/Newsletter",$data);	
//         $this->adminfooter();
//     }
    
//     public function Testimonial(){
//         $data['control']="Testimonial";
// 		$data['controlname']="Testimonial";	
// 		$data['controlnamehead']="Testimonial";
// 		$data['controlnamemsg']="Testimonial";
//         $data['user']=$this->Common_Model->getdata("user",$where="",$sort='name asc');
//         $data['results'] = $this->Core_Model->SelectRecord('testimonial',array(),array(),'id desc');
//         $this->adminheader();	
//         $this->load->view("admin/Testimonial",$data);	
//         $this->adminfooter();
//     }
    
//     public function addtestimonial(){
// $data['control']="Managetestimonial";
// $data['controlnamemsg']="Add testimonial";
// $data['controlname']="testimonial";
// $data['user']=$this->Common_Model->getdata("user",$where="",$sort='name asc');		
// $this->adminheader();	
// $this->load->view("admin/AddTestimonial",$data);	
// $this->adminfooter(); 
// }
    
//     public function edittestimonial($id=0)
// {	
// if($this->uri->segment(3))
// {
// $id=$this->uri->segment(3);
// }
// $data['control']="Managetestimonial";
// $data['controlnamemsg']="Edit testimonial";
// $data['controlname']="testimonial";
// $data['category']=$this->Common_Model->getdata("testimonialcategory",$where="",$sort='name asc');	
// $data['user']=$this->Common_Model->getdata("user",$where="",$sort='name asc');	
// $where=array("id"=>$id);
// $data['testimonial']=$this->Common_Model->getdata("testimonial",$where,$sort='');	
// $this->adminheader();	
// $this->load->view("admin/Edittestimonial",$data);	
// $this->adminfooter();
// }

// public function createtestimonial()
// {
//         $this->form_validation->set_rules('title', 'Name', 'required');
// 		$this->form_validation->set_rules('description', 'Description', 'required');
// 		$this->form_validation->set_rules('location', 'Location', 'required');
// 		//$this->form_validation->set_rules('uid', 'User', 'required');

// 		if ($this->form_validation->run() == FALSE)
// 		{
// 			$this->addtestimonial();
// 		}
// 		else
// 		{            
// 		 $photo=$this->savecropimage("photo","upload/blog/");		  
		  
// 		 //$ophoto=$this->imageUpload("ophoto","upload/testimonial/");
					
// 	     $datas=array("name"=>$this->input->post("title"),"address"=>$this->input->post("location"),"message"=>$this->input->post("description"),"image"=>$photo);
// 		 $updt=$this->Common_Model->insert("testimonial",$datas);		   
// 		 if($updt)
//          { 	 
// 	       $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'success');
// 		   $this->session->set_flashdata('msg', "Testimonial added successfully");
// 		   redirect("Admin/testimonial");
//          }
//          else	
//          {  
//            $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'danger');
// 		   $this->session->set_flashdata('msg', "Error to add");
//            redirect("Admin/testimonial");
// 	     }
// 		}		
// }

// public function updatetestimonial($id=0)
// {
//         $this->form_validation->set_rules('title', 'Title', 'required');
// 		$this->form_validation->set_rules('description', 'Description', 'required');
// 		$this->form_validation->set_rules('category[]', 'Category', 'required');
// 		$this->form_validation->set_rules('uid', 'User', 'required');
		
// 		if ($this->form_validation->run() == FALSE)
// 		{
// 			$this->edittestimonial($id);
// 		}
// 		else
// 		{	
// 	      if(!empty($_FILES['ophoto']['name']))
// 		  {
// 		  $this->unsetImage($id,'testimonial','ophoto','upload/testimonial/');		  		 
// 		  $ophoto=$this->imageUpload("ophoto","upload/testimonial/");		 	     
// 		  }
// 		  else{
// 		  $ophoto=$this->input->post('ophoto1');
//           }
// 		  $category="";	
// 		  if($this->input->post('category'))
//           $category=implode(",", $this->input->post('category'));		

//           $where=array("id"=>$id);	

//           if($this->input->post("photo"))
// 		  {
// 		  $this->unsetImage($id,'testimonial','photo','upload/testimonial/');		  		 
// 		  $photo=$this->savecropimage("photo","upload/testimonial/");		 	     
// 		  }
// 		  else{
// 		  $photo=$this->input->post('photo1');
//           }			  
		
// 	      $datas=array("title"=>$this->input->post("title"),"description"=>$this->input->post("description"),"category"=>$category,"uid"=>$this->input->post("uid"),"photo"=>$photo,"ophoto"=>$ophoto,
// 		  "status"=>0,"updated_dt"=>date("Y-m-d H:i:s"));
		 
// 		 $updt=$this->Common_Model->update("testimonial",$datas,$where);		   
// 		 if($updt)
//          { 	 
// 	       $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'success');
// 		   $this->session->set_flashdata('msg', "Testimonial updated successfully");
// 		   redirect("Managetestimonial/testimonial");
//          }
//          else	
//          {  
//            $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'danger');
// 		   $this->session->set_flashdata('msg', "Error to update");
//            redirect("Managetestimonial/edittestimonial/$id");
// 	     }
// 		}		
// }

// public function deleteTestimonial()
// 	{
// 		if($this->uri->segment(3)=='success')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'success');
// 			$this->session->set_flashdata('msg', "Testimonial delete successfully.");
// 			redirect("Admin/testimonial");
// 		}
// 		else if($this->uri->segment(3)=='error')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'error');
// 			$this->session->set_flashdata('msg', "Error to delete.");
// 			redirect("Admin/testimonial");
// 		}
// 		else{
// 			$id=$this->input->post('id');            
//             $this->unsetImage($id,'testimonial','image','upload/testimonial/');			
// 		    $data=$this->Common_Model->deletedata('testimonial',array('id'=>$id));			
// 			echo $data;
// 		}			
// 	}
	
	
// public function showtestimonial($id,$status)
// 	{
// 		$site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
//         $testimonial_name=$this->getSingleValue($id,'testimonial','title');
// 		$uid=$this->getSingleValue($id,'testimonial','uid');
// 		$name=$this->getSingleValue($uid,'user','name');
// 		$email=$this->getSingleValue($uid,'user','email');
//             $sts=0;
// 			$v="";
// 			if($status==1)
// 			{
// 				$sts=1;
// 				$v="Approved";
// 				$message="Your ".$testimonial_name." testimonial has been approved.";
// 				$subject="Testimonial approved at ".$site_title;
// 	        }
// 			if($status==2)
// 			{
// 				$sts=2;
// 				$v="Disapproved";
// 				$message="Your ".$testimonial_name." testimonial has been disapproved.";
// 				$subject="Testimonial disapproved at ".$site_title;
// 			}
			
// 			$datas['messages']=array($name,$message);
// 		    $this->email($email,$subject,$datas);
			
//             $udata=array("status"=>$sts);
// 			$data=$this->Common_Model->update('testimonial',$udata,array('id'=>$id));			
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'success');
// 			$this->session->set_flashdata('msg', "Testimonial ".$v." successfully.");
// 			redirect("Managetestimonial/testimonial");
// 	}
	
// 	public function Users(){
// 		$data['control']="Admin";
// 		$data['controlname']="Users";	
// 		$data['controlnamehead']="Manage Users";
// 		$data['controlnamemsg']="Users";
// 		//$data['user']=$this->Common_Model->getdata("user",$where="",$sort='name asc');
//         $data['results'] = $this->Core_Model->SelectRecord('user',array(),array(),'id asc');
// 		$this->adminheader();	
//         $this->load->view("admin/userlist",$data);	
//         $this->adminfooter();
// 	}
	
	
// 	public function addUsers() {
// 	$data['control']="Admin";
// 	$data['controlnamemsg']="Add user";
// 	$data['controlname']="Users";
// 	   $data['country']=$this->Common_Model->getdata("countries",$where='',$sort='countryName asc');  	
// 	$this->adminheader();	
// 	$this->load->view("admin/adduser",$data);	
// 	$this->adminfooter(); 
// }

// 		public function createUsers()
// 		{
//         $this->form_validation->set_rules('name', 'Name', 'required');
// 		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
// 		$this->form_validation->set_rules('password', 'Password', 'required');
// 		$this->form_validation->set_rules('cpassword', 'Enter Same Password Again', 'required');
// 		$this->form_validation->set_rules("phone","Phone","required");
// 		$this->form_validation->set_rules("address","Address","required");
// 		$this->form_validation->set_rules("zipcode","Zipcode","required");
// 		$this->form_validation->set_rules("description","Description","required");
// 		$this->form_validation->set_rules("facebook","Facebook","required");
// 		$this->form_validation->set_rules("google","Google","required");
// 		$this->form_validation->set_rules("linkedin","Linkedin","required");
// 		$this->form_validation->set_rules("skype","Skype","required");
// 		$this->form_validation->set_rules("twitter","Twitter","required");

// 		if ($this->form_validation->run() == FALSE)
// 		{
// 			$this->addUsers();
// 		}
// 		else
// 		{	
//          $photo=$this->savecropimage("photo","upload/user/");
        
//          $email=$this->input->post("email"); 
//          $password=$this->input->post("password");		 
//          $ophoto=$this->imageUpload("ophoto","upload/user/");
// 	     $datas=array("photo"=>$photo,"email"=>$this->input->post("email"),"contact"=>$this->input->post("phone"),"name"=>$this->input->post("name"),"zipcode"=>$this->input->post("zipcode"),"password"=>md5($password),"address"=>$this->input->post("address"), "country"=>$this->input->post("country"),"birthdate"=>$this->input->post("birthdate"),"created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"),"skype"=>$this->input->post("skype"),"google"=>$this->input->post("google"),"facebook"=>$this->input->post("facebook"),"linkedin"=>$this->input->post("linkedin"),"twitter"=>$this->input->post("twitter"),"description"=>$this->input->post("description"),"type"=>"User","ophoto"=>$ophoto
// 		 );
		 
// 		 $updt=$this->Common_Model->insert("user",$datas);
		 
// 		 if($updt)
//          { 
// 	       $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'success');
// 		   $this->session->set_flashdata('msg', "User Added successfully");
// 		   redirect("Admin/Users");
//          }
//          else	
//          {  
//            $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'danger');
// 		   $this->session->set_flashdata('msg', "Error to Add");
//            redirect("Admin/adduser");
// 	     }
// 		}	
//    }

// 		public function viewUsers($id=0)
// 		{
// 		   $this->db->select("user.*,countries.countryName");
// 		   $this->db->join("countries","user.country=countries.countryID","left");
// 		   $this->db->where("user.id",$id);
// 		   //$this->db->where("user.type","User");
// 		   $this->db->order_by("user.id","desc");
// 		   $result = $this->db->get('user')->result();
// 		   foreach($result as $key=>$value)
// 		{
// 		}
// 		   $data['user']=$result;  
// 		   $this->adminheader();
// 		   $this->load->view("admin/Viewuser",$data);
// 		   $this->adminfooter();  
// 		}

// 		public function editUsers($id=0)
// 		{
// 		   $data['control']="Admin";
// 		   $data['controlnamemsg']="Edit user";
// 		   $data['controlname']="Users";	
// 		   $data['user']=$this->Common_Model->getdata("user",$where=array("id"=>$id),$sort="");
		  
// 		   $data['country']=$this->Common_Model->getdata("countries",$where='',$sort='countryName asc');
// 		   $this->adminheader();
// 		   $this->load->view("admin/edituser",$data);
// 		   $this->adminfooter();  
// 		}

	
// 		public function updateUsers($id=0)
// 		{
//         $this->form_validation->set_rules('name', 'Name', 'required');
// 		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
// 		$this->form_validation->set_rules("password","Password","required");
// 		$this->form_validation->set_rules("cnfmpassword","Password","required");
// 		$this->form_validation->set_rules("phone","Phone","required");
// 		$this->form_validation->set_rules("address","Address","required");
// 		$this->form_validation->set_rules("zipcode","Zipcode","required");
// 		$this->form_validation->set_rules("description","Description","required");
// 		$this->form_validation->set_rules("facebook","Facebook","required");
// 		$this->form_validation->set_rules("google","Google","required");
// 		$this->form_validation->set_rules("linkedin","Linkedin","required");
// 		$this->form_validation->set_rules("skype","Skype","required");
// 		$this->form_validation->set_rules("twitter","Twitter","required");

// 		if ($this->form_validation->run() == FALSE)
// 		{
// 			$this->editUsers($id);
// 		}
// 		else
// 		{	
	   
// 		  if($this->input->post("photo"))
// 		  {
// 		  $this->unsetImage($id,'user','photo','upload/user/');		  		 
// 		  $photo=$this->savecropimage("photo","upload/user/");		 	     
// 		  }
// 		  else{
// 		  $photo=$this->input->post('photo1');
//           }
		  
		  
// 		  if(!empty($_FILES['ophoto']['name']))
// 		  {
// 		  $this->unsetImage($id,'user','ophoto','upload/user/');		  		 
// 		  $ophoto=$this->imageUpload("ophoto","upload/user/");		 	     
// 		  }
// 		  else{
// 		  $ophoto=$this->input->post('ophoto1');
//           }
//          $id=$this->input->post('id');
//          $where=array("id"=>$id);

// 	     $datas=array("photo"=>$photo,"name"=>$this->input->post("name"),"email"=>$this->input->post("email"),"password"=>$this->input->post("password"),"contact"=>$this->input->post("phone"),"zipcode"=>$this->input->post("zipcode"),"address"=>$this->input->post("address"),"state"=>$this->input->post("state"),"birthdate"=>$this->input->post("birthdate"),"state"=>$this->input->post("state"),"city"=>$this->input->post("city"),"companyname"=>$this->input->post("companyname"),"ophoto"=>$ophoto,
// 		 "country"=>$this->input->post("country"),"updated_dt"=>date("Y-m-d H:i:s"),
// 		 "skype"=>$this->input->post("skype"),"google"=>$this->input->post("google"),"facebook"=>$this->input->post("facebook"),"linkedin"=>$this->input->post("linkedin"),"twitter"=>$this->input->post("twitter"),"description"=>$this->input->post("description")
// 		 );
// 		 $updt=$this->Common_Model->update("user",$datas,$where);
		 
// 		 if($updt)
//          { 	 
// 	       $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'success');
// 		   $this->session->set_flashdata('msg', "Profile updated successfully");
// 		   redirect("Admin/Users");
//          }
//          else	
//          {  
//            $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'danger');
// 		   $this->session->set_flashdata('msg', "Error to update");
//            redirect("Admin/Users");
// 	     }
// 	}		
// }


// 	public function email_check($str)
// 	{
// 	 $email = $this->input->post('email1');
  
//      $this->db->where('email !=', $email);
// 	 $this->db->where('email', $str);
//      $query = $this->db->get('user');

//     if ($query->num_rows() > 0) {
//         $this->form_validation->set_message('email_check', 'Email ID already exists');
// 	    return FALSE;
//     } else {
//         return true;
//     }
//   }

	
// public function activeprofile()
// 	{
// 		if($this->uri->segment(3)=='active')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'success');
// 			$this->session->set_flashdata('msg', "profile active successfully.");
// 			redirect("Admin/Users");
// 		}
// 		else if($this->uri->segment(3)=='suspend')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'success');
// 			$this->session->set_flashdata('msg', " profile suspend successfully.");
// 			redirect("Admin/Users");
// 		}
// 		else if($this->uri->segment(3)=='error')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'error');
// 			$this->session->set_flashdata('msg', "Error to active/suspend.");
// 			redirect("Admin/Users");
// 		}
// 		else{
			
// 			$id=$this->input->post('id');
// 			$site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
//             $name=$this->getSingleValue($id,'user','name');
// 			$email=$this->getSingleValue($id,'user','email');
// 			$status=$this->getSingleValue($id,'user','status');
// 			$sts=0;
// 			if($status==1)
// 			{
// 				$sts=2;
// 				$message="Your account has been suspended due to invoilence activity.";
// 				$subject="Account Suspended at ".$site_title;
// 			}
// 			if($status==0)
// 			{
// 				$sts=1;
// 				$message="Your account has been active.";
// 				$subject="Account Active at ".$site_title;
// 			}
// 			if($status==2)
// 			{
// 				$sts=1;
// 				$message="Your account has been reactive.";
// 				$subject="Account Rective at ".$site_title;
// 			}
            
// 	        $datas['messages']=array($name,$message);
// 		    $this->email($email,$subject,$datas);
			
//             $udata=array("status"=>$sts);
// 			$data=$this->Common_Model->update('user',$udata,array('id'=>$id));			
// 			echo $sts;
// 		    }
// 	}

	
// 		//deactivate User 
// 	public function deleteUsers()
// 	{
// 		if($this->uri->segment(3)=='success')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'success');
// 			$this->session->set_flashdata('msg', "User Deactivated successfully.");
// 			redirect("Admin/Users");
// 		}
// 		else if($this->uri->segment(3)=='error')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'error');
// 			$this->session->set_flashdata('msg', "Error to Deactivate.");
// 			redirect("Admin/Users");
// 		}
// 		else{
// 			$id=$this->input->post('id');            
//          //   $this->unsetImage($id,'user','photo','upload/user/');
// 		//$this->unsetImage($id,'user','ophoto','upload/user/');			
// 		   $data=$this->Core_Model->UpdateRecord('user',array('is_deleted'=>1),array('id'=>$id));		
// 			if($data){
// 	  $data1= $this->Core_Model->UpdateRecord('rentourspace',array('is_deleted'=>1),array('uid'=>$id));	
// 			echo $data1;
// 			}
// 		}			
// 	}
	
// 	//delete User 
// 	public function deleteUser()
// 	{
// 		if($this->uri->segment(3)=='success')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'success');
// 			$this->session->set_flashdata('msg', "User Deleted successfully.");
// 			redirect("Admin/Users");
// 		}
// 		else if($this->uri->segment(3)=='error')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'error');
// 			$this->session->set_flashdata('msg', "Error to Delete.");
// 			redirect("Admin/Users");
// 		}
// 		else{
// 			$id=$this->input->post('id');            
//             $this->unsetImage($id,'user','photo','upload/user/');
// 			$this->unsetImage($id,'user','ophoto','upload/user/');			
// 		   $data=$this->Common_Model->deletedata('user',$WhereData = array('id'=>$id));		
// 			if($data){
// 				echo $data;
// 			}
// 		}			
// 	}
	
// 	public function Parkingspace(){
// 		$data['control']="Admin";
// 		$data['controlname']="Parkingspace";	
// 		$data['controlnamehead']="List of Parking Space";
// 		$data['controlnamemsg']="Parking Space";
				
// 		$data['results'] = $this->Core_Model->ParkingSpaceResult($where='');	
// 		$this->adminheader();
// 		$this->load->view('admin/parkingspace',$data);
// 		$this->adminfooter();
// 	}
	
	
// 	public function editParkingspace($where){
		
// 		$data['control']="Admin";
// 		$data['controlname']="Parkingspace";	
// 		$data['controlnamehead']="List of Parking Space";
		
// 		$data['results'] = $this->Core_Model->ParkingSpaceResult($where);
	
// 		$data['country']=$this->Common_Model->getdata("countries",$where='',$sort='countryName asc');  
// 		$this->adminheader();
// 		$this->load->view('admin/editparkingspace',$data);
//         $this->adminfooter();		
// 	}
	
// 	public function updateParkingspace($id)	{
//         $this->form_validation->set_rules('typeofspace', 'Type Of Space', 'required');
// 		$this->form_validation->set_rules('noofspace', 'No Of Space', 'required');
// 		$this->form_validation->set_rules("driveway_owner","Driveway Owner","required");
// 		$this->form_validation->set_rules("description","Description","required");
		
// 		if ($this->form_validation->run() == FALSE)
// 		{
// 			$this->editParkingspace($id);
// 		}
// 		else
// 		{	
// 			$id=$this->input->post('id');	
			
// 	         $where=array("uid"=>$id);

// 	     $datas=array("typeofspace"=>$this->input->post("typeofspace"),"noofspace"=>$this->input->post("noofspace"),"driveway_owner"=>$this->input->post("driveway_owner"),"pday"=>$this->input->post("pday"),"pweek"=>$this->input->post("pweek"),"pmonth"=>$this->input->post("pmonth"),"country"=>$this->input->post("country"),"address"=>$this->input->post("address"),"description"=>$this->input->post("description"),"updated_dt"=>date("Y-m-d H:i:s"));
		 
// 		 $updt=$this->Core_Model->updateFields("rentourspace",$datas,$where);
		 
// 		 if($updt)
//          { 	 
// 	       $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'success');
// 		   $this->session->set_flashdata('msg', "Profile updated successfully");
// 		   redirect("Admin/Parkingspace");
//          }
//          else	
//          {  
//            $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'danger');
// 		   $this->session->set_flashdata('msg', "Error to update");
//            redirect("Admin/Parkingspace");
// 	     }
// 	}		
// }

// 		public function viewParkingspace($id){
// 		$this->db->select('user.id,user.name,user.email,user.contact,rentourspace.uid,rentourspace.created_dt,rentourspace.updated_dt,rentourspace.typeofspace,rentourspace.noofspace,rentourspace.status,rentourspace.is_deleted,rentourspace.driveway_owner,rentourspace.phour,rentourspace.pday,rentourspace.pweek,rentourspace.pmonth,rentourspace.address,rentourspace.description,rentourspace.lat,rentourspace.lng,countries.countryName');
// 		$this->db->from('user');
// 		$this->db->join('rentourspace','user.id=rentourspace.uid','inner');
// 		$this->db->join('countries', 'rentourspace.country=countries.countryID','inner');
// 		$this->db->where('rentourspace.uid', $id);
// 		$result=$this->db->get()->result();
// 		    foreach($result as $key=>$value)
// 		{
// 		}
// 		   $data['res']=$result;  
// 		   $this->adminheader();
// 		   $this->load->view("admin/viewparkingspace",$data);
// 		   $this->adminfooter();
// 		}
		
		
// 		//Deactivate Parking Space
// 		public function deleteParkingspace(){
// 		if($this->uri->segment(3)=='success')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'success');
// 			$this->session->set_flashdata('msg', "Parking Space Deactivated successfully.");
// 			redirect("Admin/Parkingspace");
// 		}
// 		else if($this->uri->segment(3)=='error')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'error');
// 			$this->session->set_flashdata('msg', "Error to Deactivate.");
// 			redirect("Admin/Parkingspace");
// 		}
// 		else{
// 			$pid=$this->input->post('pid');
// 			$where=array("id"=>$pid);
// 			$datas=array('is_deleted'=>1);
// 		    $data=$this->Core_Model->updateFields('rentourspace',$datas,$where);
			
//             if($data){			
// 			echo $data;
// 			}
// 		}			
// 	}
	
	
// 	//delete Space 
// 	public function deleteSpace()
// 	{
// 		if($this->uri->segment(3)=='success')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'success');
// 			$this->session->set_flashdata('msg', "Space Deleted successfully.");
// 			redirect("Admin/parkingspace");
// 		}
// 		else if($this->uri->segment(3)=='error')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'error');
// 			$this->session->set_flashdata('msg', "Error to Delete.");
// 			redirect("Admin/parkingspace");
// 		}
// 		else{
// 			$pid=$this->input->post('pid');
// 			$where=array("id"=>$pid);            
//            	 $data=$this->Common_Model->deletedata('rentourspace',$where);		
// 			if($data){
// 				echo $data;
// 			}
// 		}			
// 	}
		
// 		public function Withdrawrequest(){
// 		$data['control']="Admin";
// 		$data['controlname']="Withdrawrequest";	
// 		$data['controlnamehead']="Withdraw Request";
// 		$data['controlnamemsg']="Withdraw Request";
// 		$place1 = 'user.id'; $place2 = 'withdrawRequest.user_id'; $place3='wallet.user_id'; $place4='withdrawal_methods.user_id'; $where=''; $Selectdata='user.id,user.name,user.email,withdrawRequest.id as requestid,withdrawRequest.user_id,withdrawRequest.amount,withdrawRequest.status,wallet.user_id,wallet.balance,withdrawal_methods.user_id,withdrawal_methods.account_info';$WhereData=''; $orderby=''; $table1='user'; $table2='withdrawRequest'; $table3='wallet'; $table4='withdrawal_methods';
// 	   $data['results'] = $this->Core_Model->jointables($place1,$place2,$WhereData,$Selectdata,$table1,$table2,$orderby,$place3,$table3,$place4,$table4);
		
// 		$this->adminheader();	
//         $this->load->view("admin/withdrawrequestlist",$data);	
//         $this->adminfooter();
// 	}
	
// 		function editWithdrawrequest($user_id,$reqid){
// 		$data['control']="Admin";
// 		$data['controlname']="Withdrawrequest";	
// 		$data['controlnamehead']="Withdraw Request Edit";
// 		$data['controlnamemsg']="Withdraw Request Edit";
// 		$place1 = 'user.id'; $place2 = 'withdrawRequest.user_id'; $place3='wallet.user_id'; $place4='withdrawal_methods.user_id';$where=array('withdrawRequest.id'=>$reqid); $Selectdata='user.id,user.name,user.email,withdrawRequest.id as requestid,withdrawRequest.user_id,withdrawRequest.amount,withdrawRequest.status,wallet.user_id,wallet.balance,withdrawal_methods.user_id,withdrawal_methods.account_info';$WhereData='withdrawRequest.id='.$reqid; $orderby=''; $table1='user'; $table2='withdrawRequest'; $table3='wallet';$table4='withdrawal_methods';
// 		$data['user'] = $this->Core_Model->jointables($place1,$place2,$WhereData,$Selectdata,$table1,$table2,$orderby,$place3,$table3,$place4,$table4);

// 		$requestid = $data['user'][0]['requestid'];
		
// 		$data['result'] = $this->Common_Model->getdata('withdrawRequest',array('id'=>$requestid),$sort='');
		
// 		   $this->adminheader();
// 		   $this->load->view("admin/editwithdrawreqlist",$data);
// 		   $this->adminfooter();  
// 	}
	
//     /*function updateWithdrawrequest(){
// 		//ajax [CHANGED]
// 	if($this->uri->segment(3)=='success')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'success');
// 			$this->session->set_flashdata('msg', "Request Processed successfully.");
// 			redirect("Admin/Withdrawrequest");
// 		}
// 		else if($this->uri->segment(3)=='error')
// 		{
// 			$this->session->set_flashdata('result', 1);
// 			$this->session->set_flashdata('class', 'error');
// 			$this->session->set_flashdata('msg', "Error to procress request.");
// 			redirect("Admin/Withdrawrequest");
// 		}
// 		else{
// 			$id=$this->input->post('id'); 
//             $balance=$this->input->post('balance');	
// 			$amount=$this->input->post('amount');
//  			$currentbal=$balance-$amount;
			
// 			$where=array("user_id"=>$id);
			
// 			$datas1 = array("balance"=>$currentbal);
// 			$data1 = $this->Common_Model->update('wallet',$datas1,$where);
// 			if($data1){
// 				$datas2 = array("status"=>1);
// 				$data2 = $this->Common_Model->update('withdrawrequest',$datas2,$where);
// 			}
// 			echo $data2;
// 		}		
// }*/

// 		function updateWithdrawrequest($id){
// 		$this->form_validation->set_rules('amountprocessed', 'Amount To be Processed', 'required');
// 		if ($this->form_validation->run() == FALSE)
// 		{
// 			$this->Withdrawrequest($id);
// 		}
// 		else
// 		{
			
//          $id = $this->input->post('id');
//          $requestid = $this->input->post("requestid");
// 		 $walletbalance = $this->input->post("walletbalance");
// 		 $requestedbalance = $this->input->post("requestedbalance");
// 		 $amountprocessed = $this->input->post("amountprocessed");
// 		 $transactionid = $this->input->post("transactionid");
// 		 $status = $this->input->post("status");
// 		 $moneytdate = $this->input->post("moneytransferdate");
// 		 $moneytransferdate = date("Y-m-d", strtotime($moneytdate));
// 		 $currentbal = $walletbalance - $amountprocessed;
		 
// 		 $where=array("user_id"=>$id);
// 		 $datas1 = array("balance"=>$currentbal);
		 
// 		 $data1 = $this->Common_Model->update('wallet',$datas1,$where);
// 		 if($data1){
// 			 $where1 = array('id'=>$requestid);
			 
// 			$datas=array("processed_amount"=>$this->input->post("amountprocessed"),"remark"=>$this->input->post("remark"),"transaction_id"=>$this->input->post("transactionid"),"status"=>$status,"moneytransferdate"=>$moneytransferdate);
	
// 		 $updt=$this->Common_Model->update("withdrawRequest",$datas,$where1);
// 		 if($updt)
//          { 	 
// 	       $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'success');
// 		   $this->session->set_flashdata('msg', "Request Processed Successfully");
// 		   redirect("Admin/Withdrawrequest");
//          }
//          else	
//          {  
//            $this->session->set_flashdata('result', 1);
// 		   $this->session->set_flashdata('class', 'danger');
// 		   $this->session->set_flashdata('msg', "Error to Process Request");
//            redirect("Admin/Withdrawrequest");
// 	     } 
// 		}
// 	}	
// }

    	
//     public function Bookings() {        
//         $order = $this->Core_Model->joindataResult('o.order_no', 'od.order_id', array(), 'o.*,od.product_id', 'order as o', 'order_detail as od', 'o.id desc');

//         foreach ($order as $key => $row) {
//             $booking = $this->Common_Model->getdata("booking", $where = array("order_id" => $row['order_no']), $sort = '');
//             $space = $this->Core_Model->SelectSingleRecord('rentourspace', '*', array("id" => $row['product_id']), $orderby = array());
// 			$datee = [];
//             foreach ($booking as $val) {
//                 $bookingdate = $val->created_at;
//                 $booking_from = $val->booking_from;
//                 $booking_to = $val->booking_to;
//                 $vehicle = $val->vehicle_id;
//             }
// 			$order[$key]['created_at'] = $bookingdate;
//             $order[$key]['booking_from'] = $booking_from;
//             $order[$key]['booking_to'] = $booking_to;
//             $vehicles = $this->Core_Model->SelectSingleRecord('vehicle', '*', array("id" => $vehicle), $orderby = array());
//             $user = $this->Core_Model->SelectSingleRecord('user', '*', array("id" => $row['user_id']), $orderby = array());
//             $order[$key]['vehicle_id'] = ($vehicles->isHired) ? "Car" . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license : $vehicles->vehicle_type . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license;
//             $order[$key]['typeofspace'] = $space->typeofspace . ' on ' . $space->address;
//             $order[$key]['sid'] = $user->id;
//             $order[$key]['user'] = $user->name;
//             $order[$key]['email'] = $user->email;
//             $order[$key]['contact'] = $user->contact;
//         }

//         $data['booking'] = $order;
//         //echo "<pre>"; print_r($data['booking']); die;
//         $data['control']="Bookings";
//         $data['controlnamemsg']="Bookings";
//         $data['controlnamehead']="Bookings";
//         $data['controlname']="bookings";
//         $this->adminheader();	
//         $this->load->view("admin/Booking",$data);	
//         $this->adminfooter(); 
//     }
	
	
	    
//     public function transactions(){  
//         //$data['transactions'] = $this->Core_Model->SelectRecord('transactions','*',array(),'id desc');                                        
//            $transactions = $this->Core_Model->joindataResult('o.order_no', 't.order_id', array(), 'o.*,t.*', 'order as o', 'transactions as t', 'o.id desc');
		   
// 		 /*  $test = $this->Core_Model->get_trans_order_details();
// 		   print_r($test); die;*/
		   
// 		   	     foreach($transactions as $key => $row) {
//             $booking = $this->Common_Model->getdata("booking", $where = array("order_id" => $row['order_no']), $sort = '');
			
// 			$productId = $this->Core_Model->SelectSingleRecord('order_detail', '*', array("order_id" => $row['order_no']), $orderby = array());
// 			$space = $this->Core_Model->SelectSingleRecord('rentourspace', '*', array("id" => $productId->product_id), $orderby = array());
// 			$datee = [];
           
// 			foreach ($booking as $val) {
//                 $datee[] = $val->bookdate;
//                 $booking_from = $val->booking_from;
//                 $booking_to = $val->booking_to;
//                 $vehicle = $val->vehicle_id;
//             }
//             $transactions[$key]['booking_from'] = $booking_from;
//             $transactions[$key]['booking_to'] = $booking_to;
//             $vehicles = $this->Core_Model->SelectSingleRecord('vehicle', '*', array("id" => $vehicle), $orderby = array());
//             $user = $this->Core_Model->SelectSingleRecord('user', '*', array("id" => $row['user_id']), $orderby = array());
//             $transactions[$key]['vehicle_id'] = ($vehicles->isHired) ? "Car" . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license : $vehicles->vehicle_type . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license;
//             $transactions[$key]['typeofspace'] = $space->typeofspace . ' on ' . $space->address;
//             $transactions[$key]['sid'] = $user->id;
//             $transactions[$key]['user'] = $user->name;
//             $transactions[$key]['email'] = $user->email;
//             $transactions[$key]['contact'] = $user->contact;
//      }
// 	  $data['transactions'] = $transactions;
	 
		
//         $data['control']="Transactions";
//         $data['controlnamemsg']="Transactions";
//         $data['controlnamehead']="Transactions";
//         $data['controlname']="transactions";
        
// 		$data['controlnamemsg']="Newsletter";
//         $this->adminheader();	
//         $this->load->view("admin/Transactions",$data);	
//         $this->adminfooter();
       
    
//  }
    
}