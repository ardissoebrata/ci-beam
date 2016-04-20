<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<?php echo lang('rule_page_name') ?>
		</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<?php echo messages(); ?>

<div class="row">
	<div class="col-lg-5">
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
						echo '<i class="fa-li fa fa-user"></i>';
						if($acl->is_allowed('acl/rule/edit')) {
							echo '<a href="' . site_url('acl/rule/edit/' . $node['id']) . '" class="users">';
							echo '<span>' . $node['name'] . '</span>';
							echo '</a>';
						} else {
							echo '<span>' . $node['name'] . '</span>';
						}
						if ($curr_id == $node['id'])
							echo '</strong>';
						if (isset($node['children'])) {
							echo '<ul class="fa-ul">';
							display_tree($node['children'], $acl, $curr_id);
							echo '</ul>';
						}
						echo '</li>';
					}
				}
				?>
				<ul class="fa-ul">
					<?php display_tree($role_tree, $acl, (isset($role->id) ? $role->id : 0)); ?>
				</ul>
			</div>
		</section>
	</div>
	<?php if (isset($role)): ?>
	<div class="col-lg-7">
		<?php echo form_open_multipart(uri_string(), array('class' => 'form-horizontal', 'id' => 'role-form', 'name' => 'role-form')); ?>
			<section class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title"><?php echo lang('rule_page_name') ?></h2>
				</div>
				<div class="panel-body">
					<?php echo form_hidden(array('id' => set_value('id', isset($role->id) ? $role->id : ''))); ?>
					<fieldset>
						<legend><?php echo lang('role_page_name'); ?></legend>
						<div class="form-group">
							<label class="col-sm-4 control-label">Nama</label>
							<div class="col-sm-8">
								<p class="form-control-static ">
									<a href="<?php echo site_url('acl/role/edit/' . $role->id) ?>"><?php echo $role->name ?></a>
								</p>
							</div>
						</div>
						<?php
						$parents_value = '';
						if (isset($role->parents) && count($role->parents) > 0)
						{
							foreach($role->parents as $index => $parent)
							{
								$parents_value .= '<a href="' . site_url('acl/rule/edit/' . $parent->parent) . '" style="display: block; padding: 0 0 .5em 20px;">';
								$parents_value .= '<i class="fa fa-user"></i>&nbsp;';
								$parents_value .= $parent->parent_name;
								$parents_value .= '</a>';
							}
						}
						else
							$parents_value = '-';
						?>
						<?php echo form_uneditable(lang('role_parents'), $parents_value); ?>
					</fieldset>
					<fieldset>
						<legend><?php echo lang('rule_page_name'); ?></legend>
						<table class="table table-bordered table-hover" id="table_resources">
							<thead>
								<tr>
									<th>Resource</th>
									<th style="width: 5em; text-align: center;"><?php echo lang('rule_allow'); ?></th>
									<th style="width: 5em; text-align: center;"><?php echo lang('rule_deny'); ?></th>
									<th style="width: 5em; text-align: center;"><?php echo lang('rule_inherited'); ?></th>
								</tr>
							</thead>
							<tbody>
								<tr class="tr-filter">
									<td>
										<span id="resource-filter-reset" class="fa fa-times"></span>
										<input type="text" class="form-control rounded" placeholder="Search" id="resource-filter" />
									</td>
									<td colspan="3">
										<select id="resource-access-filter" class="form-control">
											<option value="">(All)</option>
											<option value="success">Allow</option>
											<option value="danger">Deny</option>
										</select>
									</td>
								</tr>
								<?php
								function display_resource($role, $tree, $values, $acl, $sep, $iParent)
								{
									$i = 0;
									foreach($tree as $node):
										$i++;

										$checkname = 'rule_resource[' . $node['id'] . ']'; 
										$value = '';
										if (isset($values[$node['id']]))
											$value = $values[$node['id']]->access;

										if ($value == 'allow')
											$acl->removeAllow($role, $node['name']);
										elseif ($value == 'deny')
											$acl->removeDeny($role, $node['name']);

										$default_value = $acl->isAllowed($role, $node['name']) ? 'allow' : 'deny';

										$tr_class = '';
										if ($default_value == 'allow') {
											$tr_class = 'success';
										} elseif ($default_value == 'deny') {
											$tr_class = 'danger';
										}
										if ($value == 'allow') {
											$tr_class = 'success';
										} elseif ($value == 'deny') {
											$tr_class = 'danger';
										}
								?>
								<tr class="<?php echo $tr_class ?>">
									<?php
									$icon = 'fa-question';
									switch($node['type'])
									{
										case 'module':
											$icon = 'fa-folder-open-o';
											break;
										case 'controller':
											$icon = 'fa-file-text-o';
											break;
										case 'action':
											$icon = 'fa-gear';
											break;
									}
									?>
									<td class="resource-column" style="max-width: 200px; overflow-x: auto;">
										<?php echo $sep ?><i class="fa <?php echo $icon ?>"></i>&nbsp;&nbsp;<?php echo $node['name'] ?>
									</td>
									<td>
										<label class="i-switch bg-success">
											<input type="radio" id="allow<?php echo $iParent.'_'.$i?>" name="<?php echo $checkname ?>" value="allow" <?php echo set_radio($checkname, 'allow', ($value == 'allow')); ?> />
											<i></i>
										</label>
									</td>
									<td>
										<label class="i-switch bg-danger">
											<input type="radio" id="deny<?php echo $iParent.'_'.$i?>" name="<?php echo $checkname ?>" value="deny" <?php echo set_radio($checkname, 'deny', ($value == 'deny')); ?> />
											<i></i>
										</label>
									</td>
									<td>
										<label class="i-switch <?php echo ($default_value == 'allow') ? 'bg-success' : 'bg-danger'; ?>">
											<input type="radio" name="<?php echo $checkname ?>" value="" <?php echo set_radio($checkname, '', ($value == '')); ?> /> 
											<i></i>
										</label>
									</td>
								</tr>
								<?php	
										if (isset($node['children']))
											display_resource($role, $node['children'], $values, $acl, $sep . '&nbsp;&nbsp;&nbsp;&nbsp;', $iParent.'_'.$i);
									endforeach;
								}
								$sep = '';
								display_resource($role->name, $resources, $rules, $acl->acl, $sep, '');
								?>
							</tbody>
						</table>
					</fieldset>
				</div>
				<div class="panel-footer">
					<?php 
					if($acl->is_allowed('acl/rule/edit'))
					{
						echo form_button(array(
							'type' => 'submit',
							'name' => 'save-btn',
							'value' => 'save',
							'content' => '<i class="fa fa-check"></i> ' . lang('save'),
							'class' => 'btn btn-primary'
						));
					}
					?>
				</div>
			</section>
		<?php echo form_close(); ?>
	</div>
	<?php endif; ?>
