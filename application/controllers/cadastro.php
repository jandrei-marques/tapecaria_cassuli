<?php

class Cadastro extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('usuario_model'));
        date_default_timezone_set("America/Sao_paulo");
    }
    
    
    public function index(){
        $this->load->view("externo/cadastro");
    }
}
