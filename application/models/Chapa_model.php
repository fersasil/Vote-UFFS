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

    
    public function retorna_chapa_por_id($id){
        //preparar variaveis
        //$this->db->order_by('nome', 'ASC');
        $this->db->where('id_chapa', $id);
        return $this->db->get("chapa")->result()[0];
    }

    
    public function retorna_chapas_aprovadas($id){
        //preparar variaveis
        $this->db->select('nome_chapa, img, descricao, id_chapa');
        $this->db->order_by('nome_chapa', 'ASC');
        $this->db->where('eleicao_id', $id);
        $this->db->where('aprovada', 1);

        return $this->db->get("chapa")->result();
    }

    public function retorna_todas_chapas($id){
        //preparar variaveis
        $this->db->select('nome_chapa, img, descricao, id_chapa, aprovada');
        $this->db->order_by('nome_chapa', 'ASC');
        $this->db->where('eleicao_id', $id);

        return $this->db->get("chapa")->result();
    }

}