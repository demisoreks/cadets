@extends('app', ['page_title' => 'Instructors', 'open_menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12">
        <legend>Edit Instructor Details</legend>
        <?php
        $instructor_details = App\CdtInstructorDetail::where('employee_id', $employee->id);
        if ($instructor_details->count() > 0) {
            $instructor_detail = $instructor_details->first();
        }
        ?>
        @if ($instructor_details->count() > 0)
        {!! Form::model($instructor_detail, ['route' => ['instructor_details.store'], 'class' => 'form-group', 'files' => true]) !!}
            @include('instructor_details/form', ['submit_text' => 'Update Details'])
        {!! Form::close() !!}
        @else
        {!! Form::model(new App\CdtInstructorDetail, ['route' => ['instructor_details.store'], 'class' => 'form-group', 'files' => true]) !!}
            @include('instructor_details/form', ['submit_text' => 'Update Details'])
        {!! Form::close() !!}
        @endif
    </div>
</div>
@endsection