<div class="row">
    <div class="col-md-6">
        <table class="display-1 table table-condensed table-hover table-striped" width="100%">
            <tr>
                <th><strong>BIODATA</strong></th>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Surname</small><br /><strong>{{ $cadet->surname }}</strong></div>
                        <div class="col"><small>First Name</small><br /><strong>{{ $cadet->first_name }}</strong></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Middle Name</small><br /><strong>{{ $cadet->middle_name }}</strong></div>
                        <div class="col"><small>Date of Birth</small><br /><strong>{{ Carbon\Carbon::parse($cadet->date_of_birth)->format('F j, Y') }}</strong></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Gender</small><br /><strong>{{ $cadet->gender }}</strong></div>
                        <div class="col"><small>State of Origin</small><br /><strong>{{ App\CdtState::find($cadet->state_of_origin)->name }}</strong></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Height</small><br /><strong>{{ $cadet->height_ft }}ft {{ $cadet->height_in }}in</strong></div>
                        <div class="col"><small>Qualification</small><br /><strong>{{ $cadet->qualification }}</strong></div>
                    </div>
                </td>
            </tr>
            <tr>
                <th><strong>CONTACT INFO</strong></th>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Primary Phone</small><br /><strong>{{ $cadet->phone1 }}</strong></div>
                        <div class="col"><small>Alternate Phone</small><br /><strong>{{ $cadet->phone2 }}</strong></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Email Address</small><br /><strong>{{ $cadet->email }}</strong></div>
                        <div class="col"><small>Home Address</small><br /><strong>{!! nl2br($cadet->home_address) !!}</strong></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <table class="display-1 table table-condensed table-hover table-striped" width="100%">
            <tr>
                <th colspan="2"><strong>ONBOARDING</strong></th>
            </tr>
            <tr>
                <td width="40%">Test Entrance Score</td>
                <td><strong>{{ $cadet->entrance_score }}</strong></td>
            </tr>
            <tr>
                <td>Assessments</td>
                <td>
                    <strong>
                        @foreach (App\CdtCheck::where('cadet_id', $cadet->id)->get() as $check)
                        <i class="fas @if ($check->checked) fa-check @else fa-times @endif"></i>
                        {{ App\CdtAssessment::whereId($check->assessment_id)->first()->description }}
                        <br />
                        @endforeach
                    </strong>
                </td>
            </tr>
            <tr>
                <td>Pre-Training Comment</td>
                <td><strong>{!! nl2br($cadet->comment_before) !!}</strong></td>
            </tr>
            <tr>
                <td>Post-Training Comment</td>
                <td><strong>{!! nl2br($cadet->comment_after) !!}</strong></td>
            </tr>
            <tr>
                <td>Status</td>
                <td class="@if ($cadet->status == 'Rejected') text-danger @else text-info @endif"><strong>{{ $cadet->status }}</strong></td>
            </tr>
            <tr>
                <td>Index No.</td>
                <td><strong>{{ $cadet->index }}</strong></td>
            </tr>
            <tr>
                <td>Course</td>
                <td><strong>{{ Carbon\Carbon::parse($cadet->course->start_date)->format('M j, Y'). ' to '.Carbon\Carbon::parse($cadet->course->end_date)->format('M j, Y')  }}</strong></td>
            </tr>
            <tr>
                <td>Instructor</td>
                <td><strong>@if ($cadet->treated_by) {{ App\AccEmployee::find($cadet->treated_by)->username }} @endif</strong></td>
            </tr>
            <tr>
                <td>Location</td>
                <td><strong>{{ $cadet->course->location->name.' ('.$cadet->course->location->code.')' }}</strong></td>
            </tr>
            <tr>
                <td>State</td>
                <td><strong>{{ $cadet->course->location->state->name }}</strong></td>
            </tr>
            <tr>
                <td>Region</td>
                <td><strong>{{ $cadet->course->location->region->name }}</strong></td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        @if (App\CdtExam::where('cadet_id', $cadet->id)->count() > 0)
        <table class="display-1 table table-condensed table-bordered" width="100%">
            <tr>
                <th colspan="2"><strong>EXAM SCORES</strong></th>
            </tr>
            @foreach (App\CdtExam::where('cadet_id', $cadet->id)->get() as $exam)
            <tr>
                <td width="70%">{{ $exam->metric->description }}</td>
                <td align="right">{{ $exam->score }}</td>
            </tr>
            @endforeach
            <tr>
                <td><strong>TOTAL</strong></td>
                <td align="right"><strong>{{ App\CdtExam::where('cadet_id', $cadet->id)->sum('score') }}</strong></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <h3>
                        @if (App\CdtExam::where('cadet_id', $cadet->id)->sum('score') >= App\CdtConfig::find(1)->exam_pass_mark)
                        <span class="badge badge-pill badge-success">PASS</span>
                        @else
                        <span class="badge badge-pill badge-danger">FAIL</span>
                        @endif
                    </h3>
                </td>
            </tr>
        </table>
        @endif
    </div>
    <div class="col-md-6">
        @if (App\CdtQuality::where('cadet_id', $cadet->id)->count() > 0)
        <table class="display-1 table table-condensed table-bordered" width="100%">
            <tr>
                <th colspan="2"><strong>QUALITY SCORES</strong></th>
            </tr>
            @foreach (App\CdtQuality::where('cadet_id', $cadet->id)->get() as $quality)
            <tr>
                <td width="70%">{{ $quality->measure->description }}</td>
                <td align="right">{{ $quality->score }}</td>
            </tr>
            @endforeach
            <tr>
                <td><strong>TOTAL</strong></td>
                <td align="right"><strong>{{ App\CdtQuality::where('cadet_id', $cadet->id)->sum('score') }}</strong></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <h3>
                        <span class="badge badge-pill badge-primary">
                            {{ strtoupper(App\CdtBand::where('lower', '<=', App\CdtQuality::where('cadet_id', $cadet->id)->sum('score'))->where('upper', '>=', App\CdtQuality::where('cadet_id', $cadet->id)->sum('score'))->first()->quality) }}
                        </span>
                    </h3>
                </td>
            </tr>
        </table>
        @endif
    </div>
</div>