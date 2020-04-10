@extends('app', ['page_title' => 'Assessments', 'open_menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('assessments.index') }}"><i class="fas fa-list"></i> Existing Assessments</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Assessment</legend>
        {!! Form::model(new App\CdtAssessment, ['route' => ['assessments.store'], 'class' => 'form-group']) !!}
            @include('assessments/form', ['submit_text' => 'Create Assessment'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
