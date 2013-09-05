<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--<link rel="shortcut icon" href="<?= base_url() ?>css/bootstrap/assets/ico/favicon.png">-->
        <title>Tapeçaria Cassuli</title>
        <!-- Bootstrap core CSS -->
        <link href="<?= base_url() ?>css/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?= base_url() ?>css/bootstrap_style.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?= base_url() ?>css/bootstrap/assets/js/html5shiv.js"></script>
          <script src="<?= base_url() ?>css/bootstrap/assets/js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-1.9.0.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.10.2.custom.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>css/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>css/bootstrap/js/tooltip.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/noty/jquery.noty.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/noty/themes/default.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/noty/layouts/top.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-validate.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery.mask.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/utils.js"></script>
        
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
        <!-- Static navbar -->
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=  base_url().'home'?>">Tapecaria Cassuli</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?=  base_url().'home'?>">Home</a></li>
                        <li><a href="<?=  base_url().'produto'?>">Produtos</a></li>
                        <li><a href="<?=  base_url().'mostruario'?>">Mostruário</a></li>
                        <li><a href="<?=  base_url().'login'?>">Login</a></li>
                        <li><a href="<?=  base_url().'cadastro'?>">Cadastre-se</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../navbar/">Default</a></li>
                        <li class="active"><a href="./">Static top</a></li>
                        <li><a href="../navbar-fixed-top/">Fixed top</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
<!--        <div class="container">
             Main component for a primary marketing message or call to action 
            <div class="jumbotron">
                <h1>Navbar example</h1>
                <p>This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
                <p>To see the difference between static and fixed top navbars, just scroll.</p>
                <p>
                    <a class="btn btn-lg btn-primary" href="../../components/#navbar">View navbar docs &raquo;</a>
                </p>
            </div>
        </div>  /container -->
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../../assets/js/jquery.js"></script>
        <script src="../../dist/js/bootstrap.min.js"></script>
    </body>
</html>
