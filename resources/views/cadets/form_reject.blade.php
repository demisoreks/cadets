<div class="form-group row">
    {!! Form::label('comment_before', 'Comment *', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('comment_before', $value = null, ['class' => 'form-control', 'placeholder' => 'Rejection Comment', 'required' => true, 'maxlength' => 200, 'rows' => 4]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-8 offset-md-4">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>