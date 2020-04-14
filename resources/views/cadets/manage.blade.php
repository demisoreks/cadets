@extends('app', ['page_title' => 'Cadets', 'open_menu' => 'cadets'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('cadets.search') }}"><i class="fas fa-search"></i> New Search</a>
        <a class="btn btn-info" href="#"><i class="fas fa-download"></i> Download</a>
        <a class="btn btn-pink" data-toggle="modal" data-target="#modal4"><i class="fas fa-edit"></i> Edit</a>
        @if ($cadet->status == "Cadet")
        <a class="btn btn-dark-green" data-toggle="modal" data-target="#modal1">Exam</a>
        <a class="btn btn-deep-orange" data-toggle="modal" data-target="#modal2">Quality</a>
        <a class="btn btn-brown" data-toggle="modal" data-target="#modal5">Change Course</a>
        <a class="btn btn-danger" data-toggle="modal" data-target="#modal6">Reject</a>
        @endif
    </div>
</div>
@include('cadets.profile')
@if (App\CdtExam::where('cadet_id', $cadet->id)->count() > 0 && App\CdtQuality::where('cadet_id', $cadet->id)->count() > 0 && $cadet->status == 'Cadet')
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-lg btn-blue-grey btn-block" data-toggle="modal" data-target="#modal3">Complete Training</a>
    </div>
</div>
@endif

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Exam Scores</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model(null, ['route' => ['cadets.update_exam', $cadet->slug()], 'class' => 'form-group']) !!}
                @include('cadets/form_exam', ['submit_text' => 'Update Scores'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Quality Scores</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model(null, ['route' => ['cadets.update_quality', $cadet->slug()], 'class' => 'form-group']) !!}
                @include('cadets/form_quality', ['submit_text' => 'Update Scores'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modal3Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Training Completion</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model(null, ['route' => ['cadets.complete', $cadet->slug()], 'class' => 'form-group']) !!}
                @include('cadets/form_complete', ['submit_text' => 'Update'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="modal4Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Edit Biodata</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($cadet, ['route' => ['cadets.update', $cadet->slug()], 'class' => 'form-group']) !!}
                @include('cadets/form_edit', ['submit_text' => 'Update'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal5" tabindex="-1" role="dialog" aria-labelledby="modal5Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Change Course</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model(null, ['route' => ['cadets.change', $cadet->slug()], 'class' => 'form-group']) !!}
                @include('cadets/form_change', ['submit_text' => 'Change'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="modal6Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Reject Cadet</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model(null, ['route' => ['cadets.reject', $cadet->slug()], 'class' => 'form-group']) !!}
                @include('cadets/form_reject', ['submit_text' => 'Reject'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection