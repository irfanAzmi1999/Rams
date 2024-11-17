$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.kualitiPermukaan-new',function() {
    $('#modal-new-kualitiPermukaan').modal('show');
    $('#form-new-kualitiPermukaan')[0].reset();
	$('.message-form').html('');
});

$('#register-kualitiPermukaan').click(function(){
	if($('#form-new-kualitiPermukaan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterKualitiPermukaan",
			type: "POST",
			data: $('#form-new-kualitiPermukaan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-kualitiPermukaan').modal('hide');
							$(location).attr('href','kualitiPermukaan');
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

$(document).on('click','.kualitiPermukaan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-kualitiPermukaan').modal('show');
    $('#form-edit-kualitiPermukaan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewKualitiPermukaan&id=" + id,
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

$('#update-kualitiPermukaan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-kualitiPermukaan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateKualitiPermukaan&id=" + id,
			type: "POST",
			data: $('#form-edit-kualitiPermukaan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-kualitiPermukaan').modal('hide');
							$(location).attr('href','kualitiPermukaan');
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

$(document).on('click','.kualitiPermukaan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-kualitiPermukaan').modal('show');
    $('#form-delete-kualitiPermukaan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewKualitiPermukaan&id=" + id,
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

$('#delete-kualitiPermukaan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteKualitiPermukaan&id=" + id,
		type: "POST",
		data: $('#form-delete-kualitiPermukaan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','kualitiPermukaan');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});