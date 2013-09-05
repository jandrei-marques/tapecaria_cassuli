<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('usuario_model', 'current_user'));
        date_default_timezone_set('America/Sao_paulo');
    }

    public function index() {
        $logado = $this->current_user->user();
        if (!$logado) {
            $this->load->view('login');
        } else {
            $adm = $this->current_user->isAdmin();
            if (!$adm) {
                redirect("/home");
            } else {
                redirect('/admin');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function error() {
        $this->session->set_userdata('errormsg', 'Login ou senha inválidos!');
    }

    public function submit() {
        if ($this->authenticate() == FALSE) {
            $this->error();
        }
        redirect("/login");
    }

    public function authenticate() {
        return $this->current_user->login(strip_tags($this->input->post('username')), md5($this->input->post('password')));
    }

}
