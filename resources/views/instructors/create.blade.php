@extends('app', ['page_title' => 'Instructors', 'open_menu' => 'settings'])

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
        <a class="btn btn-primary" href="{{ route('regions.instructors.index', [$region->slug()]) }}"><i class="fas fa-list"></i> Existing Instructors</a>
        <a class="btn btn-primary" href="{{ route('regions.index') }}"><i class="fas fa-arrow-left"></i> Back to Regions</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Instructor</legend>
        {!! Form::model(new App\CdtInstructor, ['route' => ['regions.instructors.store', $region->slug()], 'class' => 'form-group']) !!}
            @include('instructors/form', ['submit_text' => 'Create Instructor'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
