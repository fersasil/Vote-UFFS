<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chapa_model extends CI_Model{

    public function cria_nova_chapa($chapa_info, $presidente_id, $presidente_descricao, $vice_id, $vice_descricao, $tesoureiro_id, $tesoureiro_descricao, $secretario_id, $secretario_descricao, $suplente){
        $config['presidente'] = $presidente_id;
        $config['vice_presidente'] = $vice_id;
        $config['tesoureiro'] = $tesoureiro_id;
        $config['secretario'] = $secretario_id;

        $config['descricao_presidente'] = $presidente_descricao;
        $config['descricao_vice_presidente'] = $vice_descricao;
        $config['descricao_tesoureiro'] = $tesoureiro_descricao;
        $config['descricao_secretario'] = $secretario_descricao;

        $config['nome_chapa'] = $chapa_info['nome_chapa'];
        $config['descricao'] = $chapa_info['descricao_chapa'];
        $config['img'] = $chapa_info['img_chapa'];
        $config['aprovada'] = false;
        $config['numero_suplentes'] = $chapa_info['numero_suplentes'];
        $config['eleicao_id'] = $chapa_info['eleicao_id'];

        //laço para os suplentes
        
        if($suplente != null){
            for($i = 1; $i <= $chapa_info['numero_suplentes']; $i++){
                $config['suplente' . $i] = $suplente['suplente_' . $i .' _id'];
                $config['descricao_suplente' . $i] = $suplente['suplente_' . $i .' _descricao'];
            }
        }

        //var_dump($config);

        //die();

        return $this->db->insert("chapa", $config);
    }

    public function cria_chapa($chapa_info){

        $config['nome_chapa'] = $chapa_info['nome_chapa'];
        $config['descricao_chapa'] = $chapa_info['descricao_chapa'];
        $config['img_chapa'] = $chapa_info['img_chapa'];
        $config['chapa_aprovada'] = false;
        $config['numero_suplentes'] = $chapa_info['numero_suplentes'];
        $config['eleicao_id'] = $chapa_info['eleicao_id'];

        return $this->db->insert("chapa", $config);
    }

    
    public function retorna_chapa_por_id($id){
        //preparar variaveis
        //$this->db->order_by('nome', 'ASC');
        $this->db->where('id_chapa', $id);
        return $this->db->get("chapa")->result()[0];
    }

    
    public function retorna_chapa_info($eleicao_id){

        $q = $this->db->query("SELECT id_chapa, nome_chapa, descricao_chapa, img_chapa, chapa_aprovada FROM chapa WHERE eleicao_id = {$eleicao_id}")->result();
        /*$this->db->select("*");
        $this->db->from("chapa AS c");
        $this->db->JOIN("chapa_membro AS c_m", "c.id_chapa = c_m.idChapa");
        $this->db->JOIN("usuario AS u", "c_m.idMembro = u.id_usuario");
        $this->db->where("idChapa", $id_chapa);
        */

        return $q; 
    }

    public function retorna_membros_chapa($id_chapa){

        $q = $this->db->query("SELECT * FROM chapa AS c JOIN chapa_membro AS c_m ON c.id_chapa = c_m.idChapa JOIN usuario AS u ON c_m.idMembro = u.id_usuario")->result();
        /*$this->db->select("*");
        $this->db->from("chapa AS c");
        $this->db->JOIN("chapa_membro AS c_m", "c.id_chapa = c_m.idChapa");
        $this->db->JOIN("usuario AS u", "c_m.idMembro = u.id_usuario");
        $this->db->where("idChapa", $id_chapa);
        */

        return $q; 
    }

   

    public function retorna_chapas_aprovadas($id_eleicao){

        // return $this->db->query("SELECT * FROM chapa AS c JOIN chapa_membro AS c_m ON c.id_chapa = c_m.idChapa JOIN usuario AS u ON c_m.idMembro = u.id_usuario")->result();
        $this->db->select("nome_chapa, descricao_chapa, id_chapa");
        $this->db->from("chapa");
        $this->db->where("eleicao_id", $id_eleicao);
        $this->db->where("chapa_aprovada", "1");
        return $this->db->get()->result();
    }

    public function retorna_id_users_cadastrados_eleicao($id_eleicao){
        return $this->db->query("SELECT idMembro FROM chapa AS c JOIN chapa_membro AS c_m ON c.id_chapa = c_m.idChapa JOIN usuario AS u ON c_m.idMembro = u.id_usuario WHERE eleicao_id = " . $id_eleicao)->result();
    }

    public function retorna_nome_chapas_eleicao_fim($id_eleicao){

        // return $this->db->query("SELECT * FROM chapa AS c JOIN chapa_membro AS c_m ON c.id_chapa = c_m.idChapa JOIN usuario AS u ON c_m.idMembro = u.id_usuario")->result();
        $this->db->select("nome_chapa, id_chapa");
        $this->db->from("chapa");
        $this->db->where("eleicao_id", $id_eleicao);
        $this->db->where("chapa_aprovada", "1");
        return $this->db->get()->result();
    }

    

    public function retorna_todas_chapas($id){
        //preparar variaveis
        $this->db->select('nome_chapa, img, descricao, id_chapa, aprovada');
        $this->db->order_by('nome_chapa', 'ASC');
        $this->db->where('eleicao_id', $id);

        return $this->db->get("chapa")->result();
    }

    public function cadastrar_membro($idMembro, $descricaoMembro, $idChapa, $cargo){
        $dados['idMembro'] = $idMembro;
        $dados['descricaoMembro'] = $descricaoMembro;
        $dados['idChapa'] = $idChapa;
        $dados['cargo'] = $cargo;

        return $this->db->insert("chapa_membro", $dados);
    }

    public function procura_id_por_nome($nome_chapa){
        $this->db->select("id_chapa");
        $this->db->from("chapa");
        $this->db->where("nome_chapa", $nome_chapa);
        return $this->db->get()->result();
    }

    public function aprovar_chapa($id_chapa){
        $this->db->set("chapa_aprovada", "1");
        $this->db->where("id_chapa", $id_chapa);
        return $this->db->update("chapa");
    }

    public function excluir_chapa($id){
        $this->db->where('id_chapa', $id);
        return $this->db->delete('chapa');
    }

}