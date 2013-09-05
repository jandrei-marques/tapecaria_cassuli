<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array("usuario_model", "imagem_model","current_user"));
        date_default_timezone_set("America/Sao_paulo");
        if(!$this->current_user->isAdmin()){
            redirect('/login');
        }
    }

    public function index() {
        $data['op'] = "salvar";
        $data['usuarios'] = $this->usuario_model->buscarTodos();
        $this->load->view("usuario/crud", $data);
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
        redirect("/usuario");
    }

    public function editar() {
        $id = $this->uri->segment(3);
        $data["usuario"] = $this->usuario_model->buscarId($id);
        $data['usuarios'] = $this->usuario_model->buscarTodos();
        $data['op'] = 'atualizar';
        $this->load->view('usuario/crud', $data);
    }

    public function atualizar() {
        $id = strip_tags($this->input->post("id"));
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);
        $isUploaded = TRUE;
        if (!$this->upload->do_upload()) {
            $isUploaded = FALSE;
//            $this->session->set_userdata('errorsmsg', 'Erro ao enviar imagem! Envie somente imagens no formato GIF,JPG ou JPEG');
//            redirect('/usuario');
        }
        if ($isUploaded) {
            $user = $this->usuario_model->buscarId($id);
            if(!empty($user->url_img)){
                unlink($user->url_img);
            }
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
                "updated_at" => date("Y-m-d H:i:s"),
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
                "updated_at" => date("Y-m-d H:i:s"),
                "email" => strip_tags($this->input->post("email"))
            );
        }

        $this->usuario_model->atualizar($id,$usuario);
        $this->session->set_userdata("successmsg", "Usuário atualizado com sucesso!");
        redirect("/usuario");
    }

    public function excluir() {
        $id = $this->uri->segment(3);
        $usuario = $this->usuario_model->buscarId($id);
        try {
            $this->usuario_model->apagar($id);
            unlink($usuario->url_img);
            $this->session->set_userdata("successmsg", "Usuário excluído com sucesso!");
        } catch (Exception $exc) {
            $this->session->set_userdata("errormsg", "Usuário não pode ser excluído!");
            echo $exc->getTraceAsString();
        }
        redirect("/usuario");
    }

}
