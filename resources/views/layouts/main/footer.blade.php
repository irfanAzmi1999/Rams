    <!-- Mainly scripts -->
	<script src="{{ URL::asset('inspinia/js/jquery-3.1.1.min.js') }}"></script>
	<script src="{{ URL::asset('inspinia/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('inspinia/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
	<script src="{{ URL::asset('inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

	<!-- Custom and plugin javascript -->
	<script src="{{ URL::asset('inspinia/js/inspinia.js') }}"></script>
	<script src="{{ URL::asset('inspinia/js/plugins/pace/pace.min.js') }}"></script>
	<script src="{{ URL::asset('rams/js/blockUI/jquery.blockUI.js') }}"></script>
	<script src="{{ URL::asset('rams/js/blockUI/blockUI.js') }}"></script>
	<script type="text/javascript">
		$.blockUI({
	            message: "<img src='{{ asset('rams/images/rams_wh31.png') }}' /><br /><img src='{{ asset('rams/images/loader.gif') }}' />",
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
	    $.blockUI.defaults.baseZ = 500000;

        $(document).on('click','.menuload',function() {
            $.blockUI({
                message: "<img src='{{ asset('rams/images/rams_wh31.png') }}' /><br /><img src='{{ asset('rams/images/loader.gif') }}' />",
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
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
	   $.unblockUI(); //only make sure the document is full loaded, including scripts.
	});
	</script>
	@yield('js')