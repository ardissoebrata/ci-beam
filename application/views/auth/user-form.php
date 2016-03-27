<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo lang('user') ?></h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal box" method="post">
			<fieldset>
				<legend><?php echo lang('account'); ?></legend>
				<?php echo $form->fields(); ?>
			</fieldset>
			<?php
			echo form_actions(array(
				array(
					'id' => 'save-button',
					'value' => lang('save'),
					'class' => 'btn-primary'
				),
				array(
					'id' => 'cancel-button',
					'value' => lang('cancel')
				)
			));
			?>
		</form>
	</div>
</div>