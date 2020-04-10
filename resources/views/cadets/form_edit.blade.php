<div class="form-group row">
    {!! Form::label('first_name', 'First Name *', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('first_name', $value = null, ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => true, 'maxlength' => 100]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('middle_name', 'Middle Name', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('middle_name', $value = null, ['class' => 'form-control', 'placeholder' => 'Middle Name', 'maxlength' => 100]) !!}
    </div>
</div><div class="form-group row">
    {!! Form::label('surname', 'Surname *', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::text('surname', $value = null, ['class' => 'form-control', 'placeholder' => 'Surname', 'required' => true, 'maxlength' => 100]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('date_of_birth', 'Date of Birth *', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::date('date_of_birth', $value = null, ['class' => 'form-control', 'placeholder' => 'Date of Birth', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('gender', 'Gender *', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::select('gender', ['M' => 'Male', 'F' => 'Female'], $value = null, ['class' => 'form-control', 'placeholder' => '- Select Option -', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('state_of_origin', 'State of Origin *', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::select('state_of_origin', App\CdtState::where('active', true)->orderBy('name')->pluck('name', 'id'), $value = null, ['class' => 'form-control select2', 'placeholder' => '- Select Option -', 'required' => true, 'data-live-search' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('height', 'Height', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-4 input-group">
        {!! Form::number('height_ft', $value = null, ['class' => 'form-control', 'placeholder' => 'Feet', 'aria-describedby' => 'addon1', 'min' => 5, 'max' => 7]) !!}
        <div class="input-group-append">
            <span class="input-group-text" id="addon1">ft</span>
        </div>
    </div>
    <div class="col-md-4 input-group">
        {!! Form::number('height_in', $value = null, ['class' => 'form-control', 'placeholder' => 'Inches', 'aria-describedby' => 'addon2', 'min' => 0, 'max' => 11]) !!}
        <div class="input-group-append">
            <span class="input-group-text" id="addon2">in</span>
        </div>
    </div>
</div>
<div class="form-group row">
    {!! Form::label('qualification', 'Qualification *', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::select('qualification', ['Not Applicable' => 'Not Applicable', 'SSCE' => 'SSCE', 'OND' => 'OND', 'HND' => 'HND', 'Bachelor\'s Degree' => 'Bachelor\'s Degree'], $value = null, ['class' => 'form-control', 'placeholder' => '- Select Option -', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('phone1', 'Primary Phone *', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::number('phone1', $value = null, ['class' => 'form-control', 'placeholder' => 'Primary Phone', 'required' => true, 'maxlength' => 20]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('phone2', 'Alternate Phone', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::number('phone2', $value = null, ['class' => 'form-control', 'placeholder' => 'Alternate Phone', 'maxlength' => 20]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('email', 'Email Address', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::email('email', $value = null, ['class' => 'form-control', 'placeholder' => 'Email Address', 'maxlength' => 100]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('home_address', 'Home Address *', ['class' => 'col-md-4 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('home_address', $value = null, ['class' => 'form-control', 'placeholder' => 'Home Address', 'required' => true, 'maxlength' => 500, 'rows' => 4]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-8 offset-md-4">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary', 'onClick' => 'return confirmSubmit()']) !!}
    </div>
</div>

<script type="text/javascript">
    $('.select2').select2();
    
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
            
            ajaxRequest.open("GET", "locations/"+location_id+"/getCoursesDesc", true);
            ajaxRequest.send(null);
        });
    });
</script>