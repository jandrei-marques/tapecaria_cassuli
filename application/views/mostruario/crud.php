<?=$this->load->view('home_admin');?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?
        echo form_open_multipart("mostruario/" . $op);
        if (isset($mostruario)) {
            echo form_hidden("id", $mostruario->id);
        }
        ?>
        <fieldset>
            <legend>Cadastro de mostruario</legend>
            <p>
                <label>Descrição: <input name="descricao" type="text" value="<?= isset($mostruario) ? $mostruario->descricao : '' ?>" required></label>
            </p>
            <p>
                <label>Nome Fantasia: <input name="nome_fantasia" type="text" value="<?= isset($mostruario) ? $mostruario->nome_fantasia : '' ?>" required></label>
            </p>
            <p>
                <label>Cnpj: <input type="text" name="cnpj" value="<?= isset($mostruario) ? $mostruario->cnpj : '' ?>" required /></label>
            </p>
            <p>
                <label>Endereço: <input type="text" name="endereco" value="<?= isset($mostruario) ? $mostruario->endereco : '' ?>" required /></label>
            </p>
            <p>
                <label>Descrição: <input type="text" name="descricao" value="<?= isset($mostruario) ? $mostruario->descricao : '' ?>" required /></label>
            </p>
            <input type="submit" name="action" value="Salvar">
        </fieldset>
        <fieldset>
            <legend>Fornecedores Cadastrados</legend>
            <?
            if (isset($mostruarios) && count($mostruarios) > 0) {
                ?>
                <table>
                    <thead>
                    <th>Nome</th>
                    <th>Nome Fantasia</th>
                    <th>Endereço</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        <? foreach ($mostruarios as $mostru) { ?>
                        <tr>
                            <td><?=$mostru->nome?></td>
                            <td><?=$mostru->nome_fantasia?></td>
                            <td><?=$mostru->endereco?></td>
                            <td><a href="<?=  base_url()?>mostruario/editar/<?=$mostru->id?>">Editar</a>&nbsp;
                                <a href="<?=  base_url()?>mostruario/excluir/<?=$mostru->id?>">Excluir</a>
                            </td>
                        </tr>
                        <? } ?>
                    </tbody>
                </table>
            <? } ?>
        </fieldset>
    </body>
</html>
