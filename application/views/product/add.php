<div class="row">
<form method="post" action="<?php echo base_url('product/create'); ?>">
  <div class="col-md-8">
	<div class="form-group">
		<label>Product Name</label>
		<input name="product_name" value="" placeholder="Product Name" class="form-control">
	</div>
	<div class="form-group">
		<label>Product Price</label>
		<input name="product_price" value="" placeholder="price" class="form-control">
	</div>
	<div class="form-group">
		<label>Proudct Description</label>
		<textarea name="product_description" placeholder="Product Description" class="form-control"></textarea>
	</div>
  </div>
  <div class="clearfix"></div>
  <hr>
  <div class="form-group">
	<input type="submit" value="Save Product" class="btn btn-primary">
  </div>
</form>
</div>