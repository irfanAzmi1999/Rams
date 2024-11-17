$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.balai-new',function() {
    $('#modal-new-balai').modal('show');
    $('#form-new-balai')[0].reset();
	$('.message-form').html('');
});

$('#register-balai').click(function(){
	if($('#form-new-balai').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterBalai",
			type: "POST",
			data: $('#form-new-balai').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-balai').modal('hide');
							$(location).attr('href','balai');
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

$(document).on('click','.balai-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-balai').modal('show');
    $('#form-edit-balai')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewBalai&id=" + id,
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

$('#update-balai').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-balai').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateBalai&id=" + id,
			type: "POST",
			data: $('#form-edit-balai').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-balai').modal('hide');
							$(location).attr('href','balai');
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

$(document).on('click','.balai-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-balai').modal('show');
    $('#form-delete-balai')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewBalai&id=" + id,
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

$('#delete-balai').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteBalai&id=" + id,
		type: "POST",
		data: $('#form-delete-balai').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','balai');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});