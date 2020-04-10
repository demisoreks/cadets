@extends('app', ['page_title' => 'Courses', 'open_menu' => 'cadets'])

@section('content')
<div class="alert alert-info" role="alert">
    This page shows you only courses for locations under your assigned region(s).
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('courses.create') }}"><i class="fas fa-plus"></i> New Course</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div id="accordion1">
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading3" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                            <strong>Active</strong>
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
                                    <th width="10%"><strong>CODE</strong></th>
                                    <th width="15%" data-priority="1">&nbsp;</th>
                                    <th width="10%" data-priority="1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    @if ($course->active)
                                <tr>
                                    <td align="center">{{ $course->start_date }}</td>
                                    <td align="center">{{ $course->end_date }}</td>
                                    <td>{{ $course->location->name }} ({{ $course->location->state->name }}) | {{ $course->location->region->name }}</td>
                                    <td align="center">{{ $course->code }}</td>
                                    <td><a class="btn btn-primary btn-block btn-sm" href="{{ route('courses.applicants', [$course->slug()]) }}">Applicants</a></td>
                                    <td class="text-center">
                                        <a title="Edit" href="{{ route('courses.edit', [$course->slug()]) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                        <a title="Trash" href="{{ route('courses.disable', [$course->slug()]) }}" onclick="return confirmDisable()"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading4" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                            <strong>Inactive (No longer available for registration)</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion1">
                    <div class="card-body">
                        <table id="myTable2" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="20%"><strong>START DATE</strong></th>
                                    <th width="20%"><strong>END DATE</strong></th>
                                    <th><strong>LOCATION (STATE) | REGION</strong></th>
                                    <th width="10%"><strong>CODE</strong></th>
                                    <th width="15%" data-priority="1">&nbsp;</th>
                                    <th width="10%" data-priority="1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    @if (!$course->active)
                                <tr>
                                    <td align="center">{{ $course->start_date }}</td>
                                    <td align="center">{{ $course->end_date }}</td>
                                    <td>{{ $course->location->name }} ({{ $course->location->state->name }}) | {{ $course->location->region->name }}</td>
                                    <td align="center">{{ $course->code }}</td>
                                    <td><a class="btn btn-primary btn-block btn-sm" href="{{ route('courses.applicants', [$course->slug()]) }}">Applicants</a></td>
                                    <td class="text-center">
                                        <a title="Restore" href="{{ route('courses.enable', [$course->slug()]) }}"><i class="fas fa-undo"></i></a>
                                    </td>
                                </tr>
                                    @endif
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