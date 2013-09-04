<?= $this->load->view('home') ?>
<script>
    $(function() {
        $(document).tooltip({
            track: true
        });
    });
</script>
<style>
    .ui-tooltip, .arrow:after {
        background: black;
        border: 2px solid white;
    }
    .ui-tooltip {
        padding: 10px 20px 10px 10px;
        color: white;
        border-radius: 20px;
        font: bold 14px "Helvetica Neue", Sans-Serif;
        text-transform: uppercase;
        box-shadow: 0 0 7px black;
    }
    .arrow {
        width: 70px;
        height: 16px;
        overflow: hidden;
        position: absolute;
        left: 50%;
        margin-left: -35px;
        bottom: -16px;
    }
    .arrow.top {
        top: -16px;
        bottom: auto;
    }
    .arrow.left {
        left: 20%;
    }
    .arrow:after {
        content: "";
        position: absolute;
        left: 20px;
        top: -20px;
        width: 25px;
        height: 25px;
        box-shadow: 6px 5px 9px -9px black;
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        tranform: rotate(45deg);
    }
    .arrow.top:after {
        bottom: -20px;
        top: auto;
    }
</style>
<div class="container">
    <?
    foreach ($produtos as $produto) {
        $img = $this->imagem_model->buscarImgProduto($produto->id);
        if (!$img) {
            $img = base_url() . 'imagens/no_image.png';
        } else {
            $img = base_url() . $img[0]->url;
        }
        ?>
        <div class="produto">
            <img ondragstart="return false" onclick="javascript: window.location = '<?= base_url() ?>produto/detalhes/<?= $produto->id ?>'" src="<?= $img ?>" alt="imgproduct" title="Clique para Maiores Informações" />
            <div class="informacoes">
                <label class="title"><?= $produto->nome ?></label> 
                <label class="valor">-- R$<?= $produto->valor ?></label>
            </div>
        </div>
    <? } ?>
</div>