@extends('general', ['page_title' => 'Registration Form'])

@section('content')
<div class="row">
    <div class="col-xl-8 offset-xl-2">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-info">
                    <a href="{{ route('streams') }}" class="btn btn-primary btn-sm float-md-right"><i class="fa fa-arrow-left"></i> Back to Streams</a>
                    <p>{{ $course->location->region->name }} Region<br />
                    {{ Carbon\Carbon::parse($course->start_date)->format('M j, Y'). ' to '.Carbon\Carbon::parse($course->end_date)->format('M j, Y') }}<br />
                    {{ $course->location->name }}</p>
                </div>
                {!! Form::model(new App\CdtCadet, ['route' => ['streams.submit', $course->slug()], 'class' => 'form-group']) !!}
                    @include('cadets/form_register', ['submit_text' => 'Submit Application'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection