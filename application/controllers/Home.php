<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $dados['admin'] = true;
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
