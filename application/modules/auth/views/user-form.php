		<div class="row">
			<div class="span8">
				<h2>Edit User</h2>
				<form class="form-horizontal box" method="post">
					<input type="hidden" id="id" name="id" value="<?php //echo $user->getId(); ?>" />
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