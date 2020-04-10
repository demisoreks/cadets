@foreach (App\CdtMeasure::where('active', true)->get() as $measure)
<div class="form-group row">
    {!! Form::label($measure->id, $measure->description, ['class' => 'col-md-6 col-form-label']) !!}
    <div class="col-md-6 input-group">
        {!! Form::number($measure->id, (App\CdtQuality::where('measure_id', $measure->id)->where('cadet_id', $cadet->id)->count() > 0) ? App\CdtQuality::where('measure_id', $measure->id)->where('cadet_id', $cadet->id)->first()->score : '', ['class' => 'form-control', 'placeholder' => 'Score', 'max' => $measure->percentage, 'aria-describedby' => $measure->id]) !!}
        <div class="input-group-append">
            <span class="input-group-text" id="{{ $measure->id }}">/{{ $measure->percentage }}</span>
        </div>
    </div>
</div>
@endforeach
<div class="form-group row">
    <div class="col-md-6 offset-md-6">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>