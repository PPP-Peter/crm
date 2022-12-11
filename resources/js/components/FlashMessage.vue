<template>
   
    <div class="alert alert-success" role="alert" v-show="visible">
        <div class="card-header"> {{ text }} 
            <span  @click="hide"><i class="fa fa-window-close" aria-hidden="true"></i></span>
        </div> 
    </div>

</template>

<script>
    export default {
        props: ['text'],

        data(){
            return {
                visible:false
            }
        },
       
        methods: {
            show() {
                this.visible = true
                setTimeout(() => this.hide(), 3000);
            },
            hide() {
                this.visible = false
            }
        },
         mounted() {
            if(this.text){
                this.show()
            }
             
        }
   
    }
</script>

<style>
    .alert{
        background-color: rgb(69, 189, 91); 
        color:white;
        position:absolute; 
        z-index:999; 
        padding:10px 20px;
        right:100px;
    }
        span{
        cursor:pointer;
        margin-left:5px;
    }
</style>
