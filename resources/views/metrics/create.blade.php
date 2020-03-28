@extends('app', ['page_title' => 'Exam Metrics', 'open_menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('metrics.index') }}"><i class="fas fa-list"></i> Existing Metrics</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Metric</legend>
        {!! Form::model(new App\CdtMetric, ['route' => ['metrics.store'], 'class' => 'form-group']) !!}
            @include('metrics/form', ['submit_text' => 'Create Metric'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
