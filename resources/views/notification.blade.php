@if (session()->has('success'))
    <div class="alert alert-success cs-alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>{{ session()->get('success') }}</strong>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger cs-alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>{{ session()->get('error') }}</strong>
    </div>
@endif

@if (session()->has('warning'))
    <div class="alert alert-warning cs-alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>{{ session()->get('warning') }}</strong>
    </div>
@endif

@if (session()->has('info'))
    <div class="alert alert-info cs-alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>{{ session()->has('info') }}</strong>
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger cs-alert cs-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        @foreach ($errors->all() as $error)     
                <div class="d-block">{{ $error }}</div>
        @endforeach
    </div>
@endif