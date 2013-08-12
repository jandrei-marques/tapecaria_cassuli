<?php

class Produto_model extends CI_Model {

    private $table = 'produto';

    public function __construct() {
        parent::__construct();
    }

    public function salvar($produto) {
        $this->db->insert($this->table, $produto);
    }

    public function atualizar($id, $produto) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $produto);
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

    public function buscarPorNome($nome) {
        $produtos = $this->db->query("SELECT * FROM $this->table WHERE nome LIKE ?", array("%$nome%"));
        return $produtos->result();
    }

}

