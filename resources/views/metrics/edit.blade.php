@extends('app', ['page_title' => 'Exam Metrics', 'open_menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('metrics.index') }}"><i class="fas fa-list"></i> Existing Metrics</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Edit Metric</legend>
        {!! Form::model($metric, ['route' => ['metrics.update', $metric->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('metrics/form', ['submit_text' => 'Update Metric'])
        {!! Form::close() !!}
    </div>
</div>
@endsection