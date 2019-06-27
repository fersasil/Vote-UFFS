<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eleicao_model extends CI_Model{

    public function cadastrar_eleicao($nome_eleicao, $descricao_eleicao, $inicio_eleicao, $fim_eleicao, $numero_max_chapas, $tipo_votacao, $img){
        //preparar variaveis
        $dados['nome'] = $nome_eleicao;
        $dados['descricao'] = $descricao_eleicao;
        $dados['inicio_eleicao'] = $inicio_eleicao;
        $dados['fim_eleicao'] = $fim_eleicao;
        $dados['numero_maximo_chapas'] = $numero_max_chapas;
        $dados['tipo_votacao'] = $tipo_votacao;
        $dados['eleicao_ja_iniciada'] = false;
        $dados['img'] = $img;

        return $this->db->insert("eleicao", $dados);
    }

    public function info_uma_eleicao($id){
        //preparar variaveis
        //$this->db->order_by('nome', 'ASC');
        $this->db->where('id_eleicao', $id);
        return $this->db->get("eleicao")->result();
    }

    public function ativar_eleicao($id_eleicao){
        //$dados['eleicao_ativa'] = "1";
        $this->db->set("eleicao_ativa", "1");
        $this->db->set("eleicao_ja_iniciada", "1");
        $this->db->where("id_eleicao", $id_eleicao);
        return $this->db->update("eleicao");
    }

    public function encerrar_eleicao($id_eleicao){
        //$dados['eleicao_ativa'] = "1";
        $this->db->set("eleicao_ativa", "0");
        $this->db->where("id_eleicao", $id_eleicao);
        return $this->db->update("eleicao");
    }

    public function atualizar_vencedor($id_eleicao, $id_vencedor, $total_votos, $vencedor_votos){
        //$dados['eleicao_ativa'] = "1";
        $this->db->set("id_vencedor", $id_vencedor);
        $this->db->set("total_votos", $total_votos);
        $this->db->set("vencedor_votos", $vencedor_votos);
        $this->db->where("id_eleicao", $id_eleicao);
        
        return $this->db->update("eleicao");
    }
    
    public function retorna_todas_eleicoes(){
        //preparar variaveis
        $this->db->select('*');
        $this->db->order_by('nome', 'ASC');
        return $this->db->get("eleicao")->result();
    }

    public function retorna_todas_eleicoes_encerradas(){
        //preparar variaveis
        $this->db->select('*');
        $this->db->order_by('nome', 'ASC');
        $this->db->where('eleicao_ativa', '0');
        
        return $this->db->get("eleicao")->result();
    }

    public function retorna_todas_eleicoes_ativas(){
        //preparar variaveis
        $this->db->select('*');
        $this->db->order_by('nome', 'ASC');
        $this->db->where('eleicao_ativa <>', '0');
        
        $res =  $this->db->get("eleicao")->result();
        //die();
        return $res;
    }

    public function eleicoes_ativas_e_nao_iniciadas(){
        //preparar variaveis
        $this->db->select('*');
        $this->db->order_by('nome', 'ASC');
        $this->db->where('eleicao_ativa <>', '0');
        $this->db->where('eleicao_ja_iniciada', '0');

        
        $res =  $this->db->get("eleicao")->result();
        //die();
        return $res;
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