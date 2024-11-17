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
                <form class="m-t" name="renew_form" action="{{ route('password.request') }}" method="post">
					@csrf
					<input type="hidden" name="token" value="{{ $token }}">
					@if ($errors->has('email') || $errors->has('password') || $errors->has('password_confirmation'))
					<div class="alert alert-danger rams-alert">
						<strong>
							{{ $errors->first('email') }}{{ $errors->first('password') }}{{ $errors->first('password_confirmation') }}
						</strong>
					</div>
                    @endif
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label><strong>Alamat Emel</strong></label>
						<div class="input-group m-b">
							<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
							</span>
							<input id="email" type="email" name="email" class="form-control" placeholder="Alamat Emel" data-required="true" value="{{ old('email') }}"/>
						</div>
					</div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label><strong>Kata Laluan Baru</strong> <i class="fa fa-asterisk text-danger"></i></label>
                        <div class="input-group m-b">
                            <span class="input-group-addon">
                                <i class="fa fa-lock"></i>
                            </span>
                            <input id="password" type="password" name="password" class="form-control" placeholder="Kata Laluan Baru" data-required="true" />
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label><strong>Ulang Kata Laluan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                        <div class="input-group m-b">
                            <span class="input-group-addon">
                                <i class="fa fa-lock"></i>
                            </span>
                            <input id="password-confirm" type="password" name="password_confirmation" class="form-control" placeholder="Ulang Kata Laluan" data-required="true" />
                        </div>
                    </div>
					<button type="submit" class="btn btn-success block full-width m-b">Reset Kata Laluan</button>
                    <p class="m-t">
                        <span class="pull-right">
                            <i class="fa fa-home"></i> <a href="/"><small>Utama</small></a>
                        </span>
                    </p>
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
