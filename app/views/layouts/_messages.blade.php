@if(Session::has('error'))
<div class="form-group has-error">
    <label class="control-label" for="inputError">{{Session::get('error')}}</label>
</div>
@endif

@if(Session::has('success'))
<div class="form-group has-success">
    <label class="control-label" for="inputSuccess">{{Session::get('success')}}</label>
</div>
@endif