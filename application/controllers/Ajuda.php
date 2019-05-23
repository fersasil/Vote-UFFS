<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajuda extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logado')){
            redirect(base_url());
        }

        $dados['admin'] = $this->session->userdata('user_logado')->super_usuario;    }

	public function index(){
            $dados["titulo"] = "Ajuda";

            $this->load->view("backend/template/head", $dados);
            $this->load->view("backend/template/sidebar");
            $this->load->view("backend/help_pages/login");
            $this->load->view("backend/template/footer_end");
        }

    public function como_votar(){
        $dados["titulo"] = "Como Votar";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view("backend/help_pages/como_votar");
        $this->load->view("backend/template/footer_end");
    }

    public function como_funciona(){
        $dados["titulo"] = "Como funciona";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view("backend/help_pages/como_funciona");
        $this->load->view("backend/template/footer_end");
    }

    public function seguranca(){
        $dados["titulo"] = "Segurança";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view("backend/help_pages/seguranca");
        
        $this->load->view("backend/template/footer_end");
    }

    public function fale_conosco(){
        $dados["titulo"] = "Fale Conosco";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view("backend/help_pages/fale_conosco");
        $this->load->view("backend/template/footer_end");
    }
}
