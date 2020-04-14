<div class="form-group row">
    {!! Form::label('c_region_id', 'Region *', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::select('c_region_id', App\CdtRegion::where('active', true)->orderBy('name')->pluck('name', 'id'), $value = null, ['class' => 'form-control select2', 'placeholder' => '- Select Option -', 'required' => true, 'data-live-search' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('c_location_id', 'Location *', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::select('c_location_id', [], $value = null, ['class' => 'form-control select2', 'placeholder' => '- Select Option -', 'required' => true, 'data-live-search' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('c_course_id', 'Course *', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::select('c_course_id', [], $value = null, ['class' => 'form-control select2', 'placeholder' => '- Select Option -', 'required' => true, 'data-live-search' => true]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-9 offset-md-3">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary', 'onClick' => 'return confirmSubmit()']) !!}
    </div>
</div>

<script type="text/javascript">
    $('.select2').select2();
    
    $(document).ready(function() {
        $("#c_region_id").change(function() {
            document.getElementById('c_location_id').length = 1;
            var region_id = $("#c_region_id").val();
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
                            $("#c_location_id").append("<option value='"+json_object[key].id+"'>"+json_object[key].name+"</option>");
                        }
                    }
                }
            }
            
            ajaxRequest.open("GET", "../../regions/"+region_id+"/getLocations", true);
            ajaxRequest.send(null);
        });
    });
    
    $(document).ready(function() {
        $("#c_location_id").change(function() {
            document.getElementById('c_course_id').length = 1;
            var location_id = $("#c_location_id").val();
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
                            $("#c_course_id").append("<option value='"+json_object[key].id+"'>"+json_object[key].start+" - "+json_object[key].end+"</option>");
                        }
                    }
                }
            }
            
            ajaxRequest.open("GET", "../../locations/"+location_id+"/getCoursesDesc", true);
            ajaxRequest.send(null);
        });
    });
</script>