$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.role-new',function() {
    $('#modal-new-role').modal('show');
    $('#form-new-role')[0].reset();
	$('.message-form').html('');
});

$('#register-role').click(function(){
	if($('#form-new-role').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterRole",
			type: "POST",
			data: $('#form-new-role').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-role').modal('hide');
							$(location).attr('href','userRole');
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

$(document).on('click','.role-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-role').modal('show');
    $('#form-edit-role')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewRole&id=" + id,
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

$('#update-role').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-role').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateRole&id=" + id,
			type: "POST",
			data: $('#form-edit-role').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-role').modal('hide');
							$(location).attr('href','userRole');
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

$(document).on('click','.role-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-role').modal('show');
    $('#form-delete-role')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewRole&id=" + id,
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

$('#delete-role').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteRole&id=" + id,
		type: "POST",
		data: $('#form-delete-role').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','userRole');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});