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
            die();
        }
        
        $this->load->library('form_validation');
        $this->load->model(array('eleicao_model', 'chapa_model'));
        $this->load->helper('func');
        
        
        
        $dados['admin'] = $this->session->userdata('user_logado')->super_usuario;
        $this->eleicoes = $this->eleicao_model->retorna_todas_eleicoes();
        
        date_default_timezone_set('America/Sao_Paulo');
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

    public function iniciar_eleicao(){
        $aut = $this->input->post("aut");
        $id_eleicao = $this->input->post("id_eleicao");

        if(!$aut){
            exit("Você não tem permissão para acessar essa página diretamente!");
        }

        $this->eleicao_model->ativar_eleicao($id_eleicao);
        
        $res['success'] = "true";

        echo json_encode($res);
    }

    public function encerrar_eleicao(){
        $aut = $this->input->post("aut");
        $id_eleicao = $this->input->post("id_eleicao");
        $nome_eleicao = $this->input->post("nome_eleicao");


        if(!$aut){
            exit("Você não tem permissão para acessar essa página diretamente!");
        }

        //$this->eleicao_model->encerrar_eleicao($id_eleicao);
        //Eleição ativa = false
        //Calcular vencedor
        //Colocar total de votantes
        //Vencedor
        
        $resultados = $this->calcula_resultados($nome_eleicao, $id_eleicao);

        $id_vencedor = $resultados['vencedor']['id'];
        $total_votos = $resultados['numeroDeVotos'];
        $vencedor_votos = $resultados['vencedor']['votos'];
        
        $this->eleicao_model->encerrar_eleicao($id_eleicao);
        $this->eleicao_model->atualizar_vencedor($id_eleicao, $id_vencedor, $total_votos, $vencedor_votos);

        $res['success'] = "true";

        echo json_encode($res);
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
        $dados['chapas'] = $this->chapa_model->retorna_chapa_e_membros($id_eleicao);

        $dados['eleicoes'] = $this->eleicoes;

        foreach ($this->eleicoes as $eleicao) {
            if($eleicao->id_eleicao == $id_eleicao){
                $dados['essa_eleicao'] = $eleicao;
                break;
            }
        }

        $dados['titulo'] = $dados['essa_eleicao']->nome;

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

    public function conta_votos(){
        $nome_eleicao = $this->input->post("nomeEleicao");
        $id_eleicao = $this->input->post("idEleicao");
        $verificador = $this->input->post("verificador");
        $this->load->model("chapa_model");

        //The MD5 hash for uffs_2019 is : 0f8f4803790b8f9267fd3920fe277bf9

        if(!$verificador == "0f8f4803790b8f9267fd3920fe277bf9" || !$verificador){
            //exit('No direct script access allowed');
        }

        $resultados = $this->calcula_resultados($nome_eleicao, $id_eleicao);
        
        //Contar o tempo que falta para o final da eleição!
        foreach ($this->eleicoes as $eleicao) {
            if($eleicao->id_eleicao == $id_eleicao){
                break;
            }
        }

        // echo json_encode($votos);
        $dataFim = date($eleicao->fim_eleicao);
        $dataAtual = date("Y-m-d H:i:s");
        // echo json_encode($eleicao);
        $seconds = strtotime($dataFim) - strtotime($dataAtual);

        if($dataAtual <= $dataFim){
            $resultados['tempo_restante'] = $this->secondsToTime($seconds);
        }
        else{
            $resultados['tempo_restante'] = "Votação já encerrada";
        }

        // var_dump($votos);
        echo(json_encode($resultados));
        
    }

    private function calcula_resultados($nome_eleicao, $id_eleicao){
        //pegar os votos da blockchain
        $votos = $this->get_all_votes_from_election($nome_eleicao);
        $resultados = array();
        //conseguir as chapas da eleição
        $chapas = $this->chapa_model->retorna_chapas_aprovadas($id_eleicao);
        $numeroVotos = 0;

        $resultados['vencedor']['nome'] = "";
        $resultados['vencedor']['votos'] = -1;

        foreach ($chapas as $chapa) {
            $count = 0;

            foreach($votos as $voto){
                if($chapa->id_chapa == $voto['candidateNumber']){
                    $count++;
                }
            }

            $resultados['votos'][] = array(
                "nomeChapa" => $chapa->nome_chapa,
                'votos' => $count);
            
                //Verificar o vencedor

            if($count > $resultados['vencedor']['votos']){
                $resultados['vencedor']['nome'] = $chapa->nome_chapa;
                $resultados['vencedor']['votos'] = $count;
                $resultados['vencedor']['id'] = $chapa->id_chapa;
            }
            $numeroVotos += $count;
        }

        $resultados['numeroDeVotos'] = $numeroVotos;

        return $resultados;
    }

    private function secondsToTime($seconds) {
        $dtF = new DateTime('@0');
        $dtT = new DateTime("@$seconds");
        //var_dump($dtF->diff($dtT)->format("%a:%h:%i:%s"));
        return $dtF->diff($dtT)->format('%a dias, %h horas, %i minutos e %s segundos restantes.');
    }

    private function get_all_votes_from_election($id){
        
        $code = $this->get_address_ellection($id);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'http://localhost:8084/search/' . $code);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Accept: */*';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Host: localhost:8084';
        $headers[] = 'Postman-Token: ee41204d-7326-4e9b-b4a3-0bfe2779efae,c60b98f8-a71c-4775-b0eb-c46d6124b8df';
        $headers[] = 'User-Agent: PostmanRuntime/7.11.0';
        $headers[] = 'Accept-Encoding: gzip, deflate';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);

        return json_decode($result, true);
    }

    private function get_address_ellection($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "8084",
            CURLOPT_URL => "http://localhost:8084/election-url/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n    \"electionName\": \"{$id}\"\n}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } 

        $result = json_decode($response, true);

        return $result['familyCode'] . $result['electionCode'];
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
