$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.jenisGaris-new',function() {
    $('#modal-new-jenisGaris').modal('show');
    $('#form-new-jenisGaris')[0].reset();
	$('.message-form').html('');
});

$('#register-jenisGaris').click(function(){
	if($('#form-new-jenisGaris').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterJenisGaris",
			type: "POST",
			data: $('#form-new-jenisGaris').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-jenisGaris').modal('hide');
							$(location).attr('href','jenisGaris');
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

$(document).on('click','.jenisGaris-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-jenisGaris').modal('show');
    $('#form-edit-jenisGaris')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisGaris&id=" + id,
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

$('#update-jenisGaris').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-jenisGaris').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateJenisGaris&id=" + id,
			type: "POST",
			data: $('#form-edit-jenisGaris').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-jenisGaris').modal('hide');
							$(location).attr('href','jenisGaris');
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

$(document).on('click','.jenisGaris-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-jenisGaris').modal('show');
    $('#form-delete-jenisGaris')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisGaris&id=" + id,
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

$('#delete-jenisGaris').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteJenisGaris&id=" + id,
		type: "POST",
		data: $('#form-delete-jenisGaris').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','jenisGaris');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});