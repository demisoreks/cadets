<div class="form-group row">
    {!! Form::label('gender', 'Gender', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::select('gender', ['M' => 'Male', 'F' => 'Female'], $value = null, ['class' => 'form-control', 'placeholder' => '- Select Option -']) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-8 offset-md-4">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>