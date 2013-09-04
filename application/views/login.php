<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <noscript>
        <meta http-equiv="Refresh" content="1; url=noscript.php">
        </noscript>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" href="../../css/jquery-ui-1.10.2.custom.min.css"/>
        <link rel="stylesheet" href="../../css/style.css"/>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-1.9.0.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.10.2.custom.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/noty/jquery.noty.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/noty/themes/default.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/noty/layouts/top.js"></script>
        <script>
            function generate(type, text) {
                var n = noty({
                    text: text,
                    type: type,
                    dismissQueue: false,
                    closeButton: true,
                    layout: 'top',
                    theme: 'defaultTheme'
                });
                setTimeout(function() {
                    $.noty.closeAll();
                }, 5000);
            }
        </script>
        <?
        $msg = $this->session->userdata('successmsg');
        if ($msg != null && $msg != "") {
            ?>
            <script>
                $(document).ready(function() {
                    generate('success', '<?= $msg ?>');
                });
            </script>
            <?
            $this->session->unset_userdata('successmsg');
        }
        $msg = $this->session->userdata('errormsg');
        if ($msg != null && $msg != "") {
            ?>
        <script>
            $(document).ready(function() {
                generate('error', '<?= $msg ?>');
            });
        </script>
        <?
        $this->session->unset_userdata('errormsg');
    }
    ?>
</head>
<body>
    <?= form_open('login/submit', 'class="login"'); ?>
    <div class="contentLogin">
        <div align="center">
            <table>
                <tr>
                    <td><?= form_input('username', '', "class='inputNormal' autofocus='true' placeholder='Username' required"); ?></td>
                </tr>
                <tr>
                    <td><?= form_password('password', "", "class='inputNormal' placeholder='Senha' required"); ?></td>
                </tr>
            </table>
        </div>
        <div align="center">
            <div class="espacoElementos"></div>
            <button type="submit" class="btnLogin">Login</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</body>
</html>