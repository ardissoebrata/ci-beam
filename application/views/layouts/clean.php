<!DOCTYPE html>
<html lang="<?php echo $this->session->userdata('lang') ?>">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $template['metas']; ?>

    <title><?php echo $template['title']; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo bower_url('bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
	
    <!-- MetisMenu CSS -->
    <link href="<?php echo bower_url('metisMenu/dist/metisMenu.min.css') ?>" rel="stylesheet">
	
    <!-- Custom CSS -->
    <link href="<?php echo css_url('sb-admin-2') ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo bower_url('font-awesome/css/font-awesome.css') ?>" rel="stylesheet">
	
    <?php echo $template['css']; ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<?php echo $template['js_header']; ?>
</head>

<body class="clean">

	<div class="container">
		<?php echo $template['content']; ?>
	</div>

    <!-- jQuery -->
    <script src="<?php echo bower_url('jquery/dist/jquery.min.js') ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo bower_url('bootstrap/dist/js/bootstrap.min.js') ?>"></script>

     <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo bower_url('metisMenu/dist/metisMenu.min.js') ?>"></script>
	
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo js_url('sb-admin-2.js') ?>"></script>
	
    <?php echo $template['js_footer']; ?>

</body>

</html>
