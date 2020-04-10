@extends('app', ['page_title' => 'Cadet Search'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header text-primary" style="border-bottom: 1px solid #999; padding-bottom: 20px; margin-bottom: 20px;">Search Cadets</h4>
    </div>
    <div class="col-md-6">
        {!! Form::model(null, ['route' => ['cadets.fetch'], 'class' => 'form-group']) !!}
            @include('cadets/form_search', ['submit_text' => 'Fetch Cadets'])
        {!! Form::close() !!}
    </div>
</div>
@endsection