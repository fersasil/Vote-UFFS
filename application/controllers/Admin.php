<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }

	public function index(){
    
        $dados["titulo"] = "Dashboard";
        $dados["admin"] = true;
        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");
        //Middle
        
        $this->load->view("admin/help/candidatos_chapa");
        
        //Footer
        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");

        //echo base_url();
        //teste();
    }


    public function cadastrar_eleicao(){
        $dados["titulo"] = "Dashboard";
        $dados["admin"] = true;
        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");
        //Middle
        
        $this->load->view("admin/cadastrar_eleicao");
        
        //Footer
        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }

    public function eleicao($id_eleicao, $nome_eleicao = null){
        $this->load->library('table');


        $dados['titulo'] = $nome_eleicao;

        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");
        //Middle
        
        $this->load->view("admin/chapas_eleicao");
        
        //Footer
        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }







    /**
     * Páginas de ajuda ao usuário
     */
    
    
    public function cadastrando_eleicao(){
        $dados['titulo'] = "Cadastrando Eleição";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");

        $this->load->view("admin/help/cadastrando_eleicao");

        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }
    
    public function excluindo_eleicao(){
        $dados['titulo'] = "Excluindo Eleição";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");

        $this->load->view("admin/help/excluindo_eleicao");

        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }
    public function candidatos_chapas(){
        $dados['titulo'] = "Candidatos e Chapas";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");

        $this->load->view("admin/help/candidatos_chapa");

        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }

    public function editando_eleicao(){
        $dados['titulo'] = "Editando uma eleição";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");

        $this->load->view("admin/help/editando_eleicao");

        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }
    
    public function como_funciona(){
        $dados['titulo'] = "Como funciona";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");

        $this->load->view("admin/help/como_funciona");

        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }
}
