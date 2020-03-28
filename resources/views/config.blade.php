@extends('app', ['page_title' => 'Configuration', 'open_menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12">
        <legend>Edit Configuration</legend>
        {!! Form::model($config, ['route' => ['config.update'], 'class' => 'form-group']) !!}
        @method('PUT')
            <div class="form-group row">
                {!! Form::label('entrance_pass_mark', 'Entrance Pass Mark *', ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-4">
                    {!! Form::number('entrance_pass_mark', $value = null, ['class' => 'form-control', 'placeholder' => 'Entrance Pass Mark', 'required' => true, 'maxlength' => 20, 'step' => '0.1']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('exam_pass_mark', 'Exam Pass Mark *', ['class' => 'col-md-2 col-form-label']) !!}
                <div class="col-md-4">
                    {!! Form::number('exam_pass_mark', $value = null, ['class' => 'form-control', 'placeholder' => 'Exam Pass Mark', 'required' => true, 'maxlength' => 20, 'step' => '0.1']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-10 offset-md-2">
                    {!! Form::submit('Update Configuration', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection