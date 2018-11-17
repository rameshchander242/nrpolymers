<div class="row">
<form method="post" action="<?php echo base_url('company/update/'.$company->id); ?>">
  <div class="col-sm-6">
	<div class="form-group">
		<label>Company Name</label>
		<input name="company_name" value="<?php echo $company->company_name; ?>" placeholder="Company Name" class="form-control">
	</div>
	<div class="form-group">
		<label>Customer Name</label>
		<input name="customer_name" value="<?php echo $company->customer_name; ?>" placeholder="Customer Name" class="form-control">
	</div>
	<div class="form-group">
		<label>Contact Number</label>
		<input name="contact_number" value="<?php echo $company->contact_number; ?>" placeholder="Contact Number" class="form-control">
	</div>
	<hr>
	<div class="contacts_more">
	<?php
		$more_contacts = json_decode($company->more_contacts);
		if(!empty($more_contacts)){ foreach($more_contacts->name as $key=>$contact){
			echo '<div class="row">
				<div class="col-xs-6 form-group"><label>Contact Name</label><input type="text" class="form-control" name="more_contacts[name][]" value="'.$more_contacts->name[$key].'"></div>
				<div class="col-xs-6 form-group"><label>Contact Number</label><input type="text" class="form-control" name="more_contacts[number][]" value="'.$more_contacts->number[$key].'"></div>
				<i class="fa fa-times-circle text-danger close_more"></i>
			</div>';
		}}
	?>
	</div>
	<input class="btn btn-default add_more_contacts pull-right" type="button" value="Add more contacts">
  </div>
  <div class="col-sm-6">
	<div class="form-group">
		<label>Address</label>
		<textarea name="address" placeholder="Address" class="form-control"><?php echo $company->address; ?></textarea>
	</div>
	<div class="form-group">
		<label>City</label>
		<input name="city" value="<?php echo $company->city; ?>" placeholder="City" class="form-control">
	</div>
	<div class="form-group">
		<label>State</label>
		<input name="state" value="<?php echo $company->state; ?>" placeholder="State" class="form-control">
	</div>
	<div class="form-group">
		<label>Pincode</label>
		<input name="pincode" value="<?php echo $company->pincode; ?>" placeholder="Pincode" class="form-control">
	</div>
  </div>
  <div class="clearfix"></div>
  <hr>
  <div class="form-group">
	<input type="submit" value="Save Contact" class="btn btn-primary">
  </div>
</form>
</div>