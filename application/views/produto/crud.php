<?=$this->load->view('home_admin');?>
<!DOCTYPE html>
<section class="container">
        <?
        echo form_open_multipart("produto/" . $op);
        if (isset($produto)) {
            echo form_hidden("id", $produto->id);
        }
        ?>
        <fieldset class="ui-widget-content ui-corner-all fieldCad">
            <legend>Cadastro de Produto</legend>
            <table>
                <tr>
                    <td>
                        <label>Nome: </label>
                    </td>
                    <td>
                        <input name="nome" type="text" value="<?= isset($produto) ? $produto->nome : '' ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Descrição: </label>
                    </td>
                    <td>
                        <input name="descricao" type="text" value="<?= isset($produto) ? $produto->descricao : '' ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Valor: </label>
                    </td>
                    <td>
                        <input type="text" name="valor" value="<?= isset($produto) ? $produto->valor : '' ?>" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Fornecedor: </label>
                    </td>
                    <td>
                        <?=  form_dropdown('fornecedor',$fornecedores, isset($produto) ? $produto->id_fornecedor : '');?>
                    </td>
                </tr>
            </table>
            <br />
            <hr>
            <button type="submit" class="btnSave">Salvar</button>
        </fieldset>
    <?=  form_close()?>
    <fieldset class="fieldList">
            <legend>Produtos Cadastrados</legend>
            <?
            if (isset($produtos) && count($produtos) > 0) {
                ?>
            <table class="listAll">
                    <thead>
                    <th style="text-align: left; width: 30%;">Nome</th>
                    <th style="text-align: left; width: 30%;">Descrição</th>
                    <th style="text-align: left; width: 20%;">Valor</th>
                    <th style="text-align: left; width: 10%;">Imagem</th>
                    <th style="text-align: left; width: 10%;">&nbsp;</th>
                    </thead>
                    <tbody>
                        <? foreach ($produtos as $pro) { ?>
                            <tr>
                                <td><?= $pro->nome ?></td>
                                <td><?= $pro->descricao ?></td>
                                <td><?= $pro->valor ?></td>
                                <td><a href="#" onclick="javascript: window.open('<?= base_url() ?>produto/add_imagem/<?= $pro->id ?>', 'janela', 'width=1200, height=630, top=20, left=10, scrollbars=yes, status=no, toolbar=no, location=hide, directories=no, menubar=no, resizable=no, fullscreen=no, modal=yes');">Add Imagem</a>&nbsp;
                                <td><a href="<?= base_url() ?>produto/editar/<?= $pro->id ?>">Editar</a>&nbsp;
                                    <a href="<?= base_url() ?>produto/excluir/<?= $pro->id ?>">Excluir</a>
                                </td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
            <? } ?>
        </fieldset>
</section>