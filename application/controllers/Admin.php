<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        if(!$this->session->userdata('logado')){//false se não tiver logado, negação true, logo ele loga
            redirect(base_url());
        }
        else if(!$dados['admin'] = $this->session->userdata('user_logado')->super_usuario){ //verificar se é super usuário, caso não for exibir erro
            echo "Você não tem permissão para acessar essa página!";
        }
        
        $this->load->library('form_validation');
        $this->load->model(array('eleicao_model', 'chapa_model'));
        $this->load->helper('func');
        
        
        $dados['admin'] = $this->session->userdata('user_logado')->super_usuario;
        $this->eleicoes = $this->eleicao_model->retorna_todas_eleicoes();
        

    }

	public function index(){
        
        $dados['eleicoes'] = $this->eleicoes;
        $dados["titulo"] = "Dashboard";
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
        $this->load->helper('form');
        

        $dados['eleicoes'] = $this->eleicoes;

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
        $dados['chapas'] = $this->chapa_model->retorna_todas_chapas($id_eleicao);

        $dados['eleicoes'] = $this->eleicoes;
        $dados['titulo'] = $nome_eleicao;

        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");
        //Middle
        
        $this->load->view("admin/chapas_eleicao");
        
        //Footer
        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }

    public function nova_eleicao(){
        //Fazer as verificações
        $this->form_validation->set_rules('nome_eleicao', 'nome da eleição', 'required');
        $this->form_validation->set_rules('descricao_eleicao', 'descrição da eleição', 'required');

        $this->form_validation->set_rules('inicioEleicao', 'Inicio da eleicao é necessário', 'required');
        $this->form_validation->set_rules('fimEleicao', 'Fim eleição é necessário', 'required');
        
        $this->form_validation->set_rules('numero_max_chapas', 'numero máximo de chapas', 'required');
        $this->form_validation->set_rules('tipo_votacao', 'tipo da votação', 'required');

        $this->form_validation->set_rules('numero_max_chapas', 'numero máximo de chapas', 'required');
        $this->form_validation->set_rules('tipo_votacao', 'tipo da votação', 'required');

        if($this->form_validation->run()){
            //gravar no banco
            //Pegar as variaveis
            $nome_eleicao = $this->input->post('nome_eleicao');
            $descricao_eleicao = $this->input->post('descricao_eleicao');
            $inicio_eleicao = $this->input->post('inicioEleicao');
            $fim_eleicao = $this->input->post('fimEleicao');
            $numero_max_chapas = $this->input->post('numero_max_chapas');
            $tipo_votacao = $this->input->post('tipo_votacao');

            $this->eleicao_model->cadastrar_eleicao($nome_eleicao, $descricao_eleicao, $inicio_eleicao, $fim_eleicao, $numero_max_chapas, $tipo_votacao);
           
           
            //Voltar a tela de cadastrar eleições ou transferir para o menu da votação
            $this->cadastrar_eleicao();
        }
        else{
            $this->cadastrar_eleicao();
        }
        
    }

    public function chapa_admin($id, $nome = null){
        echo "ok";    
    }

    /**
     * Páginas de ajuda ao usuário
     */
    
    
    public function cadastrando_eleicao(){
        $dados['eleicoes'] = $this->eleicoes;
        $dados['titulo'] = "Cadastrando Eleição";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");

        $this->load->view("admin/help/cadastrando_eleicao");

        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }
    
    public function excluindo_eleicao(){
        $dados['eleicoes'] = $this->eleicoes;
        $dados['titulo'] = "Excluindo Eleição";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");

        $this->load->view("admin/help/excluindo_eleicao");

        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }
    public function candidatos_chapas(){
        $dados['eleicoes'] = $this->eleicoes;
        $dados['titulo'] = "Candidatos e Chapas";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");

        $this->load->view("admin/help/candidatos_chapa");

        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }

    public function editando_eleicao(){
        $dados['eleicoes'] = $this->eleicoes;
        $dados['titulo'] = "Editando uma eleição";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");

        $this->load->view("admin/help/editando_eleicao");

        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }
    
    public function como_funciona(){
        $dados['eleicoes'] = $this->eleicoes;
        $dados['titulo'] = "Como funciona";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("admin/template/sidebar");

        $this->load->view("admin/help/como_funciona");

        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }
}
