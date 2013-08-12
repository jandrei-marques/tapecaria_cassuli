<?php

class Fornecedor_model extends CI_Model {

    private $table = 'fornecedor';

    public function __construct() {
        parent::__construct();
    }

    public function salvar($fornecedor) {
        $this->db->insert($this->table, $fornecedor);
    }

    public function atualizar($id, $fornecedor) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $fornecedor);
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
        $fornecedores = $this->db->query("SELECT * FROM $this->table WHERE nome LIKE ?", array("%$nome%"));
        return $fornecedores->result();
    }

}

