@extends('app', ['page_title' => 'Quality Bands', 'open_menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('bands.create') }}"><i class="fas fa-plus"></i> New Band</a>
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
                                    <th width="30%"><strong>LOWER LIMIT</strong></th>
                                    <th width="30%"><strong>UPPER LIMIT</strong></th>
                                    <th data-priority="1"><strong>QUALITY</strong></th>
                                    <th width="10%" data-priority="1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bands as $band)
                                <tr>
                                    <td align="center">{{ $band->lower }}%</td>
                                    <td align="center">{{ $band->upper }}%</td>
                                    <td>{{ $band->quality }}</td>
                                    <td class="text-center">
                                        <a title="Trash" href="{{ route('bands.delete', [$band->slug()]) }}" onclick="return confirmDelete()"><i class="fas fa-trash"></i></a>
                                    </td>
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