	<div class="row">
		<div class="span8">
			<h2><?php echo lang('sign_up_heading'); ?></h2>
            <?php echo form_open(uri_string()); ?>
			<?php echo form_fieldset(); ?>
			<div class="clearfix<?php echo form_error('sign_up_username') ? ' error' : ''; ?>">
				<?php echo form_label(lang('sign_up_username'), 'sign_up_username'); ?>
				<div class="input">
					<?php echo form_input(array(
							'name' => 'sign_up_username',
							'id' => 'sign_up_username',
							'value' => set_value('sign_up_username'),
							'maxlength' => '24',
							'class' => 'xlarge'
						)); ?>
					<?php echo form_error('sign_up_username'); ?>
				</div>
			</div>
			<div class="clearfix<?php echo form_error('sign_up_password') ? ' error' : ''; ?>">
				<?php echo form_label(lang('sign_up_password'), 'sign_up_password'); ?>
				<div class="input">
					<?php echo form_password(array(
							'name' => 'sign_up_password',
							'id' => 'sign_up_password',
							'value' => set_value('sign_up_password'),
							'class' => 'xlarge'
						)); ?>
					<?php echo form_error('sign_up_password'); ?>
				</div>
			</div>
			<div class="clearfix<?php echo form_error('sign_up_email') ? ' error' : ''; ?>">
				<?php echo form_label(lang('sign_up_email'), 'sign_up_email'); ?>
				<div class="input">
					<?php echo form_input(array(
							'name' => 'sign_up_email',
							'id' => 'sign_up_email',
							'value' => set_value('sign_up_email'),
							'maxlength' => '160',
							'class' => 'xlarge'
						)); ?>
					<?php echo form_error('sign_up_email'); ?>
				</div>
			</div>
            <?php if (isset($recaptcha)) : ?>
            <div class="prefix_2 grid_4 alpha omega">
                <?php echo $recaptcha; ?>
            </div>
            <?php if (isset($sign_up_recaptcha_error)) : ?>
            <div class="prefix_2 grid_4 alpha omega">
                <span class="field_error"><?php echo $sign_up_recaptcha_error; ?></span>
            </div>
            <?php endif; ?>
            <div class="clear"></div>
            <?php endif; ?>
			<?php echo form_fieldset_close(); ?>
            <div class="actions">
                <?php echo form_button(array(
                        'type' => 'submit',
                        'class' => 'btn primary',
                        'content' => lang('sign_up_create_my_account')
                    )); ?>
            </div>
            <div class="prefix_2 grid_4 alpha omega">
                <p><?php echo lang('sign_up_already_have_account'); ?> <?php echo anchor('account/sign_in', lang('sign_up_sign_in_now')); ?></p>
            </div>
            <?php echo form_close(); ?>
        </div>
        <div class="span8">
            <h3><?php echo sprintf(lang('sign_up_third_party_heading')); ?></h3>
            <ul>
                <?php foreach($this->config->item('third_party_auth_providers') as $provider) : ?>
                <li class="third_party <?php echo $provider; ?>"><?php echo anchor('account/connect_'.$provider, lang('connect_'.$provider), 
                    array('title'=>sprintf(lang('sign_up_with'), lang('connect_'.$provider)))); ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="clear"></div>
        </div>
	</div>