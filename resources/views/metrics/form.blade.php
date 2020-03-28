<div class="form-group row">
    {!! Form::label('description', 'Description *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('description', $value = null, ['class' => 'form-control', 'placeholder' => 'Description', 'required' => true, 'maxlength' => 200]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('percentage', 'Percentage *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4 input-group">
        {!! Form::number('percentage', $value = null, ['class' => 'form-control', 'placeholder' => 'Percentage', 'required' => true, 'min' => 1, 'max' => 100, 'aria-describedby' => 'addon']) !!}
        <div class="input-group-append">
            <span class="input-group-text" id="addon">%</span>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>
