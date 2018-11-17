<div class="row">
<form method="post" action="<?php echo base_url('company/create'); ?>">
  <div class="col-sm-6">
	<div class="form-group">
		<label>Company Name</label>
		<input name="company_name" value="" placeholder="Company Name" class="form-control">
	</div>
	<div class="form-group">
		<label>Customer Name</label>
		<input name="customer_name" value="" placeholder="Customer Name" class="form-control">
	</div>
	<div class="form-group">
		<label>Contact Number</label>
		<input name="contact_number" value="" placeholder="Contact Number" class="form-control">
	</div>
	<hr>
	<div class="contacts_more"></div>
	<input class="btn btn-default add_more_contacts pull-right" type="button" value="Add more contacts">
  </div>
  <div class="col-sm-6">
	<div class="form-group">
		<label>Address</label>
		<textarea name="address" placeholder="Address" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<label>City</label>
		<input name="city" value="" placeholder="City" class="form-control">
	</div>
	<div class="form-group">
		<label>State</label>
		<input name="state" value="" placeholder="State" class="form-control">
	</div>
	<div class="form-group">
		<label>Pincode</label>
		<input name="pincode" value="" placeholder="Pincode" class="form-control">
	</div>
  </div>
  <div class="clearfix"></div>
  <hr>
  <div class="form-group">
	<input type="submit" value="Save Contact" class="btn btn-primary">
  </div>
</form>
</div>