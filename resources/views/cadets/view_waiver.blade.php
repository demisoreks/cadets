@extends('app', ['page_title' => 'Entry Waiver', 'open_menu' => 'cadets'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-dark-green" data-toggle="modal" data-target="#modal1">Admit Applicant</a>
    </div>
</div>
@include('cadets.profile')

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Admit Applicant</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model(null, ['route' => ['cadets.waive', $cadet->slug()], 'class' => 'form-group']) !!}
                @include('cadets/form_waive', ['submit_text' => 'Waive & Admit'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection