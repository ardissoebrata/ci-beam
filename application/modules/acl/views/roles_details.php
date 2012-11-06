<div class="block-border">
<form action="<?php echo base_url().'index.php/acl/roles/details'; ?>" method="post" id="simple_form" class="block-content form">
<input type="hidden" name="id" id="id" value="<?php echo $id?>" />
	<h1>Role</h1>
	
			<label for="" class="required">Parent</label>

			<?php 
			foreach($role_structure as $role => $val): 

				$options[$role] = $val;

			 endforeach;

			echo form_dropdown('parent', $options, $parent);
			?>		  
		<br/>	
		
			<label for="" class="required">Nama</label>
			<input type="text" class="" value="<?php echo $name;?>" id="name" name="name" size="40">
		<br/>	
			<?php echo form_error('nama', '<ul class="message error">', '</ul>'); ?>
						
			<fieldset class="grey-bg no-margin">
				<p>
					<button value="Save" id="save" name="save"> Save </button>
					<button value="Back" id="back" name="back"> Back </button>
				</p>
			</fieldset>		
</form>
</div>