<template>
    <div class="p-10 py-5 w-100 max-w-3xl rounded-xl bg-slate-100 rounded-lg overflow-x-auto">
        <header>
            <button v-if="!showCharts" @click="showCharts = !showCharts">Gráficas</button>
            <button v-if="showCharts" @click="showCharts = !showCharts">Tabla</button>
        </header>
        <table class="w-fit m-auto border-collapse bg-slate-100 rounded" :style="{'display':(!showCharts)?'block':'none'}">
            <!-- Se tiene que poner inline, sino pone un espacio en blanco -->
            <caption class="p-2 border-0 text-left font-bold text-2xl text-slate-900 bg-slate-100">
                <img v-bind:src="logo" alt="logo" class="w-16 inline-block mr-5">
                <span>{{tableName}}</span>
            </caption>
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
                <tr class="item h-fit" v-for="(value, index) in tableValues" v-bind:class="{
                    'super-top':(isTopTable && index<topRange.superTop),
                    'top':(isTopTable && index<topRange.top)
                    }">
                    <td class="px-4 py-1 text-center border-2 border-slate-900">{{index+1}}</td>
                    <td class="py-1 border-2 border-slate-900">
                        <div class="mx-auto w-fit">
                            <i class="m-auto fa-solid fa-arrow-up" v-if="value.position>0" style="color: rgb(39, 130, 3);"></i>
                            <i class="m-auto fa-solid fa-arrow-down" v-else-if="value.position<0"  style="color: rgb(212, 28, 4);"></i>
                            <i class="m-auto fa-solid fa-arrow-right" v-else="value.position===0"  style="color: rgb(225, 235, 38);"></i>
                        </div>
                    </td>
                    <td class="px-4 py-1 text-center border-2 border-slate-900">{{value.playerName}}</td>
                    <td class="px-4 py-1 text-center border-2 border-slate-900">{{value.countryName}}</td>
                    <td class="px-4 py-1 text-center border-2 border-slate-900">{{value.totalValue}}</td>
                    <td class="px-4 py-1 text-center border-2 border-slate-900">{{value.incrementedValue}}</td>
                    <td class="px-4 py-1 text-center percentage border-2 border-slate-900">{{value.incrementedPercentage}}</td>
                    <td class="px-4 py-1 text-center border-2 border-slate-900 arrow"><i class="m-auto fa-solid fa-arrow-right" 
                        :style="{
                            'transform' : incrementStyleTranslation(value.incrementedPercentage),
                            'color' : incrementStyleColor(value.incrementedPercentage)
                            }"></i></td>
                </tr>
            </tbody>
        </table>
        <div class="flex flex-column" :style="{'display':(showCharts)?'block':'none'}">
            <div class="h-1/3 w-full">
                <canvas class="h-full w-full" ref="donut"></canvas>
            </div>
            <div class="h-1/3 w-full"></div>
            <div class="h-1/3 w-full"></div>
        </div>
    </div>
</template>
<script>
import { Chart } from 'chart.js';
export default {
    props:{
        isTopTable: Boolean,
        tableValues: Object,
        tableName: String,
        topRange:Object
    },
    data() {
		return {
			showCharts: false
		}
	},
    setup: () => ({
        isTopTable:false,
        showCharts:false,
        logo:location.origin + "/img/logo.png",
    }),
    mounted(){
        //calculamos donut
        var chartConfig = {
            type:'pie',
            data:{
                labels:[],
                datasets:[
                    {
                        label:"",
                        data:[]
                    }
                ]
            },
            options:{
                responsive:true
            }
        };
        this.tableValues.forEach(values => {
            chartConfig.data.labels.push(values.countryName)
            chartConfig.data.datasets[0].data.push(values.totalValue);
        });
        var donutChart = new Chart(this.$refs.donut, chartConfig)
    },
    methods:{
        incrementStyleTranslation: function(pertencageString){
            pertencageString = pertencageString.substring(0, pertencageString.length-1);
            var percentage = parseFloat(pertencageString)/100;
            percentage = (percentage>1)? 1 : percentage;
            percentage = (percentage < -1)?-1:percentage;
            return "rotate("+(percentage*-90)+"deg)";
        },
        incrementStyleColor : function(pertencageString){
            pertencageString = pertencageString.substring(0, pertencageString.length-1);
            var percentage = parseFloat(pertencageString)/100;
            percentage = (percentage>1)? 1 : percentage;
            percentage = (percentage < -1)?-1:percentage;
            if(percentage>0){
                return this.rgbToHex(this.colourGradientor(percentage, [39, 130, 3], [240, 250, 60]));
            }else if (percentage<0){
                return  this.rgbToHex(this.colourGradientor(Math.abs(percentage), [212, 28, 4], [240, 250, 60]));
            }else{
                return this.rgbToHex([225, 235, 38])
            }
        },
        rgbToHex:function(rgb) {
            return "#" + ((1 << 24) + (rgb[0] << 16) + (rgb[1] << 8) + rgb[2]).toString(16).slice(1);
        },
        colourGradientor:function(p, rgb_beginning, rgb_end){
            var w = p * 2 - 1;
            var w1 = (w + 1) / 2.0;
            var w2 = 1 - w1;
            var rgb = [parseInt(rgb_beginning[0] * w1 + rgb_end[0] * w2),
                parseInt(rgb_beginning[1] * w1 + rgb_end[1] * w2),
                    parseInt(rgb_beginning[2] * w1 + rgb_end[2] * w2)];
            return rgb;
        }
    }
}
</script>
