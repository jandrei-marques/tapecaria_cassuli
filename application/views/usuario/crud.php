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
        echo form_open_multipart("usuario/" . $op);
        if (isset($usuario)) {
            echo form_hidden("id", $usuario->id);
        }
        ?>
        <fieldset>
            <legend>Cadastro de Usuario</legend>
            <p>
                <label>Nome: <input name="nome" type="text" value="<?= isset($usuario) ? $usuario->nome : '' ?>" required></label>
            </p>
            <p>
                <label>Cpf: <input name="cpf" type="text" value="<?= isset($usuario) ? $usuario->cpf : '' ?>" required></label>
            </p>
            <p>
                <label>E-mail: <input type="email" name="email" value="<?= isset($usuario) ? $usuario->email : '' ?>" /></label>
            </p>
            <p>
                <label>Telefone: <input type="tel" name="telefone" value="<?= isset($usuario) ? $usuario->telefone : '' ?>" /></label>
            </p>
            <p>
                <label>Celular: <input type="tel" name="celular" value="<?= isset($usuario) ? $usuario->telefone : '' ?>" /></label>
            </p>
            <p>
                <label>Endereço: <input type="text" name="endereco" value="<?= isset($usuario) ? $usuario->endereco : '' ?>" required /></label>
            </p>
            <p>
                <label>Login: <input type="text" name="login" value="<?= isset($usuario) ? $usuario->login : '' ?>" required /></label>
            </p>
            <p>
                <label>Senha: <input type="password" name="senha" value="" required /></label>
            </p>
            <p>
                <label>Confirmação de Senha: <input type="password" name="confirmacaosenha" value="" required /></label>
            </p>
            <p>
                <label>Foto: <input type="file" name="userfile" accept="image/*"/></label>
            </p>
            <input type="submit" name="action" value="Salvar">
        </fieldset>
        <fieldset>
            <legend>Usuarios Cadastrados</legend>
            <?
            if (isset($usuarios) && count($usuarios) > 0) {
                ?>
                <table>
                    <thead>
                    <th>Nome</th>
                    <th>Cpf</th>
                    <th>Endereço</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        <? foreach ($usuarios as $user) { ?>
                        <tr>
                            <td><?=$user->nome?></td>
                            <td><?=$user->cpf?></td>
                            <td><?=$user->endereco?></td>
                            <td><a href="<?= base_url()?>usuario/editar/<?=$user->id?>">Editar</a>&nbsp;
                                <a href="<?= base_url()?>usuario/excluir/<?=$user->id?>">Excluir</a>
                            </td>
                        </tr>
                        <? } ?>
                    </tbody>
                </table>
            <? } ?>
        </fieldset>
    </body>
</html>
