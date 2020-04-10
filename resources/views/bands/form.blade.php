<div class="form-group row">
    {!! Form::label('lower', 'Lower Limit *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4 input-group">
        {!! Form::number('lower', $value = null, ['class' => 'form-control', 'placeholder' => 'Lower Limit', 'required' => true, 'step' => '0.1', 'min' => 0, 'max' => 100, 'aria-describedby' => 'addon']) !!}
        <div class="input-group-append">
            <span class="input-group-text" id="addon">%</span>
        </div>
    </div>
</div>
<div class="form-group row">
    {!! Form::label('upper', 'Upper Limit *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4 input-group">
        {!! Form::number('upper', $value = null, ['class' => 'form-control', 'placeholder' => 'Upper Limit', 'required' => true, 'step' => '0.1', 'min' => 0, 'max' => 100, 'aria-describedby' => 'addon']) !!}
        <div class="input-group-append">
            <span class="input-group-text" id="addon">%</span>
        </div>
    </div>
</div>
<div class="form-group row">
    {!! Form::label('quality', 'Quality *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('quality', $value = null, ['class' => 'form-control', 'placeholder' => 'Quality', 'required' => true, 'maxlength' => 100]) !!}
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