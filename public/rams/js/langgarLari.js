$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.langgarLari-new',function() {
    $('#modal-new-langgarLari').modal('show');
    $('#form-new-langgarLari')[0].reset();
	$('.message-form').html('');
});

$('#register-langgarLari').click(function(){
	if($('#form-new-langgarLari').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterLanggarLari",
			type: "POST",
			data: $('#form-new-langgarLari').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-langgarLari').modal('hide');
							$(location).attr('href','langgarLari');
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

$(document).on('click','.langgarLari-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-langgarLari').modal('show');
    $('#form-edit-langgarLari')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewLanggarLari&id=" + id,
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

$('#update-langgarLari').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-langgarLari').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateLanggarLari&id=" + id,
			type: "POST",
			data: $('#form-edit-langgarLari').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-langgarLari').modal('hide');
							$(location).attr('href','langgarLari');
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

$(document).on('click','.langgarLari-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-langgarLari').modal('show');
    $('#form-delete-langgarLari')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewLanggarLari&id=" + id,
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

$('#delete-langgarLari').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteLanggarLari&id=" + id,
		type: "POST",
		data: $('#form-delete-langgarLari').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','langgarLari');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});