<div class="form-group row">
    {!! Form::label('name', 'Name *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => true, 'maxlength' => 100]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('code', 'Code *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('code', $value = null, ['class' => 'form-control', 'placeholder' => 'Code (exactly 3 characters)', 'required' => true, 'maxlength' => 3, 'minlength' => 3]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('region_id', 'Region *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('region_id', App\CdtRegion::whereIn('id', App\CdtInstructor::where('employee_id', App\Http\Controllers\UtilsController::getEmployee()->id)->pluck('region_id')->toArray())->pluck('name', 'id'), $value = null, ['class' => 'form-control select2', 'placeholder' => '- Select Option -', 'required' => true, 'data-live-search' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('state_id', 'State *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('state_id', App\CdtState::where('active', true)->orderBy('name')->pluck('name', 'id'), $value = null, ['class' => 'form-control select2', 'placeholder' => '- Select Option -', 'required' => true, 'data-live-search' => true]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>

<script>
    $('.select2').select2();
</script>