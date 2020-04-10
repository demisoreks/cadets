@extends('app', ['page_title' => 'Instructors', 'open_menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('bands.index') }}"><i class="fas fa-list"></i> Existing Bands</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Band</legend>
        {!! Form::model(new App\CdtBand, ['route' => ['bands.store'], 'class' => 'form-group']) !!}
            @include('bands/form', ['submit_text' => 'Create Band'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
