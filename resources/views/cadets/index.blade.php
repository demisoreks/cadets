@extends('app', ['page_title' => 'Cadets', 'open_menu' => 'cadets'])

@section('content')
<div class="row">
    <div class="col-md-6">
        <h4 class="page-header text-primary" style="border-bottom: 1px solid #999; padding-bottom: 20px; margin-bottom: 20px;">New Cadet</h4>
        {!! Form::model(new App\CdtCadet, ['route' => ['cadets.store'], 'class' => 'form-group']) !!}
            @include('cadets/form', ['submit_text' => 'Create Cadet'])
        {!! Form::close() !!}
    </div>
    <div class="col-md-6">
        <h4 class="page-header text-primary" style="border-bottom: 1px solid #999; padding-bottom: 20px; margin-bottom: 20px;">Search Cadets</h4>
        {!! Form::model(null, ['route' => ['cadets.fetch'], 'class' => 'form-group']) !!}
            @include('cadets/form_search', ['submit_text' => 'Fetch Cadets'])
        {!! Form::close() !!}
    </div>
</div>
@endsection