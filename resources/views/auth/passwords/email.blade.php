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
                <form id="password-renew-form" name="formemail" action="{{ route('password.email') }}" method="post">
					@csrf
                    @if (session('status'))
					<div class="alert alert-success rams-alert">
						<strong>
							{{ session('status') }}
						</strong>
					</div>
                    @endif
                    @if ($errors->has('reset'))
					<div class="alert alert-danger rams-alert">
						<strong>
							{{ $errors->first('reset') }}
						</strong>
					</div>
                    @endif
					<div class="form-group{{ $errors->has('icno') || $errors->has('reset') ? ' has-error' : '' }}">
						<label><strong>Nombor Kad Pengenalan</strong></label>
						<div class="input-group m-b">
							<span class="input-group-addon">
								<i class="fa fa-address-card-o"></i>
							</span>
							<input type="text" name="icno" class="form-control" placeholder="Nombor Kad Pengenalan" data-required="true" value="{{ old('icno') }}"/>
						</div>
						@if ($errors->has('icno'))
							<span class="help-block">
								<strong>{{ $errors->first('icno') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('email') || $errors->has('reset') ? ' has-error' : '' }}">
						<label><strong>Alamat Emel</strong></label>
						<div class="input-group m-b">
							<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
							</span>
							<input type="email" name="email" class="form-control" placeholder="Alamat Emel" data-required="true" value="{{ old('email') }}"/>
						</div>
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
						<label><strong>Captcha</strong></label>

						<div class="m-b col-md-12">
							{!! NoCaptcha::display() !!}

							@if ($errors->has('g-recaptcha-response'))
								<span class="help-block">
									<strong>{{ $errors->first('g-recaptcha-response') }}</strong>
								</span>
							@endif
						</div>
					</div>
                    <button type="submit" class="btn btn-success block full-width m-b">Hantar Link Reset Kata Laluan</button>
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
{!! NoCaptcha::renderJs() !!}
@endsection
