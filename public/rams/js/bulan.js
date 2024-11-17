$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.bulan-new',function() {
    $('#modal-new-bulan').modal('show');
    $('#form-new-bulan')[0].reset();
	$('.message-form').html('');
});

$('#register-bulan').click(function(){
	if($('#form-new-bulan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterBulan",
			type: "POST",
			data: $('#form-new-bulan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-bulan').modal('hide');
							$(location).attr('href','bulan');
						}, 1000);
				}else{
					var error = '';
					$.each(data.error_form, function(k,v){
						error += v[0]+'<br/>';
					});
					$('.message-form').html('<div class="row">'+
												'<div class="col-md-12">'+
													'<div class="alert alert-danger alert-dismissable">'+
														'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
														error +
													'</div>'+
												'</div>'+    
											'</div>');
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}
		});
	}
});

$(document).on('click','.bulan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-bulan').modal('show');
    $('#form-edit-bulan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewBulan&id=" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data){
			$('[name="e_id"]').val(data.id);
			$('[name="e_name"]').val(data.name);
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});

$('#update-bulan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-bulan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateBulan&id=" + id,
			type: "POST",
			data: $('#form-edit-bulan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-bulan').modal('hide');
							$(location).attr('href','bulan');
						}, 1000);
				}else{
					$('.message-form').html(data.error_form);
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}
		});
	}
});

$(document).on('click','.bulan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-bulan').modal('show');
    $('#form-delete-bulan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewBulan&id=" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data){
			$('[name="d_id"]').val(data.id);
			$('[name="d_name"]').val(data.name);
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});

$('#delete-bulan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteBulan&id=" + id,
		type: "POST",
		data: $('#form-delete-bulan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','bulan');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});