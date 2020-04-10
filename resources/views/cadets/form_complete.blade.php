<div class="form-group row">
    {!! Form::label('assessments', 'Assessments', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        @foreach (App\CdtAssessment::where('when', 'A')->where('active', true)->get() as $assessment)
        <div class="form-check">
            {!! Form::checkbox('ass'.$assessment->id, $value = null, false, ['class' => 'form-check-input']) !!}
            {!! Form::label('ass'.$assessment->id, $assessment->description, ['class' => 'form-check-label']) !!}
        </div>
        @endforeach
    </div>
</div>
<div class="form-group row">
    {!! Form::label('comment_after', 'Comment *', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('comment_after', $value = null, ['class' => 'form-control', 'placeholder' => 'Comment', 'required' => true, 'maxlength' => 200, 'rows' => 4]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-8 offset-md-4">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>