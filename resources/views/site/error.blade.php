<h1>404</h1>
<h3 class="font-bold">Page Not Found</h3>

<div class="error-desc">
    Sorry, but the page you are looking for has not been found. Try checking the URL for error, then hit the refresh button on your browser or click the button below.
    <br /><br /><a href="/Logout" class="btn btn-primary">Exit</a>
</div>

<div class="row">&nbsp;</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <i class="fa fa-danger"></i> Error {{ $code }}
            </div>
            <div class="panel-body">
                <p><?php echo CHtml::encode($message); ?></p>
            </div>
        </div>
    </div>
</div>
