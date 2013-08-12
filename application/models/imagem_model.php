<?php

class Imagem_model extends CI_Model {

    private $table = 'imagem';

    public function __construct() {
        parent::__construct();
    }

    public function salvar($imagem) {
        $this->db->insert($this->table, $imagem);
    }

    public function atualizar($id, $imagem) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $imagem);
    }

    public function apagar($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function buscarTodos() {
        $this->db->order_by("nome", "asc");
        return $this->db->get($this->table)->result();
    }

    public function buscarId($id) {
        $this->db->where("id", $id);
        return $this->db->limit(1)->get($this->table)->row();
    }

}

