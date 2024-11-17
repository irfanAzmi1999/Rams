$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.jenisKawalan-new',function() {
    $('#modal-new-jenisKawalan').modal('show');
    $('#form-new-jenisKawalan')[0].reset();
	$('.message-form').html('');
});

$('#register-jenisKawalan').click(function(){
	if($('#form-new-jenisKawalan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterJenisKawalan",
			type: "POST",
			data: $('#form-new-jenisKawalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-jenisKawalan').modal('hide');
							$(location).attr('href','jenisKawalan');
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

$(document).on('click','.jenisKawalan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-jenisKawalan').modal('show');
    $('#form-edit-jenisKawalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisKawalan&id=" + id,
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

$('#update-jenisKawalan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-jenisKawalan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateJenisKawalan&id=" + id,
			type: "POST",
			data: $('#form-edit-jenisKawalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-jenisKawalan').modal('hide');
							$(location).attr('href','jenisKawalan');
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

$(document).on('click','.jenisKawalan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-jenisKawalan').modal('show');
    $('#form-delete-jenisKawalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisKawalan&id=" + id,
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

$('#delete-jenisKawalan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteJenisKawalan&id=" + id,
		type: "POST",
		data: $('#form-delete-jenisKawalan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','jenisKawalan');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});