$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.jenisJalan-new',function() {
    $('#modal-new-jenisJalan').modal('show');
    $('#form-new-jenisJalan')[0].reset();
	$('.message-form').html('');
});

$('#register-jenisJalan').click(function(){
	if($('#form-new-jenisJalan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterJenisJalan",
			type: "POST",
			data: $('#form-new-jenisJalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-jenisJalan').modal('hide');
							$(location).attr('href','jenisJalan');
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

$(document).on('click','.jenisJalan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-jenisJalan').modal('show');
    $('#form-edit-jenisJalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisJalan&id=" + id,
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

$('#update-jenisJalan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-jenisJalan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateJenisJalan&id=" + id,
			type: "POST",
			data: $('#form-edit-jenisJalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-jenisJalan').modal('hide');
							$(location).attr('href','jenisJalan');
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

$(document).on('click','.jenisJalan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-jenisJalan').modal('show');
    $('#form-delete-jenisJalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisJalan&id=" + id,
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

$('#delete-jenisJalan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteJenisJalan&id=" + id,
		type: "POST",
		data: $('#form-delete-jenisJalan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','jenisJalan');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});