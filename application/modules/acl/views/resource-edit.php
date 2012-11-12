<?php if (!$isAjax): ?>
<h1>
	<?php echo lang('resource_page_name'); ?>
	<?php if($acl->is_allowed('acl/resource/add')){ ?>
	<a href="<?php echo site_url('acl/resource/add') ?>?redirect=<?php echo urlencode(current_url_params()); ?>" class="btn" title="<?php echo lang('resource_add_title'); ?>">
		<i class="icon-plus"></i>
	</a>
	<?php } ?>
</h1>
<?php echo messages(); ?>
<div class="row-fluid">
	<div class="span6">
		<?php
		function display_tree($tree, $curr_id = 0, $acl)
		{
			foreach($tree as $node)
			{
				echo '<li>';
				if (isset($node['children']))
					echo '<span class="toggle"></span>';
				$class = $node['type'];
				if ($node['id'] == $curr_id)
					$class .= ' current';
					if($acl->is_allowed('acl/resource/edit')){
						echo '<a href="' . site_url('acl/resource/edit') . '/' . $node['id'] . '?redirect=' . urlencode(site_url('acl/resource')) . '" class="' . $class . '">';
						echo '<span>' . $node['name'] . '</span>';
						echo '</a>';
					}else{
						echo '<span>' . $node['name'] . '</span>';
					}
				if (isset($node['children']))
				{
					echo '<ul>';
					display_tree($node['children'], $curr_id, $acl);
					echo '</ul>';
				}
				echo '</li>';
			}
		}
		?>
		<ul class="arbo">
			<?php display_tree($resource_tree, (isset($resource->id) ? $resource->id : 0), $acl); ?>
		</ul>
	</div>
	
	<div class="span6">
<?php endif; ?>						
		<?php echo form_open_multipart(uri_string(), array('class' => 'form-horizontal', 'id' => 'resource-form', 'name' => 'resource-form')); ?>
			<?php 
			echo form_hidden(array('id' => set_value('id', isset($resource->id) ? $resource->id : '')));
			if (isset($redirect))
				echo form_hidden(array('redirect' => $redirect));
			?>
			<fieldset>
				<legend><?php echo lang('resource_page_name'); ?></legend>
				<div class="control-group">
					<?php echo form_label(lang('resource_name'), 'name', array('class' => 'control-label required')); ?>
					<div class="controls">
						<?php echo form_input(array(
							'name'		=> 'name',
							'id'		=> 'name',
							'value'		=> set_value('name', isset($resource->name) ? $resource->name : ''),
							'maxlength'	=> '255',
							'class'		=> 'full-width' . (form_error('name') ? ' error' : '')
						)); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo form_label(lang('resource_type'), 'type', array('class' => 'control-label')); ?>
					<div class="controls">
						<?php
						echo form_dropdown('type', 
							array(
								'module'		=> 'Module',
								'controller'	=> 'Controller',
								'action'		=> 'Action',
								'other'			=> 'Other'
							),
							set_value('type', isset($resource->type) ? $resource->type : 'other')
						);
						?>
					</div>
				</div>
				<div class="control-group">
					<?php echo form_label(lang('resource_parent'), 'parent', array('class' => 'control-label')); ?>
					<div class="controls">
					<?php
					function generate_options($tree, $sep = '')
					{
						$result = array();
						foreach($tree as $node)
						{
							$result[$node['id']] = $sep . $node['name'];
							if (isset($node['children']))
								$result = $result + generate_options($node['children'], $sep . '&nbsp;&nbsp;');
						}
						return $result;
					}
					$parents = array(0 => '(' . lang('resource_parent_none') . ')') + generate_options($resource_tree);
					if (isset($resource->id) && isset($parents[$resource->id]))
						unset($parents[$resource->id]);
					echo form_dropdown('parent', 
						$parents, 
						set_value('parent', isset($resource->parent) ? $resource->parent : 0)
					);
					?>
					</div>
				</div>
			</fieldset>
			<?php if (!$isAjax): ?>
			<div class="form-actions">
				<?php 
				if($acl->is_allowed('acl/resource/edit')){
					echo form_button(array(
						'type' => 'submit',
						'name' => 'save_task',
						'value' => 'save',
						'content' => lang('save'),
						'class' => 'btn btn-primary'
					));
				}
				?>
				<?php
				if (isset($resource->id) && $acl->is_allowed('acl/resource/delete'))
				{
					$delete_url = site_url('acl/resource/delete/' . $resource->id) . '?redirect=' . urlencode($redirect);
					echo form_confirmwindow('delete-confirm', lang('delete'), lang('delete'), lang('resource_delete_confirm'), $delete_url);
				}
				?>
				<a href="<?php echo site_url('acl/resource'); ?>" class="btn"><?php echo lang('cancel') ?></a>
			</div>
			<?php endif; ?>
		<?php echo form_close(); ?>
<?php if (! $isAjax): ?>
	</div>
</div>
<!-- End resource -->
<?php endif; ?>
		