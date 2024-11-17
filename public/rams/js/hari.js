$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.hari-new',function() {
    $('#modal-new-hari').modal('show');
    $('#form-new-hari')[0].reset();
	$('.message-form').html('');
});

$('#register-hari').click(function(){
	if($('#form-new-hari').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterHari",
			type: "POST",
			data: $('#form-new-hari').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-hari').modal('hide');
							$(location).attr('href','hari');
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

$(document).on('click','.hari-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-hari').modal('show');
    $('#form-edit-hari')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewHari&id=" + id,
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

$('#update-hari').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-hari').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateHari&id=" + id,
			type: "POST",
			data: $('#form-edit-hari').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-hari').modal('hide');
							$(location).attr('href','hari');
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

$(document).on('click','.hari-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-hari').modal('show');
    $('#form-delete-hari')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewHari&id=" + id,
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

$('#delete-hari').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteHari&id=" + id,
		type: "POST",
		data: $('#form-delete-hari').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','hari');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});