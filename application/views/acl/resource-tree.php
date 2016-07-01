
<?php if (isset($form)) $resource = $form->get_default(); ?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<?php echo lang('resource_page_name') ?>
			<?php if($acl->is_allowed('acl/resource/add')): ?>
			<a href="<?php echo site_url('acl/resource/add') ?>" class="btn btn-primary pull-right" title="<?php echo lang('resource_add_title'); ?>">
				<i class="fa fa-plus"></i> <?php echo lang('add'); ?>
			</a>
			<?php endif; ?>
		</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<?php echo messages(); ?>
<div class="row">
	<div class="col-md-5">
		<section class="panel panel-default">
			<div class="panel-body">
				<?php
				function display_tree($tree, $acl, $curr_id = 0)
				{
					foreach($tree as $node) {
						if ($curr_id == $node['id'])
							echo '<li class="active"><strong>';
						else
							echo '<li>';
						$class = 'fa ';
						switch($node['type']) {
							case 'module':
								$class .= 'fa-folder-open-o ';
								break;
							case 'controller':
								$class .= 'fa-file-text-o';
								break;
							case 'action':
								$class .= 'fa-gear';
								break;
							default:
								$class .= 'fa-question';
								break;
						}
						echo '<i class="fa-li ' . $class . '"></i>';
						if($acl->is_allowed('acl/resource/edit')){
							echo '<a href="' . site_url('acl/resource/edit/' . $node['id']) . '">';
							echo $node['name'];
							echo '</a>';
						} else {
							echo $node['name'];
						}
						if (isset($node['children'])) {
							echo '<ul class="fa-ul">';
							display_tree($node['children'], $acl, $curr_id);
							echo '</ul>';
						}
						if ($curr_id == $node['id'])
							echo '</strong>';
						echo '</li>';
					}
				}
				?>
				<ul class="fa-ul">
					<?php display_tree($resource_tree, $acl, (isset($resource->id) ? $resource->id : 0)); ?>
				</ul>
			</div>
		</section>
	</div>
	<?php if (isset($form)): ?>
	<div class="col-md-7">
		<?php echo form_open_multipart(uri_string(), array('class' => 'form-horizontal form-bordered', 'id' => 'resource-form', 'name' => 'resource-form')); ?>
			<section class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title"><?php echo lang('resource_page_name') ?></h2>
				</div>
				<div class="panel-body">
					<?php echo $form->fields(array('id', 'name', 'type')) ?>
					<div class="form-group">
						<?php echo form_label(lang('resource_parent'), 'parent', array('class' => 'col-lg-4 control-label')); ?>
						<div class="col-lg-8">
						<?php
						function generate_options($tree, $sep = '')
						{
							$result = array();
							foreach($tree as $node)
							{
								$result[$node['id']] = $sep . $node['type'] . '&nbsp;' . $node['name'];
								if (isset($node['children']))
									$result = $result + generate_options($node['children'], $sep . '&nbsp;&nbsp;&nbsp;&nbsp;');
							}
							return $result;
						}
						$parents = array(0 => '(' . lang('resource_parent_none') . ')') + generate_options($resource_tree);
						if (isset($resource->id) && isset($parents[$resource->id]))
							unset($parents[$resource->id]);

						echo form_dropdown('parent', 
							$parents, 
							set_value('parent', isset($resource->parent) ? $resource->parent : 0),
							'id="parent" class="form-control"'
						);
						?>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<?php 
					if($acl->is_allowed('acl/resource/edit')) {
						echo form_button(array(
							'type' => 'submit',
							'name' => 'save_task',
							'value' => 'save',
							'content' => '<i class="fa fa-check"></i> ' . lang('save'),
							'class' => 'btn btn-primary'
						));
					}
					?>
					<?php
					if (isset($resource->id) && $acl->is_allowed('acl/resource/delete')) {
						$delete_url = site_url('acl/resource/delete/' . $resource->id);
						echo form_confirmwindow('delete-confirm', '<i class="fa fa-trash-o"></i> ' . lang('delete'), lang('delete'), lang('resource_delete_confirm'), $delete_url, 'btn btn-danger pull-right', 'btn btn-danger');
					}
					?>
					<a href="<?php echo site_url('acl/resource'); ?>" class="btn btn-default">
						<i class="fa fa-repeat"></i>
						<?php echo lang('cancel') ?>
					</a>
				</div>
			</section>
		<?php echo form_close(); ?>
	</div>
	<?php endif; ?>
</div>

<script>
	$(document).ready(function() {
		$('#type').select2({
			minimumResultsForSearch: 20,
			escapeMarkup: function (markup) { return markup; },
			templateResult: function(row) {
				return render_type(row.text);
			},
			templateSelection: function(row) {
				return render_type(row.text);
			}
		});
		$('#parent').select2({
			minimumResultsForSearch: 20,
			escapeMarkup: function (markup) { return markup; },
			templateResult: function(row) {
				return render_parent(row.text);
			},
			templateSelection: function(row) {
				return render_parent(row.text);
			}
		});
	});
	
	function render_type(text) {
		switch (text) {
			case 'Module':
				return '<i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;' + text;
				break;
			case 'Controller':
				return '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;' + text;
				break;
			case 'Action':
				return '<i class="fa fa-gear"></i>&nbsp;&nbsp;' + text;
				break;
			default:
				return '<i class="fa fa-question"></i>&nbsp;&nbsp;' + text;
				break;
		}
	}
	
	function render_parent(text) {
		return text.replace('module', '<i class="fa fa-folder-open-o"></i>&nbsp;')
				.replace('controller', '<i class="fa fa-file-text-o"></i>&nbsp;')
				.replace('action', '<i class="fa fa-gear"></i>&nbsp;')
				.replace('other', '<i class="fa fa-question"></i>&nbsp;');
	}
</script>