@extends('app', ['page_title' => 'Approvals', 'open_menu' => 'cadets'])

@section('content')
<div class="row">
    <div class="col-12">
        <div id="accordion1">
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading3" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                            <strong>Courses Pending Approval</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion1">
                    <div class="card-body">
                        <table id="myTable3" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="20%"><strong>START DATE</strong></th>
                                    <th width="20%"><strong>END DATE</strong></th>
                                    <th><strong>LOCATION (STATE) | REGION</strong></th>
                                    <th width="15%" data-priority="1">&nbsp;</th>
                                    <th width="15%" data-priority="1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                <tr>
                                    <td align="center">{{ $course->start_date }}</td>
                                    <td align="center">{{ $course->end_date }}</td>
                                    <td>{{ $course->location->name }} ({{ $course->location->state->name }}) | {{ $course->location->region->name }}</td>
                                    <td><a class="btn btn-primary btn-block btn-sm" href="{{ route('courses.cadets', [$course->slug()]) }}">Cadets ({{ App\CdtCadet::where('course_id', $course->id)->where('status', '<>', 'Rejected')->count() }})</a></td>
                                    <td><a class="btn btn-success btn-block btn-sm" href="{{ route('courses.approve', [$course->slug()]) }}" onclick="return confirmApprove()">Approve</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection