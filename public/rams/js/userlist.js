$(document).ready(function() {
    $('.chosen-role, .chosen-e-role, .chosen-department, .chosen-state, chosen-e-state, .chosen-district, .chosen-e-district').chosen({
        width: "100%"
    });
    
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click','.user-new',function() {
    $('#modal-new-user').modal('show');
    $('#form-new-user')[0].reset();
	$('[name="r_role"]').val(null).trigger('chosen:updated');
	$('[name="r_department"]').val(null).trigger('chosen:updated');
	$('.message-form').html('');
});

$('#register-user').click(function(){
	if($('#form-new-user').parsley().validate()){
		$.ajax({
			url:"ajaxRegisterUser",
			type: "POST",
			data: $('#form-new-user').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-new-user').modal('hide');
							$(location).attr('href','userUser');
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

$(document).on('click','.user-view',function() {
	var id = $(this).data('id');
    $('#modal-view-user').modal('show');
    $('#form-view-user')[0].reset();
	$('.message-form').html('');
    $('.form-v-state, .form-v-district').hide();
	
	$.ajax({
		url: "ajaxViewUser&id=" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data){
            if(data.role.name == 'JKR NEGERI'){
                $('.form-v-state').show(500);
            }if(data.role.name == 'JKR DAERAH'){
                $('.form-v-state, .form-v-district').show(500);
            }
			$('[name="v_full_name"]').val(data.fullname);
			$('[name="v_nric"]').val(data.icno);
			$('[name="v_role"]').val(data.role.name);
			$('[name="v_state"]').val(data.state);
			$('[name="v_district"]').val(data.district);
			$('[name="v_department"]').val(data.department.name);
			$('[name="v_email"]').val(data.email);
			$('[name="v_created_date"]').val(data.created);
			$('[name="v_logged_in_date"]').val(data.login);
			$('[name="v_logged_out_date"]').val(data.logout);
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});

$('#update-user').click(function(){
	var id = $('[name="e_id"]').val();

	if($('#form-edit-user').parsley().validate()){
		$.ajax({
			url:"ajaxUpdateUser&id=" + id,
			type: "POST",
			data: $('#form-edit-user').serialize(),
			dataType: "JSON",
		 	success: function(data){
				if(data.status == 'success'){
					$('.message-form').html(data.success_form);
						setTimeout(function(){
							$('.message-form').remove();
							$('#modal-edit-user').modal('hide');
							$(location).attr('href','userUser');
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

$(document).on('click','.user-delete',function() {
	var id = $(this).data('id');
    $('#modal-delete-user').modal('show');
    $('#form-delete-user')[0].reset();
	$('.message-form').html('');
    $('.form-d-state, .form-d-district').hide();
	
	$.ajax({
		url: "ajaxViewUser&id=" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data){
            if(data.role.name == 'JKR NEGERI'){
                $('.form-d-state').show(500);
            }if(data.role.name == 'JKR DAERAH'){
                $('.form-d-state, .form-d-district').show(500);
            }
			$('[name="d_id"]').val(data.id);
			$('[name="d_full_name"]').val(data.fullname);
			$('[name="d_nric"]').val(data.icno);
			$('[name="d_role"]').val(data.role.name);
            $('[name="d_state"]').val(data.state);
			$('[name="d_district"]').val(data.district);
			$('[name="d_department"]').val(data.department.name);
			$('[name="d_email"]').val(data.email);
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});

$('#delete-user').click(function(){
	var id = $('[name="d_id"]').val();
	
	$.ajax({
		url:"ajaxDeleteUser&id=" + id,
		type: "POST",
		data: $('#form-delete-user').serialize(),
		dataType: "JSON",
		success: function(data){
			$(location).attr('href','userUser');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});

$(document).on('click', '.user-profile-edit', function () {
    var id = $(this).data('id');
    $('#modal-edit-user').modal('show');
    $('#form-edit-user')[0].reset();
    $('.message-form').html('');

    $.ajax({
        url: "ajaxViewUser&id=" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('[name="e_id"]').val(data.id);
            $('[name="e_password"]').val(data.password);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
});

$('#update-profile-user').click(function () {
    var id = $('[name="e_id"]').val();

    if ($('#form-edit-user').parsley().validate()) {
        $.ajax({
            url: "ajaxUpdatePassword&id=" + id,
            type: "POST",
            data: $('#form-edit-user').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status == 'success') {
                    $('.message-form').html(data.success_form);
                    setTimeout(function () {
                        $('.message-form').remove();
                        $('#modal-edit-user').modal('hide');
                        $(location).attr('href', 'userprofile');
                    }, 1000);
                } else {
                    var error = '';
                    $.each(data.error_form, function (k, v) {
                        error += v[0] + '<br/>';
                    });
                    $('.message-form').html('<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="alert alert-danger alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                        error +
                        '</div>' +
                        '</div>' +
                        '</div>');
                    // $('.message-form').html(data.error_form);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log($('#form-edit-user').serialize());
                alert('Error get data from ajax');
            }
        });
    }
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