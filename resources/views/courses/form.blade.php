<div class="form-group row">
    {!! Form::label('start_date', 'Start Date *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::date('start_date', $value = null, ['class' => 'form-control', 'placeholder' => 'Start Date', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('end_date', 'End Date *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::date('end_date', $value = null, ['class' => 'form-control', 'placeholder' => 'End Date', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('location_id', 'Location *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('location_id', App\CdtLocation::select(DB::raw("CONCAT(name, ' (', code, ')') AS full_name"), 'id')->where('active', true)->whereIn('region_id', App\CdtInstructor::where('employee_id', App\Http\Controllers\UtilsController::getEmployee()->id)->pluck('region_id')->toArray())->orderBy('name')->pluck('full_name', 'id'), $value = null, ['class' => 'form-control select2', 'placeholder' => '- Select Option -', 'required' => true, 'data-live-search' => true]) !!}
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