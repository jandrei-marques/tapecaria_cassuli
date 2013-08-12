<?php

class Comentario_model extends CI_Model {

    private $table = 'comentario';

    public function __construct() {
        parent::__construct();
    }

    public function salvar($comentario) {
        $this->db->insert($this->table, $comentario);
    }

    public function atualizar($id, $comentario) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $comentario);
    }

    public function apagar($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function buscarTodos() {
//        $this->db->order_by("nome", "asc");
        return $this->db->get($this->table)->result();
    }

    public function buscarId($id) {
        $this->db->where("id", $id);
        return $this->db->limit(1)->get($this->table)->row();
    }

}

