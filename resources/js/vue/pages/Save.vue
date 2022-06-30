<template>
    <TablePage :data="tables" :topTableName="topTableName"></TablePage>
</template>
<script>
import axios from 'axios';
import TablePage from './TablePage.vue';

export default {
    props:{
        topTableName: String,
        year: Number
    },
    setup: () => ({
        
    }),
    components:{TablePage},
    data(){
        return{
            tables: []
        }
    },
    mounted(){

        axios.get(location.origin + "/storage/save.json").then(
            response=>{
                this.tables = response.data;
            }
        )
        

        // Production
        // let urlParam = location.pathname.split("/");
        // const saveId = urlParam[urlParam.length-1];
        // axios
        //     .post(location.origin + "/api/save",{id:saveId})
        //     .then(response=>{
        //         this.tables = response.data;
        //     });
    }
}
</script>