$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.jenisPermukaan-new',function() {
    $('#modal-new-jenisPermukaan').modal('show');
    $('#form-new-jenisPermukaan')[0].reset();
	$('.message-form').html('');
});

$('#register-jenisPermukaan').click(function(){
	if($('#form-new-jenisPermukaan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterJenisPermukaan",
			type: "POST",
			data: $('#form-new-jenisPermukaan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-jenisPermukaan').modal('hide');
							$(location).attr('href','jenisPermukaan');
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

$(document).on('click','.jenisPermukaan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-jenisPermukaan').modal('show');
    $('#form-edit-jenisPermukaan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisPermukaan&id=" + id,
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

$('#update-jenisPermukaan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-jenisPermukaan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateJenisPermukaan&id=" + id,
			type: "POST",
			data: $('#form-edit-jenisPermukaan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-jenisPermukaan').modal('hide');
							$(location).attr('href','jenisPermukaan');
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

$(document).on('click','.jenisPermukaan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-jenisPermukaan').modal('show');
    $('#form-delete-jenisPermukaan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewJenisPermukaan&id=" + id,
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

$('#delete-jenisPermukaan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteJenisPermukaan&id=" + id,
		type: "POST",
		data: $('#form-delete-jenisPermukaan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','jenisPermukaan');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});