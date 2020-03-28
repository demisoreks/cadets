<div class="form-group row">
    {!! Form::label('employee_id', 'Employee *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('employee_id', App\AccEmployee::where('active', true)->whereIn('id', App\AccEmployeeRole::where('role_id', App\AccRole::where('privileged_link_id', config('var.link_id'))->where('title', 'Instructor')->first()->id)->pluck('employee_id')->toArray())->orderBy('username')->pluck('username', 'id'), $value = null, ['class' => 'form-control select2', 'placeholder' => '- Select Option -', 'required' => true, 'data-live-search' => true]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>

<script>
    $('.select2').select2();
</script>