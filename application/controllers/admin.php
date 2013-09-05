<?php

class Admin extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array("usuario_model",'current_user'));
        date_default_timezone_set('America/Sao_paulo');
        if(!$this->current_user->isAdmin()){
            redirect('/login');
        }
    }
    
    public function index(){
        $this->load->view('home_admin');
    }
    
}