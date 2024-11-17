$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.bentukJalan-new',function() {
    $('#modal-new-bentukJalan').modal('show');
    $('#form-new-bentukJalan')[0].reset();
	$('.message-form').html('');
});

$('#register-bentukJalan').click(function(){
	if($('#form-new-bentukJalan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterBentukJalan",
			type: "POST",
			data: $('#form-new-bentukJalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-bentukJalan').modal('hide');
							$(location).attr('href','bentukJalan');
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

$(document).on('click','.bentukJalan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-bentukJalan').modal('show');
    $('#form-edit-bentukJalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewBentukJalan&id=" + id,
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

$('#update-bentukJalan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-bentukJalan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateBentukJalan&id=" + id,
			type: "POST",
			data: $('#form-edit-bentukJalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-bentukJalan').modal('hide');
							$(location).attr('href','bentukJalan');
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

$(document).on('click','.bentukJalan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-bentukJalan').modal('show');
    $('#form-delete-bentukJalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewBentukJalan&id=" + id,
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

$('#delete-bentukJalan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteBentukJalan&id=" + id,
		type: "POST",
		data: $('#form-delete-bentukJalan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','bentukJalan');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});