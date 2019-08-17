<input type="datepicker--date-only" class="form-control" name="{{ $row->field }}"
       placeholder="{{ $row->display_name }}"
       value="@if(isset($dataTypeContent->{$row->field})){{ \Carbon\Carbon::parse(old($row->field, $dataTypeContent->{$row->field}))->format('Y-m-d') }}@else{{old($row->field)}}@endif">
