@extends('app', ['page_title' => 'Quality Measures', 'open_menu' => 'settings'])

@section('content')
@if ($percentage_sum == 100)
<div class="alert alert-info" role="alert">
    Percentage sum of active measures is 100%. This is the expected value.
</div>
@else
<div class="alert alert-warning" role="alert">
    Percentage sum of active measures is {{ $percentage_sum }}%. Expected value is 100%.
</div>
@endif
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('measures.create') }}"><i class="fas fa-plus"></i> New Measure</a>
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
                        <table id="myTable1" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th><strong>DESCRIPTION</strong></th>
                                    <th width="20%"><strong>PERCENTAGE</strong></th>
                                    <th width="10%" data-priority="1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($measures as $measure)
                                    @if ($measure->active)
                                <tr>
                                    <td>{{ $measure->description }}</td>
                                    <td align="right">{{ $measure->percentage }}%</td>
                                    <td class="text-center">
                                        <a title="Edit" href="{{ route('measures.edit', [$measure->slug()]) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                        <a title="Trash" href="{{ route('measures.disable', [$measure->slug()]) }}" onclick="return confirmDisable()"><i class="fas fa-trash"></i></a>
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
                            <strong>Inactive</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion1">
                    <div class="card-body">
                        <table id="myTable2" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th><strong>DESCRIPTION</strong></th>
                                    <th width="20%"><strong>PERCENTAGE</strong></th>    
                                    <th width="10%" data-priority="1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($measures as $measure)
                                    @if (!$measure->active)
                                <tr>
                                    <td>{{ $measure->description }}</td>
                                    <td align="right">{{ $measure->percentage }}%</td>
                                    <td class="text-center">
                                        <a title="Restore" href="{{ route('measures.enable', [$measure->slug()]) }}"><i class="fas fa-undo"></i></a>
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