<template>
<div class="p-10 flex flex-auto flex-wrap gap-5 place-content-evenly">
    <Stadistic v-for="(tableData, key) in data.stadistics" :tableValues="tableData" :tableName="key" :isTopTable="key === topTableName"
        :topRange="data.tops"></Stadistic>
</div>
</template>
<script>
import Stadistic from '../components/Stadistic.vue';
export default {
    props:{
        topTableName:String,
        data: Object
    },
    components:{Stadistic},
    setup: () => ({
        
    }),
    mounted(){
    }
}
</script>