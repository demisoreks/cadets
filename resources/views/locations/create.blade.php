@extends('app', ['page_title' => 'Locations', 'open_menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12">
        <table class="table table-condensed table-hover table-primary">
            <tr>
                <td><strong>Region:</strong> {{ $region->name }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('regions.locations.index', [$region->slug()]) }}"><i class="fas fa-list"></i> Existing Locations</a>
        <a class="btn btn-primary" href="{{ route('regions.index') }}"><i class="fas fa-arrow-left"></i> Back to Regions</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Location</legend>
        {!! Form::model(new App\CdtLocation, ['route' => ['regions.locations.store', $region->slug()], 'class' => 'form-group']) !!}
            @include('locations/form', ['submit_text' => 'Create Location'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
