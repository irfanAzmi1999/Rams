$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.jenisKemalangan-new',function() {
    $('#modal-new-jenisKemalangan').modal('show');
    $('#form-new-jenisKemalangan')[0].reset();
	$('.message-form').html('');
});

$('#register-jenisKemalangan').click(function(){
	if($('#form-new-jenisKemalangan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterJenisKemalangan",
			type: "POST",
			data: $('#form-new-jenisKemalangan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-jenisKemalangan').modal('hide');
							$(location).attr('href','jenisKemalangan');
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

$(document).on('click','.jenisKemalangan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-jenisKemalangan').modal('show');
    $('#form-edit-jenisKemalangan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisKemalangan&id=" + id,
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

$('#update-jenisKemalangan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-jenisKemalangan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateJenisKemalangan&id=" + id,
			type: "POST",
			data: $('#form-edit-jenisKemalangan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-jenisKemalangan').modal('hide');
							$(location).attr('href','jenisKemalangan');
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

$(document).on('click','.jenisKemalangan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-jenisKemalangan').modal('show');
    $('#form-delete-jenisKemalangan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisKemalangan&id=" + id,
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

$('#delete-jenisKemalangan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteJenisKemalangan&id=" + id,
		type: "POST",
		data: $('#form-delete-jenisKemalangan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','jenisKemalangan');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});