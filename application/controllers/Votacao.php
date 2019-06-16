<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Votacao extends CI_Controller {
        
    public function __construct(){
        parent::__construct();  
        
        if(!$this->session->userdata('logado')){
            redirect(base_url());
        }

        $this->load->model('eleicao_model');
        $this->load->helper(array('func', 'form'));
        //$this->load->library('form');
        $this->eleicoes = $this->eleicao_model->retorna_todas_eleicoes();

        date_default_timezone_set('America/Sao_Paulo');
    }

	public function index(){
        $dados['eleicoes'] = $this->eleicoes;

		$dados["titulo"] = "Página não encontrada!";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");
        
		$this->load->view('backend/template/404');
		
		$this->load->view('backend/template/footer');
		$this->load->view("backend/template/footer_end");
    }
    
    public function votar($id = null, $eleicao = null){
        //carregar o model das eleições
        if($id == null){
            echo "Não acesse essa pagina diretamente!";
            die();
        }

        $this->load->model(array("eleicao_model", "chapa_model"));
        //$res = $this->eleicoes->retorna_eleicoes_ativas();
        $dados['chapas'] = $this->chapa_model->retorna_chapas_aprovadas($id);
        

        //Procurar as informações da eleição
        foreach ($this->eleicoes as $e) {
            if($e->id_eleicao == $id){
                $dados['eleicao'] = $e;
                $dados["titulo"] = $e->nome;
                $dados['nome_eleicao'] = $e->nome;

                break;
                //var_dump($dados);
                //die();
            }
        }

        $dados['id_eleicao'] = $id;
        $dados['dia_de_hoje'] = date("Y-m-d H:i:s");
        

        
        $dados['eleicoes'] = $this->eleicoes;
        
        $dados['admin'] = true;
        $this->load->view("backend/template/head", $dados);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");

        $this->load->view('eleicao/apresenta_eleicao');

        $this->load->view('backend/template/footer');
		$this->load->view("backend/template/footer_end");
    }

    public function realizar_votar(){
        $chave = $this->input->post("chavePrivada");
        //$election_name = $this->input->post("id_eleicao");
        $id_eleicao = $this->input->post("id_eleicao");
        $nome_eleicao = $this->input->post("nome_eleicao");

        $id_chapa = $this->input->post("id_chapa");
        //$id_eleicao = "novo";


        foreach ($this->eleicoes as $eleicao) {
            if($eleicao->id_eleicao == $id_eleicao){
                $eleicao = $eleicao;
                break;
            }
        }


        $data_inicio = date("Y-m-d H:i:s", strtotime($eleicao->inicio_eleicao));
        $data_final = date("Y-m-d H:i:s", strtotime($eleicao->fim_eleicao));
        $data_atual = date("Y-m-d H:i:s");

        if(!($data_atual >= $data_inicio && $data_atual <= $data_final)){
            echo "Você não tem mais tempo para votar!";
            die();
        }

        $chavePublica = $this->get_public_key($chave);
        

        if($chavePublica){
            //verificar se a chave publica ja votou, se sim, retornar um erro
            $votes = $this->get_all_votes_from_election($eleicao->nome);
            
            //var_dump($votes);

            foreach ($votes as $vote) {
                if($vote["publicKey"] == $chavePublica){
                    //exibir mensagem de erro
                    //$this->votar();
                    echo "Chave ja utilizada";
                    die();
                }
            }

            echo "Pode votar!";

            $aux_str = rand(); 
            $address = md5($aux_str); 

            $payload = array();
            $payload["userNumber"] = $chave;
            $payload["ellectionName"] = $eleicao->nome;
            $payload["address"] = $address;
            $payload["candidateNumber"] = $id_chapa;
            $payload['date'] = date("Y-m-d H:i:s");

            $this->register_vote_blockchain($payload);

            echo "OK";
        }
        else{ //chave privada inválida
            echo "erro";
        }
        
        
    }

    private function register_vote_blockchain($payload){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_PORT => "8084",
        CURLOPT_URL => "http://localhost:8084/register/vote",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{  \n   \"userNumber\":\"{$payload['userNumber']}\",\n   \"ellectionName\":\"{$payload['ellectionName']}\",\n   \"address\":\"{$payload['address']}\",\n   \"candidateNumber\":\"{$payload['candidateNumber']}\",\n   \"date\":\"{$payload['date']}\"\n}",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 5bc6f563-a1f6-0f76-e7f4-f1c09a085c48"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
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
            CURLOPT_POSTFIELDS => "{\n    \"electionName\": \"nome da eleição\"\n}",
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

    private function get_public_key($privateKey){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'http://localhost:8084/get-public-key/' . $privateKey);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Accept: */*';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Host: localhost:8084';
        $headers[] = 'Postman-Token: 232c9d97-6b63-4e09-a408-f985db5ef830,ec949543-761c-4169-9c4e-e962e158c9ac';
        $headers[] = 'User-Agent: PostmanRuntime/7.11.0';
        $headers[] = 'Accept-Encoding: gzip, deflate';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);

        
        $aux = json_decode($result, true);

        if(isset($aux['code'])){
            return false;
        }

        return $aux['publicKey'];
    }

}
