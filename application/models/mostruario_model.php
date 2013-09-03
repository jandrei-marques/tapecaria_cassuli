<?php

class Mostruario_model extends CI_Model {

    private $table = 'mostruario';

    public function __construct() {
        parent::__construct();
    }

    public function salvar($mostruario) {
        $this->db->insert($this->table, $mostruario);
    }

    public function atualizar($id, $mostruario) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $mostruario);
    }

    public function apagar($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function buscarTodos() {
        $this->db->order_by("descricao", "asc");
        return $this->db->get($this->table)->result();
    }

    public function buscarId($id) {
        $this->db->where("id", $id);
        return $this->db->limit(1)->get($this->table)->row();
    }

//    public function buscarPorNome($nome) {
//        $mostruarios = $this->db->query("SELECT * FROM $this->table WHERE nome LIKE ?", array("%$nome%"));
//        return $mostruarios->result();
//    }

}

