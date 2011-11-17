	<div class="row">
		<div class="span9">
			<h2><?php echo lang('sign_in_heading'); ?></h2>
            <?php echo form_open(uri_string().($this->input->get('continue')?'/?continue='.urlencode($this->input->get('continue')):'')); ?>
            <?php echo form_fieldset(); ?>
			<div class="clearfix<?php echo form_error('sign_in_username_email') ? ' error' : ''; ?>">
				<?php echo form_label(lang('sign_in_username_email'), 'sign_in_username_email'); ?>
				<div class="input">
					<?php echo form_input(array(
							'name' => 'sign_in_username_email',
							'id' => 'sign_in_username_email',
							'value' => set_value('sign_in_username_email'),
							'maxlength' => '24',
							'class' => 'xlarge'
						)); ?>
					<?php echo form_error('sign_in_username_email'); ?>
				</div>
			</div>
			<div class="clearfix<?php echo form_error('sign_in_password') ? ' error' : ''; ?>">
				<?php echo form_label(lang('sign_in_password'), 'sign_in_password'); ?>
				<div class="input">
					<?php echo form_password(array(
							'name' => 'sign_in_password',
							'id' => 'sign_in_password',
							'value' => set_value('sign_in_password'),
							'class' => 'xlarge'
						)); ?>
					<?php echo form_error('sign_in_password'); ?>
				</div>
			</div>
			<?php if (isset($recaptcha)) : ?>
			<div class="clearfix<?php echo isset($sign_in_recaptcha_error) ? ' error' : ''; ?>">
				<?php echo form_label('', 'recaptcha_response_field'); ?>
				<div class="input">
					<?php echo $recaptcha; ?>
					<?php if (isset($sign_in_recaptcha_error)) : ?>
					<span class="help-block"><?php echo $sign_in_recaptcha_error; ?></span>
					<?php endif; ?>					
				</div>
			</div>
            <?php endif; ?>
			<div class="clearfix">
				<?php echo form_label(''); ?>
				<div class="input">
					<ul class="inputs-list">
						<li>
							<?php echo form_checkboxlabel(array(
									'name' => 'sign_in_remember',
									'id' => 'sign_in_remember',
									'value' => 'checked',
									'checked' => $this->input->post('sign_in_remember'),
									'label' => lang('sign_in_remember_me')
								)); ?>							
						</li>
					</ul>
				</div>
			</div>
			<?php echo form_fieldset_close(); ?>
            <div class="actions">
                <?php echo form_button(array(
                        'type' => 'submit',
                        'class' => 'btn primary',
                        'content' => lang('sign_in_sign_in')
                    )); ?>
            </div>
            <div class="clearfix">
                <p><?php echo anchor('account/forgot_password', lang('sign_in_forgot_your_password')); ?><br />
                <?php echo sprintf(lang('sign_in_dont_have_account'), anchor('account/sign_up', lang('sign_in_sign_up_now'))); ?></p>
            </div>
            <?php echo form_close(); ?>
		</div>
        <div class="span7">
            <h2><?php echo sprintf(lang('sign_in_third_party_heading')); ?></h2>
            <ul class="unstyled">
                <?php foreach($this->config->item('third_party_auth_providers') as $provider) : ?>
                <li class="third_party <?php echo $provider; ?>">
					<?php echo anchor('account/connect_'.$provider, lang('connect_'.$provider), array('title'=>sprintf(lang('sign_in_with'), lang('connect_'.$provider)))); ?>
				</li>
                <?php endforeach; ?>
            </ul>
        </div>
	</div>