</div>

<style>
.table > tbody > .tr-filter > td {
	padding: 5px;
	background-color: #fafbfc;
	position: relative;
}
#resource-filter-reset {
	position: absolute;
	top: 16px;
	right: 16px;
	cursor: pointer;
}
</style>
<script>
$(document).ready(function() {
	$('#table_resources').on('change', 'input[type="radio"]', function(){
		var $tr = $(this).parents('tr');
		var $check_radio = $tr.find(':checked');
		
		$tr.removeClass('success').removeClass('danger');
		if ($check_radio.parent('label').hasClass('bg-success'))
			$tr.addClass('success');
		else
			$tr.addClass('danger');
    });
	$('#resource-filter').on('keyup', function() {
		filter_resource();
	});
	$('#resource-filter-reset').on('click', function() {
		$('#resource-filter').val('').trigger('keyup');
	});
	$('#resource-access-filter').on('change', function() {
		filter_resource();
	});
});

function filter_resource() {
	var search = $('#resource-filter').val();
	var access = $('#resource-access-filter').val();
		
	$('.resource-column').each(function() {
		var $row = $(this).parent('tr');
		var resource = $(this).text();

		if (resource.search(new RegExp(search, "i")) < 0 || (access !== '' && !$row.hasClass(access))) {
			$row.hide();
		} else {
			$row.show();
		}
	});
}
</script>
