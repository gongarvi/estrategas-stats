@extends('layouts.master')
@section('content')
    <div class="">
        <ul class="flex flex-wrap items-stretch justify-center dark:bg-gray-900 sm:items-center sm:pt-0">
            @foreach ($data as $item)
                <li class="m-1">
                    <div class="rounded-lg shadow-lg bg-white max-w-sm">
                        <div class="p-6">
                            <h5 class="text-gray-900 text-xl font-medium mb-2">{{$item->name}}</h5>
                            <a href="{{route('save', $item->key)}}" class="">
                                Go
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@stop