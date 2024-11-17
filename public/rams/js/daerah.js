$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.daerah-new',function() {
    $('#modal-new-daerah').modal('show');
    $('#form-new-daerah')[0].reset();
	$('.message-form').html('');
});

$('#register-daerah').click(function(){
	if($('#form-new-daerah').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterDaerah",
			type: "POST",
			data: $('#form-new-daerah').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-daerah').modal('hide');
							$(location).attr('href','daerah');
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

$(document).on('click','.daerah-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-daerah').modal('show');
    $('#form-edit-daerah')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewDaerah&id=" + id,
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

$('#update-daerah').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-daerah').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateDaerah&id=" + id,
			type: "POST",
			data: $('#form-edit-daerah').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-daerah').modal('hide');
							$(location).attr('href','daerah');
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

$(document).on('click','.daerah-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-daerah').modal('show');
    $('#form-delete-daerah')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewDaerah&id=" + id,
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

$('#delete-daerah').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteDaerah&id=" + id,
		type: "POST",
		data: $('#form-delete-daerah').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','daerah');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});