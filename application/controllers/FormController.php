<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormController extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('app_model');
    }

	public function index()
	{
		$data['users'] = $this->app_model->getData('users');
		$this->load->view('header');
		$this->load->view('index',$data);
		$this->load->view('footer');
	}

	public function add()
	{	$this->load->view('header');
		$this->load->view('form');
		$this->load->view('footer');
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

	public function edit($id)
	{	$this->load->view('header');
		$data['user'] = $this->app_model->getRow('users',array('*'),array('id'=>$id));
		$this->load->view('edit_form',$data);
		$this->load->view('footer');
	}

	public function update(){
		
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
    		$rs = $this->app_model->rowUpdate('users',$postArray,array('id'=>$post['user_id']));
    		if($rs){
    			$response['status'] = true;
    			$response['msg'] = 'Data updated successfully';
    		}else{
    			$response['status'] = false;
    			$response['msg'] = 'There are some problem to perform this action.';
    		}
    	}else{
    		 $response['error'] = validation_errors();
    	}
    	echo json_encode($response);
	}

	public function delete()
	{	
		$rs = $this->app_model->RowsDelete('users',array('id'=>$this->input->post('id')));
		if($rs){
			$response['status'] = true;
			$response['msg'] = 'Data deleted successfully';
		}else{
			$response['status'] = false;
			$response['msg'] = 'There are some problem to perform this action.';
		}
		echo json_encode($response);
	}
}
