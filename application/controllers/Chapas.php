<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chapas extends CI_Controller {
    public function __construct(){
        parent::__construct();

        if(!$this->session->userdata('logado')){
            redirect(base_url());
        }

        $this->load->model(array('eleicao_model', 'chapa_model', 'usuario_model'));
        $this->load->helper(array('func', 'form'));
        $this->load->library('form_validation');
        $this->eleicoes = $this->eleicao_model->retorna_todas_eleicoes();
    }

	public function index(){
        //$this->load->view('welcome_message');
        //Top
        $dados['eleicoes'] = $this->eleicoes;
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
    
    public function imprime_chapa($id, $nome = null){
        $dados['chapa'] = $this->chapa_model->retorna_chapa_por_id($id);

        $dados['titulo'] = "";
        
        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view("backend/exibe_chapa");

        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }
    
    public function cadastrar_chapa($info = null){
        $dados['eleicoes'] = $this->eleicoes;
        $dados['titulo'] = "Cadastrar Chapa";
        
        if($info){
            $dados['sucesso'] = true;
        }
        else{
            $dados['sucesso'] = false;            
        }

        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view("backend/cadastrar_chapas");

        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
    }

    public function cria_nova_chapa(){
        //validação dos campos
        //var_dump(var_dump($this->input->post()));
        //die();
        //chapa
        $this->form_validation->set_rules('eleicao_id', 'eleição não selecionada', 'required');
        $this->form_validation->set_rules('nome_chapa', 'nome da chapa', 'required');
        $this->form_validation->set_rules('descricao_chapa', 'descrição da chapa', 'required');
        //$this->form_validation->set_rules('img_chapa', '', 'required');

        //presidente
        $this->form_validation->set_rules('nome_presidente', 'nome do presidente', 'required');
        $this->form_validation->set_rules('matricula_presidente', 'matricula do presidente', 'required');
        $this->form_validation->set_rules('semestre_presidente', 'semestre do presidente', 'required');
        $this->form_validation->set_rules('descricao_presidente', 'descricao do presidente', 'required');
        
        //vice
        $this->form_validation->set_rules('nome_vice_presidente', 'nome do vice-presidente', 'required');
        $this->form_validation->set_rules('matricula_vice_presidente', 'matricula do vice-presidente', 'required');
        $this->form_validation->set_rules('semestre_vice_presidente', 'semestre do vice-presidente', 'required');
        $this->form_validation->set_rules('descricao_vice_presidente', 'descricao do vice-presidente', 'required');

        //tesoureiro
        $this->form_validation->set_rules('nome_tesoureiro', 'nome do tesoureiro(a)', 'required');
        $this->form_validation->set_rules('matricula_tesoureiro', 'matricula do tesoureiro(a)', 'required');
        $this->form_validation->set_rules('semestre_tesoureiro', 'semestre do tesoureiro(a)', 'required');
        $this->form_validation->set_rules('descricao_tesoureiro', 'descrição do tesoureiro(a)', 'required');

        //secretario
        $this->form_validation->set_rules('nome_secretario', 'nome do secretário(a)', 'required');
        $this->form_validation->set_rules('matricula_secretario', 'matricula do secretario(a)', 'required');
        $this->form_validation->set_rules('semestre_secretario', 'semestre do secretario(a)', 'required');
        $this->form_validation->set_rules('descricao_secretario', 'descricao do secretario(a)', 'required');

        //Pegar o número de suplentes cadastrados e fazer a verificação
        $numero_suplentes = $this->input->post('numero_suplentes');

        
        //var_dump($this->input->post());

        //verificação para os suplentes, que começa com suplente1
        for($i = 1; $i <= $numero_suplentes; $i++){
            $string = 'suplente_' . $i; // . '_nome';
            //var_dump($string);
            
            $this->form_validation->set_rules($string . '_nome', 'nome do suplente ' . $i . ' não preenchido', 'required');
            $this->form_validation->set_rules($string . '_matricula', 'matricula do suplente' . $i . 'não preenchido', 'required');
            $this->form_validation->set_rules($string . '_semestre', 'semestre do suplente' . $i . 'não preenchido', 'required');
            $this->form_validation->set_rules($string . '_descricao', 'descricao do suplente' . $i . 'não preenchido', 'required');
        }

        if($this->form_validation->run()){
            //salvar no banco
            $chapa_info['eleicao_id'] = $this->input->post('eleicao_id');
            $chapa_info['nome_chapa'] = $this->input->post('nome_chapa');
            $chapa_info['descricao_chapa'] = $this->input->post('descricao_chapa');
            $chapa_info['img_chapa'] = false;
            $chapa_info['chapa_aprovada'] = false;
            $chapa_info['numero_suplentes'] = $numero_suplentes;

            $suplente = null;

            

            //$presidente['nome'] = $this->input->post('nome_presidente');
            $presidente['matricula'] = $this->input->post('matricula_presidente');
            //$presidente['semestre'] = $this->input->post('semestre_presidente');
            $presidente['descricao'] = $this->input->post('descricao_presidente');
            $presidente['concorre_eleicao'] = true;


            //$vice['nome'] = $this->input->post('nome_vice_presidente');
            $vice['matricula'] = $this->input->post('matricula_vice_presidente');
           // $vice['semestre'] = $this->input->post('semestre_vice_presidente');
            $vice['descricao'] = $this->input->post('descricao_vice_presidente');
            $vice['concorre_eleicao'] = true;

            


            //$tesoureiro['nome'] = $this->input->post('nome_tesoureiro');
            $tesoureiro['matricula'] = $this->input->post('matricula_tesoureiro');
            //$tesoureiro['semestre'] = $this->input->post('semestre_tesoureiro');
            $tesoureiro['descricao'] = $this->input->post('descricao_tesoureiro');
            $tesoureiro['concorre_eleicao'] = true;


            //$secretario['nome'] = $this->input->post('nome_secretario');
            $secretario['matricula'] = $this->input->post('matricula_secretario');
            //$secretario['semestre'] = $this->input->post('semestre_secretario');
            $secretario['descricao'] = $this->input->post('descricao_secretario');
            $secretario['concorre_eleicao'] = true;

            for($i = 1; $i <= $numero_suplentes; $i++){
                //$suplente['suplente_' . $i .' _nome'] = $this->input->post('suplente_' . $i .' _nome');
                $suplente['suplente_' . $i . '_matricula'] = $this->input->post('suplente_' . $i . '_matricula', 'matricula do suplente');
                //$suplente['suplente_' . $i . '_semestre'] = $this->input->post('suplente_' . $i . '_semestre', 'semestre do suplente');
                $suplente['suplente_' . $i . '_descricao'] = $this->input->post('suplente_' . $i . '_descricao', 'descricao do suplente');
                $suplente['suplente_' . $i . '_concorre_eleicao'] = true;
            }

            
            //Encontrar o id dos membros com base na matricula
            $dado = $this->usuario_model->matricula_para_id($presidente['matricula']);
            
            if(sizeof($dado) > 0)
                $presidente['id'] = $dado[0]->id_usuario;
            else{
                echo "usuario não cadastrado no sistema!";
                die();
                //TODO retorno com o erro a view
            }

            $dado = $this->usuario_model->matricula_para_id($vice['matricula']);

            if(sizeof($dado) > 0)
                $vice['id'] = $dado[0]->id_usuario;
            else{
                echo "usuario não cadastrado no sistema!";
                die();
                //TODO retorno com o erro a view
            }

            $dado = $this->usuario_model->matricula_para_id($tesoureiro['matricula']);

            if(sizeof($dado) > 0)
                $tesoureiro['id'] = $dado[0]->id_usuario;
            else{
                echo "usuario não cadastrado no sistema!";
                die();
                //TODO retorno com o erro a view
            }

            $dado =  $this->usuario_model->matricula_para_id($secretario['matricula']);

            if(sizeof($dado) > 0)
                $secretario['id'] = $dado[0]->id_usuario;
            else{
                echo "usuario não cadastrado no sistema!";
                die();
                //TODO retorno com o erro a view
            }

            for($i = 1; $i <= $numero_suplentes; $i++){
                //var_dump($suplente);
                //die();
                $suplente['suplente_' . $i .'_id'] = $this->usuario_model->matricula_para_id($suplente['suplente_' . $i .'_matricula']);
                
                //APENAS PARA TESTES
                //$suplente['suplente_' . $i .' _id'] = $i;
            }

            
            //$this->chapa_model->cria_nova_chapa($chapa_info, $presidente['id'], $presidente['descricao'], $vice['id'], $vice['descricao'], $tesoureiro['id'], $tesoureiro['descricao'], $secretario['id'], $secretario['descricao'], $suplente);
            $this->chapa_model->cria_chapa($chapa_info);
            
            $idChapa = $this->chapa_model->procura_id_por_nome($chapa_info["nome_chapa"]);
            $idChapa = $idChapa[0]->id_chapa;
 
            $this->chapa_model->cadastrar_membro($presidente['id'], $presidente['descricao'], $idChapa, "Presidente");
            $this->chapa_model->cadastrar_membro($vice['id'], $vice['descricao'], $idChapa, "Vice-Presidente");
            $this->chapa_model->cadastrar_membro($tesoureiro['id'], $tesoureiro['descricao'], $idChapa, "Tesoureiro");
            $this->chapa_model->cadastrar_membro($secretario['id'], $secretario['descricao'], $idChapa, "Secretario");

            for($i = 1; $i <= $numero_suplentes; $i++){
                $this->chapa_model->cadastrar_membro($suplente['suplente_' . $i .'_id'], $suplente['suplente_' . $i . '_descricao'], $idChapa, "Suplente");            
            }

            //Redirecionar para a pagina que estava e mostrar uma mensagem nela!
            //ou ir para uma página de pendentes...
            redirect(base_url('cadastrar-chapa/'));
        }
        else{   //caso de erro
            $this->cadastrar_chapa();
        }

    }
}
