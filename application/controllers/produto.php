<?php

class Produto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('produto_model', 'usuario_model', 'comentario_model', 'fornecedor_model', 'imagem_model', 'current_user'));
        date_default_timezone_set('America/Sao_paulo');
    }

    public function index() {
        $produtos = $this->produto_model->buscarTodos();
        $data['produtos'] = $produtos;
        $this->load->view('externo/produtos', $data);
    }

    public function novo() {
        if (!$this->current_user->isAdmin()) {
            redirect('/login');
        }
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
        if (!$this->current_user->isAdmin()) {
            redirect('/login');
        }
        $produto = array(
            'nome' => $this->input->post('nome'),
            'descricao' => $this->input->post('descricao'),
            'valor' => $this->input->post('valor'),
            'id_fornecedor' => $this->input->post('fornecedor') != 0 ? $this->input->post('fornecedor') : null,
            'created_at' => date("Y-m-d H:i:s")
        );
        $this->produto_model->salvar($produto);
        redirect('/produto/novo');
    }

    public function editar() {
        if (!$this->current_user->isAdmin()) {
            redirect('/login');
        }
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
        if (!$this->current_user->isAdmin()) {
            redirect('/login');
        }
        $id = $this->input->post('id');
        $produto = array(
            'nome' => $this->input->post('nome'),
            'descricao' => $this->input->post('descricao'),
            'valor' => $this->input->post('valor'),
            'id_fornecedor' => $this->input->post('fornecedor') != 0 ? $this->input->post('fornecedor') : null,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $this->produto_model->atualizar($id, $produto);
        redirect('/produto/novo');
    }

    public function excluir() {
        if (!$this->current_user->isAdmin()) {
            redirect('/login');
        }
        $id = $this->uri->segment(3);
        $images = $this->imagem_model->buscarImgProduto($id);
        try {

            if (is_array($images)) {
                foreach ($images as $img) {
                    $this->imagem_model->excluirImgPro($img->id_imagem);
                    unlink($img->url);
                }
            }
            $this->produto_model->apagar($id);
            $this->session->set_userdata('successmsg', 'Produto excluído com sucesso!');
        } catch (Exception $e) {
            $this->session->set_userdata('errormsg', 'Ocorreu um erro na exclusão!');
        }
        redirect('/produto/novo');
    }

    public function add_imagem() {
        if (!$this->current_user->isAdmin()) {
            redirect('/login');
        }
        $id_produto = $this->uri->segment(3);
//        $produto = $this->produto_model->buscarId($id_produto);
        $imagens = $this->imagem_model->buscarImgProduto($id_produto);
        $data['produto'] = $id_produto;
        $data['imagens'] = $imagens;
        $data['op'] = 'save_img';
        $this->load->view('produto/add_image', $data);
    }

    public function save_img() {
        if (!$this->current_user->isAdmin()) {
            redirect('/login');
        }
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);
        $isUploaded = true;
        $id_pro = strip_tags($this->input->post('id_produto'));
        if (!$this->upload->do_upload()) {
            $isUploaded = false;
            $this->session->set_userdata('errorsmsg', 'Erro ao enviar imagem! Envie somente imagens no formato GIF,JPG ou JPEG');
            redirect('/usuario');
        }
        if ($isUploaded) {
            $upload = $this->upload->data();
            $name = array_sum(explode('.', microtime(true)));
            $patern = dirname(__FILE__) . "../../../foto/produto/";
            $this->load->library("wideimage/lib/WideImage");
            $image = WideImage::load($upload['full_path']);
            if ($image->getWidth() > $image->getHeight()) {
                $image = $image->resize(null, 600);
            } else {
                $image = $image->resize(800, null);
            }
//            $image = $image->crop("center", "middle", 800, 600);
            $image->saveToFile($patern . $name .
                    $upload["file_ext"]);

            $img = array(
                "descricao" => strip_tags($this->input->post("descricao")),
                'url' => "foto/produto/" . $name . $upload["file_ext"],
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->imagem_model->salvar($img);
            $id_img = $this->db->insert_id();
            $img_pro = array(
                'id_imagem' => $id_img,
                'id_produto' => $id_pro
            );
            $this->imagem_model->salvarImgProduto($img_pro);
            $this->session->set_userdata("successmsg", "Imagem cadastrada com sucesso!");
        }
        redirect("/produto/add_imagem/$id_pro");
    }

    public function editar_img() {
        if (!$this->current_user->isAdmin()) {
            redirect('/login');
        }
        $id = $this->uri->segment(3);
        $img_pro = $this->imagem_model->buscarProImg($id);
        $data['produto'] = $img_pro->id_produto;
        $data['imagens'] = $this->imagem_model->buscarImgProduto($img_pro->id_produto);
        $data['imagem'] = $img_pro;
        $data['op'] = 'atualizar_img';
        $this->load->view('produto/add_image', $data);
    }

    public function atualizar_img() {
        if (!$this->current_user->isAdmin()) {
            redirect('/login');
        }
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);
        $isUploaded = true;
        $id_pro = strip_tags($this->input->post('id_produto'));
        $id_img = strip_tags($this->input->post('id_imagem'));
        if (!$this->upload->do_upload()) {
            $isUploaded = false;
//            $this->session->set_userdata('errormsg', 'Erro ao enviar imagem! Envie somente imagens no formato GIF,JPG ou JPEG');
//            redirect("/produto/add_imagem/$id_pro");
        }
        if ($isUploaded) {
            $image = $this->imagem_model->buscarId($id_img);
            unlink($image->url);
            $upload = $this->upload->data();
            $name = array_sum(explode('.', microtime(true)));
            $patern = dirname(__FILE__) . "../../../foto/produto/";
            $this->load->library("wideimage/lib/WideImage");
            $image = WideImage::load($upload['full_path']);
            if ($image->getWidth() > $image->getHeight()) {
                $image = $image->resize(null, 600);
            } else {
                $image = $image->resize(800, null);
            }
            $image = $image->crop("center", "middle", 800, 600);
            $image->saveToFile($patern . $name .
                    $upload["file_ext"]);


            $img = array(
                "descricao" => strip_tags($this->input->post("descricao")),
                'url' => "foto/produto/" . $name . $upload["file_ext"],
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->imagem_model->atualizar($id_img, $img);
            $this->session->set_userdata("successmsg", "Imagem cadastrada com sucesso!");
        } else {
            $img = array(
                "descricao" => strip_tags($this->input->post("descricao")),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->imagem_model->atualizar($id_img, $img);
            $this->session->set_userdata("successmsg", "Imagem cadastrada com sucesso!");
        }
        redirect("/produto/add_imagem/$id_pro");
    }

    public function excluir_img() {
        if (!$this->current_user->isAdmin()) {
            redirect('/login');
        }
        $id_img = $this->uri->segment(3);
        $imagem = $this->imagem_model->buscarProImg($id_img);
        try {
            $this->imagem_model->excluirImgPro($id_img);
            unlink($imagem->url);
            $this->session->set_userdata('successmsg', 'Imagem excluída com sucesso!');
        } catch (Exception $ex) {
            $this->session->set_userdata('successmsg', 'Ocorreu um erro ao excluír a imagem!');
        }
        redirect("/produto/add_imagem/$imagem->id_produto");
    }

}