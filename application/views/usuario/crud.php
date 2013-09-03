<?= $this->load->view('home_admin'); ?>
<!DOCTYPE html>
<section class="container">
    <?
    echo form_open_multipart("usuario/" . $op);
    if (isset($usuario)) {
        echo form_hidden("id", $usuario->id);
    }
    ?>
    <fieldset class="ui-widget-content ui-corner-all fieldCad">
        <legend>Cadastro de Usuario</legend>
        <table
            <tr>
                <td>
                    <label>Nome: </label>
                </td>
                <td>
                    <input name="nome" type="text" value="<?= isset($usuario) ? $usuario->nome : '' ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Cpf:</label>
                </td>
                <td>
                    <input name="cpf" type="text" value="<?= isset($usuario) ? $usuario->cpf : '' ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label>E-mail:</label>
                </td>
                <td>
                    <input type="email" name="email" value="<?= isset($usuario) ? $usuario->email : '' ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Telefone:</label>
                </td>
                <td>
                    <input type="tel" name="telefone" value="<?= isset($usuario) ? $usuario->telefone : '' ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Celular: </label>
                </td>
                <td>
                    <input type="tel" name="celular" value="<?= isset($usuario) ? $usuario->telefone : '' ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Endereço:</label>
                </td>
                <td>
                    <input type="text" name="endereco" value="<?= isset($usuario) ? $usuario->endereco : '' ?>" required />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Login: </label>
                </td>
                <td>
                    <input type="text" name="login" value="<?= isset($usuario) ? $usuario->login : '' ?>" required />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Senha:</label>
                </td>
                <td>
                    <input type="password" name="senha" value="" required />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Confirmação de Senha:</label>
                </td>
                <td>
                    <input type="password" name="confirmacaosenha" value="" required />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Foto:</label>
                </td>
                <td>
                    <input type="file" name="userfile" accept="image/*"/>
                </td>
            </tr>
        </table>
        <br />
        <hr>
        <button type="submit" class="btnSave">Salvar</button>
    </fieldset>
    <?= form_close() ?>
    <fieldset class="fieldList">
        <legend>Usuarios Cadastrados</legend>
        <?
        if (isset($usuarios) && count($usuarios) > 0) {
            ?>
            <table class="listAll">
                <thead>
                <th style="text-align: left; width: 20%;">Nome</th>
                <th style="text-align: left; width: 20%;">Cpf</th>
                <th style="text-align: left; width: 20%;">Endereço</th>
                <th style="text-align: left; width: 20%;">Foto</th>
                <th style="text-align: left; width: 10%;">&nbsp;</th>
                </thead>
                <tbody>
                    <? foreach ($usuarios as $user) { ?>
                        <tr>
                            <td><?= $user->nome ?></td>
                            <td><?= $user->cpf ?></td>
                            <td><?= $user->endereco ?></td>
                            <td><? if (!empty($user->url_img)) { ?>
                                    <img src="<?= base_url() . $user->url_img ?>"/> 
                                    <?
                                } else {
                                    echo "&nbsp;";
                                }
                                ?>
                            </td>
                            <td><a href="<?= base_url() ?>usuario/editar/<?= $user->id ?>">Editar</a>&nbsp;
                                <a href="<?= base_url() ?>usuario/excluir/<?= $user->id ?>">Excluir</a>
                            </td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        <? } ?>
    </fieldset>
</section>