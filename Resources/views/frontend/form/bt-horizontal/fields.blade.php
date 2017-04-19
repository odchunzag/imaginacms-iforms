<?php $fields = $form->fields; ?>
{{ csrf_field() }}

@if(Setting::get('iforms::trans')=="1")
    @foreach($fields as $index => $field)
        <div class="form-group">
            @if($field['type'] != "textarea" && $field['type'] != "select" && $field['type'] != "checkbox" && $field['type'] != "radio")
                <label for="{!!$field['name']!!}"
                       class="col-sm-2 control-label">{{ trans('icustom::iforms.field.'.$field['name']) }} </label>
                <div class="col-sm-10">
                    <input type="{!!$field['type']!!}" class="form-control" name="{!!$field['name']!!}"
                           id="input{!!$field['name']!!}" required
                           placeholder="{{ trans('icustom::iforms.field.'.$field['description']) or '' }}">
                </div>
            @elseif($field['type'] == "textarea")
                <label for="{!!$field['name']!!}"
                       class="control-label col-sm-2">{{ trans('icustom::iforms.field.'.$field['name'])}}</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="{!!$field['name']!!}"
                              placeholder="{{ trans('icustom::iforms.field.'.$field['description']) }}"
                              rows="4"></textarea>
                </div>
            @elseif($field['type'] == "select")
            @elseif($field['type'] == "checkbox"||$field['type'] == "radio")
                <div class="{!!$field['type']!!}">
                    <label>
                        <input name="{!!$field['name']!!}" type="{!!$field['type']!!}" value="{!!$field['name']!!}">
                        {{ trans('icustom::iforms.field.'.$field['name'])}}
                    </label>
                </div>
            @elseif($field['type'] == "terms")
                <div class="checkbox col-sm-10">
                    <label>
                        <input name="{!!$field['name']!!}" type="checkbox" required>{{trans('iforms:form.form.terms_ini')}}<a
                                href="{{url($field['description'])}}" target="_blank">{{trans('iforms:form.form.terms_end')}} </a>
                    </label>
                </div>
            @endif
        </div>
    @endforeach
@else
    @foreach($fields as $index => $field)
        <div class="form-group">
            @if($field['type'] != "textarea" && $field['type'] != "select" && $field['type'] != "checkbox" && $field['type'] != "radio")
                <label for="{!!$field['name']!!}" class="col-sm-2 control-label">{{$field['label']}} </label>
                <div class="col-sm-10">
                    <input type="{!!$field['type']!!}" class="form-control" name="{!!$field['name']!!}"
                           id="input{!!$field['name']!!}" required placeholder="{{ $field['description'] or '' }}">
                </div>
            @elseif($field['type'] == "textarea")
                <label for="{!!$field['name']!!}" class="control-label col-sm-2">{{ $field['label']}}</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="{!!$field['name']!!}" placeholder="{{$field['description']}}"
                              rows="4"></textarea>
                </div>
            @elseif($field['type'] == "select")
            @elseif($field['type'] == "checkbox"||$field['type'] == "radio")
                <div class="{!!$field['type']!!}">
                    <label>
                        <input name="{!!$field['name']!!}" type="{!!$field['type']!!}" value="{!!$field['name']!!}">
                        {{$field['description']}}
                    </label>
                </div>
            @elseif($field['type'] == "terms")
                <div class="checkbox col-sm-10">
                    <label>
                        <input name="{!!$field['name']!!}" type="checkbox" required> Estoy de acuerdo <a
                                href="{{url($field['description'])}}" target="_blank">la politica de proteccion de datos
                            personales </a>
                    </label>
                </div>
            @endif
        </div>
    @endforeach
@endif



