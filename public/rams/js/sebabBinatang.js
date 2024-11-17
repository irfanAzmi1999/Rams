$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.sebabBinatang-new',function() {
    $('#modal-new-sebabBinatang').modal('show');
    $('#form-new-sebabBinatang')[0].reset();
	$('.message-form').html('');
});

$('#register-sebabBinatang').click(function(){
	if($('#form-new-sebabBinatang').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterSebabBinatang",
			type: "POST",
			data: $('#form-new-sebabBinatang').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-sebabBinatang').modal('hide');
							$(location).attr('href','sebabBinatang');
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

$(document).on('click','.sebabBinatang-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-sebabBinatang').modal('show');
    $('#form-edit-sebabBinatang')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewSebabBinatang&id=" + id,
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

$('#update-sebabBinatang').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-sebabBinatang').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateSebabBinatang&id=" + id,
			type: "POST",
			data: $('#form-edit-sebabBinatang').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-sebabBinatang').modal('hide');
							$(location).attr('href','sebabBinatang');
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

$(document).on('click','.sebabBinatang-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-sebabBinatang').modal('show');
    $('#form-delete-sebabBinatang')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewSebabBinatang&id=" + id,
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

$('#delete-sebabBinatang').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteSebabBinatang&id=" + id,
		type: "POST",
		data: $('#form-delete-sebabBinatang').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','sebabBinatang');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});