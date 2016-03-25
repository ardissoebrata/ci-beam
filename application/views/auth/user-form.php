		<div class="row">
			<div class="span8">
				<h2><?php echo lang('user'); ?></h2>
				<?php echo messages(); ?>
				<form class="form-horizontal box" method="post">
					<fieldset>
						<legend><?php echo lang('account'); ?></legend>
						<?php echo $form->fields(); ?>
					</fieldset>
					<?php echo form_actions(array(
						array(
							'id'	=> 'save-button',
							'value' => lang('save'),
							'class' => 'btn-primary'
						),
						array(
							'id'	=> 'cancel-button',
							'value'	=> lang('cancel')
						)
					)); ?>
				</form>
			</div>
		</div>