$(document).ready(function() {
    $('.rams-password-alert').hide();
});

$(document).on('click','.block-login',function() {
    swal({
        title: "Sekatan Log Masuk",
        text: "Sila klik Lupa Kata Laluan untuk mendapatkan kata laluan baru.",
        type: "warning"
    });
});

$(document).on('click','.rams-login',function() {
    $('.rams-alert').remove();
});

$(document).on('click','.rams-password',function() {
    $('#modal-password-renew').modal('show');
    $('#password-renew-form')[0].reset();
});