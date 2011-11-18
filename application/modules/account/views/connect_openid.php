        <div class="span8">
            <?php echo form_open(uri_string()); ?>
            <?php echo form_fieldset(); ?>
            <h2><?php echo sprintf(lang('connect_enter_your'), lang('connect_openid_url')); ?> 
                <small><?php echo anchor($this->config->item('openid_what_is_url'), lang('connect_start_what_is_openid'), array('target'=>'_blank')); ?></small></h2>
            <div class="clearfix<?php echo (form_error('connect_openid_url') || isset($connect_openid_error)) ? ' error' : ''; ?>">
                <?php echo form_input(array(
                        'name' => 'connect_openid_url',
                        'id' => 'connect_openid_url',
                        'class' => 'xlarge',
                        'value' => set_value('connect_openid_url')
                    )); ?>
                <?php echo form_error('connect_openid_url'); ?>
				<?php if (isset($connect_openid_error)) : ?>
				<span class="help-block">
					<?php echo $connect_openid_error; ?>
				</span>
				<?php endif; ?>
            </div>
            <div class="clearfix">
                <?php echo form_button(array(
                        'type' => 'submit',
                        'class' => 'btn primary',
                        'content' => lang('connect_proceed')
                    )); ?>
            </div>
            <?php echo form_fieldset_close(); ?>
            <?php echo form_close(); ?>
        </div>