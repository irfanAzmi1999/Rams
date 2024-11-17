$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.department-new',function() {
    $('#modal-new-department').modal('show');
    $('#form-new-department')[0].reset();
	$('.message-form').html('');
});

$('#register-department').click(function(){
	if($('#form-new-department').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterDepartment",
			type: "POST",
			data: $('#form-new-department').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-department').modal('hide');
							$(location).attr('href','department');
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

$(document).on('click','.department-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-department').modal('show');
    $('#form-edit-department')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewDepartment&id=" + id,
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

$('#update-department').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-department').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateDepartment&id=" + id,
			type: "POST",
			data: $('#form-edit-department').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-department').modal('hide');
							$(location).attr('href','department');
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

$(document).on('click','.department-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-department').modal('show');
    $('#form-delete-department')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewDepartment&id=" + id,
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

$('#delete-department').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteDepartment&id=" + id,
		type: "POST",
		data: $('#form-delete-department').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','department');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});