@extends('app', ['page_title' => 'Locations', 'open_menu' => 'cadets'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('locations.index') }}"><i class="fas fa-list"></i> Existing Locations</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Location</legend>
        {!! Form::model(new App\CdtLocation, ['route' => ['locations.store'], 'class' => 'form-group']) !!}
            @include('locations/form', ['submit_text' => 'Create Location'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
