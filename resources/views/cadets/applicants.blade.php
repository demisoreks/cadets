@extends('app', ['page_title' => 'Applicants', 'open_menu' => 'cadets'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <div class="alert alert-info">
            <a href="{{ route('courses.index') }}" class="btn btn-primary btn-sm float-md-right"><i class="fa fa-arrow-left"></i> Back to Courses</a>
            <p>{{ $course->location->region->name }} Region<br />
            {{ Carbon\Carbon::parse($course->start_date)->format('M j, Y'). ' to '.Carbon\Carbon::parse($course->end_date)->format('M j, Y') }}<br />
            {{ $course->location->name }}</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>STATUS DISTRIBUTION</strong>
            </div>
            <div class="card-body">
                {!! $status_chart->container() !!}
                {!! $status_chart->script() !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>GENDER DISTRIBUTION</strong>
            </div>
            <div class="card-body">
                {!! $gender_chart->container() !!}
                {!! $gender_chart->script() !!}
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>PENDING APPLICANTS</strong>
            </div>
            <div class="card-body">
                <table id="myTable1" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th width="10%"><strong>INDEX NO.</strong></th>
                            <th><strong>NAME</strong></th>
                            <th width="5%"><strong>GENDER</strong></th>
                            <th width="5%"><strong>HGT. (CM)</strong></th>
                            <th width="10%"><strong>PRIMARY PHONE</strong></th>
                            <th width="25%"><strong>LOCATION (STATE) | REGION</strong></th>
                            <th width="15%" data-priority="1">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cadets as $cadet)
                            @if ($cadet->status == 'Applicant')
                        <tr>
                            <td>{{ $cadet->index }}</td>
                            <td>{{ $cadet->surname.', '.$cadet->first_name.' '.$cadet->middle_name }}</td>
                            <td align="center">{{ $cadet->gender }}</td>
                            <td align="right">{{ $cadet->height }}</td>
                            <td>{{ $cadet->phone1 }}</td>
                            <td>{{ $cadet->course->location->name.' ('.$cadet->course->location->state->name.') | '.$cadet->course->location->region->name }}</td>
                            <td><a class="btn btn-primary btn-sm btn-block" href="{{ route('cadets.treat', [$cadet->slug()]) }}" title="Treat">Treat <i class="fas fa-arrow-right"></i></a></td>
                        </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection