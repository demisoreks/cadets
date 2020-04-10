<div class="form-group row">
    {!! Form::label('description', 'Description *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('description', $value = null, ['class' => 'form-control', 'placeholder' => 'Description', 'required' => true, 'maxlength' => 200]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('when', 'When? *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('when', ['B' => 'Before Training', 'A' => 'After Training'], $value = null, ['class' => 'form-control', 'placeholder' => '- Select Option -', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>
