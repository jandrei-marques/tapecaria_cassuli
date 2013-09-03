<?=$this->load->view('home_admin');?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?
        echo form_open("fornecedor/" . $op);
        if (isset($fornecedor)) {
            echo form_hidden("id", $fornecedor->id);
        }
        ?>
        <fieldset>
            <legend>Cadastro de fornecedor</legend>
            <table>
                <tr>
                    <td>
                        <label>Nome: </label>
                    </td>
                    <td>
                        <input name="nome" type="text" value="<?= isset($fornecedor) ? $fornecedor->nome : '' ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Nome Fantasia: </label>
                    </td>
                    <td>
                        <input name="nome_fantasia" type="text" value="<?= isset($fornecedor) ? $fornecedor->nome_fantasia : '' ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Cnpj: </label>
                    </td>
                    <td>
                        <input type="text" name="cnpj" value="<?= isset($fornecedor) ? $fornecedor->cnpj : '' ?>" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Endereço: </label>
                    </td>
                    <td>
                        <input type="text" name="endereco" value="<?= isset($fornecedor) ? $fornecedor->endereco : '' ?>" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Descrição: </label>
                    </td>
                    <td>
                        <input type="text" name="descricao" value="<?= isset($fornecedor) ? $fornecedor->descricao : '' ?>" required />
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
            <legend>Fornecedores Cadastrados</legend>
            <?
            if (isset($fornecedores) && count($fornecedores) > 0) {
                ?>
                <table>
                    <thead>
                    <th>Nome</th>
                    <th>Nome Fantasia</th>
                    <th>Endereço</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        <? foreach ($fornecedores as $fornece) { ?>
                            <tr>
                                <td><?= $fornece->nome ?></td>
                                <td><?= $fornece->nome_fantasia ?></td>
                                <td><?= $fornece->endereco ?></td>
                                <td><a href="<?= base_url() ?>fornecedor/editar/<?= $fornece->id ?>">Editar</a>&nbsp;
                                    <a href="<?= base_url() ?>fornecedor/excluir/<?= $fornece->id ?>">Excluir</a>
                                </td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
            <? } ?>
        </fieldset>
    </body>
</html>
