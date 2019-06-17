<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
    public function __construct(){
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('usuario_model', 'umodel');
        date_default_timezone_set('America/Sao_Paulo');
    }

	public function index(){
        if($this->session->userdata('logado')){
            redirect(base_url('home'));
        }
        
        $dados['titulo'] = "Entrar";

        $this->load->view("backend/template/head", $dados);
        $this->load->view("login/login");
        $this->load->view("backend/template/footer_end");
    }

    public function login(){
        if($this->session->userdata('logado')){
            redirect(base_url('home'));
        }

        $dados['titulo'] = "Entrar";

        $this->load->view("backend/template/head", $dados);
        $this->load->view("login/login");
        $this->load->view("backend/template/footer_end");
    }

    public function cadastrar(){
        if($this->session->userdata('logado')){
            redirect(base_url('home'));

            //TODO se for super usuário direcionar para a página de super user 
        }

        $dados['titulo'] = "Cadastrar";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("login/cadastrar");
        $this->load->view("backend/template/footer_end");
    }

    public function esqueceu_senha(){
        if($this->session->userdata('logado')){
            redirect(base_url('home'));
        }

        $dados['titulo'] = "Esqueceu a senha?";
        $this->load->view("backend/template/head", $dados);
        $this->load->view("login/esqueceu_senha");
        $this->load->view("backend/template/footer_end");
    }

    public function bem_vindo($conf = null){
        if($conf['verificador'] != md5("VERIFICADOR")){
            echo "Você não tem autorização para acessar essa página";
            die();
        }

        $this->load->model('eleicao_model');
        $this->load->helper('func');

        $conf['titulo'] = "Seja bem vindo!";
        $conf['eleicoes'] = $this->eleicao_model->retorna_todas_eleicoes();

        $this->load->view("backend/template/head", $conf);
        $this->load->view("backend/template/sidebar");
        $this->load->view("backend/template/topbar");
        //Middle
        
        $this->load->view("backend/boas_vindas");
        
        //Footer
        $this->load->view("backend/template/footer");
        $this->load->view("backend/template/footer_end");
        
    }


    public function realizar_login(){
        //Fazer as verificações
        $this->form_validation->set_rules('usuario', 'usuario', 'required');
        $this->form_validation->set_rules('senha', 'senha', 'required');

        if($this->form_validation->run()){
            //Pegar as variáveis e verificar se o email e a senha esta correta
            //verificar se é email ou número de matricula, se for só número considerar
            //numero de matricula
            $usuario = $this->input->post('usuario');
            $senha = $this->input->post('senha');
            //encriptar a senha com md5
            $senha = md5($senha);

            if(is_numeric($usuario)){ //login com matricula
                $dados = $this->umodel->verifica_usuario_matricula($usuario, $senha);
                if(count($dados)){ //usuario e senha corretos, mandar mensagem!
                    //iniciar uma sessão
                    echo "LOGADO";
                    $session_data['user_logado'] = $dados[0]; //é um array, mas só tem um valor
                    $session_data['logado'] = TRUE;

                    //salvar na sessão
                    $this->session->set_userdata($session_data);
                    //Verificar se o usuário é superusuário ou não
                    if($dados[0]->super_usuario){
                        redirect(base_url('admin'));
                    }
                    else{ //usuário normal
                        redirect(base_url('home'));
                    }

                }
                else{//senha ou usuário errado, mandar mensagem dizendo isso
                    echo "USUARIO E SENHA ERRADOS";
                    $session_data['user_logado'] = NULL;
                    $session_data['logado'] = FALSE;
                    $this->session->set_userdata($session_data);
                    redirect(base_url('usuario')); //voltar a tela
                }
            }
            else{ //login com email
                $dados = $this->umodel->verifica_usuario_email($usuario, $senha);
                if(count($dados)){ //usuario e senha corretos, mandar mensagem!
                    //iniciar uma sessão
                    echo "LOGADO";
                    $session_data['user_logado'] = $dados[0]; //é um array, mas só tem um valor
                    $session_data['logado'] = TRUE;

                    //salvar na sessão
                    $this->session->set_userdata($session_data);
                    //Verificar se o usuário é superusuário ou não
                    //caso for mandar para a tela de adminsitração, se não para a tela normal
                    //Mandar para a home do admin
                    //var_dump($session_data['user_logado']);
                    
                    redirect(base_url('home'));

                }
                else{//senha ou usuário errado, mandar mensagem dizendo isso
                    echo "USUARIO E SENHA ERRADOS";
                    $session_data['user_logado'] = NULL;
                    $session_data['logado'] = FALSE;
                    $this->session->set_userdata($session_data);
                    redirect(base_url('usuario')); //voltar a tela
                }
            }
        }
        else{
            $this->index();
        }


    }

    public function logout(){
        //Destruir a sessão e mandar para a pagina inicial
        $dadosSessao['user_logado'] = NULL;
        $dadosSessao['logado'] = FALSE;
        $this->session->set_userdata($dadosSessao);
        redirect(base_url());
    }

    public function nova_conta(){
        $this->load->model("eleicao_model");

        //validar os campos para ver se estão corretos
        $this->form_validation->set_rules('nome', 'nome', 'required');
        $this->form_validation->set_rules('sobrenome', 'sobrenome', 'required');
        
        $this->form_validation->set_rules('email', 'email', 'required|is_unique[usuario.email]');
        $this->form_validation->set_rules('matricula', 'matricula', 'required|is_unique[usuario.matricula]|min_length[10]');
        
        //TODO fazer validação de cpf aqui
        $this->form_validation->set_rules('cpf', 'cpf', 'required|min_length[11]|is_unique[usuario.cpf]');

        
        $this->form_validation->set_rules('senha', 'senha', 'required|min_length[3]');
        $this->form_validation->set_rules('senha2', 'você digitou a senha incorreta', 'required|matches[senha]');

        if($this->form_validation->run()){
            //Pegar variaveis com post
            $nome = $this->input->post('nome');
            $sobrenome = $this->input->post('sobrenome');
            $matricula = $this->input->post('matricula');
            $email = $this->input->post('email');
            
            $cpf = $this->input->post('cpf');
            // $cpf = str_replace("-", "", $cpf);

            $senha = md5($this->input->post('senha')); //encriptar

            

            //Mandar para o model que escreve no banco
            $this->umodel->cria_usuario($nome, $sobrenome, $matricula, $cpf, $senha, $email);

            $aux['nome'] = $nome;
            $aux['sobrenome'] = $sobrenome;
            $aux['matricula'] = $matricula;
            $aux['super_usuario'] = FALSE;
            $aux['img'] = FALSE;

            //Logar o usuário e manda-lo para a pagina;
            $session_data['user_logado'] = (object)($aux);
            $session_data['logado'] = TRUE;

            //salvar na sessão
            $this->session->set_userdata($session_data);
            //ir para a home
            //Criar uma chave privada e salvar a chave publica dele no banco!

            $private_key = $this->create_private_key($cpf, $matricula);
            $private_key = json_decode($private_key);

        
            $public_key = $this->create_pub_key($private_key->privateKey);
            $data_criacao = date("Y-m-d H:i:s");

            //salvar a chave publica no banco
            $this->eleicao_model->salvar_chave_publica($public_key, $data_criacao);
            //redirect(base_url('home/bem-vind'));
            //ir para a tela de boas vindas
            $conf['privateKey'] = $private_key->privateKey;
            $conf['verificador'] = md5("VERIFICADOR");
            $conf['nome'] = $nome;
            $conf['sobrenome'] = $sobrenome;

            $this->bem_vindo($conf);
        }
        else{ //Volta e exibe os erros
            $this->cadastrar();
        }

    }

    private function create_private_key($cpf, $matricula){
        $VERIFICADOR = "uffs_2019";

        $cript = hash('sha512', $cpf . $matricula . $VERIFICADOR);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_PORT => "8084",
        CURLOPT_URL => "http://localhost:8084/generate-private-key/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n\t\"cript\" : \"{$cript}\",\n\t\"cpf\": \"{$cpf}\",\n\t\"matricula\": \"{$matricula}\"\n}",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 25f4170e-3a62-6dd7-7ee1-2d8f95698185"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } 
        
        return $response;
    }

    private function create_pub_key($privateKey){
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
