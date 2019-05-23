<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resultados extends CI_Controller {
	public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logado')){
            redirect(base_url());
        }

		$dados['admin'] = $this->session->userdata('user_logado')->super_usuario;
	}

	public function index(){
		$dados['titulo'] = "Resultado das Eleições";

		$this->load->view("backend/template/head", $dados);
		$this->load->view("backend/template/sidebar");
		$this->load->view("backend/template/topbar");
		
		$this->load->view("resultados/resultado");

		$this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");

	}

	//Vai receber a votação ou o id da votação
	public function eleicao($ano, $nome_eleicao){
		//$nome_eleicao = "DCE";
		$dados['titulo'] = $nome_eleicao;
		$dados['ano'] = $ano;
		$this->load->view("resultados/thead", $dados);
		$this->load->view("backend/template/sidebar");
		$this->load->view("backend/template/topbar");

		$this->load->view("resultados/blank");
		$this->load->view("backend/template/footer");
		$this->load->view("resultados/footer_end_table");
	
	}
}
