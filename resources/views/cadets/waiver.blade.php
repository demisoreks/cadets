@extends('app', ['page_title' => 'Entry Waiver', 'open_menu' => 'cadets'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header text-primary" style="border-bottom: 1px solid #999; padding-bottom: 20px; margin-bottom: 20px;">Search Cadet</h4>
    </div>
    <div class="col-md-12">
        {!! Form::model(null, ['route' => ['cadets.waiver_fetch'], 'class' => 'form-group']) !!}
            @include('cadets/form_waiver', ['submit_text' => 'Fetch Cadet'])
        {!! Form::close() !!}
    </div>
</div>
@endsection