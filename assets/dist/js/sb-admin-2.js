$(function() {
    $('#side-menu').metisMenu();
});

$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;

    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
	
	$(document).on('click', ".item-select", function(e) {
   		e.preventDefault;
   		var product = $(this);
   		$('#insert').modal({ backdrop: 'static', keyboard: false }).one('click', '#selected', function(e) {

		    var itemText = $('#insert').find("option:selected").text();
		    var itemValue = $('#insert').find("option:selected").val();
console.log(itemValue);
		    $(product).closest('tr').find('.invoice_product').val(itemText);
		    $(product).closest('tr').find('.invoice_product_price').val(itemValue);

		    updateTotals('.calculate');
        	calculateTotal();

   		});

   		return false;

   	});

   	$(document).on('click', ".selectCompany", function(e) {
   		e.preventDefault;
   		var customer = $(this);
   		$('#insert_customer').modal({ backdrop: 'static', keyboard: false });
   		return false;
   	});

   	$(document).on('click', "#select_company_btn", function(e) {
		let selected_option = $('#select_company option:selected');
		var company_name = selected_option.attr('data-company_name');
		var customer_name = selected_option.attr('data-customer_name');
		var contact_number = selected_option.attr('data-contact_number');
		var gstin = selected_option.attr('data-gstin');
		var address_detail = selected_option.attr('data-address')+', '+selected_option.attr('data-city')+', '+selected_option.attr('data-state')+', '+selected_option.attr('data-pincode');
		
		$('#company_name').val(company_name);
		$('#customer_name').val(customer_name);
		$('#contact_number').val(contact_number);
		$('#gstin').val(gstin);
		$('#address_detail').val(address_detail);
		$('#insert_customer').modal('hide');
	});
	
	
    $('#invoice_table').on('click', ".delete-row", function(e) {
    	e.preventDefault();
       	$(this).closest('tr').remove();
        calculateTotal();
    });
	var cloned = $('#invoice_table tr.clone_tr').clone();
    $(".add-row").click(function(e) {
        e.preventDefault();
        cloned.removeClass('clone_tr').clone().insertBefore('#invoice_table tr.subTotal'); 
    });
	
	
    
    $('#invoice_table').on('input', '.invoice_product_bags', function () {
		let qty = $(this).val() * 30;
		$(this).parent().parent().next('td').find('.invoice_product_qty').val(qty)
	});
    
    $('#invoice_table').on('input', '.calculate', function () {
	    updateTotals(this);
	    calculateTotal();
	});

	$('#invoice_totals').on('input', '.calculate', function () {
	    calculateTotal();
	});

	$('#invoice_product').on('input', '.calculate', function () {
	    calculateTotal();
	});

	$('.remove_vat').on('change', function() {
        calculateTotal();
    });
    
    calculateTotal();

	
	
	$('.add_more_contacts').click(function(){
		$('.contacts_more').append('<div class="row"><div class="form-group col-xs-6"><label>Contact Name</label><input type="text" name="more_contacts[name][]" class="form-control" value=""></div><div class="form-group col-xs-6"><label>Contact Number</label><input type="text" name="more_contacts[number][]" class="form-control" value=""></div><i class="fa fa-times-circle text-danger close_more"></i></div>');
	});
	
	$(document).on('click', '.close_more', function(){
		$(this).parent('div').remove();
	});
});

function updateTotals(elem) {

	var tr = $(elem).closest('tr'),
		quantity = $('.invoice_product_qty', tr).val(),
		price = $('.invoice_product_price', tr).val(),
		subtotal = parseInt(quantity) * parseFloat(price);
	console.log(subtotal);
	$('.calculate-sub', tr).val(subtotal.toFixed(2));
}

function calculateTotal() {
	
	var grandTotal = 0,
		disc = 0,
		c_ship = parseInt($('.calculate.shipping').val()) || 0;

	$('#invoice_table tbody tr').each(function() {
		var c_sbt = $('.calculate-sub', this).val(),
			quantity = $('[name="invoice_product_qty[]"]', this).val(),
			price = $('[name="invoice_product_price[]"]', this).val() || 0,
			subtotal = parseInt(quantity) * parseFloat(price);
		
		grandTotal += parseFloat(c_sbt);
		disc += subtotal - parseFloat(c_sbt);
	});

	// VAT, DISCOUNT, SHIPPING, TOTAL, SUBTOTAL:
	var subT = parseFloat(grandTotal),
		finalTotal = parseFloat(grandTotal + c_ship),
		vat = parseInt($('.invoice-vat').attr('data-vat-rate'));

	$('.invoice-sub-total').text(subT.toFixed(2));
	$('#invoice_subtotal').val(subT.toFixed(2));
	$('.invoice-discount').text(disc.toFixed(2));
	$('#invoice_discount').val(disc.toFixed(2));

	if($('.invoice-vat').attr('data-enable-vat') === '1') {

		if($('.invoice-vat').attr('data-vat-method') === '1') {
			$('.invoice-vat').text(((vat / 100) * finalTotal).toFixed(2));
			$('#invoice_vat').val(((vat / 100) * finalTotal).toFixed(2));
			$('.invoice-total').text((finalTotal).toFixed(2));
			$('#invoice_total').val((finalTotal).toFixed(2));
		} else {
			$('.invoice-vat').text(((vat / 100) * finalTotal).toFixed(2));
			$('#invoice_vat').val(((vat / 100) * finalTotal).toFixed(2));
			$('.invoice-total').text((finalTotal + ((vat / 100) * finalTotal)).toFixed(2));
			$('#invoice_total').val((finalTotal + ((vat / 100) * finalTotal)).toFixed(2));
		}
	} else {
		$('.invoice-total').text((finalTotal).toFixed(2));
		$('#invoice_total').val((finalTotal).toFixed(2));
	}

	// remove vat
	if($('input.remove_vat').is(':checked')) {
		$('.invoice-vat').text("0.00");
		$('#invoice_vat').val("0.00");
		$('.invoice-total').text((finalTotal).toFixed(2));
		$('#invoice_total').val((finalTotal).toFixed(2));
	}

}
