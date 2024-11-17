$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.mukaJalan-new',function() {
    $('#modal-new-mukaJalan').modal('show');
    $('#form-new-mukaJalan')[0].reset();
	$('.message-form').html('');
});

$('#register-mukaJalan').click(function(){
	if($('#form-new-mukaJalan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterMukaJalan",
			type: "POST",
			data: $('#form-new-mukaJalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-mukaJalan').modal('hide');
							$(location).attr('href','mukaJalan');
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

$(document).on('click','.mukaJalan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-mukaJalan').modal('show');
    $('#form-edit-mukaJalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewMukaJalan&id=" + id,
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

$('#update-mukaJalan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-mukaJalan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateMukaJalan&id=" + id,
			type: "POST",
			data: $('#form-edit-mukaJalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-mukaJalan').modal('hide');
							$(location).attr('href','mukaJalan');
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

$(document).on('click','.mukaJalan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-mukaJalan').modal('show');
    $('#form-delete-mukaJalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewMukaJalan&id=" + id,
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

$('#delete-mukaJalan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteMukaJalan&id=" + id,
		type: "POST",
		data: $('#form-delete-mukaJalan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','mukaJalan');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});