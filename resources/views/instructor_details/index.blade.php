@extends('app', ['page_title' => 'Instructors', 'open_menu' => 'settings'])

@section('content')
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
                        <table id="myTable1" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th><strong>USERNAME</strong></th>
                                    <th><strong>NAME</strong></th>
                                    <th><strong>PICTURE</strong></th>
                                    <th><strong>MOBILE NUMBER</strong></th>
                                    <th><strong>ALTERNATE NUMBER</strong></th>
                                    <th><strong>ADDRESS</strong></th>
                                    <th><strong>STATE</strong></th>
                                    <th><strong>EDUCATIONAL QUALIFICATIONS</strong></th>
                                    <th><strong>PROFESSIONAL QUALIFICATIONS</strong></th>
                                    <th data-priority="1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instructors as $instructor)
                                <?php
                                $instructor_detail = App\CdtInstructorDetail::where('employee_id', $instructor->id);
                                ?>
                                <tr>
                                    <td>{{ $instructor->username }}</td>
                                    <td>@if ($instructor_detail->count() > 0) {{ $instructor_detail->first()->first_name.' '.$instructor_detail->first()->surname }} @endif</td>
                                    <td class="text-center">@if ($instructor_detail->count() > 0) @if (File::exists('storage/pictures/'.$instructor_detail->first()->id.'.jpg')) {{ Html::image('storage/pictures/'.$instructor_detail->first()->id.'.jpg', 'Instructor\'s picture', ['height' => '100px', 'class' => 'rounded-circle']) }} @endif @endif</td>
                                    <td>@if ($instructor_detail->count() > 0) {{ $instructor_detail->first()->phone1 }} @endif</td>
                                    <td>@if ($instructor_detail->count() > 0) {{ $instructor_detail->first()->phone2 }} @endif</td>
                                    <td>@if ($instructor_detail->count() > 0) {{ $instructor_detail->first()->address }} @endif</td>
                                    <td>@if ($instructor_detail->count() > 0) {{ $instructor_detail->first()->state->name }} @endif</td>
                                    <td>@if ($instructor_detail->count() > 0) {{ $instructor_detail->first()->educational }} @endif</td>
                                    <td>@if ($instructor_detail->count() > 0) {{ $instructor_detail->first()->professional }} @endif</td>
                                    <td class="text-center">
                                        <a title="Edit" href="{{ route('instructor_details.edit', [$instructor->slug()]) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr
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