<?php

class Mostruario extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->view(array('mostruario_model','usuario_model'));
    }
    
    public function index(){
        $data['op'] = 'salvar';
        $data['mostruarios'] = $this->mostruario_model->buscarTodos();
        $this->load->view('mostruario/crud',$data);
    }
}
