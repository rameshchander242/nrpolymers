<table class="table table-stripe">
	<tr>
		<th>Company Name</th>
		<th>Customer Name</th>
		<th>Mobile</th>
		<th>Address</th>
		<th>Action</th>
	</tr>
	<?php if(!empty($companies)){
		foreach($companies as $company){
			echo '<tr>
				<td>'.$company->company_name.'</td>
				<td>'.$company->customer_name.'</td>
				<td>'.$company->contact_number.'</td>
				<td>'.$company->address.'</td>
				<td>'.btn_edit('company/edit/'.$company->id).' &nbsp; '.btn_delete('company/destroy/'.$company->id).'</td>
			</tr>';
		}
	}else{
		echo '<tr><td colspan="5">Not any Record found.</td></tr>';
	} ?>
</table>

<p><?php echo anchor('company/add', 'Add New', 'class="btn btn-warning"'); ?></p>