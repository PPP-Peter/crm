<template>

        <div class="input-title">Company</div>
        <input type="text" name="Company" class="form-control Company" placeholder="Company"><br>

        <div class="input-title">Address</div>
        <textarea name="Address" placeholder="Address" class="md-textarea form-control Address" rows="3"></textarea>

        <div class="input-title">VAT</div>
        <input  name="VAT" value="" class="form-control VAT" placeholder="VAT number">

        <input type="hidden" name="created_at" :value="date"> <br>

        <input name="image"  v-show="page=='Create'" type="file" id="image" class="form-control" /> 

        <button class="btn btn-success" @click.stop.prevent="updatePost(itemid)" > {{ page }}</button>   
                      
</template>



<script>
    export default {
        props: ['date', 'itemid'],
        mounted() {
            this.identif()
            document.querySelector('[name="Company"]').value = document.querySelectorAll('td')[1].innerText
            document.querySelector('[name="Address"]').value = document.querySelectorAll('td')[2].innerText
            document.querySelector('[name="VAT"]').value = document.querySelectorAll('td')[3].innerText
        },
        data() {
            return {
            show: true,
            page: 'Update',
            }
        },
        methods: {
            updatePost(id) {
                if ( document.querySelector('form.createform') ) {
                    document.querySelector('form.createform').submit()
                }
                else {
                    axios.patch(window.location.href, {
                            VAT: Number(document.querySelector('.VAT').value),
                            Company: document.querySelector('.Company').value,
                            Address: document.querySelector('.Address').value
                        })
                   setTimeout(() => window.location.href = window.location.href, 500);
                }
            },
            identif (){
              document.querySelector('form.createform') ? this.page ='Create' : this.page = 'Update'
            }
        },
    }
</script>


<style>
    .slide-fade-enter-active {
        transition: all 0.3s ease-out;
    }

    .slide-fade-leave-active {
        transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
    }

    .slide-fade-enter-from,
    .slide-fade-leave-to {
        transform: translateX(20px);
        opacity: 0;
    }
</style>