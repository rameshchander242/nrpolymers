<?php $this->load->view('layouts/header.php'); ?>
<div id="wrapper">
	<?php $this->load->view('layouts/header_top.php'); ?>
	<div id="page-wrapper">
		<?php echo error_message($this); ?>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?php echo $title; ?></h1>
			</div>
		</div>
		<?php $this->load->view($view_content); ?>
	
	</div>

	<?php $this->load->view('layouts/footer_bottom.php'); ?>
</div>
<?php $this->load->view('layouts/footer.php'); ?>