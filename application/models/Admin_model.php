<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

    public function cadastrar_eleicao($nome_eleicao, $descricao_eleicao, $duracao_eleicao, $dia_eleicao, $numero_max_chapas, $tipo_votacao){
        //preparar variaveis
        $dados['nome'] = $nome_eleicao;
        $dados['descricao'] = $descricao_eleicao;
        $dados['duracao_eleicao'] = $duracao_eleicao;
        $dados['dia_eleicao'] = $dia_eleicao;
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
        $this->db->order_by('nome', 'ASC');
        return $this->db->get("eleicao")->result();
    }

}