<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajuda extends CI_Controller {
    public function __construct(){
        parent::__construct();
        
        if(!$this->session->userdata('logado')){
            redirect(base_url());
        }
        
        $this->load->model('eleicao_model');
        $this->load->helper('func');
        $this->eleicoes = $this->eleicao_model->retorna_todas_eleicoes();

        $dados['admin'] = $this->session->userdata('user_logado')->super_usuario;    }

    public function index(){
        $dados['eleicoes'] = $this->eleicoes;
        $dados["titulo"] = "Ajuda";


        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/help_pages/login");
        $this->load->view("backend/template/footer_end");
    }

    public function gerar_chave_publica($pk = null){
        $this->load->helper('form');

        if($pk)
            $dados['pk'] = base64_decode(urldecode($pk));
        else
            $dados['pk'] = null;

        $dados['eleicoes'] = $this->eleicoes;
        $dados["titulo"] = "Gerar chave";

        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view("backend/help_pages/gerar_chave_publica");


        $this->load->view("backend/template/footer_end");

    }

    public function pesquisar_na_blockchain(){
        $this->load->helper('form');
        $dados['eleicoes'] = $this->eleicoes;
        $dados["titulo"] = "Pesquisar eleição por nome";

        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view("backend/help_pages/pesquisar_na_blockchain");


        $this->load->view("backend/template/footer_end");
    }

    public function pesquisa_eleicao_por_nome(){
        //TODO pegar o nome de todas as eleições e verificar se o digitado esta no banco! se sim, fazer a busca na blockchain

        $nome_eleicao = $this->input->post("nomeEleicao");
        
        $address = $this->get_address_ellection($nome_eleicao);
        $eleicao_info = $this->get_info_election_bc($address);

        $this->mostrar_resultados($eleicao_info, $nome_eleicao);
    }

    public function pesquisa_chave_publica(){
        //TODO pegar o nome de todas as eleições e verificar se o digitado esta no banco! se sim, fazer a busca na blockchain

        $chavePublica = $this->input->post("chavePublica");
        //vol
        $address = $this->get_familyCode();


        $eleicao_info = json_decode($this->get_info_election_bc($address));

        $user_votes = null;

        foreach ($eleicao_info as $voto) {
            if($voto->publicKey == $chavePublica){
                $user_votes[] = $voto;
            }
        }


        $this->mostrar_resultados(json_encode($user_votes), "chave publica");
    }

    public function historico_votos(){
        $this->load->helper('form');
        $dados['eleicoes'] = $this->eleicoes;
        $dados["titulo"] = "Histórico de votos";

        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view("backend/help_pages/historico_votos");


        $this->load->view("backend/template/footer_end");
    }

    public function mostrar_resultados($eleicao_info, $nome_eleicao = null){
        
        $dados['eleicoes'] = $this->eleicoes;
        $dados["titulo"] = "Resultado da busca por " . $nome_eleicao;
        $dados['eleicao_info'] = $eleicao_info;

        $this->load->view("resultados/thead", $dados);
		$this->load->view("backend/template/sidebar");
		$this->load->view("backend/template/topbar");

		$this->load->view("backend/help_pages/mostrar_resultado");
		$this->load->view("backend/template/footer");
		$this->load->view("resultados/footer_end_table");
    }

    private function get_info_election_bc($code){
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

        return $result;
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

    private function get_familyCode(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "8084",
            CURLOPT_URL => "http://localhost:8084/familyCode/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
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

        return $result['familyName'];
    }

    public function getting_pub_key(){
        $chave_privada = $this->input->post("chavePrivada");

        //verificar se tem espaços

        if( $chave_privada !== str_replace(' ','',$chave_privada) ){
            $res = "erro";
            redirect(base_url("ajuda/") . "gerar_chave_publica/" . urlencode(base64_encode($res)));
        }

        //se tiver mais que 200 caracteres retornar
        if(strlen($chave_privada) > 200 || strlen($chave_privada) < 50){
            $res = "erro";
            redirect(base_url("ajuda/") . "gerar_chave_publica/" . urlencode(base64_encode($res)));
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_PORT => "8084",
        CURLOPT_URL => "http://localhost:8084/get-public-key/" . $chave_privada,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: d9460869-a9ae-7f90-4f24-90e2906bca2e"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if($err){
            echo "cURL Error #:" . $err;
        }
        
        $response = json_decode($response, true);

        if(isset($response['publicKey'])){
            $res = $response['publicKey'];
        }
        else{
            $res = "erro";
        }

        $this->gerar_chave_publica($response);
        redirect(base_url("ajuda/") . "gerar_chave_publica/" . urlencode(base64_encode($res)));
        
    }


    public function como_votar(){
        $dados['eleicoes'] = $this->eleicoes;

        $dados["titulo"] = "Como Votar";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view("backend/help_pages/como_votar");
        $this->load->view("backend/template/footer_end");
    }

    public function como_funciona(){
        $dados['eleicoes'] = $this->eleicoes;

        $dados["titulo"] = "Como funciona";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view("backend/help_pages/como_funciona");
        $this->load->view("backend/template/footer_end");
    }

    public function seguranca(){
        $dados['eleicoes'] = $this->eleicoes;

        $dados["titulo"] = "Segurança";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view("backend/help_pages/seguranca");
        
        $this->load->view("backend/template/footer_end");
    }

    public function fale_conosco(){
        $dados['eleicoes'] = $this->eleicoes;

        $dados["titulo"] = "Fale Conosco";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view("backend/help_pages/fale_conosco");
        $this->load->view("backend/template/footer_end");
    }
}
