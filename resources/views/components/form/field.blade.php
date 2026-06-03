@props(['label'=>false,'name','type'=>'text','value'=>''])
<div class="space-y-2">
    @if($label)
        <label class="{{$name}}" for="name">{{$label}}</label>
    @endif

    @if($type=='textarea')
        <textarea
            name="{{$name}}"
            id="{{$name}}"
            class="input w-full mt-1"
            {{$attributes}}
        >{{old($name,$value)}}</textarea>
        @else

    <input
        type="{{$type}}"
        class="input w-full mt-1"
        name="{{$name}}"
        placeholder="{{$name}}"
        value="{{old($name, $value)}}"
        {{$attributes}} >
        @endif

        <x-form.error name="{{$name}}"></x-form.error>
</div>
