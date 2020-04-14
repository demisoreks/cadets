@extends('app', ['page_title' => 'Cadet Profile'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('cadets.search') }}"><i class="fas fa-search"></i> New Search</a>
        <!--<a class="btn btn-blue-grey" href="{{ route('courses.applicants', [$cadet->course->slug()]) }}"><i class="fas fa-list"></i> Fellow Applicants</a>-->
        <a class="btn btn-info" href="#"><i class="fas fa-download"></i> Download Cadet Info</a>
        <a class="btn btn-blue-grey" href="{{ route('cadets.manage', [$cadet->slug()]) }}"><i class="fas fa-wrench"></i> Manage</a>
    </div>
</div>
@include('cadets.profile')
@endsection