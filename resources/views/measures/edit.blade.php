@extends('app', ['page_title' => 'Quality Measures', 'open_menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('measures.index') }}"><i class="fas fa-list"></i> Existing Measures</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Edit Measure</legend>
        {!! Form::model($measure, ['route' => ['measures.update', $measure->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('measures/form', ['submit_text' => 'Update Measure'])
        {!! Form::close() !!}
    </div>
</div>
@endsection