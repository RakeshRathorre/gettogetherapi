<?php 	
class Auth extends CI_Controller{

 function __construct() {
    parent::__construct();
    $this->load->model('Core_Model');
    $this->load->model('Common_Model');
    $this->load->library('session');
    $this->res = new stdClass();
    $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
    }
// 
    public function signup() {
        $request = json_decode(rtrim(file_get_contents('php://input'), "\0")); 
        $email = $request->email;
        $password = $request->password;    
        $full_name = $request->full_name;    
        $user_id = $request->user_id;    
        $address = $request->address;    
        $home_town = $request->home_town;    
        $language = $request->language;    
        $birthday = $request->birthday;    
        $gender = $request->gender;    
        $bio = $request->bio;    
        $image = $request->image;    
        // echo $full_name; die;
        if (!$email) {
                    $this->_error('Form error', 'Email is not specified.');
        }
        if (!$password) {
                    $this->_error('Form error', 'Password is not specified.');
        }
        if (!$full_name) {
                    $this->_error('Form error', 'Full Name is not specified.');
        }
        if (!$user_id) {
                    $this->_error('Form error', 'User Id is not specified.');
        }  
        if (!$address) {
                    $this->_error('Form error', 'Address is not specified.');
        }
        if (!$home_town) {
                    $this->_error('Form error', 'Home is not specified.');
        }
        if (!$language) {
                    $this->_error('Form error', 'Language is not specified.');
        }
        if (!$birthday) {
                    $this->_error('Form error', 'Birthday is not specified.');
        }
        if (!$gender) {
                    $this->_error('Form error', 'Gender is not specified.');
        }
        if (!$bio) {
                    $this->_error('Form error', 'Bio is not specified.');
        }
        if (!$image) {
                    $this->_error('Form error', 'Image is not specified.');
        } 
        if ($this->email_check($email)) {
                    $this->_error('Form error', 'Email already exists.');
        }
        else {
            $where = array('email'=>$email,'password'=>md5($password),'full_name'=>$full_name,'user_id'=>$user_id,'address'=>$address,'home_town'=>$home_town,'language'=>$language,'birthday'=>$birthday,'gender'=>$gender,'bio'=>$bio,'image'=>$image);
            // $field=array('email');
            $get_email = $this->Core_Model->InsertRecord('user', $where);
            // print_r($get_email);die;
            }
            if (!empty($get_email)) {
                return true;
            }
            return false;
        }
    function email_check($email) {
        $where = array('email' => $email);
        $field = 'email';
        // print_r($where);die();
        $get_email = $this->Core_Model->SelectSingleRecord('user', $field, $where);
    // print_r($get_email);die;
        if (!empty($get_email)) {
             return true;
            $this->res->status = 'Failed';
        }
         return false;
        $this->res->status = 'Success';
    }
    public function signin()
    {
        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
        $email = $request->email;
        $password = $request->password;
        // print_r($this->input->request_headers());die();
        //for accesstoken check
        // echo $password;die();
        if (!$email) {
            $this->_error('Form error', 'Email-Id is not specified.');
        }
        if (!$password) {
            $this->_error('Form error', 'Password is not specified.');
        }
         $where_login = array('email' => $email, 'password' => md5($password));
         $aray_login = $this->Core_Model->selectsinglerecord('user', '*', $where_login);
         if(empty($aray_login)) {
            $this->res->status = 'Failed';
            $this->_error('error', 'Incorrect Email Id & Password.');
        } else {
            // $id=$aray_login['id'];
            $accesstoken = base64_encode(random_bytes(32));
            $is_user_login=1;
            // print_r($accesstoken);die();
            //for accesstoken show
            //update access token
            $where_update = array('email' => $email);
            $field_update = array('accesstoken'=>$accesstoken,'is_user_login'=>$is_user_login);
            $this->Core_Model->updateFields('user', $field_update, $where_update);
            $this->res->status = 'Success';
            $this->res->data = $aray_login;
            $this->res->accesstoken = $accesstoken;
        }
        $this->_output();
        die();
    }
    public function logout()
    {
        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
         $user_id = $request->user_id;
         $header = $this->input->request_headers();
         $accesstoken = $header['accesstoken'];
         // print_r($accesstoken);die();
        if($this->check_accesstoken($user_id,$accesstoken)){
            $where_update = array('id' => $user_id);
            $field_update = array('accesstoken'=>0,'is_user_login'=>0);
            $this->Core_Model->updateFields('user', $field_update, $where_update);
            $this->res->status = 'Successfull updated/removed accesstoken';
        }else{
            $this->res->status = 'Failed';
            $this->_error('error', 'Invalid accesstoken.');
        }
        $this->_output();
          die();
    }
    public function check_accesstoken($user_id,$accesstoken)
    {
        $where = array('id'=>$user_id,'accesstoken'=>$accesstoken);
        $selectdata = 'id,accesstoken';
        $res = $this->Core_Model->SelectSingleRecord('user',$selectdata,$where,$order='');
       if($res){
        return true;
       }else
       return false;
    }
    function _output() {
        header('Content-Type: application/json');
        //$this->res->request = $this->req->request;
        $this->res->datetime = date('Y-m-d\TH:i:sP');
        echo json_encode($this->res);
    }
    function _error($error, $reason, $code = null) {
        header('Content-Type: application/json');
        $this->res->status = 'error';
        if (isset($this->req->request)) {
            $this->res->request = $this->req->request;
        }
        $this->res->error = $error;
        $this->res->message = $reason;
        $this->res->datetime = date('Y-m-d\TH:i:sP');
        echo json_encode($this->res);
        die();
    }
}

?>