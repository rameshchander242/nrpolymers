<div class="col-md-4 col-md-offset-4">
	<div class="login-panel panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Please Sign In</h3>
		</div>
		<div class="panel-body">
			<p><?php echo lang('login_subheading');?></p>
			<?php if(isset($message)){ echo '<div class="alert alert-danger">'.$message.'</div>'; } ?>
			<?php echo form_open("login");?>
				<fieldset>
					<div class="form-group">
						<?php echo form_input($identity);?>
					</div>
					<div class="form-group">
						<?php echo form_input($password);?>
					</div>
					<div class="checkbox">
						<label>
							<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?><?php echo lang('login_remember_label', 'remember');?>
						</label>
					</div>
					<!-- Change this to a button or input when using this as a form -->
					<?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-lg btn-success btn-block"');?>
				</fieldset>
			<?php echo form_close();?>
		</div>
	</div>
</div>