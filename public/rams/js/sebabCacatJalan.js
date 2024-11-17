$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.sebabCacatJalan-new',function() {
    $('#modal-new-sebabCacatJalan').modal('show');
    $('#form-new-sebabCacatJalan')[0].reset();
	$('.message-form').html('');
});

$('#register-sebabCacatJalan').click(function(){
	if($('#form-new-sebabCacatJalan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterSebabCacatJalan",
			type: "POST",
			data: $('#form-new-sebabCacatJalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-sebabCacatJalan').modal('hide');
							$(location).attr('href','sebabCacatJalan');
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

$(document).on('click','.sebabCacatJalan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-sebabCacatJalan').modal('show');
    $('#form-edit-sebabCacatJalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewSebabCacatJalan&id=" + id,
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

$('#update-sebabCacatJalan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-sebabCacatJalan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateSebabCacatJalan&id=" + id,
			type: "POST",
			data: $('#form-edit-sebabCacatJalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-sebabCacatJalan').modal('hide');
							$(location).attr('href','sebabCacatJalan');
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

$(document).on('click','.sebabCacatJalan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-sebabCacatJalan').modal('show');
    $('#form-delete-sebabCacatJalan')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewSebabCacatJalan&id=" + id,
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

$('#delete-sebabCacatJalan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteSebabCacatJalan&id=" + id,
		type: "POST",
		data: $('#form-delete-sebabCacatJalan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','sebabCacatJalan');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});