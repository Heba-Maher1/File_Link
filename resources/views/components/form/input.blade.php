@props([
    'type' => 'text' ,
    'name' ,
    'value' => '' ,
    'id'

])

@php
$old_name = str_replace('[' , '.', $name);
$old_name = str_replace(']' , '', $old_name);
@endphp

<input type="{{$type}}"
           value="{{old($old_name , $value)}}"
           name="{{$name}}"
           id="{{$id ?? $name}}"
           {{ $attributes->class(['form-control mb-3 py-3' , 'is-invalid'=> $errors->has($old_name)])}}
>