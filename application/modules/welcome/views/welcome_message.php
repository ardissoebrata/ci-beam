<div class="jumbotron">
	<h1><?php echo lang('welcome_to_codeigniter'); ?></h1>
	<p><?php echo lang('generated_by_codeigniter'); ?></p>
	<p><a class="btn btn-lg btn-primary" href="https://ellislab.com/codeigniter/user-guide/" target="_blank"><?php echo lang('learn_more'); ?></a></p>
</div>

<div class="row">
	<div class="col-md-4">
		<h2><?php echo lang('first_timer'); ?></h2>
		<p><?php echo lang('start_by_reading_userguide'); ?></p>
		<p><a class="btn btn-default" href="user_guide/" target="_blank"><?php echo lang('user_guide'); ?></a></p>
	</div>
	<div class="col-md-4">
		<h2><?php echo lang('edit_this'); ?></h2>
		<p><?php echo lang('edit_at'); ?></p>
		<code>application/modules/welcome/views/welcome_message.php</code>
	</div>
	<div class="col-md-4">
		<h2><?php echo lang('found_at'); ?></h2>
		<p><?php echo lang('corresponding_at'); ?></p>
		<code>application/modules/welcome/controllers/welcome.php</code>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<h2><?php echo lang('run_module'); ?></h2>
		<?php echo $this->template->get_module_partial('welcome/hmvc/module_run'); ?>
	</div>
	<?php echo $template['partials']['sections']; ?>
</div>