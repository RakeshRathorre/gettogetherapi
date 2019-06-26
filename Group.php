<?php 	
class Group extends CI_Controller{

 function __construct() {
    parent::__construct();
    $this->load->model('Core_Model');
    $this->load->model('Common_Model');
    $this->load->library('session');
    $this->res = new stdClass();
    $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
    }
    public function group_list() {
        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
        $category_id = $request->category_id;
        // print_r($request);die();
        $where = array('category_id' => $category_id );
        $res = $this->Core_Model->SelectRecord('group_list','id,category_id,image,name',$where,$order = '');

        if (empty($res)) {
            $this->res->status = 'Failed';
            $this->_error('error', 'Incorrect data.');
        } else {
            $where1 = $res[0]['category_id'];
            $res1 = $this->Core_Model->CountDet($where1);
            $this->res->status = 'Successfull';
            $this->res->data = $res;
            $this->res->members = $res1;
        }
            $this->_output();
            die();
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