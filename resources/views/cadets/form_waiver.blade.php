<div class="form-group row">
    {!! Form::label('index', 'Index No.', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('index', $value = null, ['class' => 'form-control', 'placeholder' => 'Index Number', 'required' => true, 'maxlength' => 100]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>