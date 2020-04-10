@extends('app', ['page_title' => 'Cadets'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('cadets.search') }}"><i class="fas fa-search"></i> New Search</a>
        <a class="btn btn-info" href="#"><i class="fas fa-download"></i> Download Full Report</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table id="myTable1" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
            <thead>
                <tr class="text-center">
                    <th width="10%"><strong>INDEX NO.</strong></th>
                    <th><strong>NAME</strong></th>
                    <th width="5%"><strong>GENDER</strong></th>
                    <th width="5%"><strong>HGT. (CM)</strong></th>
                    <th width="10%"><strong>PRIMARY PHONE</strong></th>
                    <th width="20%"><strong>LOCATION (STATE) | REGION</strong></th>
                    <th width="10%"><strong>ADMISSION STATUS</strong></th>
                    <th width="5%" data-priority="1">&nbsp;</th>
                    <th width="5%" data-priority="1">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cadets as $cadet)
                <tr>
                    <td>{{ $cadet->index }}</td>
                    <td>{{ $cadet->surname.', '.$cadet->first_name.' '.$cadet->middle_name }}</td>
                    <td align="center">{{ $cadet->gender }}</td>
                    <td align="right">{{ $cadet->height }}</td>
                    <td>{{ $cadet->phone1 }}</td>
                    <td>{{ $cadet->course->location->name.' ('.$cadet->course->location->state->name.') | '.$cadet->course->location->region->name }}</td>
                    <td align="center"><h4><span class="badge badge-pill @if($cadet->admission_status == 'P') badge-success @else badge-danger @endif">{{ $cadet->admission_status }}</span></h4></td>
                    <td><a class="btn btn-primary btn-block" href="{{ route('cadets.view', [$cadet->slug()]) }}" title="View"><i class="fas fa-user"></i></a></td>
                    <td><a class="btn btn-info btn-block" href="{{ route('cadets.manage', [$cadet->slug()]) }}" title="Manage"><i class="fas fa-wrench"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection