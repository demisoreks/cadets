@extends('general', ['page_title' => 'Available Streams'])

@section('content')
<div class="row">
    @foreach ($courses as $course)
    <div class="col-xl-4" style="margin-bottom: 20px;">
        <div class="card">
            <div class="card-body text-center">
                <p>{{ $course->location->region->name }} Region</p>
                <h5 class="text-info">{{ Carbon\Carbon::parse($course->start_date)->format('M j, Y'). ' to '.Carbon\Carbon::parse($course->end_date)->format('M j, Y') }}</h5>
                <p>{{ $course->location->name }}</p>
                <a href="{{ route('streams.register', [$course->slug()]) }}" class="btn btn-primary">Apply</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection