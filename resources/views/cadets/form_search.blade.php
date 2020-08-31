<div class="form-group row">
    {!! Form::label('index', 'Index No.', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('index', $value = null, ['class' => 'form-control', 'placeholder' => 'Index No.']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('gender', 'Gender', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::select('gender', ['M' => 'Male', 'F' => 'Female'], $value = null, ['class' => 'form-control', 'placeholder' => '- Select Option -']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('phone', 'Phone', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('phone', $value = null, ['class' => 'form-control', 'placeholder' => 'Phone']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('email', 'Email Address', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('email', $value = null, ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('status', 'Admission Status', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::select('status', ['Applicant' => 'Applicant', 'Cadet' => 'Cadet', 'Trained' => 'Trained', 'Rejected' => 'Rejected'], $value = null, ['class' => 'form-control', 'placeholder' => '- Select Option -']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('state_id', 'State', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::select('state_id', App\CdtState::orderBy('name')->pluck('name', 'id'), $value = null, ['class' => 'form-control select2', 'placeholder' => '- Select Option -']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('region_id', 'Region', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::select('region_id', App\CdtRegion::orderBy('name')->pluck('name', 'id'), $value = null, ['class' => 'form-control select2', 'placeholder' => '- Select Option -']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('location_id', 'Location', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::select('location_id', [], $value = null, ['class' => 'form-control select2', 'placeholder' => '- Select Option -']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('course_id', 'Course', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::select('course_id', [], $value = null, ['class' => 'form-control select2', 'placeholder' => '- Select Option -']) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-8 offset-md-4">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>

<script type="text/javascript">
    $('.select2').select2();

    $(document).ready(function() {
        $("#region_id").change(function() {
            document.getElementById('location_id').length = 1;
            var region_id = $("#region_id").val();
            var myString = "";

            var ajaxRequest = null;

            var browser = navigator.appName;
            if (browser == "Microsoft Internet Explorer") {
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } else {
                ajaxRequest = new XMLHttpRequest();
            }

            ajaxRequest.onreadystatechange = function() {
                if (ajaxRequest.readyState == 4) {
                    var json_object = JSON.parse(ajaxRequest.responseText);
                    for (var key in json_object) {
                        if (json_object.hasOwnProperty(key)) {
                            $("#location_id").append("<option value='"+json_object[key].id+"'>"+json_object[key].name+"</option>");
                        }
                    }
                }
            }

            ajaxRequest.open("GET", "../regions/"+region_id+"/getLocations", true);
            ajaxRequest.send(null);
        });
    });

    $(document).ready(function() {
        $("#location_id").change(function() {
            document.getElementById('course_id').length = 1;
            var location_id = $("#location_id").val();
            var myString = "";

            var ajaxRequest = null;

            var browser = navigator.appName;
            if (browser == "Microsoft Internet Explorer") {
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } else {
                ajaxRequest = new XMLHttpRequest();
            }

            ajaxRequest.onreadystatechange = function() {
                if (ajaxRequest.readyState == 4) {
                    var json_object = JSON.parse(ajaxRequest.responseText);
                    for (var key in json_object) {
                        if (json_object.hasOwnProperty(key)) {
                            $("#course_id").append("<option value='"+json_object[key].id+"'>"+json_object[key].start+" - "+json_object[key].end+"</option>");
                        }
                    }
                }
            }

            ajaxRequest.open("GET", "../locations/"+location_id+"/getCoursesDesc", true);
            ajaxRequest.send(null);
        });
    });
</script>
