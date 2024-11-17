$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.jenisTempat-new',function() {
    $('#modal-new-jenisTempat').modal('show');
    $('#form-new-jenisTempat')[0].reset();
	$('.message-form').html('');
});

$('#register-jenisTempat').click(function(){
	if($('#form-new-jenisTempat').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterJenisTempat",
			type: "POST",
			data: $('#form-new-jenisTempat').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-jenisTempat').modal('hide');
							$(location).attr('href','jenisTempat');
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

$(document).on('click','.jenisTempat-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-jenisTempat').modal('show');
    $('#form-edit-jenisTempat')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisTempat&id=" + id,
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

$('#update-jenisTempat').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-jenisTempat').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateJenisTempat&id=" + id,
			type: "POST",
			data: $('#form-edit-jenisTempat').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-jenisTempat').modal('hide');
							$(location).attr('href','jenisTempat');
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

$(document).on('click','.jenisTempat-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-jenisTempat').modal('show');
    $('#form-delete-jenisTempat')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisTempat&id=" + id,
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

$('#delete-jenisTempat').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteJenisTempat&id=" + id,
		type: "POST",
		data: $('#form-delete-jenisTempat').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','jenisTempat');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});