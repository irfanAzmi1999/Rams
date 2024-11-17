$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.jenisBahuJalan-new',function() {
    $('#modal-new-jenisBahuJalan').modal('show');
    $('#form-new-jenisBahuJalan')[0].reset();
	$('.message-form').html('');
});

$('#register-jenisBahuJalan').click(function(){
	if($('#form-new-jenisBahuJalan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterJenisBahuJalan",
			type: "POST",
			data: $('#form-new-jenisBahuJalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-jenisBahuJalan').modal('hide');
							$(location).attr('href','jenisBahuJalan');
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

$(document).on('click','.jenisBahuJalan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-jenisBahuJalan').modal('show');
    $('#form-edit-jenisBahuJalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisBahuJalan&id=" + id,
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

$('#update-jenisBahuJalan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-jenisBahuJalan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateJenisBahuJalan&id=" + id,
			type: "POST",
			data: $('#form-edit-jenisBahuJalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-jenisBahuJalan').modal('hide');
							$(location).attr('href','jenisBahuJalan');
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

$(document).on('click','.jenisBahuJalan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-jenisBahuJalan').modal('show');
    $('#form-delete-jenisBahuJalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisBahuJalan&id=" + id,
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

$('#delete-jenisBahuJalan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteJenisBahuJalan&id=" + id,
		type: "POST",
		data: $('#form-delete-jenisBahuJalan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','jenisBahuJalan');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});