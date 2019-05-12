<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	public function index(){
        $dados['titulo'] = "Entrar";

        $this->load->view("backend/template/head", $dados);
        $this->load->view("login/login");
        $this->load->view("backend/template/footer_end");
    }

    public function login(){
        $dados['titulo'] = "Entrar";

        $this->load->view("backend/template/head", $dados);
        $this->load->view("login/login");
        $this->load->view("backend/template/footer_end");
    }

    public function cadastrar(){
        $dados['titulo'] = "Cadastrar";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("login/cadastrar");
        $this->load->view("backend/template/footer_end");
    }

    public function esqueceu_senha(){
        $dados['titulo'] = "Esqueceu a senha?";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("login/esqueceu_senha");
        $this->load->view("backend/template/footer_end");
    }
}
