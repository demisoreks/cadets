<div class="form-group row">
    {!! Form::label('waiver_comment', 'Comment *', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('waiver_comment', $value = null, ['class' => 'form-control', 'placeholder' => 'Waiver Comment', 'required' => true, 'maxlength' => 200, 'rows' => 4]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-8 offset-md-4">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>