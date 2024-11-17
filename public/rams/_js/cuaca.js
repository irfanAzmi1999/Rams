$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.cuaca-new',function() {
    $('#modal-new-cuaca').modal('show');
    $('#form-new-cuaca')[0].reset();
	$('.message-form').html('');
});

$('#register-cuaca').click(function(){
	if($('#form-new-cuaca').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterCuaca",
			type: "POST",
			data: $('#form-new-cuaca').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-cuaca').modal('hide');
							$(location).attr('href','cuaca');
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

$(document).on('click','.cuaca-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-cuaca').modal('show');
    $('#form-edit-cuaca')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewCuaca&id=" + id,
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

$('#update-cuaca').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-cuaca').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateCuaca&id=" + id,
			type: "POST",
			data: $('#form-edit-cuaca').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-cuaca').modal('hide');
							$(location).attr('href','cuaca');
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

$(document).on('click','.cuaca-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-cuaca').modal('show');
    $('#form-delete-cuaca')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewCuaca&id=" + id,
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

$('#delete-cuaca').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteCuaca&id=" + id,
		type: "POST",
		data: $('#form-delete-cuaca').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','cuaca');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});