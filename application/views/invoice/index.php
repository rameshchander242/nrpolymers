<table class="table table-stripe">
	<tr>
		<th>Invoice Number</th>
		<th>Company Name</th>
		<th>Contact</th>
		<th>Quanity</th>
		<th>Total</th>
		<th>Action</th>
	</tr>
	<?php if(!empty($invoices)){
		foreach($invoices as $invoice){
			echo '<tr>
				<td>'.$invoice->invoice_number.'</td>
				<td>'.$invoice->company_name.'</td>
				<td>'.$invoice->contact_number.'</td>
				<td>'.$invoice->quantity.'</td>
				<td>'.currency_format($invoice->total).'</td>
				<td>'.btn_edit('invoice/edit/'.$invoice->id).' &nbsp; '.btn_delete('invoice/destroy/'.$invoice->id).'</td>
			</tr>';
		}
	}else{
		echo '<tr><td colspan="6">Not any Record found.</td></tr>';
	} ?>
</table>

<p><?php echo anchor('invoice/add', 'Add New', 'class="btn btn-warning"'); ?></p>