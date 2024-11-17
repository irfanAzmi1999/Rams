$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.sistemLaluan-new',function() {
    $('#modal-new-sistemLaluan').modal('show');
    $('#form-new-sistemLaluan')[0].reset();
	$('.message-form').html('');
});

$('#register-sistemLaluan').click(function(){
	if($('#form-new-sistemLaluan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterSistemLaluan",
			type: "POST",
			data: $('#form-new-sistemLaluan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-sistemLaluan').modal('hide');
							$(location).attr('href','sistemLaluan');
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

$(document).on('click','.sistemLaluan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-sistemLaluan').modal('show');
    $('#form-edit-sistemLaluan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewSistemLaluan&id=" + id,
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

$('#update-sistemLaluan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-sistemLaluan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateSistemLaluan&id=" + id,
			type: "POST",
			data: $('#form-edit-sistemLaluan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-sistemLaluan').modal('hide');
							$(location).attr('href','sistemLaluan');
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

$(document).on('click','.sistemLaluan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-sistemLaluan').modal('show');
    $('#form-delete-sistemLaluan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewSistemLaluan&id=" + id,
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

$('#delete-sistemLaluan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteSistemLaluan&id=" + id,
		type: "POST",
		data: $('#form-delete-sistemLaluan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','sistemLaluan');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});