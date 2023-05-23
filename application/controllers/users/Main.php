<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model("user_model");
	}
	public function index()
	{
		$data = array("data" => $this->user_model->getUsers());
		$this->load->view('user/main.php',$data);
	}

	public function delete($id){
		$this->user_model->delete($id);
		$this->session->set_flashdata('success','Se elimino el dato correctamente');
		redirect(base_url()."usuarios");
	}
}
