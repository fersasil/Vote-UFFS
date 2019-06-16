<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logado')){
            redirect(base_url());
        }

        //var_dump($this->session->userdata('user_logado'));
        //die();

        $this->load->model('eleicao_model');
        $this->load->helper('func');
        $this->eleicoes = $this->eleicao_model->retorna_todas_eleicoes();
    }

	public function index(){
        //$this->load->view('welcome_message');
        //Top
        $dados["titulo"] = "Dashboard";
        $dados['eleicoes'] = $this->eleicoes;
        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");

        $this->load->view("backend/template/topbar");
        //Middle
        
        $this->load->view("backend/template/content");
        
        //Footer
        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");

        //echo base_url();
        //teste();
    }
    
    
    public function teste(){
        echo "teste";
    }
}
