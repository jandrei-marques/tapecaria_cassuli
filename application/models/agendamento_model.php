<?php

class Agendamento_model extends CI_Model {

    private $table = 'agendamento';

    public function __construct() {
        parent::__construct();
    }

    public function salvar($agendamento) {
        $this->db->insert($this->table, $agendamento);
    }

    public function atualizar($id, $agendamento) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $agendamento);
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

