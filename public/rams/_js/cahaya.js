$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.cahaya-new',function() {
    $('#modal-new-cahaya').modal('show');
    $('#form-new-cahaya')[0].reset();
	$('.message-form').html('');
});

$('#register-cahaya').click(function(){
	if($('#form-new-cahaya').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterCahaya",
			type: "POST",
			data: $('#form-new-cahaya').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-cahaya').modal('hide');
							$(location).attr('href','cahaya');
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

$(document).on('click','.cahaya-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-cahaya').modal('show');
    $('#form-edit-cahaya')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewCahaya&id=" + id,
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

$('#update-cahaya').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-cahaya').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateCahaya&id=" + id,
			type: "POST",
			data: $('#form-edit-cahaya').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-cahaya').modal('hide');
							$(location).attr('href','cahaya');
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

$(document).on('click','.cahaya-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-cahaya').modal('show');
    $('#form-delete-cahaya')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewCahaya&id=" + id,
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

$('#delete-cahaya').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteCahaya&id=" + id,
		type: "POST",
		data: $('#form-delete-cahaya').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','cahaya');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});