$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.jenisKawasan-new',function() {
    $('#modal-new-jenisKawasan').modal('show');
    $('#form-new-jenisKawasan')[0].reset();
	$('.message-form').html('');
});

$('#register-jenisKawasan').click(function(){
	if($('#form-new-jenisKawasan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterJenisKawasan",
			type: "POST",
			data: $('#form-new-jenisKawasan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-jenisKawasan').modal('hide');
							$(location).attr('href','jenisKawasan');
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

$(document).on('click','.jenisKawasan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-jenisKawasan').modal('show');
    $('#form-edit-jenisKawasan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisKawasan&id=" + id,
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

$('#update-jenisKawasan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-jenisKawasan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateJenisKawasan&id=" + id,
			type: "POST",
			data: $('#form-edit-jenisKawasan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-jenisKawasan').modal('hide');
							$(location).attr('href','jenisKawasan');
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

$(document).on('click','.jenisKawasan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-jenisKawasan').modal('show');
    $('#form-delete-jenisKawasan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisKawasan&id=" + id,
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

$('#delete-jenisKawasan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteJenisKawasan&id=" + id,
		type: "POST",
		data: $('#form-delete-jenisKawasan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','jenisKawasan');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});