	<div class="row">
		<div class="span8">
            <h2><?php echo lang('linked_currently_linked_accounts'); ?></h2>
            <?php if ($num_of_linked_accounts == 0) : ?>
            <div class="clearfix">
                <p><?php echo lang('linked_no_linked_accounts'); ?></p>
            </div>
            <?php else :?>
                <?php if ($facebook_links) : ?>
                    <?php foreach ($facebook_links as $facebook_link) : ?>
			<div class="row">
				<div class="span2">
					<img src="resource/img/auth_icons/facebook.png" alt="<?php echo lang('connect_facebook'); ?>" title="<?php echo lang('connect_facebook'); ?>" width="40" />
				</div>
				<div class="span4">
					<?php echo lang('connect_facebook'); ?><br />
					<?php echo anchor('http://facebook.com/profile.php?id='.$facebook_link->facebook_id, substr('http://facebook.com/profile.php?id='.$facebook_link->facebook_id, 0, 30).(strlen('http://facebook.com/profile.php?id='.$facebook_link->facebook_id) > 30 ? '...' : ''), array('target' => '_blank', 'title' => 'http://facebook.com/profile.php?id='.$facebook_link->facebook_id)); ?>
				</div>
				<div class="span2">
							<?php if ($num_of_linked_accounts != 1) : ?>
					<?php echo form_open(uri_string()); ?>
						<?php echo form_fieldset(); ?>
							<?php echo form_hidden('facebook_id', $facebook_link->facebook_id); ?>
							<?php echo form_button(array(
									'type' => 'submit',
									'class' => 'button',
									'content' => lang('linked_remove')
								)); ?>
						<?php echo form_fieldset_close(); ?>
					<?php echo form_close(); ?>
							<?php endif; ?>
				</div>
			</div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if ($twitter_links) : ?>
                    <?php foreach ($twitter_links as $twitter_link) : ?>
			<div class="row">
				<div class="span2">
					<img src="resource/img/auth_icons/twitter.png" alt="<?php echo lang('connect_twitter'); ?>" title="<?php echo lang('connect_twitter'); ?>" width="40" />
				</div>
				<div class="span4">
					<?php echo lang('connect_twitter'); ?><br />
					<?php echo anchor('http://twitter.com/'.$twitter_link->twitter->screen_name, substr('http://twitter.com/'.$twitter_link->twitter->screen_name, 0, 30).(strlen('http://twitter.com/'.$twitter_link->twitter->screen_name) > 30 ? '...' : ''), array('target' => '_blank', 'title' => 'http://twitter.com/'.$twitter_link->twitter->screen_name)); ?>
				</div>
				<div class="span2">
							<?php if ($num_of_linked_accounts != 1) : ?>
					<?php echo form_open(uri_string()); ?>
						<?php echo form_fieldset(); ?>
							<?php echo form_hidden('twitter_id', $twitter_link->twitter_id); ?>
							<?php echo form_button(array(
									'type' => 'submit',
									'class' => 'button',
									'content' => lang('linked_remove')
								)); ?>
						<?php echo form_fieldset_close(); ?>
					<?php echo form_close(); ?>
							<?php endif; ?>
				</div>
			</div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if ($openid_links) : ?>
                    <?php foreach ($openid_links as $openid_link) : ?>
			<div class="row">
				<div class="span2">
					<img src="resource/img/auth_icons/<?php echo $openid_link->provider; ?>.png" alt="<?php echo lang('connect_'.$openid_link->provider); ?>" width="40" />
				</div>
				<div class="span4">
					<?php echo lang('connect_'.$openid_link->provider); ?><br />
					<?php echo anchor($openid_link->openid, substr($openid_link->openid, 0, 30).(strlen($openid_link->openid) > 30 ? '...' : ''), array('target' => '_blank', 'title' => $openid_link->openid)); ?>
				</div>
				<div class="span2">
							<?php if ($num_of_linked_accounts != 1) : ?>
					<?php echo form_open(uri_string()); ?>
						<?php echo form_fieldset(); ?>
							<?php echo form_hidden('openid', $openid_link->openid); ?>
							<?php echo form_button(array(
									'type' => 'submit',
									'class' => 'button',
									'content' => lang('linked_remove')
								)); ?>
						<?php echo form_fieldset_close(); ?>
					<?php echo form_close(); ?>
							<?php endif; ?>
				</div>
			</div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="span8">
            <h2><?php echo lang('linked_link_with_your_account_from'); ?></h2>
            <?php if ($this->session->flashdata('linked_error')) : ?>
            <div class="form_error"><?php echo $this->session->flashdata('linked_error'); ?></div>
            <?php endif; ?>
            <ul class="third_party">
                <?php foreach($this->config->item('third_party_auth_providers') as $provider) : ?>
                <li class="third_party <?php echo $provider; ?>"><?php echo anchor('account/connect_'.$provider, lang('connect_'.$provider), 
                    array('title'=>sprintf(lang('connect_with_x'), lang('connect_'.$provider)))); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
	</div>