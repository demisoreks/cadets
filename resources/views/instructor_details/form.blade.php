<div class="form-group row">
    {!! Form::label('username', 'Username *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('username', $employee->username, ['class' => 'form-control', 'placeholder' => 'Username', 'required' => true, 'maxlength' => 100, 'readonly' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('first_name', 'First Name *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('first_name', $value = null, ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => true, 'maxlength' => 50]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('surname', 'Surname *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('surname', $value = null, ['class' => 'form-control', 'placeholder' => 'Surname', 'required' => true, 'maxlength' => 50]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('phone1', 'Mobile Number *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('phone1', $value = null, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'required' => true, 'maxlength' => 20]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('phone2', 'Alternate Number', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('phone2', $value = null, ['class' => 'form-control', 'placeholder' => 'Alternate Number', 'maxlength' => 20]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('address', 'Residential Address *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('address', $value = null, ['class' => 'form-control', 'placeholder' => 'Residential Address', 'required' => true, 'maxlength' => 500, 'rows' => 4]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('state_id', 'State of Residence *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('state_id', App\CdtState::where('active', true)->orderBy('name')->pluck('name', 'id'), $value = null, ['class' => 'form-control select2', 'placeholder' => '- Select Option -', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('educational', 'Educational Qualifications', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('educational', $value = null, ['class' => 'form-control', 'placeholder' => 'Educational Qualifications', 'maxlength' => 500, 'rows' => 4]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('professional', 'Professional Qualifications', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('professional', $value = null, ['class' => 'form-control', 'placeholder' => 'Professional Qualifications', 'maxlength' => 500, 'rows' => 4]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('picture', 'Picture', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::file('picture', $value = null, ['class' => 'form-control', 'placeholder' => 'Picture']) !!}
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