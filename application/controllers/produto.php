<?php

class Produto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('produto_model', 'usuario_model', 'comentario_model', 'fornecedor_model','imagem_model'));
    }

    public function index() {
        $data['op'] = 'salvar';
        $data['produtos'] = $this->produto_model->buscarTodos();
        $fornecedor = $this->fornecedor_model->buscarTodos();
        $fornecedores[0] = 'Selecione...';
        if (count($fornecedor) > 0) {
            foreach ($fornecedor as $f) {
                $fornecedores[$f->id] = $f->nome_fantasia;
            }
        }
        $data['fornecedores'] = $fornecedores;
        $this->load->view('produto/crud', $data);
    }

    public function salvar() {
        $produto = array(
            'nome' => $this->input->post('nome'),
            'descricao' => $this->input->post('descricao'),
            'valor' => $this->input->post('valor'),
            'id_fornecedor' => $this->input->post('fornecedor'),
        );
        $this->produto_model->salvar($produto);
        redirect('/produto');
    }

    public function editar() {
        $id = $this->uri->segment(3);
        $data['produto'] = $this->produto_model->buscarId($id);
        $data['produtos'] = $this->produto_model->buscarTodos();
        $fornecedor = $this->fornecedor_model->buscarTodos();
        $fornecedores[0] = 'Selecione...';
        if (count($fornecedor) > 0) {
            foreach ($fornecedor as $f) {
                $fornecedores[$f->id] = $f->nome_fantasia;
            }
        }
        $data['fornecedores'] = $fornecedores;
        $data['op'] = 'atualizar';
        $this->load->view('produto/crud', $data);
    }

    public function atualizar() {
        $id = $this->input->post('id');
        $produto = array(
            'nome' => $this->input->post('nome'),
            'descricao' => $this->input->post('descricao'),
            'valor' => $this->input->post('valor'),
            'id_fornecedor' => $this->input->post('fornecedor')
        );
        $this->produto_model->atualizar($id, $produto);
        redirect('/produto');
    }

    public function excluir() {
        $id = $this->uri->segment(3);
        $this->produto_model->apagar($id);
        redirect('/produto');
    }
    
    public function add_imagem(){
        $id_produto = $this->uri->segment(3);
        $produto = $this->produto_model->buscarId($id_produto);
        
    }

}