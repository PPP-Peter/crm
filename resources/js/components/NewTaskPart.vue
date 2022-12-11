<template>

        <div class="input-title">Task Title</div>
        <input type="text" name="title"  class="form-control title" placeholder="Task name">

        <div class="input-title">Description</div>
        <textarea name="description" placeholder="Description" class="md-textarea form-control description" rows="3"></textarea>             

        <div class="input-title" >Status</div>
        <select class="form-control status" name="status">
            <option  value="open"> Open </option>
            <option  value="close"> Close </option>
        </select>
        
        <div class="input-title" >Priority</div>
        <select class="form-control priority" name="priority">
            <option value="1 - low"> 1 - low </option>
            <option value="2 - medium"> 2 - medium </option>
            <option value="3- hight"> 3- hight </option>
        </select>

        <div class="input-title">Assigned client</div>
        <select name="client_id" class="form-control client_id">
                <option v-for="client in clients" :value="client.id">{{ client.Company}} </option>
        </select>      

        <div class="input-title">Assigned User</div>
        <select name="user_id" class="form-control user_id">
                <option v-for="user in users" :value="user.id">{{user.name }} </option>
        </select>

        <div class="input-title">Assigned Project</div>
        <select name="project_id" class="form-control project_id">
                <option v-for="project in projects" :value="project.id">{{project.title }} </option>
        </select>

        <input type="hidden" name="created_at" :value="date"> <br>

        <button class="btn btn-success" @click.stop.prevent="updatePost(itemid)"> {{ page }} </button>     
                   
</template>



<script>
    export default {
        props: ['date', 'users', 'clients', 'itemid', 'projects'],
        mounted() {
            this.identif()
       
            if(document.querySelector('.tasks')){
                    document.querySelector('[name="title"]').value = document.querySelectorAll('td')[1].innerText
                    document.querySelector('[name="description"]').value = document.querySelectorAll('td')[2].innerText
                    document.querySelector('[name="priority"]').value = document.querySelectorAll('td')[3].innerText
                    document.querySelector('[name="status"]').value = document.querySelectorAll('td')[4].innerText
                    document.querySelector('[name="user_id"]').value = document.querySelectorAll('td')[5].dataset.typeid
                    document.querySelector('[name="client_id"]').value = document.querySelectorAll('td')[6].dataset.typeid
                    document.querySelector('[name="project_id"]').value = document.querySelectorAll('td')[7].dataset.typeid
            }
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
                    let newTitle = document.querySelector('.title').value
                    let newDescription = document.querySelector('.description').value
                    let newStatus =  document.querySelector('.status').options[document.querySelector('[name="status"]').selectedIndex].value
                    let newPriority = document.querySelector('.priority').options[document.querySelector('[name="priority"]').selectedIndex].value
                    let newUser_id = document.querySelector('.user_id').options[document.querySelector('[name="user_id"]').selectedIndex].value
                    let newClient_id = document.querySelector('.client_id').options[document.querySelector('[name="client_id"]').selectedIndex].value
                    let newProject_id = document.querySelector('.project_id').options[document.querySelector('[name="project_id"]').selectedIndex].value
                    var task_id = document.querySelectorAll('td')[0].innerText
                    var title = document.querySelectorAll('td')[1].innerText
                    var description = document.querySelectorAll('td')[2].innerText
                    var status =  document.querySelectorAll('td')[4].innerText
                    var priority = document.querySelectorAll('td')[3].innerText
                    var user_id = document.querySelectorAll('td')[5].innerText
                    var client_id = document.querySelectorAll('td')[6].innerText
                    var project_id = document.querySelectorAll('td')[7].innerText
                    axios.post("/crm/public/task-history/"+ task_id + "/" + title + "/" + description + "/" + status + "/" + priority + "/" + user_id + "/" +client_id + "/" + project_id)
                     //axios.post("http://localhost/cccrm/public/task-history/9/New%20task%202/description%203/open/1%20-%20low/admin/Fuga%20quia/Nihil")
                    axios.patch(window.location.href, {
                            client_id: newClient_id,
                            user_id: newUser_id,
                            project_id: newProject_id,
                            status: newStatus,
                            priority: newPriority,
                            title: newTitle,
                            description: newDescription
                        })
                    setTimeout(() => window.location.href = window.location.href, 1000);
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