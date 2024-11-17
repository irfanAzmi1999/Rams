$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.negeri-new',function() {
    $('#modal-new-negeri').modal('show');
    $('#form-new-negeri')[0].reset();
	$('.message-form').html('');
});

$('#register-negeri').click(function(){
	if($('#form-new-negeri').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterNegeri",
			type: "POST",
			data: $('#form-new-negeri').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-negeri').modal('hide');
							$(location).attr('href','negeri');
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

$(document).on('click','.negeri-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-negeri').modal('show');
    $('#form-edit-negeri')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewNegeri&id=" + id,
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

$('#update-negeri').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-negeri').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateNegeri&id=" + id,
			type: "POST",
			data: $('#form-edit-negeri').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-negeri').modal('hide');
							$(location).attr('href','negeri');
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

$(document).on('click','.negeri-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-negeri').modal('show');
    $('#form-delete-negeri')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewNegeri&id=" + id,
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

$('#delete-negeri').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteNegeri&id=" + id,
		type: "POST",
		data: $('#form-delete-negeri').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','negeri');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});