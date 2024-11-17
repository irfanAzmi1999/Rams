$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.arah-new',function() {
    $('#modal-new-arah').modal('show');
    $('#form-new-arah')[0].reset();
	$('.message-form').html('');
});

$('#register-arah').click(function(){
	if($('#form-new-arah').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterArah",
			type: "POST",
			data: $('#form-new-arah').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-arah').modal('hide');
							$(location).attr('href','arah');
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

$(document).on('click','.arah-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-arah').modal('show');
    $('#form-edit-arah')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewArah&id=" + id,
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

$('#update-arah').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-arah').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateArah&id=" + id,
			type: "POST",
			data: $('#form-edit-arah').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-arah').modal('hide');
							$(location).attr('href','arah');
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

$(document).on('click','.arah-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-arah').modal('show');
    $('#form-delete-arah')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewArah&id=" + id,
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

$('#delete-arah').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteArah&id=" + id,
		type: "POST",
		data: $('#form-delete-arah').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','arah');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});