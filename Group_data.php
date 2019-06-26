<?php   
class Group_data extends CI_Controller{

 function __construct() {
    parent::__construct();
    header('Content-Type: application/json');
    // header("Access-Control-Allow-Headers: Content-Type");
    // header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Origin: *"); 
    $this->load->model('Core_Model');
    $this->load->model('Common_Model');
    $this->load->library('session');
    $this->res = new stdClass();
    // $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
    }

    public function group_tabdetails() //tabedetails
    {
        $request = json_decode(rtrim(file_get_contents('php://input'), "\0")); 
        // print_r($request);die();
        // print_r($this->input->request_headers());die();
        $group_id = $request->group_id;
        $header_name = $request->header_name; 
        // print_r($header_name);die();
        $longShift = true;
        if ($header_name == 'about') 
        {
            $header_name = $request->header_name;
            // $group_id = $request->group_id;
            // $where = array();
            $where = array('id' => $group_id );
            $res = $this->Core_Model->SelectRecord('group_list','about',$where,$order='');
            // print_r($res);die();
            $userdata = [];
            foreach ($res as $total)
            {
                $userdata[] = array('about' => $total['about']);
                // print_r($total);die();
            }
            if (empty($userdata)) 
            {
                $this->res->success = false;
                $this->_error('error', 'Incorrect id or data.');
            } else 
                {
                    $this->res->success = true;
                    $this->res->data = $userdata;
                }
                $this->_output();
                  exit();
        }
         elseif ($header_name == 'members') 
         {
            // echo 'Keep going. Good luck!';
            $header_name = $request->header_name;
            // $group_id = $request->group_id;
            // print_r($group_id);die();
            $where = array('group_members.group_id' => $group_id);
                //CONCAT('w3resource','.','com')
            $res = $this->Core_Model->joindataResult($place1 ='user.user_id', $place2 = 'group_members.user_id',$where,'group_members.id,group_members.group_id,user.image,user.full_name,user.user_id','user','group_members',$order='');
            // print_r($res);die();
            $userdata = [];
            foreach ($res as $total) 
            {
                $userdata[] = array('id' => $total['id'],'group_id' => $total['group_id'],'name' => $total['full_name'],'image' => base_url('assets/img/').$total['image']);
                // print_r($userdata);die();
            }
            if (empty($userdata)) 
            {
                $this->res->success = false;
                $this->_error('error', 'Incorrect id or data.');
            } else
             {
                $this->res->success = 'true';
                 $this->res->data = $res;
                $where1 = $res[0]['group_id'];
                // print_r($where1);die();
                $res1 = $this->Core_Model->Countmembers($where1);
                $this->res->success = true;
                $this->res->data = $userdata;
                $this->res->members = $res1;
            }
                $this->_output();
                exit();
        } 
        elseif ($header_name == 'photos')
         {
            $header_name = $request->header_name;
            // print_r($request);die();
            $where = array();
            $res = $this->Core_Model->SelectRecord('group_photo','id,image',$where,$order = '');
            // print_r($res);die();
            $userdata = [];
            foreach ($res as $total)
             {
               $userdata[] = array('image' => base_url('assets/img/').$total['image'] );
            // print_r($total);die();
            }
            if (empty($userdata))
             {
                $this->res->success = false;
                $this->_error('error', 'Incorrect id or data.');
            } else 
            {
                    $this->res->success = true;
                    $this->res->data = $userdata;
            }
                $this->_output();
                exit();
        } 
          elseif ($header_name == 'discussions') 
         {
            // echo 'Keep going. Good luck!';
            $header_name = $request->header_name;
            // $group_id = $request->group_id;
            // print_r($group_id);die();
            $where = array('discussions.group_id' => $group_id);
            $res = $this->Core_Model->joindataResult($place1 ='user.user_id', $place2 = 'discussions.user_id',$where,'discussions.id,discussions.group_id,discussions.chat,user.image,user.full_name','user','discussions',$order='');
            // print_r($res);die();
            $userdata = [];
            foreach ($res as $total) 
            {
                $userdata[] = array('id' => $total['id'],'group_id' => $total['group_id'],'name' => $total['full_name'],'image' => base_url('assets/img/').$total['image'],'discussions' => $total['chat']);
            }
                // print_r($userdata);die();
            if (empty($userdata)) 
            {
                $this->res->success = false;
                $this->_error('error', 'Incorrect id or data');
            } else
             {
                $this->res->success = 'true';
                 $this->res->data = $res;
                $where1 = $res[0]['group_id'];
                // print_r($where1);die();
                $res1 = $this->Core_Model->Countmembers($where1);
                $this->res->success = true;
                $this->res->data = $userdata;
                $this->res->members = $res1;
            }
                $this->_output();
                exit();
        }
        else
         {
        // echo 'Wrong header_name';
        $this->res->success = false;
        $this->_error('error', 'Incorrect id or data');
        }
    }
        function _output() {
            // header('Content-Type: application/json');
            //$this->res->request = $this->req->request;
            $this->res->datetime = date('Y-m-d\TH:i:sP');
            echo json_encode($this->res);
            exit();
        }
        function _error($error, $reason, $code = null) {
            // header('Content-Type: application/json');
            $this->res->success = false;
            if (isset($this->req->request)) {
                $this->res->request = $this->req->request;
            }
            // $this->res->error = $error;
            $this->res->message = $reason;
            $this->res->datetime = date('Y-m-d\TH:i:sP');
            echo json_encode($this->res);
            exit();
    }
}

?>