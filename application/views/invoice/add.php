<div class="row">
  <div class="col-md-11">
	<form method="post" action="<?php echo base_url('product/create'); ?>">
		<div class="col-sm-8 row">
			<div class="form-group col-xs-6">
				<label>Invoice Number</label>
				<input name="invoice_number" value="" placeholder="Invoice Number" class="form-control">
			</div>
			<div class="form-group col-xs-6">
				<label>Invoice Date</label>
				<input name="invoice_date" value="" placeholder="Invoice Date" class="form-control">
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="pull-left">Company Information</h4>
				<input type="button" class="pull-right btn btn-default selectCompany" value="Select Company">
				<div class="clearfix"></div>
			</div>
			<div class="panel-body row">
				<div class="form-group col-xs-6">
					<label>Company Name</label>
					<input name="company_name" id="company_name" value="" placeholder="Company" class="form-control">
				</div>
				<div class="form-group col-xs-6">
					<label>Customer Name</label>
					<input name="customer_name" id="customer_name" value="" placeholder="Customer name" class="form-control">
				</div>
				<div class="form-group col-xs-6">
					<label>Contact Number</label>
					<input name="contact_number" id="contact_number" value="" placeholder="Contact Number" class="form-control">
				</div>
				<div class="form-group col-xs-6">
					<label>GST Number</label>
					<input name="gstin" id="gstin" value="" placeholder="GST Number" class="form-control">
				</div>
				<div class="form-group col-lg-12">
					<label>Address Detail</label>
					<textarea name="address_detail" id="address_detail" placeholder="Address" class="form-control"></textarea>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<table class="table table-striped" id="invoice_table">
			<tr>
				<th width="50%"><a href="#" class="btn btn-success btn-xs add-row"><i class="fa fa-plus"></i></a> &nbsp; Product</th>
				<th>Bags</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Sub-Total</th>
			</tr>
			<tr class="clone_tr">
				<td>
					<div class="form-group ">
						<a href="#" class="btn btn-danger btn-xs delete-row"><span class="fa fa-remove" aria-hidden="true"></span></a>
						<input type="text" class="form-control item-input invoice_product" name="product_name[]" placeholder="Enter item title and / or description">
						<p class="item-select">or <a href="#">select an item</a></p>
					</div>
				</td>
				<td class="text-right">
					<div class="form-group"><input type="number" class="form-control invoice_product_bags" name="invoice_bags[]" value="1"></div>
				</td>
				<td class="text-right">
					<div class="form-group"><input type="number" class="form-control invoice_product_qty calculate" name="product_quantity[]" value="30"></div>
				</td>
				<td class="text-right">
					<div class="input-group input-group-sm ">
						<span class="input-group-addon"><?php echo currency_sign(); ?></span>
						<input type="text" class="form-control calculate invoice_product_price required" name="product_price[]" aria-describedby="sizing-addon1" placeholder="0.00">
					</div>
				</td>
				<td class="text-right">
					<div class="input-group input-group-sm">
						<span class="input-group-addon"><?php echo currency_sign(); ?></span>
						<input type="text" class="form-control calculate-sub" name="product_sub[]" id="invoice_product_sub" value="0.00" aria-describedby="sizing-addon1" disabled="">
					</div>
				</td>
			</tr>
			<tr class="subTotal">
				<td colspan="3" rowspan="3"><textarea class="col-sm-8" rows="4"></textarea></td>
				<td class="text-right bold">Sub Total:</td><td class="text-right"><?php echo currency_sign(); ?> <span class="sub_total">0.00</span></td>
			</tr>
			<tr><td class="text-right bold">SGST(9%):</td><td class="text-right"><?php echo currency_sign(); ?> <span class="gst_sgst">0.00</span></td></tr>
			<tr><td class="text-right bold">CGST(9%):</td><td class="text-right"><?php echo currency_sign(); ?> <span class="gst_cgst">0.00</span></td></tr>
			<tr><td colspan="3"></td><td class="text-right bold">Total:</td><td class="text-right"><?php echo currency_sign(); ?> <span id="total">0.00</span></td></tr>
		</table>
	  <div class="clearfix"></div>
	  <hr>
	  <div class="form-group text-right">
		<input type="submit" value="Create Invoice" class="btn btn-success">
	  </div>
	</form>
  </div>
</div>

<div id="insert" class="modal fade">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Select an item</h4>
	  </div>
	  <div class="modal-body">
		<select id="select_product" class="form-control">
			<option value=""> - Select Company - </option>
			<?php foreach($products as $product){
				echo '<option value="'.$product->product_price.'">'.$product->product_name.'</option>';
			} ?>
		</select>
	  </div>
	  <div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-primary" id="selected">Add</button>
		<button type="button" data-dismiss="modal" class="btn">Cancel</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="insert_customer" class="modal fade">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Select an existing Company</h4>
	  </div>
	  <div class="modal-body">
		<select id="select_company" class="form-control">
			<option value=""> - Select Company - </option>
			<?php foreach($companies as $company){
				echo '<option value="'.$company->id.'" data-company_name="'.$company->company_name.'" data-customer_name="'.$company->customer_name.'" data-contact_number="'.$company->contact_number.'" data-gstin="'.$company->gstin.'" data-city="'.$company->city.'" data-state="'.$company->state.'" data-pincode="'.$company->pincode.'" data-address="'.$company->address.'">'.$company->company_name.'('.$company->customer_name.' - '.$company->contact_number.')</option>';
			} ?>
		</select>
	  </div>
	  <div class="modal-footer">
		<button type="button" id="select_company_btn" class="btn btn-primary">Select Company</button>
		<button type="button" data-dismiss="modal" class="btn">Cancel</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
