<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_model extends CI_Model {

	
	public function save($data)
	{
		$this->db->query("ALTER TABLE datospersonas AUTO_INCREMENT 1");
		$this->db->insert("datospersonas",$data);
	}
	public function getUsers(){
		$this->db->select("*");
		$this->db->from("datospersonas");
		$results =$this->db->get();
		return $results->result();
	}
	public function getUser($id){
		$this->db->select("id, nombre, email");
		$this->db->from("datospersonas");
		$this->db->where("id = $id");
		$results=$this->db->get();
		return $results->row();
	}
	public function update($data,$id)
	{
		$this->db->where("id",$id);
		$this->db->update("datospersonas",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		$this->db->delete("datospersonas");
	}
}