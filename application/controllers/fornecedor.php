<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fornecedor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array("fornecedor_model"));
        date_default_timezone_set("America/Sao_paulo");
    }
    
    public function index(){
        $data['op'] = 'salvar';
        $data['fornecedores'] = $this->fornecedor_model->buscarTodos();
        $this->load->view("fornecedor/crud",$data);
    }
    
    public function salvar(){
        $fornecedor = array(
            "nome"=>strip_tags($this->input->post("nome")),
            "nome_fantasia"=>strip_tags($this->input->post("nome_fantasia")),
            "cnpj"=>strip_tags($this->input->post("cnpj")),
            "endereco"=>strip_tags($this->input->post("endereco")),
            "descricao"=>strip_tags($this->input->post("descricao")),
            "created_at"=>date("Y-m-d H:i:s"),
        );
        $this->fornecedor_model->salvar($fornecedor);
        
        $this->session->set_userdata("sucessmsg","Fornecedor cadastrado com sucesso!");
        redirect('/fornecedor');
        
    }
    
    public function editar(){
        $id = $this->uri->segment(3);
        $data['fornecedor'] = $this->fornecedor_model->buscarId($id);
        $data['op'] = 'atualizar';
        $data['fornecedores'] = $this->fornecedor_model->buscarTodos();
        $this->load->view("fornecedor/crud",$data);
    }
    
    public function atualizar(){
        $id = $this->input->post("id");
        $fornecedor = array(
            "nome"=>strip_tags($this->input->post("nome")),
            "nome_fantasia"=>strip_tags($this->input->post("nome_fantasia")),
            "cnpj"=>strip_tags($this->input->post("cnpj")),
            "endereco"=>strip_tags($this->input->post("endereco")),
            "descricao"=>strip_tags($this->input->post("descricao")),
            "updated_at"=>date("Y-m-d H:i:s"),
        );
        $this->fornecedor_model->atualizar($id,$fornecedor);
        $this->session->set_userdata("successmsg","Fornecedor atualizado com sucesso!");
        redirect("/fornecedor");
    }
    
    public function excluir(){
        $id  = $this->uri->segment(3);
        $fornecedor = $this->fornecedor_model->buscarId($id);
        try {
            $this->fornecedor_model->apagar($id);
            $this->session->set_userdata("successmsg","Fornecedor excluido com sucesso!");
        } catch (Exception $exc) {
            $this->session->set_userdata("errormsg","Fornecedor não pode ser excluido!");
            echo $exc->getTraceAsString();
        }

        redirect('/fornecedor');
    }

}