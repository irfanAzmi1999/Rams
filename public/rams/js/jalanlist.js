$(document).ready(function() {
    $('.chosen-role, .chosen-e-role, .chosen-department, .chosen-state, chosen-e-state, .chosen-district, .chosen-e-district').chosen({
        width: "100%"
    });
    
    $('[data-toggle="tooltip"]').tooltip();
});


$(document).on('click','.jalan-new',function() {
    $('#modal-new-jalan').modal('show');
    $('#form-new-jalan')[0].reset();
	$('.chosen-select').chosen('destroy');
    $('.chosen-select').chosen({
        width: '100%'
    });

	// $('[name="r_negeri"]').val(null).trigger('chosen:updated');
	$('[name="negeri_id"]').val(null).trigger('chosen:updated');
	$('.message-form').html('');
});


$('#register-jalan').click(function(){
	if($('#form-new-jalan').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterJalan",
			type: "POST",
			data: $('#form-new-jalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-jalan').modal('hide');
							$(location).attr('href','roadRoad');
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
				console.error("AJAX Error:", errorThrown);
				console.log("Status Code:", jqXHR.status);
				console.log("Response Text:", jqXHR.responseText);
				alert('Error get data from Ajax');
				
			}
		});
	}
});

$(document).on('click','.jalan-view',function() {
	var id = $(this).data('id');
    $('#modal-view-jalan').modal('show');
    $('#form-view-jalan')[0].reset();
	$('.message-form').html('');
    $('.form-v-state, .form-v-district').hide();
	
	$.ajax({
		url: "ajaxViewJalan&id=" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data){
			$('[name="v_code"]').val(data.jenisjalan.name);
			$('[name="v_no_laluan"]').val(data.nolaluan);
			$('[name="v_name"]').val(data.nama);
			$('[name="v_state"]').val(data.negeri);
			$('[name="v_nowarta"]').val(data.nowarta);
			$('[name="v_panjang"]').val(data.panjang);
            $('[name="v_updated_at"]').val(data.updated);
			$('[name="v_updated_by"]').val(data.updated_by_fullname);
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});

$('#update-jalan').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-jalan').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateJalan&id=" + id,
			type: "POST",
			data: $('#form-edit-jalan').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-jalan').modal('hide');
							$(location).attr('href','roadRoad');
						}, 1000);
				}else{
					$('.message-form').html(data.error_form);
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.error("AJAX Error:", errorThrown);
				console.log("Status Code:", jqXHR.status);
				console.log("Response Text:", jqXHR.responseText);
			}
		});
	}
});

$(document).on('click','.jalan-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-jalan').modal('show');
    $('#form-delete-jalan')[0].reset();
	$('.message-form').html('');
    $('.form-d-state').hide();
	
	$.ajax({
		url: "ajaxViewJalan&id=" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data){

			$('[name="d_id"]').val(data.id);
			$('[name="d_code"]').val(data.code);
			$('[name="d_nolaluan"]').val(data.nolaluan);
			$('[name="d_nama"]').val(data.nama);
            $('[name="d_panjang"]').val(data.panjang);
			$('[name="d_state"]').val(data.negeri);
			$('[name="d_nowarta"]').val(data.nowarta);
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.error("AJAX Error:", errorThrown);
			console.log("Status Code:", jqXHR.status);
			console.log("Response Text:", jqXHR.responseText);
		}
	});
});

$('#delete-jalan').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteJalan&id=" + id,
		type: "POST",
		data: $('#form-delete-jalan').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','roadRoad');
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.error("AJAX Error:", errorThrown);
			console.log("Status Code:", jqXHR.status);
			console.log("Response Text:", jqXHR.responseText);
		}
	});
});

$(document).on('change','.chosen-role',function() {
    if($(this).val() == 5 || $(this).val() == 6){
        $('.form-state').show('500');
        $('.form-district').hide('500');
        $('.chosen-state').change();
    }else{
        $('.form-state, .form-district').hide('500');
    }
});

$(document).on('change','.chosen-e-role',function() {
    if($(this).val() == 5 || $(this).val() == 6){
        $('.form-e-state').show('500');
        $('.form-e-district').hide('500');
        $('.chosen-e-state').change().chosen({width: "100%"});
    }else{
        $('.form-e-state, .form-e-district').hide('500');
    }
});