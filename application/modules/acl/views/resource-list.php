<section class="grid_12">
	<div class="block-border">
		<div class="block-content">
			<h1>
				<?php echo lang('resource_page_name'); ?>
				<a href="<?php echo site_url('acl/resource/add') ?>?redirect=<?php echo urlencode(current_url_params()); ?>" class="resource-modal" title="<?php echo lang('resource_add_title'); ?>">
					<img height="16" width="16" src="<?php echo $assets_dir ?>images/icons/fugue/plus-circle-blue.png">
				</a>
			</h1>

			<form class="form" id="table_form" method="get" action="<?php echo current_url_params(); ?>">
				<div class="no-margin">
					<div class="block-controls">
						<?php if ($this->pagination->getTotalPage() > 1): ?>
						<ul class="controls-buttons">
							<?php echo str_replace("?page=","/",$this->pagination->create_links()); ?>
						</ul>
						<?php endif; ?>
					</div>
					
					<table class="table sortable no-margin" cellspacing="0" width="100%">

						<thead>
							<tr>
								<th scope="col">
									<?php echo sort_buttons('name'); ?>
									<?php echo lang('resource_name'); ?>
								</th>
								<th scope="col">
									<?php echo sort_buttons('parent_name'); ?>
									<?php echo lang('resource_parent'); ?>
								</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach($resources as $resource): ?>
							<tr>
								<td>
									<a href="<?php echo site_url('acl/resource/edit') . '/' . $resource->id ?>?redirect=<?php echo urlencode(current_url_params()); ?>" class="resource-modal">
										<?php echo $resource->name ?>
									</a>
								</td>
								<td>
									<a href="<?php echo site_url('acl/resource/edit') . '/' . $resource->parent ?>?redirect=<?php echo urlencode(current_url_params()); ?>" class="resource-modal">
										<?php echo $resource->parent_name ?>
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>

					</table>
					
					<div class="message no-margin">
						<?php printf(lang('showing_to_of'), local_number($page+1), local_number((($page+$per_page)>$total_rows) ? $total_rows :($page+$per_page)), local_number($total_rows)); ?>
					</div>
					
					<div class="block-footer clearfix">
						<div class="float-left">
							<?php 
								printf(lang('show_entries'), form_dropdown(
									'per_page',
									array(5 => 5, 10 => 10, 25 => 25, 50 => 50, 100 => 100),
									$per_page,
									'id="per_page" onchange="$(this).parents(\'form\').submit();"'
								)); 
							?>
						</div>
						<div class="float-right">
							Search: <input type="text" name="search" id="search" autocomplete="off" value="<?php echo $search ?>">
							<a href="#" class="big-button grey" onclick="$('#search').val('');$(this).parents('form').submit();return false;">Reset</a>
						</div>
					</div>
					
					<?php echo form_hidden(array(
						'page' => $page,
						'sort_by' => $sort_by,
						'sort_order' => $sort_order,
					)) ?>
				</div>
			</form>
		</div>
	</div>
</section>
<?php // $this->load->view('calendar/task-modal'); ?>