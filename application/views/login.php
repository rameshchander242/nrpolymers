<div class="col-md-4 col-md-offset-4">
	<div class="login-panel panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Please Sign In</h3>
		</div>
		<div class="panel-body">
			<?php if(isset($message)){ echo '<div class="alert alert-error">'.$message.'</div>'; } ?>
			<?php echo form_open("auth/login");?>
				<fieldset>
					<div class="form-group">
						<?php echo form_input($identity);?>
					</div>
					<div class="form-group">
						<input class="form-control" placeholder="Password" name="password" type="password" value="">
					</div>
					<div class="checkbox">
						<label>
							<input name="remember" type="checkbox" value="Remember Me">Remember Me
						</label>
					</div>
					<!-- Change this to a button or input when using this as a form -->
					<a href="index.html" class="btn btn-lg btn-success btn-block">Login</a>
				</fieldset>
			</form>
		</div>
	</div>
</div>
			

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/login");?>

  <p>
    <?php echo lang('login_identity_label', 'identity');?>
    <?php echo form_input($identity);?>
  </p>

  <p>
    <?php echo lang('login_password_label', 'password');?>
    <?php echo form_input($password);?>
  </p>

  <p>
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>


  <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>

<?php echo form_close();?>

<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>