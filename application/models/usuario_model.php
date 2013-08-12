<?php

class Usuario_model extends CI_Model {

    private $table = 'usuario';

    public function __construct() {
        parent::__construct();
    }

    public function salvar($usuario) {
        $this->db->insert($this->table, $usuario);
    }

    public function atualizar($id, $usuario) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $usuario);
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
        $usuarios = $this->db->query("SELECT * FROM $this->table WHERE nome LIKE ?", array("%$nome%"));
        return $usuarios->result();
    }

}

