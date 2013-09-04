<?= $this->load->view('home') ?>
<div class="container">
    <?= form_open('login/submit', 'class="form-signin"'); ?>
    <h2 class="form-signin-heading">Insira seu dados de Login</h2>
    <input type="text" class="form-control" placeholder="Login" autofocus name="username"/>
    <input type="password" class="form-control" placeholder="Password" name="password"/>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    <?= form_close() ?>

</div>
