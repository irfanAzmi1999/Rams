$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.keadaanJalan-new',function() {
    $('#modal-new-keadaanJalan').modal('show');
    $('#form-new-keadaanJalan')[0].reset();
	$('.message-form').html('');
});

$('#register-keadaanJalan').click(function(){
	if($('#form-new-keadaanJalan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterKeadaanJalan",
			type: "POST",
			data: $('#form-new-keadaanJalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-keadaanJalan').modal('hide');
							$(location).attr('href','keadaanJalan');
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

$(document).on('click','.keadaanJalan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-keadaanJalan').modal('show');
    $('#form-edit-keadaanJalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewKeadaanJalan&id=" + id,
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

$('#update-keadaanJalan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-keadaanJalan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateKeadaanJalan&id=" + id,
			type: "POST",
			data: $('#form-edit-keadaanJalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-keadaanJalan').modal('hide');
							$(location).attr('href','keadaanJalan');
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

$(document).on('click','.keadaanJalan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-keadaanJalan').modal('show');
    $('#form-delete-keadaanJalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewKeadaanJalan&id=" + id,
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

$('#delete-keadaanJalan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteKeadaanJalan&id=" + id,
		type: "POST",
		data: $('#form-delete-keadaanJalan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','keadaanJalan');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});