@extends('app', ['page_title' => 'Applicants', 'open_menu' => 'cadets'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <legend>Treat Applicant</legend>
        {!! Form::model($cadet, ['route' => ['cadets.admit', $cadet->slug()], 'class' => 'form-group']) !!}
            @include('cadets/form', ['submit_text' => 'Update Applicant'])
        {!! Form::close() !!}
    </div>
</div>
@endsection