<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Tapeçaria Cassuli - Admin</title>        
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/jquery-ui-1.10.2.custom.min.css">
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-1.9.0.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.10.2.custom.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery.mask.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/utils.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-validate.js"></script>
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
            <div id="successmsg"></div>
            <script>
                generate('success', '<?= $msg ?>');
            </script>
            <?
            $this->session->unset_userdata('successmsg');
            }
            $msg = $this->session->userdata('errormsg');
            if ($msg != null && $msg != "") {
                ?>
                <div id="errormsg"></div>
                <script>
                    generate('error', '<?= $msg ?>');
                </script>
                <?
                $this->session->unset_userdata('errormsg');
            }
       ?>
        
    </head>
    <body>
        <nav>
            <div style="height: 60px;" title="Área Administrativa">
                <div id="menu">
                    <ul>
                        <li><a href="<?= base_url() ?>usuario">Usuários</a></li>
                        <li><a href="<?= base_url() ?>fornecedor">Fornecedores</a></li>
                        <li><a href="<?= base_url() ?>mostruario/novo">Mostruário</a></li>
                        <li><a href="<?= base_url() ?>produto/novo">Produtos</a></li>
                        <!--<li><a href="<?= base_url() ?>vencimentos">Venc. do dia</a></li>-->
                        <li><a href="<?= base_url() ?>login/logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </body>
</html>
