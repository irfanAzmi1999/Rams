@extends('layouts.login.main')

@section('content')
<div class="row p-sm login-overlay">
    <div class="row">
        <div class="col-md-6">
            <h2 class="font-bold text-white">
                <img src="{{ URL::asset('rams/images/rams_white_wh31.png') }}" />
            </h2>
            <p class="text-white">
                <small>Sistem Pengurusan Kemalangan Jalan Raya</small>
            </p>
            <p>&nbsp;</p>
			<table class="table">
				<tbody>
					<tr class="text-white">
						<td><span class="label label-success">R</span> &nbsp;O&nbsp;A&nbsp;D</td>
					</tr>
					<tr class="text-white">
						<td><span class="label label-success">A</span> &nbsp;C&nbsp;C&nbsp;I&nbsp;D&nbsp;E&nbsp;N&nbsp;T</td>
					</tr>
					<tr class="text-white">
						<td><span class="label label-success">M</span> &nbsp;A&nbsp;N&nbsp;A&nbsp;G&nbsp;E&nbsp;M&nbsp;E&nbsp;N&nbsp;T</td>
					</tr>
					<tr class="text-white">
						<td><span class="label label-success">S</span> &nbsp;Y&nbsp;S&nbsp;T&nbsp;E&nbsp;M</td>
					</tr>
				</tbody>
			</table>
        </div>
        <div class="col-md-6">
            <div class="ibox-content">
                <form class="m-t" name="formlogin" role="form" action="{{ route('login') }}" method="POST">
					@csrf
                    <div class="row">
                        <img src="{{ URL::asset('rams/images/rams_dark.png') }}" />
                    </div>
                    @if ($errors->has('icno') || $errors->has('password') || $errors->has('disable'))
                        <div class="alert alert-danger rams-alert">
                            <strong>
								{{ $errors->first('icno') }} {{ $errors->first('password') }} {{ $errors->first('disable') }}
                            </strong>
                        </div>
                    @endif
                    <div class="form-group">
						<input type="text" class="form-control" name="icno" placeholder="IC Pengguna" value="{{ old('icno') }}" id="icno" required autofocus>
                    </div>
                    <div class="form-group">
                        <div class="input-group m-b">
                            <input id="password" type="password" placeholder="Kata Laluan" class="form-control masked" name="password" required autocomplete="off">
                            <span class="input-group-addon" id="eye">
                                    <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success block full-width m-b">Log Masuk</button>
                    <a href="{{ route('password.request') }}"><small>Lupa Kata Laluan?</small></a>
                    <span class="pull-right">
                        <i class="fa fa-home"></i> <a href="/"><small>Utama</small></a>
                    </span>
                </form>
                <p class="m-t">
                    <small>
                        Sistem Pengurusan Kemalangan Jalan Raya <a class="block-login"><span class="badge badge-success">RAMS</span></a>
                    </small>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('inspinia/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ URL::asset('rams/js/login.js') }}"></script>
<script type="text/javascript">
    function show() {
        var p = document.getElementById('password');
        p.setAttribute('type', 'text');
    }

    function hide() {
        var p = document.getElementById('password');
        p.setAttribute('type', 'password');
    }

    var pwShown = 0;

    document.getElementById("eye").addEventListener("click", function () {
        if (pwShown == 0) {
            pwShown = 1;
            show();
        } else {
            pwShown = 0;
            hide();
        }
    }, false);
</script>
@endsection