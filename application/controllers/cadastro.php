<?php

class Cadastro extends CI_Controller {

    public function __construct() {
        parent::__construct();
                $this->load->model(array("usuario_model", "imagem_model","current_user"));
        date_default_timezone_set("America/Sao_paulo");
    }

    public function index() {
        $this->load->view("externo/cadastro");
    }

    public function salvar() {
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);
        $isUploaded = true;
        if (!$this->upload->do_upload()) {
            $isUploaded = false;
//            $this->session->set_userdata('errormsg', 'Erro ao enviar imagem! Envie somente imagens no formato GIF,JPG ou JPEG');
//            redirect('/usuario');
        }
        if ($isUploaded) {
            $upload = $this->upload->data();
            $name = array_sum(explode('.', microtime(true)));
            $patern = dirname(__FILE__) . "../../../foto/usuario";
            $this->load->library("wideimage/lib/WideImage");
            $image = WideImage::load($upload['full_path']);
            if ($image->getWidth() > $image->getHeight()) {
                $image = $image->resize(null, 100);
            } else {
                $image = $image->resize(100, null);
            }
            $image = $image->crop("center", "middle", 100, 100);
            $image->saveToFile($patern . $name .
                    $upload["file_ext"]);

            $usuario = array(
                "nome" => strip_tags($this->input->post("nome")),
                "cpf" => strip_tags($this->input->post("cpf")),
                "endereco" => strip_tags($this->input->post("endereco")),
                "dt_ultimoacesso" => date("Y-m-d H:i:s"),
                "login" => strip_tags($this->input->post("login")),
                "senha" => md5($this->input->post("senha")),
                "celular" => strip_tags($this->input->post("celular")),
                "created_at" => date("Y-m-d H:i:s"),
                "email" => strip_tags($this->input->post("email")),
                'url_img' => "foto/usuario" . $name . $upload["file_ext"]
            );
        } else {
            $usuario = array(
                "nome" => strip_tags($this->input->post("nome")),
                "cpf" => strip_tags($this->input->post("cpf")),
                "endereco" => strip_tags($this->input->post("endereco")),
                "dt_ultimoacesso" => date("Y-m-d H:i:s"),
                "login" => strip_tags($this->input->post("login")),
                "senha" => md5($this->input->post("senha")),
                "celular" => strip_tags($this->input->post("celular")),
                "created_at" => date("Y-m-d H:i:s"),
                "email" => strip_tags($this->input->post("email"))
            );
        }
        $this->usuario_model->salvar($usuario);

        $this->session->set_userdata("successmsg", "Usuário cadastrado com sucesso!");
        redirect("/login");
    }

}
