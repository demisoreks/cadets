@extends('app', ['page_title' => 'Quality Measures', 'open_menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('measures.index') }}"><i class="fas fa-list"></i> Existing Measures</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Measure</legend>
        {!! Form::model(new App\CdtMeasure, ['route' => ['measures.store'], 'class' => 'form-group']) !!}
            @include('measures/form', ['submit_text' => 'Create Measure'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
