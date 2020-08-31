@extends('app', ['page_title' => 'Cadets'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('cadets.search') }}"><i class="fas fa-search"></i> New Search</a>
        <!--<a class="btn btn-info" href="#"><i class="fas fa-download"></i> Download Full Report</a>-->
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table id="myTable4" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
            <thead>
                <tr class="text-center">
                    <th data-priority="2"><strong>INDEX NO.</strong></th>
                    <th data-priority="2"><strong>NAME</strong></th>
                    <th data-priority="2"><strong>GENDER</strong></th>
                    <th data-priority="3"><strong>DATE OF BIRTH</strong></th>
                    <th data-priority="2"><strong>HEIGHT</strong></th>
                    <th data-priority="3"><strong>STATE OF ORIGIN</strong></th>
                    <th data-priority="3"><strong>QUALIFICATION</strong></th>
                    <th data-priority="2"><strong>PRIMARY PHONE</strong></th>
                    <th data-priority="3"><strong>ALTERNATE PHONE</strong></th>
                    <th data-priority="3"><strong>EMAIL ADDRESS</strong></th>
                    <th data-priority="3"><strong>HOME ADDRESS</strong></th>
                    <th data-priority="2"><strong>LOCATION (STATE) | REGION</strong></th>
                    <th data-priority="2"><strong>STATUS</strong></th>
                    <th data-priority="3"><strong>COURSE</strong></th>
                    <th data-priority="3"><strong>ENTRANCE SCORE</strong></th>
                    <th data-priority="3"><strong>PRE-TRAINING COMMENT</strong></th>
                    <th data-priority="3"><strong>POST-TRAINING COMMENT</strong></th>
                    <th data-priority="3"><strong>INSTRUCTOR</strong></th>
                    @foreach (App\CdtMetric::all() as $metric)
                    <th data-priority="4"><strong>EXAM/{{ $metric->description }}</strong></th>
                    @endforeach
                    @foreach (App\CdtMeasure::all() as $measure)
                    <th data-priority="4"><strong>QUALITY/{{ $measure->description }}</strong></th>
                    @endforeach
                    <th data-priority="1">&nbsp;</th>
                    <th data-priority="1">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cadets as $cadet)
                <tr>
                    <td>{{ $cadet->index }}</td>
                    <td>{{ $cadet->surname.', '.$cadet->first_name.' '.$cadet->middle_name }}</td>
                    <td align="center">{{ $cadet->gender }}</td>
                    <td>{{ $cadet->date_of_birth }}</td>
                    <td>{{ $cadet->height_ft }}ft {{ $cadet->height_in }}in</td>
                    <td>{{ App\CdtState::find($cadet->state_of_origin)->name }}</td>
                    <td>{{ $cadet->qualification }}</td>
                    <td>{{ $cadet->phone1 }}</td>
                    <td>{{ $cadet->phone2 }}</td>
                    <td>{{ $cadet->email }}</td>
                    <td>{{ $cadet->home_address }}</td>
                    <td>{{ $cadet->course->location->name.' ('.$cadet->course->location->state->name.') | '.$cadet->course->location->region->name }}</td>
                    <td>{{ $cadet->status }}</td>
                    <td>{{ Carbon\Carbon::parse($cadet->course->start_date)->format('M j, Y'). ' to '.Carbon\Carbon::parse($cadet->course->end_date)->format('M j, Y') }}</td>
                    <td>{{ $cadet->entrance_score }}</td>
                    <td>{!! nl2br($cadet->comment_before) !!}</td>
                    <td>{!! nl2br($cadet->comment_after) !!}</td>
                    <td>@if ($cadet->treated_by) {{ App\AccEmployee::find($cadet->treated_by)->username }} @endif</td>
                    @foreach (App\CdtMetric::all() as $metric)
                    <td>
                        @if (App\CdtExam::where('cadet_id', $cadet->id)->where('metric_id', $metric->id)->count() > 0)
                        {{ App\CdtExam::where('cadet_id', $cadet->id)->where('metric_id', $metric->id)->first()->score }}
                        @endif
                    </td>
                    @endforeach
                    @foreach (App\CdtMeasure::all() as $measure)
                    <td>
                        @if (App\CdtQuality::where('cadet_id', $cadet->id)->where('measure_id', $measure->id)->count() > 0)
                        {{ App\CdtQuality::where('cadet_id', $cadet->id)->where('measure_id', $measure->id)->first()->score }}
                        @endif
                    </td>
                    @endforeach
                    <td><a class="btn btn-primary btn-block" href="{{ route('cadets.view', [$cadet->slug()]) }}" title="View"><i class="fas fa-user"></i></a></td>
                    <td><a class="btn btn-info btn-block" href="{{ route('cadets.manage', [$cadet->slug()]) }}" title="Manage"><i class="fas fa-wrench"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
