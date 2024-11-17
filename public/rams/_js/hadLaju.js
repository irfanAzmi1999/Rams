$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.hadLaju-new',function() {
    $('#modal-new-hadLaju').modal('show');
    $('#form-new-hadLaju')[0].reset();
	$('.message-form').html('');
});

$('#register-hadLaju').click(function(){
	if($('#form-new-hadLaju').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterHadLaju",
			type: "POST",
			data: $('#form-new-hadLaju').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-hadLaju').modal('hide');
							$(location).attr('href','hadLaju');
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

$(document).on('click','.hadLaju-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-hadLaju').modal('show');
    $('#form-edit-hadLaju')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewHadLaju&id=" + id,
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

$('#update-hadLaju').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-hadLaju').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateHadLaju&id=" + id,
			type: "POST",
			data: $('#form-edit-hadLaju').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-hadLaju').modal('hide');
							$(location).attr('href','hadLaju');
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

$(document).on('click','.hadLaju-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-hadLaju').modal('show');
    $('#form-delete-hadLaju')[0].reset();
	$('.message-form').html('');
	
	$.ajax({
		url: "ajaxViewHadLaju&id=" + id,
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

$('#delete-hadLaju').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteHadLaju&id=" + id,
		type: "POST",
		data: $('#form-delete-hadLaju').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','hadLaju');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});