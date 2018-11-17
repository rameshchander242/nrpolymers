<table class="table table-stripe">
	<tr>
		<th>Product Name</th>
		<th>Product Price</th>
		<th>Action</th>
	</tr>
	<?php if(!empty($products)){
		foreach($products as $product){
			echo '<tr>
				<td>'.$product->product_name.'</td>
				<td>'.currency_format($product->product_price).'</td>
				<td>'.btn_edit('product/edit/'.$product->id).' &nbsp; '.btn_delete('product/destroy/'.$product->id).'</td>
			</tr>';
		}
	}else{
		echo '<tr><td colspan="5">Not any Record found.</td></tr>';
	} ?>
</table>

<p><?php echo anchor('product/add', 'Add New', 'class="btn btn-warning"'); ?></p>