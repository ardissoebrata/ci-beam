		<div class="row">
			<div class="span8">
				<h2>Edit User</h2>
				<form class="form-horizontal box" method="post">
					<fieldset>
						<legend>Account</legend>
						<?php echo $form->fields(); ?>
					</fieldset>
					<?php echo form_actions(array(
						array(
							'id'	=> 'save-button',
							'value' => 'Save',
							'class' => 'btn-primary'
						),
						array(
							'id'	=> 'cancel-button',
							'value'	=> 'Cancel'
						)
					)); ?>
				</form>
			</div>
		</div>