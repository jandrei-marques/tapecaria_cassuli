<?= $this->load->view('home') ?>
<?= form_open_multipart('cadastro/salvar', 'class="" id="formUsuario"'); ?>
<div class="container">
    <table
        <tr>
            <td>
                <label>Nome: </label>
            </td>
            <td>
                <input name="nome" type="text" class="form-control" value="<?= isset($usuario) ? $usuario->nome : '' ?>" required>
            </td>
        </tr>
        <tr>
            <td>
                <label>Cpf:</label>
            </td>
            <td>
                <input name="cpf" type="text" id="cpf" class="form-control" value="<?= isset($usuario) ? $usuario->cpf : '' ?>" required>
            </td>
        </tr>
        <tr>
            <td>
                <label>E-mail:</label>
            </td>
            <td>
                <input type="email" name="email" class="form-control" value="<?= isset($usuario) ? $usuario->email : '' ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Telefone:</label>
            </td>
            <td>
                <input type="tel" name="telefone" class="form-control" id="fone" value="<?= isset($usuario) ? $usuario->telefone : '' ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Celular: </label>
            </td>
            <td>
                <input type="tel" name="celular" class="form-control" id="celular" value="<?= isset($usuario) ? $usuario->telefone : '' ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Endereço:</label>
            </td>
            <td>
                <input type="text" name="endereco" class="form-control" value="<?= isset($usuario) ? $usuario->endereco : '' ?>" required />
            </td>
        </tr>
        <tr>
            <td>
                <label>Login: </label>
            </td>
            <td>
                <input type="text" name="login" class="form-control" value="<?= isset($usuario) ? $usuario->login : '' ?>" required />
            </td>
        </tr>
        <tr>
            <td>
                <label>Senha:</label>
            </td>
            <td>
                <input type="password" name="senha" class="form-control" id="senha" value="" required />
            </td>
        </tr>
        <tr>
            <td>
                <label>Confirmação de Senha:</label>
            </td>
            <td>
                <input type="password" name="confirmacaosenha" class="form-control" id="confirmacaosenha" value="" required />
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
    <button type="submit" class="btn btn-lg btn-success glyphicon glyphicon-chevron-down">Salvar</button>
</div>