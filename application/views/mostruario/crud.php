<?= $this->load->view('home_admin'); ?>
<!DOCTYPE html>
<section class="container">
        <?
        echo form_open_multipart("mostruario/" . $op);
        if (isset($mostruario)) {
            echo form_hidden("id", $mostruario->id);
        }
        ?>
        <fieldset class="ui-widget-content ui-corner-all fieldCad">
            <legend>Cadastro de mostruario</legend>
            <table>
                <tr>
                    <td>
                        <label>Descrição: </label>
                    </td>
                    <td>
                        <input name="descricao" type="text" value="<?= isset($mostruario) ? $mostruario->descricao : '' ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Valor Unitário: </label>
                    </td>
                    <td>
                        <input name="vlr_unit" type="text" value="<?= isset($mostruario) ? $mostruario->vlr_unit : '' ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Unidade Medida: </label>
                    </td>
                    <td>
                        <input type="text" name="un_medida" value="<?= isset($mostruario) ? $mostruario->un_medida : '' ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Referência: </label>
                    </td>
                    <td>
                        <input type="text" name="referencia" value="<?= isset($mostruario) ? $mostruario->referencia : '' ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Tipo Material: </label>
                    </td>
                    <td>
                        <input type="text" name="tipo_material" value="<?= isset($mostruario) ? $mostruario->tipo_material : '' ?>" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Observação: </label>
                    </td>
                    <td>
                        <input type="text" name="observacao" value="<?= isset($mostruario) ? $mostruario->observacao : '' ?>" required />
                    </td>
                </tr>
            </table>
            <br />
            <hr>
            <button type="submit" class="btnSave">Salvar</button>
        </fieldset>
        <fieldset  class="fieldList">
            <legend>Mostruarios Cadastrados</legend>
            <?
            if (isset($mostruarios) && count($mostruarios) > 0) {
                ?>
                <table class="listAll">
                    <thead>
                    <th style="text-align: left; width: 40%;">Descrição</th>
                    <th style="text-align: left; width: 20%;">Valor</th>
                    <th style="text-align: left; width: 30%;">Observação</th>
                    <th style="text-align: left; width: 10%;">&nbsp;</th>
                    </thead>
                    <tbody>
                        <? foreach ($mostruarios as $mostru) { ?>
                            <tr>
                                <td><?= $mostru->descricao ?></td>
                                <td><?= $mostru->vlr_unit ?></td>
                                <td><?= $mostru->observacao ?></td>
                                <td><a href="<?= base_url() ?>mostruario/editar/<?= $mostru->id ?>">Editar</a>&nbsp;
                                    <a href="<?= base_url() ?>mostruario/excluir/<?= $mostru->id ?>">Excluir</a>
                                </td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
            <? } ?>
        </fieldset>
</section>