<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array("usuario", "comentario", "imagem"));
        date_default_timezone_set("America/Sao_paulo");
    }

    public function index() {
        $data['op'] = "salvar";
        $this->load->view("usuario/crud",$data);
    }

    public function salvar() {
        $usuario = array(
            "nome" =>strip_tags($this->input->post("nome")),
            "cpf" =>strip_tags($this->input->post("cpf")),
            "endereco" =>strip_tags($this->input->post("endereco")),
            "dt_ultimoacesso" =>date("Y-m-d H:i:s"),
            "login" =>strip_tags($this->input->post("login")),
            "senha" =>strip_tags($this->input->post("senha")),
            "celular" =>strip_tags($this->input->post("celular")),
            "created_at" =>date("Y-m-d H:i:s"),
            "email" =>strip_tags($this->input->post("email"))
        );
        $this->usuario->salvar($usuario);
//        $usuario->setNome(strip_tags($this->input->post("nome")));
//        $usuario->setCpf(strip_tags($this->input->post("cpf")));
//        $usuario->setEndereco(strip_tags($this->input->post("endereco")));
//        $usuario->setDt_ultimoacesso(date_create(date("Y-m-d H:i:s")));
//        $usuario->setLogin(strip_tags($this->input->post("login")));
//        $usuario->setSenha(strip_tags($this->input->post("senha")));
//        $usuario->setCelular(strip_tags($this->input->post("celular")));
//        $usuario->setCreated_at(date_create(date("Y-m-d H:i:s")));
//        $usuario->setEmail(strip_tags($this->input->post("email")));
//
//        //implementar upload imagem
//        $this->doctrine->em->persist($usuario);
//        $this->doctrine->em->flush();

        $this->session->set_userdata("successmsg", "Usuário cadastrado com sucesso!");
        redirect("/usuario");
    }

    public function editar() {
        $id = $this->uri->segment(3);
        $data["usuario"] = $this->usuario->buscarId($id);
        $data['op'] = 'atualizar';
        $this->load->view('usuario/crud', $data);
    }

    public function atualizar() {
        $id = strip_tags($this->input->post("id"));
        $usuario = array(
            "nome" =>strip_tags($this->input->post("nome")),
            "cpf" =>strip_tags($this->input->post("cpf")),
            "endereco" =>strip_tags($this->input->post("endereco")),
            "dt_ultimoacesso" =>date("Y-m-d H:i:s"),
            "login" =>strip_tags($this->input->post("login")),
            "senha" =>strip_tags($this->input->post("senha")),
            "celular" =>strip_tags($this->input->post("celular")),
            "updated_at" =>date("Y-m-d H:i:s"),
            "email" =>strip_tags($this->input->post("email"))
        );
        $this->usuario->salvar($usuario);
        //implementar upload imagem
        $this->session->set_userdata("successmsg","Usuário atulizado com sucesso!");
        
        redirect("/usuario");
    }
    
    public function excluir(){
        $id = $this->uri->segment(3);
        $usuario = $this->usuario->buscarId($id);
        try {
            $this->usuario->apagar($id);
            $this->session->set_userdata("successmsg","Usuário excluído com sucesso!");
        } catch (Exception $exc) {
            $this->session->set_userdata("errormsg","Usuário não pode ser excluído!");
            echo $exc->getTraceAsString();
        }
        redirect("/usuario");
    }

}
