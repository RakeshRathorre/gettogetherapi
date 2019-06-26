<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Verify extends MY_Base_Controller{
	function __construct() {
        parent::__construct();        			 
    }
	
public function account()
{	
    if($this->uri->segment(3))
	{
    $id=base64_decode($this->uri->segment(3));
	$email_status=$this->getSingleValue($id,'user','email_status');
	if($email_status==1)
	{
	     $this->session->set_flashdata('result', 1);
	     $this->session->set_flashdata('class', 'danger');
	     $this->session->set_flashdata('msg', "Your email id has been already verified");
		 redirect("Home/");	
	}
	else{
	$data=array("email_status"=>1);
	$this->db->where("id",$id);
	$this->db->update("user",$data);
	if($this->db->affected_rows()>0)
	{
		$name=$this->getSingleValue($id,'user','name');
		$email=$this->getSingleValue($id,'user','email');
		$type=$this->getSingleValue($id,'user','type');
        $site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
		$message="Your account has been successfully verified.<br> Now you can login at <a href='".base_url()."'>".$site_title."</a>";
	
		   $datas['messages']=array($name,$message);
		   $this->email($email,"Account Approval at ".$site_title,$datas);	
		
		 $this->session->set_flashdata('result', 1);
	     $this->session->set_flashdata('class', 'success');
	     $this->session->set_flashdata('msg', "Your account has been verified successfully");
		 redirect("Home/");
	}
	else{
		 $this->session->set_flashdata('result', 1);
	     $this->session->set_flashdata('class', 'danger');
	     $this->session->set_flashdata('msg', "Error to verify");
		 redirect("Home/");
	}
	}
	}
	else{
		 $this->session->set_flashdata('result', 1);
	     $this->session->set_flashdata('class', 'danger');
	     $this->session->set_flashdata('msg', "Error to verify");
		 redirect("Home/");
	}
	
}


}