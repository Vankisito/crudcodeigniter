<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model("user_model");
	}
	public function index($id)
	{
        $data=$this->user_model->getUser($id);
		$this->load->view('user/edit', $data);
	}
	public function update($id)
	{
		$fullname = $this->input->post("fullname");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$repeatpassword = $this->input->post("repeatpassword");
        $validateEmail= "";
        $data=$this->user_model->getUser($id);
        if($email != $data->email){
            $validateEmail="|is_unique[datospersonas.email]";
        };

		$this->form_validation->set_rules('fullname', 'Nombre', 'required|min_length[2]');
		$this->form_validation->set_rules('email', 'Correo', 'required|valid_email'.$validateEmail);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('repeatpassword', 'Confirmar contraseña', 'required|matches[password]');

		if ($this->form_validation->run() == FALSE)
		{
            $this->index($id);
		}
		else
		{
			$data = array(
				"nombre"=>$fullname,
				"email"=> $email,
				"contraseña"=>md5($password),
                "ultModificacion"=>date("Y-m-d h:m:s")
			);
			$this->user_model->update($data,$id);
			$this->session->set_flashdata('success','Se editaron los datos correctamente');
			redirect(base_url()."usuarios");

		}


		
	}
}