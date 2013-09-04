<?=$this->load->view('home_admin');?>
<!DOCTYPE html>
<section class='container'>
        <?
        echo form_open("fornecedor/" . $op);
        if (isset($fornecedor)) {
            echo form_hidden("id", $fornecedor->id);
        }
        ?>
        <fieldset class="ui-widget-content ui-corner-all fieldCad">
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
                        <input type="text" name="cnpj" id="cnpj" value="<?= isset($fornecedor) ? $fornecedor->cnpj : '' ?>" required />
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
            </table>
            <br />
            <hr>
            <button type="submit" class="btnSave">Salvar</button>
        </fieldset>
        <?=  form_close()?>
    <fieldset class="fieldList">
            <legend>Fornecedores Cadastrados</legend>
            <?
            if (isset($fornecedores) && count($fornecedores) > 0) {
                ?>
                <table class="listAll">
                    <thead>
                    <th style="text-align: left; width: 30%;">Nome</th>
                    <th style="text-align: left; width: 30%;">Nome Fantasia</th>
                    <th style="text-align: left; width: 30%;">Endereço</th>
                    <th style="text-align: left; width: 10%;">&nbsp;</th>
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
</section>