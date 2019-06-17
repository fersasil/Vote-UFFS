<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eleicao_model extends CI_Model{

    public function cadastrar_eleicao($nome_eleicao, $descricao_eleicao, $inicio_eleicao, $fim_eleicao, $numero_max_chapas, $tipo_votacao){
        //preparar variaveis
        $dados['nome'] = $nome_eleicao;
        $dados['descricao'] = $descricao_eleicao;
        $dados['inicio_eleicao'] = $inicio_eleicao;
        $dados['fim_eleicao'] = $fim_eleicao;
        $dados['numero_maximo_chapas'] = $numero_max_chapas;
        $dados['tipo_votacao'] = $tipo_votacao;
        $dados['img'] = FALSE;

        return $this->db->insert("eleicao", $dados);
    }

    public function info_uma_eleicao($id){
        //preparar variaveis
        //$this->db->order_by('nome', 'ASC');
        $this->db->where('id_eleicao', $id);
        return $this->db->get("eleicao")->result();
    }

    public function retorna_todas_eleicoes(){
        //preparar variaveis
        $this->db->select('*');
        $this->db->order_by('nome', 'ASC');
        return $this->db->get("eleicao")->result();
    }

    public function buscar_chave_publica($chavePublica){
        $this->db->select("chave_publica");
        $this->db->where("chave_publica", $chavePublica);
        $this->db->from("chaves_publicas");
        return $this->db->get()->result();
    }

    public function salvar_chave_publica($chavePublica, $data_criacao){
        $dados['chave_publica'] = $chavePublica;
        $dados['data_criacao'] = $data_criacao;
        return $this->db->insert("chaves_publicas", $dados);
    }

}