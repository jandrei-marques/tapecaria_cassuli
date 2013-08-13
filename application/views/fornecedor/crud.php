<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
            <p>
                <label>Nome: <input name="nome" type="text" value="<?= isset($fornecedor) ? $fornecedor->nome : '' ?>" required></label>
            </p>
            <p>
                <label>Nome Fantasia: <input name="nome_fantasia" type="text" value="<?= isset($fornecedor) ? $fornecedor->nome_fantasia : '' ?>" required></label>
            </p>
            <p>
                <label>Cnpj: <input type="text" name="cnpj" value="<?= isset($fornecedor) ? $fornecedor->cnpj : '' ?>" required /></label>
            </p>
            <p>
                <label>Endereço: <input type="text" name="endereco" value="<?= isset($fornecedor) ? $fornecedor->endereco : '' ?>" required /></label>
            </p>
            <p>
                <label>Descrição: <input type="text" name="descricao" value="<?= isset($fornecedor) ? $fornecedor->descricao : '' ?>" required /></label>
            </p>
            <input type="submit" name="action" value="Salvar">
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
                            <td><?=$fornece->nome?></td>
                            <td><?=$fornece->nome_fantasia?></td>
                            <td><?=$fornece->endereco?></td>
                            <td><a href="<?= base_url()?>fornecedor/editar/<?=$fornece->id?>">Editar</a>&nbsp;
                                <a href="<?= base_url()?>fornecedor/excluir/<?=$fornece->id?>">Excluir</a>
                            </td>
                        </tr>
                        <? } ?>
                    </tbody>
                </table>
            <? } ?>
        </fieldset>
    </body>
</html>
