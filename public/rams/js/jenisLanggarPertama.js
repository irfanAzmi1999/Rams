$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.jenisLanggarPertama-new',function() {
    $('#modal-new-jenisLanggarPertama').modal('show');
    $('#form-new-jenisLanggarPertama')[0].reset();
	$('.message-form').html('');
});

$('#register-jenisLanggarPertama').click(function(){
	if($('#form-new-jenisLanggarPertama').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterJenisLanggarPertama",
			type: "POST",
			data: $('#form-new-jenisLanggarPertama').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-jenisLanggarPertama').modal('hide');
							$(location).attr('href','jenisLanggarPertama');
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

$(document).on('click','.jenisLanggarPertama-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-jenisLanggarPertama').modal('show');
    $('#form-edit-jenisLanggarPertama')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisLanggarPertama&id=" + id,
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

$('#update-jenisLanggarPertama').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-jenisLanggarPertama').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateJenisLanggarPertama&id=" + id,
			type: "POST",
			data: $('#form-edit-jenisLanggarPertama').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-jenisLanggarPertama').modal('hide');
							$(location).attr('href','jenisLanggarPertama');
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

$(document).on('click','.jenisLanggarPertama-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-jenisLanggarPertama').modal('show');
    $('#form-delete-jenisLanggarPertama')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisLanggarPertama&id=" + id,
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

$('#delete-jenisLanggarPertama').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteJenisLanggarPertama&id=" + id,
		type: "POST",
		data: $('#form-delete-jenisLanggarPertama').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','jenisLanggarPertama');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});