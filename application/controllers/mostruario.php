<?php

class Mostruario extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('mostruario_model','usuario_model','imagem_model'));
        date_default_timezone_set('America/Sao_paulo');
    }
    
    public function index(){
        $data['op'] = 'salvar';
        $data['mostruarios'] = $this->mostruario_model->buscarTodos();
        $this->load->view('mostruario/crud',$data);
    }
    
    public function salvar(){
        $mostruario = array(
            'descricao' => strip_tags($this->input->post('descricao')),
            'vlr_unit'=> strip_tags($this->input->post('vlr_unit')),
            'un_medida'=> strip_tags($this->input->post('un_medida')),
            'referencia'=>  strip_tags($this->input->post('referencia')),
            'tipo_material' => strip_tags($this->input->post('tipo_material')),
            'observacao' => strip_tags($this->input->post('observacao')),
            'created_at' => date("Y-m-d H:i:s")
        );
        $this->mostruario_model->salvar($mostruario);
        $this->session->set_userdata('successmsg','Mostruário cadastrado com sucesso!');
        redirect('/mostruario');
    }
    
    public function editar(){
        $id = $this->uri->segment(3);
        $data['mostruario'] = $this->mostruario_model->buscarId($id);
        $data['mostruarios'] = $this->mostruario_model->buscarTodos();
        $data['op'] = 'atualizar';
        $this->load->view('mostruario/crud',$data);
    }
    
    public function atualizar(){
        $id = $this->input->post('id');
        $mostruario = array(
            'descricao' => strip_tags($this->input->post('descricao')),
            'vlr_unit'=> strip_tags($this->input->post('vlr_unit')),
            'un_medida'=> strip_tags($this->input->post('un_medida')),
            'referencia'=>  strip_tags($this->input->post('referencia')),
            'tipo_material' => strip_tags($this->input->post('tipo_material')),
            'observacao' => strip_tags($this->input->post('observacao')),
            'updated_at' => date("Y-m-d H:i:s")
        );
        $this->mostruario_model->atualizar($id,$mostruario);
        $this->session->set_userdata('successmsg','Mostruário atualizado com sucesso!');
        redirect('/mostruario');
    }
    
    public function excluir(){
        $id = $this->uri->segment(3);
        
    }
    public function add_imagem() {
        $id_mostruario = $this->uri->segment(3);
//        $produto = $this->produto_model->buscarId($id_produto);
        $imagens = $this->imagem_model->buscarImgMostruario($id_mostruario);
        $data['mostruario'] = $id_mostruario;
        $data['imagens'] = $imagens;
        $data['op'] = 'save_img';
        $this->load->view('mostruario/add_image', $data);
    }

    public function save_img() {
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);
        $isUploaded = true;
        $id_most = strip_tags($this->input->post('id_mostruario'));
        if (!$this->upload->do_upload()) {
            $isUploaded = false;
            $this->session->set_userdata('errorsmsg', 'Erro ao enviar imagem! Envie somente imagens no formato GIF,JPG ou JPEG');
            redirect('/usuario');
        }
        if ($isUploaded) {
            $upload = $this->upload->data();
            $name = array_sum(explode('.', microtime(true)));
            $patern = dirname(__FILE__) . "../../../foto/mostruario/";
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
                'url' => "foto/mostruario/" . $name . $upload["file_ext"],
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->imagem_model->salvar($img);
            $id_img = $this->db->insert_id();
            $img_most = array(
                'id_imagem' => $id_img,
                'id_mostruario' => $id_most
            );
            $this->imagem_model->salvarImgMostruario($img_most);
            $this->session->set_userdata("successmsg", "Imagem cadastrada com sucesso!");
        }
        redirect("/mostruario/add_imagem/$id_most");
    }

    public function editar_img() {
        $id = $this->uri->segment(3);
        $img_mos = $this->imagem_model->buscarMosImg($id);
        $data['mostruario'] = $img_mos->id_mostruario;
        $data['imagens'] = $this->imagem_model->buscarImgMostruario($img_mos->id_mostruario);
        $data['imagem'] = $img_mos;
        $data['op'] = 'atualizar_img';
        $this->load->view('mostruario/add_image', $data);
    }

    public function atualizar_img() {
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);
        $isUploaded = true;
        $id_mos = strip_tags($this->input->post('id_mostruario'));
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
            $patern = dirname(__FILE__) . "../../../foto/mostruario/";
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
                'url' => "foto/mostruario/" . $name . $upload["file_ext"],
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->imagem_model->atualizar($id_img, $img);
            $this->session->set_userdata("successmsg", "Imagem atualizada com sucesso!");
        } else {
            $img = array(
                "descricao" => strip_tags($this->input->post("descricao")),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->imagem_model->atualizar($id_img, $img);
            $this->session->set_userdata("successmsg", "Imagem atualizada com sucesso!");
        }
        redirect("/mostruario/add_imagem/$id_mos");
    }

    public function excluir_img() {
        $id_img = $this->uri->segment(3);
        $imagem = $this->imagem_model->buscarMosImg($id_img);
        try {
            $this->imagem_model->excluirImgMos($id_img);
            unlink($imagem->url);
            $this->session->set_userdata('successmsg', 'Imagem excluída com sucesso!');
        } catch (Exception $ex) {
            $this->session->set_userdata('successmsg', 'Ocorreu um erro ao excluír a imagem!');
        }
        redirect("/mostruario/add_imagem/$imagem->id_mostruario");
    }
}
