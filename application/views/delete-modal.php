
<div id="delete-modal" class="modal hide fade" style="display: none;">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3><?php echo lang('confirmation'); ?></h3>
	</div>
	<div class="modal-body">
		<p><?php echo lang('are_you_sure'); ?></p>
	</div>
	<div class="modal-footer">
		<a id="delete-modal-cancel" href="#" class="btn" data-dismiss="modal"><?php echo lang('cancel'); ?></a>
		<a id="delete-modal-continue" href="#" class="btn btn-danger"><?php echo lang('continue'); ?></a>
	</div>
</div>
<script>
$('[data-button=delete]').on('click', function(e) {
	$('#delete-modal-continue').attr('href', $(this).attr('href'));
	$('#delete-modal').modal('show');
	e.preventDefault();
});
</script>