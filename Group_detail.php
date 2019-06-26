<?php   
class Group_detail extends CI_Controller{

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
    $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
    }

    public function group_detail() {
        $request = json_decode(rtrim(file_get_contents('php://input'), "\0")); 
        $group_id = $request->group_id;
        $where = array('group_id' => $group_id );
        $res = $this->Core_Model->SelectRecord('group_members','id,group_id,image,name,address,is_user_login',$where,$order='');
        // print_r($res);die();
        // $userdata = [];
        // foreach ($res as $total) {
        //     $userdata[] = array('id' => $total['id'],'name' => $total['name'],'image' => base_url('assets/img/').$total['image'] );
        //     // print_r($total);die();
        // }

        $userdata = [];
        foreach ($res as $total) {
            $userdata[] = array('id' => $total['id'],'group_id' => $total['group_id'],'name' => $total['name'],'address' => $total['address'],'image' => base_url('assets/img/').$total['image'],'is_user_login' => $total['is_user_login']);
            // print_r($total);die();
        }
        if (empty($userdata)) {
            $this->res->success = false;
            $this->_error('error', 'Incorrect data.');
        } else {
            // $this->res->success = 'true';
            //  $this->res->data = $res;
            $where1 = $res[0]['group_id'];
            // print_r($where1);die();
            $res1 = $this->Core_Model->Countmembers($where1);
            $this->res->success = true;
            $this->res->data = $userdata;
            $this->res->members = $res1;
        }
        $this->_output();
          die();
    }

    function _output() {
        // header('Content-Type: application/json');
        //$this->res->request = $this->req->request;
        $this->res->datetime = date('Y-m-d\TH:i:sP');
        echo json_encode($this->res);
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
        die();
    }
}

?>