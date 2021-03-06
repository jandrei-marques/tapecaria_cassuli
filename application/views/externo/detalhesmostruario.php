<?= $this->load->view('home'); ?>
<script src="<?= base_url() ?>js/gallery/js/jquery.timers-1.2.js"></script>
<script src="<?= base_url() ?>js/gallery/js/jquery.easing.1.3.js"></script>
<script src="<?= base_url() ?>js/gallery/js/jquery.galleryview-3.0-dev.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>js/gallery/css/jquery.galleryview-3.0-dev.css"/>

<script>
    $(function() {
        $('#galeria').galleryView();
    });
</script>
<div class="container">
    <div>
    <ul id="galeria" >
        <? foreach ($imagens as $img) { ?>
            <li><img src="<?= base_url() . $img->url ?>" alt="<?= $img->descricao ?>"/>
            <? } ?>
    </ul>
    </div>
    <div>
        <fieldset>
            <legend>Informações sobre o item de mostruário</legend>
            <?=$produto->descricao?><br />
            <?=$produto->Observacao?><br />
            <?=$produto->vlr_unit?><br/>
        </fieldset>
    </div>
</div>