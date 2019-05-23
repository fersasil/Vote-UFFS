<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
    public function __construct(){
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('usuario_model', 'umodel');
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
        //validar os campos para ver se estão corretos
        $this->form_validation->set_rules('nome', 'nome', 'required');
        $this->form_validation->set_rules('sobrenome', 'sobrenome', 'required');
        
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('matricula', 'matricula', 'required');
        
        $this->form_validation->set_rules('cpf', 'cpf', 'required');
        
        $this->form_validation->set_rules('senha', 'senha', 'required');
        $this->form_validation->set_rules('senha2', 'você digitou a senha incorreta', 'required');


        if($this->form_validation->run()){
            //Pegar variaveis com post
            $nome = $this->input->post('nome');
            $sobrenome = $this->input->post('sobrenome');
            $matricula = $this->input->post('matricula');
            $email = $this->input->post('email');
            $cpf = $this->input->post('cpf');
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
            redirect(base_url('home'));
        }
        else{ //Volta e exibe os erros
            $this->cadastrar();
        }

    }
}
