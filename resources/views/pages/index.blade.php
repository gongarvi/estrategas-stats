@extends('layouts.master')

@section('header')
    <div class="w-fit ml-auto p-4">
        <a class="px-4 py-3 rounded border-1 border-stone-500 bg-slate-50 text-sky-600" href="{{$discordLogin}}">Login</a>
    </div>
@stop
@section('content')
    <div class="place-items-center grow">
        @if(isset($data) && $data != null)
            <ul class="px-0 sm:px-5 h-fit w-full flex flex-wrap place-items-center dark:bg-gray-900 gap-4">
                @foreach ($data as $item)
                    <li class="m-auto">
                        <a href="{{route('save', $item->key)}}" class="save-id">
                            <div class="rounded-lg shadow-lg bg-white w-40 h-40 hover:scale-105 hover:shadow-slate-600 hover:cursor-pointer">
                                <div class="p-6 flex h-full place-items-center">
                                    <h5 class="w-full text-gray-900 text-xl text-center font-medium mb-2">{{$item->name}}</h5>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <script src="{{asset('js/spinner.js')}}"></script>
@stop