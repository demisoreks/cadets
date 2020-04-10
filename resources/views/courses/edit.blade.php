@extends('app', ['page_title' => 'Courses', 'open_menu' => 'cadets'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('courses.index') }}"><i class="fas fa-list"></i> Existing Courses</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Edit Course</legend>
        {!! Form::model($course, ['route' => ['courses.update', $course->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('courses/form', ['submit_text' => 'Update Course'])
        {!! Form::close() !!}
    </div>
</div>
@endsection