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

        $dados['admin'] = $this->session->userdata('user_logado')->super_usuario;
    }

	public function index(){
        //$this->load->view('welcome_message');
        //Top
        $dados["titulo"] = "Dashboard";
        $dados["admin"] = true;
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
