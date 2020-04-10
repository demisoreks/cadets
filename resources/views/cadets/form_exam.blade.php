@foreach (App\CdtMetric::where('active', true)->get() as $metric)
<div class="form-group row">
    {!! Form::label($metric->id, $metric->description, ['class' => 'col-md-6 col-form-label']) !!}
    <div class="col-md-6 input-group">
        {!! Form::number($metric->id, (App\CdtExam::where('metric_id', $metric->id)->where('cadet_id', $cadet->id)->count() > 0) ? App\CdtExam::where('metric_id', $metric->id)->where('cadet_id', $cadet->id)->first()->score : '', ['class' => 'form-control', 'placeholder' => 'Score', 'max' => $metric->percentage, 'aria-describedby' => $metric->id]) !!}
        <div class="input-group-append">
            <span class="input-group-text" id="{{ $metric->id }}">/{{ $metric->percentage }}</span>
        </div>
    </div>
</div>
@endforeach
<div class="form-group row">
    <div class="col-md-6 offset-md-6">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>