@extends('app', ['page_title' => 'Applicants', 'open_menu' => 'cadets'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <legend>Treat Applicant</legend>
        @if (App\CdtCadet::where('id', '<>', $cadet->id)->where(function ($query) use ($cadet) {
            $query->where('phone1', $cadet->phone1)
                ->orWhere('phone2', $cadet->phone1);
        })->count() > 0 ||
        App\CdtCadet::where('id', '<>', $cadet->id)->whereNotNull('phone2')->where(function ($query) use ($cadet) {
            $query->where('phone1', $cadet->phone2)
                ->orWhere('phone2', $cadet->phone2);
        })->count() > 0)
        <div class="alert alert-danger">
            This applicant has registered in other streams. You can <a href="{{ route('cadets.search') }}">search</a> using the phone numbers supplied.
        </div>
        @endif
        {!! Form::model($cadet, ['route' => ['cadets.admit', $cadet->slug()], 'class' => 'form-group']) !!}
            @include('cadets/form', ['submit_text' => 'Update Applicant'])
        {!! Form::close() !!}
    </div>
</div>
@endsection