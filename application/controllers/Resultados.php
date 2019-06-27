<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resultados extends CI_Controller {
	public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logado')){
            redirect(base_url());
        }

		$this->load->model(array('eleicao_model', 'chapa_model'));
        $this->load->helper('func');
		$this->eleicoes = $this->eleicao_model->retorna_todas_eleicoes();
		
	}

	public function index(){
		$dados['eleicoes'] = $this->eleicoes;
		//Adicionar um capo ativo a tabela de eleições no banco
		$dados['titulo'] = "Resultado das Eleições";

		$this->load->view("backend/template/head", $dados);
		$this->load->view("backend/template/sidebar");
		$this->load->view("backend/template/topbar");
		
		$this->load->view("resultados/resultado");

		$this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");

	}

	//Vai receber a votação ou o id da votação
	public function eleicao($id, $nome_eleicao){
		//$nome_eleicao = "DCE";
		$dados['titulo'] = $nome_eleicao;
		
		//$nome_eleicao = $this->input->post("nomeEleicao");

		foreach ($this->eleicoes as $e) {
			if($e->id_eleicao == $id){
				break;
			}
		}
        
        $address = $this->get_address_ellection($e->nome);
		$votos = json_decode($this->get_info_election_bc($address), true);

		$chapas = $this->chapa_model->retorna_nome_chapas_eleicao_fim($id);


		foreach ($chapas as $c) {
			$count = 0;
			for ($i = 0; $i < sizeof($votos); $i++) {
				if($c->id_chapa == $votos[$i]['candidateNumber']){
					$votos[$i]['candidateName'] = $c->nome_chapa;
					$count++;	
				}
			}

			$chapa_votos[] = array("nomeChapa" => $c->nome_chapa, "votos" => $count);
		}
		
		$dados['votos'] = $votos;
		$dados['eleicao'] = $e;
        $dados['eleicoes'] = $this->eleicoes;
        
        if(isset($chapa_votos)){
            $dados['resultado_json'] = json_encode($chapa_votos);
        }
        else{
            $dados['resultado_json'] = false;
        }
		
		
		$this->load->view("resultados/thead", $dados);
		$this->load->view("backend/template/sidebar");
		$this->load->view("backend/template/topbar");

		$this->load->view("resultados/blank");

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
	
}
