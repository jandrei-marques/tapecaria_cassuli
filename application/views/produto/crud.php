<?=$this->load->view('home_admin');?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?
        echo form_open_multipart("produto/" . $op);
        if (isset($produto)) {
            echo form_hidden("id", $produto->id);
        }
        ?>
        <fieldset>
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
                <tr>
                    <td colspan="2">
                        <input type="submit" name="action" value="Salvar">
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Produtos Cadastrados</legend>
            <?
            if (isset($produtos) && count($produtos) > 0) {
                ?>
                <table>
                    <thead>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        <? foreach ($produtos as $pro) { ?>
                            <tr>
                                <td><?= $pro->nome ?></td>
                                <td><?= $pro->descricao ?></td>
                                <td><?= $pro->valor ?></td>
                                <td><a href="<?= base_url() ?>produto/add_imagem/<?= $pro->id ?>">Add Imagem</a>&nbsp;
                                <td><a href="<?= base_url() ?>produto/editar/<?= $pro->id ?>">Editar</a>&nbsp;
                                    <a href="<?= base_url() ?>produto/excluir/<?= $pro->id ?>">Excluir</a>
                                </td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
            <? } ?>
        </fieldset>
    </body>
</html>
