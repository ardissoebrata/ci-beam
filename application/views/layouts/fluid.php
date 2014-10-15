<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $template['title'] ?></title>
		<?php echo $template['metas']; ?>

		<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le styles -->
		<?php echo $template['css']; ?>

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
		
		<?php echo $template['js_header']; ?>
	</head>

	<body>

		<?php $this->load->view('navbar', $template); ?>

		<div class="container-fluid">
			<div class="row">
				<?php if (isset($template['partials']['sidebar'])): ?>
				<div class="col-md-3">
					<?php echo $template['partials']['sidebar']; ?>
				</div><!--/span-->
				<div class="col-md-9">
					<?php echo $template['content']; ?>
				</div><!--/span-->
				<?php else: ?>
				<div class="col-md-12">
					<?php echo $template['content']; ?>
				</div><!--/span-->
				<?php endif; ?>
			</div><!--/row-->
			<?php $this->load->view('footer'); ?>
			
		</div> <!-- /container -->

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<?php echo $template['js_footer']; ?>

	</body>
</html>
