<template>

        <div class="input-title">Project Title</div>
        <input type="text" name="title"  v-model="projectName" class="form-control title" placeholder="Project Name">

        <div class="input-title">Description</div>
        <textarea name="description" placeholder="Description" class="md-textarea form-control description" rows="3"></textarea>

        <div class="input-title">Deadline</div>
        <input type="date" name="deadline" value="" class="form-control deadline">

        <div class="input-title" >Status</div>
        <select class="form-control status" name="status">
            <option  value="open"> Open </option>
            <option  value="close"> Close </option>
            <option  value="waiting"> Waiting </option>
        </select>

        <div class="input-title">Assigned client</div>
        <select name="client_id" class="form-control client_id">
                <option v-for="client in clients" :value="client.id">{{ client.Company}} </option>
        </select>      

        <div class="input-title">Assigned User</div>
        <select name="user_id" class="form-control user_id">
                <option v-for="user in users" :value="user.id">{{user.name }} </option>
        </select>


        <input type="hidden" name="created_at" :value="date"> 
        <input type="hidden" name="slug" :value=toSlag() >

        <br>
        <button class="btn btn-success" @click.stop.prevent="updatePost(itemid)" > {{ page}}</button>      
          
</template>



<script>
    export default {
        props: ['date', 'users', 'clients', 'itemid'],
        mounted() {
            this.identif()
            document.querySelector('[name="title"]').value = document.querySelectorAll('td')[1].innerText
            document.querySelector('[name="description"]').value = document.querySelectorAll('td')[2].innerText
            document.querySelector('[name="deadline"]').value =   document.querySelectorAll('td')[3].dataset.typeid
            document.querySelector('[name="status"]').value = document.querySelectorAll('td')[4].innerText
            document.querySelector('[name="user_id"]').value = document.querySelectorAll('td')[5].dataset.typeid
            document.querySelector('[name="client_id"]').value = document.querySelectorAll('td')[6].dataset.typeid
            document.querySelector('[name="title"]').value = document.querySelectorAll('td')[1].innerText
            this.projectName= document.querySelectorAll('td')[1].innerText
        },
        data() {
            return {
                show: true,
                projectName: '',
                page: 'Update'
            }
        },
        methods: {
            toSlag() {
              return this.projectName
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            },
            updatePost(id) {
              if ( document.querySelector('form.createform') ) {
                  document.querySelector('form.createform').submit()
              }
              else {
                  axios.patch(window.location.href, {
                          client_id: document.querySelector('.client_id').options[document.querySelector('[name="client_id"]').selectedIndex].value,
                          user_id: document.querySelector('.user_id').options[document.querySelector('[name="user_id"]').selectedIndex].value,
                          status: document.querySelector('.status').options[document.querySelector('[name="status"]').selectedIndex].value,
                          title: document.querySelector('.title').value,
                          description: document.querySelector('.description').value
                      })
                  setTimeout(() => window.location.href = window.location.href, 500);
              }
          },
          identif (){
            document.querySelector('form.createform') ? this.page =' Create ' : this.page = ' Update '
          }
        }
           
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