<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model("user_model");
	}
	public function index()
	{
		$this->load->view('user/add');
	}
	public function save()
	{
		$fullname = $this->input->post("fullname");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$repeatpassword = $this->input->post("repeatpassword");

		$this->form_validation->set_rules('fullname', 'Nombre', 'required|min_length[2]');
		$this->form_validation->set_rules('email', 'Correo', 'required|valid_email|is_unique[datospersonas.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('repeatpassword', 'Confirmar contraseña', 'required|matches[password]');

		if ($this->form_validation->run() == FALSE)
		{
				$this->load->view('user/add');
		}
		else
		{
			$data = array(
				"nombre"=>$fullname,
				"email"=> $email,
				"contraseña"=>md5($password)
	
			);
			$this->user_model->save($data);
			$this->session->set_flashdata('success','Se guardaron los datos correctamente');
			redirect(base_url()."usuarios");

		}


		
	}
}