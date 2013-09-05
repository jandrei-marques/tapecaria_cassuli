<?= $this->load->view('home') ?>
<script>
    $(function() {
        $(".toltip").tooltip({
        });
    });
</script>
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
            <img ondragstart="return false" data-toogle='tooltip' class="toltip" onclick="javascript: window.location = '<?= base_url() ?>produto/detalhes/<?= $produto->id ?>'" src="<?= $img ?>" alt="imgproduct" title="Clique para Maiores Informações" />
            <div class="informacoes">
                <label class="title"><?= $produto->nome ?></label> 
                <label class="valor">-- R$<?= $produto->valor ?></label>
            </div>
        </div>
    <? } ?>
</div>