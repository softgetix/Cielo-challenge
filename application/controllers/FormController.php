<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormController extends CI_Controller {

	public function index()
	{
		$this->load->view('form');
	}

	public function save(){
		
		$this->form_validation->set_rules('name','Username','trim|required');
    	$this->form_validation->set_rules('dob','DOB','trim|required');
    	$this->form_validation->set_rules('email','Email','trim|required');
    	$response = array();
    	if($this->form_validation->run() == true){
    		$post = $this->input->post();
    		$postArray = array(
    				'name' => $post['name'],
    				'dob' => date('Y-m-d',strtotime($post['dob'])),
    				'email' => $post['email'],
    				'color' => $post['color'],
    		);
    		$rs = $this->db->insert('users',$postArray);
    		if($rs){
    			$response['status'] = true;
    			$response['msg'] = 'Data inserted successfully';
    		}else{
    			$response['status'] = false;
    			$response['msg'] = 'There are some problem to perform this action.';
    		}
    	}else{
    		 $response['error'] = validation_errors();
    	}
    	echo json_encode($response);
	}
}
