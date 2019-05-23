<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Erro extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logado')){
            redirect(base_url('admin/login'));
        }

		$dados['admin'] = $this->session->userdata('user_logado')->super_usuario;    }

	public function index(){
		$dados["titulo"] = "Página não encontrada!";
		$dados['admin'] = true;
        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");
        
		$this->load->view('backend/template/404');
		
		$this->load->view('backend/template/footer');
		$this->load->view("backend/template/footer_end");

        
	}
}
