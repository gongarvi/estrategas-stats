@extends('layouts.master')
@section('content')
    <button id="descargarImagenes">Descargar Imagenes</button>
    <div class="h-screen overflow-auto flex flex-auto flex-wrap">
        @foreach ($data->stadistics as $key => $stadistic)
            <div class="m-auto my-5 p-10 py-5 rounded-xl w-fit h-fit bg-slate-100 rounded">
                <table class="border-collapse bg-slate-100 rounded">
                    <caption class="p-2 border-0 text-left font-bold text-2xl text-slate-900 bg-slate-100"> <img src="{{asset('img/logo.png')}}" alt="logo" class="w-16 inline-block mr-5"> {{$data->year . " " . $key}}</caption>
                    <thead class="border-2 border-slate-900">
                        <tr class="bg-slate-900 color text-white">
                            <td class="px-4 text-center font-medium">#</td>
                            <td class="px-4 text-center font-medium"></td>
                            <td class="px-4 text-center font-medium">Jugador</td>
                            <td class="px-4 text-center font-medium">País</td>
                            <td class="px-4 text-center font-medium">Valor</td>
                            <td class="px-4 text-center font-medium">∆</td>
                            <td class="px-4 text-center font-medium">%∆</td>
                            <td class="px-4 font-medium"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stadistic as $index => $row)
                            <tr class="item h-fit">
                                <td class="px-4 py-1 text-center border-2 border-slate-900">{{$index+1}}</td>
                                <td class="py-1 border-2 border-slate-900">
                                    <div class="mx-auto w-fit">                                     
                                        @if ($row->position > 0)
                                            <i class="m-auto fa-solid fa-arrow-up" style="color: rgb(39, 130, 3);"></i>
                                        @else
                                            @if ($row->position < 0)
                                                <i class="m-auto fa-solid fa-arrow-down" style="color: rgb(212, 28, 4);"></i>
                                            @else
                                                <i class="m-auto fa-solid fa-arrow-right" style="color: rgb(225, 235, 38);"></i>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-1 text-center border-2 border-slate-900">{{$row->playerName}}</td>
                                <td class="px-4 py-1 text-center border-2 border-slate-900">{{$row->countryName}}</td>
                                <td class="px-4 py-1 text-center border-2 border-slate-900">{{$row->totalValue}}</td>
                                <td class="px-4 py-1 text-center border-2 border-slate-900">{{$row->incrementedValue}}</td>
                                <td class="px-4 py-1 text-center percentage border-2 border-slate-900">{{$row->incrementedPercentage}}</td>
                                <td class="px-4 py-1 text-center border-2 border-slate-900 arrow"><i class="m-auto fa-solid fa-arrow-right"></i></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
    <script src="{{asset('js/save.js')}}"></script>
@stop