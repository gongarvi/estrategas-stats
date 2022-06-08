@extends('layouts.master')
@section('content')
    <button id="descargarImagenes" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-5 mt-4">Descargar Imagenes</button>
    <h1 class="w-full text-8xl font-bold text-center eu4-style">{{($title !== '')?$title:'Configura el excel para incluir el nombre en el título'}}</h1>
    <div class="p-10 flex flex-auto flex-wrap gap-5 place-content-evenly">
        @foreach ($data->stadistics as $key => $stadistic)
            <div class="p-10 py-5 w-100 max-w-3xl rounded-xl bg-slate-100 rounded-lg overflow-x-auto">
                <table class="m-auto border-collapse bg-slate-100 rounded">
                    <!-- Se tiene que poner inline, sino pone un espacio en blanco -->
                    <caption class="p-2 border-0 text-left font-bold text-2xl text-slate-900 bg-slate-100"><img src="{{asset('img/logo.png')}}" alt="logo" class="w-16 inline-block mr-5"><span>{{$year . " - " . $key}}</span></caption>
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
                        @php
                            $isTOPTable = \App\Enumerations\StadisticsRanges::TOPs->name() == $key;
                        @endphp
                        @foreach ($stadistic as $index => $row)
                            <tr @class(['item', 'h-fit', 'super-top' => ($isTOPTable && $index < $data->tops->superTop), 'top' => ($isTOPTable && $index < $data->tops->top)])>
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