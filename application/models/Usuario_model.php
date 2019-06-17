<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model{

    public function verifica_usuario_email($email, $senha){
        //Preparar banco
        $this->db->where('email', $email);
        $this->db->where("senha", $senha);
        $this->db->select('nome, super_usuario, img_usuario');
        return $this->db->get("usuario")->result();
    }

    public function verifica_usuario_matricula($matricula, $senha){
        //Preparar banco
        $this->db->where('matricula', $matricula);
        $this->db->where("senha", $senha);
        $this->db->select('nome, super_usuario, img_usuario');
        return $this->db->get("usuario")->result();
    }

    public function cria_usuario($nome, $sobrenome, $matricula, $cpf, $senha, $email){
        //preparar variaveis
        $dados['nome'] = $nome;
        $dados['sobrenome'] = $sobrenome;
        $dados['matricula'] = $matricula;
        $dados['cpf'] = $cpf;
        $dados['senha'] = $senha;
        $dados['email'] = $email;
        $dados['super_usuario'] = false;

        $this->db->insert("usuario", $dados);
    }

    public function matricula_para_id($matricula){
        //Preparar banco
        $this->db->select('id_usuario');
        $this->db->where('matricula', $matricula);
        return $this->db->get("usuario")->result();
    }

    

}