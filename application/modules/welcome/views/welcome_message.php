<div class="hero-unit">
	<h1>Welcome to CodeIgniter!</h1>
	<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>
	<p><a class="btn btn-primary btn-large" href="http://codeigniter.com/user_guide/toc.html" target="_blank">Learn more &raquo;</a></p>
</div>

<div class="row">
	<div class="span4">
		<h2>First Timer</h2>
		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the User Guide.</p>
		<p><a class="btn" href="user_guide/" target="_blank">User Guide &raquo;</a></p>
	</div>
	<div class="span4">
		<h2>Edit This!</h2>
		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/modules/welcome/views/welcome_message.php</code>
	</div>
	<div class="span4">
		<h2>Found At</h2>
		<p>The corresponding controller for this page is found at:</p>
		<code>application/modules/welcome/controllers/welcome.php</code>
	</div>
</div>
<div class="row">
	<div class="span4">
		<h2>Run Module... Run!!</h2>
		<?php echo Modules::run('welcome/hmvc/module_run'); ?>
	</div>
	<?php echo $template['partials']['sections']; ?>
</div>