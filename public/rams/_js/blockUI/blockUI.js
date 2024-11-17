$(document).ready(function(){
    $(document).ajaxStart(function() {
        $.blockUI({
            message: "<img src='{{ asset('rams/images/rams_dark_wh31.png') }}' /><br /><img src='{{ asset('rams/images/loader.gif') }}' />",
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        });
    });
    $.blockUI.defaults.baseZ = 500000;

    $(document).ajaxStop(function() {
        $.unblockUI();
    });
});