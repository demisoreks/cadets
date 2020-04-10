@extends('app', ['page_title' => 'Locations', 'open_menu' => 'cadets'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('locations.index') }}"><i class="fas fa-list"></i> Existing Locations</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Edit Location</legend>
        {!! Form::model($location, ['route' => ['locations.update', $location->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('locations/form', ['submit_text' => 'Update Location'])
        {!! Form::close() !!}
    </div>
</div>
@endsection