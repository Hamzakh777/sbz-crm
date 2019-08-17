@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        
        <form class="form-edit-add" role="form"
              action="@if(!is_null($dataTypeContent->getKey())){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
              method="POST" enctype="multipart/form-data" autocomplete="off">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-bordered">

                    {{-- <div class="panel"> --}}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="first_name">{{ __('voyager::profile.first_name') }}</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="{{ __('voyager::profile.first_name') }}"
                                       value="{{ $dataTypeContent->first_name ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="last_name">{{ __('voyager::profile.last_name') }}</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="{{ __('voyager::profile.last_name') }}"
                                       value="{{ $dataTypeContent->last_name ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="user_name">{{ __('voyager::profile.user_name') }}</label>
                                <input type="text" class="form-control" id="user_name" name="username" placeholder="{{ __('voyager::profile.user_name') }}"
                                       value="{{ $dataTypeContent->username ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('voyager::generic.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('voyager::generic.email') }}"
                                    value="{{ $dataTypeContent->email ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('voyager::generic.password') }}</label>
                                @if(isset($dataTypeContent->password))
                                    <br>
                                    <small>{{ __('voyager::profile.password_hint') }}</small>
                                @endif
                                <input type="password" class="form-control" id="password" name="password" value="" autocomplete="new-password">
                            </div>

                            {{-- editing --}}
                            @if (isset($dataTypeContent->id)) 
                                {{-- only show these fields when the user that's been edited has 
                                sales person role --}}
                                @php
                                    $salesPersonRole = \TCG\Voyager\Models\Role::where('name', 'sales_person')->first();
                                @endphp

                                @if ( $salesPersonRole->id  == $dataTypeContent->role_id)     
                                    <div class="form-group">
                                        <label for="address">{{ __('voyager::generic.address') }}</label>
                                        <input type="text" class="form-control" name="address" value="{{ $dataTypeContent->address ?? '' }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="address">{{ __('voyager::generic.bank_name') }}</label>
                                        <input type="text" class="form-control" name="bank_name" value="{{ $dataTypeContent->bank_name ?? '' }}">
                                    </div>

                                    
                                    <div class="form-group">
                                        <label for="address">{{ __('voyager::generic.bank_IBAN') }}</label>
                                        <input type="text" class="form-control" name="bank_IBAN" value="{{ $dataTypeContent->bank_IBAN ?? '' }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="address">{{ __('voyager::generic.AHV_NO') }}</label>
                                        <input type="text" class="form-control" name="bank_name" value="{{ $dataTypeContent->AHV_NO ?? '' }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="address">{{ __('voyager::generic.phone_number') }}</label>
                                        <input type="number" class="form-control" name="phone_number" value="{{ $dataTypeContent->phone_number ?? '' }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="address">{{ __('voyager::generic.start_date') }}</label>
                                        <input type="text" class="form-control datepicker--date-only" name="start_date" 
                                            value="@if(isset($dataTypeContent->start_date)){{ \Carbon\Carbon::parse(old('start_date', $dataTypeContent->start_date))->format('Y-m-d') }}@else{{old('start_date')}}@endif">
                                    </div>

                                    <div class="form-group">
                                        <label for="address">{{ __('voyager::generic.end_date') }}</label>
                                        <input type="text" class="form-control datepicker--date-only" name="end_date" 
                                            value="@if(isset($dataTypeContent->end_date)){{ \Carbon\Carbon::parse(old('end_date', $dataTypeContent->end_date))->format('Y-m-d') }}@else{{old('end_date')}}@endif">
                                    </div>
                                @endif
                            @endif
                            

                            @can('editRoles', $dataTypeContent)
                                <div class="form-group">
                                    <label for="default_role">{{ __('voyager::profile.role_default') }}</label>
                                    @php
                                        $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};

                                        $row     = $dataTypeRows->where('field', 'user_belongsto_role_relationship')->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                            @endcan

                            @php
                            if (isset($dataTypeContent->locale)) {
                                $selected_locale = $dataTypeContent->locale;
                            } else {
                                $selected_locale = config('app.locale', 'en');
                            }

                            @endphp
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-body">
                            <div class="form-group">
                                @if(isset($dataTypeContent->avatar))
                                    <img src="{{ filter_var($dataTypeContent->avatar, FILTER_VALIDATE_URL) ? $dataTypeContent->avatar : Voyager::image( $dataTypeContent->avatar ) }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                                @endif
                                <input type="file" data-name="avatar" name="avatar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('voyager.users.index') }}" class="btn pull-right btn-danger">
                {{ __('voyager::generic.cancel') }}
            </a>
            <button type="submit" class="btn btn-primary pull-right save">
                {{ __('voyager::generic.save') }}
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            {{ csrf_field() }}
            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
        </form>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle()
            // We want to set the username automatically using the first and last name
            $('#first_name, #last_name').change(function(e) {
                const first_name = $('#first_name').val().replace(/\s/g, "");
                const last_name = $('#last_name').val().replace(/\s/g, "");
                // set the username
                $('#user_name').val(first_name + ' ' + last_name);
            });
        });
    </script>
@stop
