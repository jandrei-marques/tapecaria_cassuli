<?php

class Mostruario extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('mostruario_model','usuario_model'));
        date_default_timezone_set('America/Sao_paulo');
    }
    
    public function index(){
        $data['op'] = 'salvar';
        $data['mostruarios'] = $this->mostruario_model->buscarTodos();
        $this->load->view('mostruario/crud',$data);
    }
    
    public function salvar(){
        $mostruario = array(
            'descricao' => strip_tags($this->input->post('descricao')),
            'vlr_unit'=> strip_tags($this->input->post('vlr_unit')),
            'un_medida'=> strip_tags($this->input->post('un_medida')),
            'referencia'=>  strip_tags($this->input->post('referencia')),
            'tipo_material' => strip_tags($this->input->post('tipo_material')),
            'observacao' => strip_tags($this->input->post('observacao')),
            'created_at' => date("Y-m-d H:i:s")
        );
        $this->mostruario_model->salvar($mostruario);
        $this->session->set_userdata('successmsg','Mostruário cadastrado com sucesso!');
        redirect('/mostruario');
    }
    
    public function editar(){
        $id = $this->uri->segment(3);
        $data['mostruario'] = $this->mostruario_model->buscarId($id);
        $data['mostruarios'] = $this->mostruario_model->buscarTodos();
        $data['op'] = 'atualizar';
        $this->load->view('mostruario/crud',$data);
    }
    
    public function atualizar(){
        $id = $this->input->post('id');
        $mostruario = array(
            'descricao' => strip_tags($this->input->post('descricao')),
            'vlr_unit'=> strip_tags($this->input->post('vlr_unit')),
            'un_medida'=> strip_tags($this->input->post('un_medida')),
            'referencia'=>  strip_tags($this->input->post('referencia')),
            'tipo_material' => strip_tags($this->input->post('tipo_material')),
            'observacao' => strip_tags($this->input->post('observacao')),
            'updated_at' => date("Y-m-d H:i:s")
        );
        $this->mostruario_model->atualizar($id,$mostruario);
        $this->session->set_userdata('successmsg','Mostruário atualizado com sucesso!');
        redirect('/mostruario');
    }
    
    public function excluir(){
        $id = $this->uri->segment(3);
        
    }
}
