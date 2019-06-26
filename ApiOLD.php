<?php 	
class Api extends CI_Controller{

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
        $address = $request->address;    
        $contact = $request->contact;    
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
        if (!$address) {
                    $this->_error('Form error', 'Address is not specified.');
        }  
        if (!$contact) {
                    $this->_error('Form error', 'Contact is not specified.');
        }  
        if ($this->email_check($email)) {
                    $this->_error('Form error', 'Email already exists.');
        }
        else {
            echo "checked";
                }

        $where=array('email'=>$email,'password'=>md5($password),'full_name'=>$full_name,'address'=>$address,'contact'=>$contact);
        // $field=array('email');
        $get_email = $this->Core_Model->InsertRecord('user', $where);
        // print_r($get_email);die;
        if (!empty($get_email)) {
            return true;
        }
        return false;
    }

    function email_check($email) {
        $where = array('email' => $email);
        $field = array('email');
        $get_email = $this->Core_Model->selectsinglerecord('user', $field, $where);
    //print_r($get_email);die;
        if (!empty($get_email)) {
            return true;
        }
        return false;
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
            $this->session->sess_destroy();
            $this->res->status = 'Successfull updated/removed accesstoken';
        }else{
            $this->res->status = 'Failed';
            $this->_error('error', 'Invalid accesstoken.');
        }
        $this->_output();
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

    // public function update()
    // {
    //     $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
    //     // print_r($request);die();
    //     $email = $request->email;
    //     $password = $request->password;
    //     //$accesstoken2 = base64_encode(random_bytes(32));
    //     $where_update = array('email' => $email);
    //     $field_update = array('accesstoken'=>$accesstoken2);
    //     $aray_update = $this->Core_Model->updateFields('user', $field_update, $where_update);
    //     // if($aray_update->accesstoken!=)
    //     $this->res->status = 'Successfull updated/removed accesstoken';
    // }













    function _parse_request() {
        if ($request == json_decode(file_get_contents('php://input'))) {
            $this->req = json_encode(rtrim(file_get_contents('php://input'), "\0"));
            return true;
        } else {
            $this->req = json_encode(rtrim(file_get_contents('php://input'), "\0"));
    //$request = json_encode(rtrim(file_get_contents('php://input'), "\0"));
            return true;
        }
    }

    function _exec_request() {
        $api_request = $this->req->request;
        list($module, $function) = explode('/', $api_request);

        if (method_exists($this, $module)) {
            $this->{$module}($function);
        } else {
            $this->_error("No method?");
        }
    }

    function _require_auth() {
        if (in_array($this->req->request, $this->no_auth_request))
            return false;
        return true;
    }

    function _check_auth() {
        if (!isset($this->req->authkey)) {
            return false;
        }
        list($email, $key) = explode('#', $this->req->authkey);
        $query = $this->db->query("SELECT * FROM `users` WHERE `email` = ? AND `key` = ?", array($email, $key));
        if (!$query->num_rows()) {
            return false;
        }
        $this->userdata = $query->row();
        return true;
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

    function _throw($code, $header, $msg) {
        switch ($code) {
            case "403":
                header("HTTP/1.0 403 Forbidden");
                echo "<h1>{$header}</h1>";
                echo "<p>{$msg}</p>";
                echo "<hr />";
                echo date('Y-m-d\TH:i:sP');
                break;
        }
        die();
    }
}

?>