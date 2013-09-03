<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Tapeçaria Cassuli - Admin</title>        
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/jquery-ui-1.10.2.custom.min.css">
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-1.9.0.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.10.2.custom.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery.mask.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/utils.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/noty/jquery.noty.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/noty/themes/default.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/noty/layouts/top.js"></script>
        <script>
            function generate(type, text) {
                var n = noty({
                    text: text,
                    type: type,
                    dismissQueue: false,
                    closeButton: true,
                    layout: 'top',
                    theme: 'defaultTheme'
                });
                setTimeout(function() {
                    $.noty.closeAll();
                }, 5000);
            }
        </script>
        <?
        $msg = $this->session->userdata('successmsg');
        if ($msg != null && $msg != "") {
            ?>
        <div id="successmsg"></div>
        <script>
            generate('success', '<?= $msg ?>');
        </script>
        <?
        $this->session->unset_userdata('successmsg');
    }
    $msg = $this->session->userdata('errormsg');
    if ($msg != null && $msg != "") {
        ?>
        <div id="errormsg"></div>
        <script>
            generate('error', '<?= $msg ?>');
        </script>
        <?
        $this->session->unset_userdata('errormsg');
    }
    ?>

</head>
<body>
    <?
    echo form_open_multipart("mostruario/" . $op);
    if (isset($imagem)) {
        echo form_hidden("id_imagem", $imagem->id);
    }
    echo form_hidden('id_mostruario',$mostruario);
    ?>
    <fieldset class="ui-widget-content ui-corner-all fieldCad">
        <legend>Adicionar Imagem</legend>
        <table>
            <tr>
                <td>
                    <label>Selecionar Imagem: </label>
                </td>
                <td>
                    <input type="file" name="userfile"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Descrição</label>
                </td>
                <td>
                    <input type="text" name="descricao" value="<?= isset($imagem) ? $imagem->descricao : "" ?>"/>
                </td>
            </tr>
        </table>
        <br />
        <hr>
        <button type="submit" class="btnSave">Salvar</button>
    </fieldset>
    <?= form_close() ?>
    <fieldset class="fieldList">
        <legend>Imagens deste Mostruário</legend>
        <? if (isset($imagens) && is_array($imagens)) { ?>
            <table class="listAll">
                <thead>
                <th style="text-align: left; width: 40%;">Descrição</th>
                <th style="text-align: left; width: 40%;">Imagem</th>
                <th style="text-align: left; width: 20%;">&nbsp;</th>
                </thead>
                <tbody>
                    <? foreach ($imagens as $img) { ?>
                        <tr>
                            <td><?= $img->descricao ?></td>
                            <td><img width="100px" height="100px" src="<?= base_url() . $img->url ?>"></td>
                            <td><a href="<?= base_url() ?>mostruario/editar_img/<?= $img->id_imagem ?>">Editar</a>&nbsp;
                                <a href="<?= base_url() ?>mostruario/excluir_img/<?= $img->id_imagem ?>">Excluir</a>
                            </td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        <? } ?>
    </fieldset>
</body>
</html>
