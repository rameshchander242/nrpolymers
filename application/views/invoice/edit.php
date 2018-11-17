<div class="row">
<form method="post" action="<?php echo base_url('product/update/'.$product->id); ?>">
  <div class="col-sm-6">
	<div class="form-group">
		<label>Product Name</label>
		<input name="product_name" value="<?php echo $product->product_name; ?>" placeholder="Product Name" class="form-control">
	</div>
	<div class="form-group">
		<label>Product Price</label>
		<input name="product_price" value="<?php echo $product->product_price; ?>" placeholder="Price" class="form-control">
	</div>
	<div class="form-group">
		<label>Product Description</label>
		<textarea name="product_description" placeholder="Description" class="form-control"><?php echo $product->product_description; ?></textarea>
	</div>
  </div>
  <div class="clearfix"></div>
  <hr>
  <div class="form-group">
	<input type="submit" value="Save Product" class="btn btn-primary">
  </div>
</form>
</div>