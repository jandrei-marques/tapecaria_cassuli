<?php

class Home extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Sao_paulo');
        $this->load->model(array('usuario_model','current_user','produto_model'));
    }
    
    public function index(){
        $this->load->view('home');
    }

}
