/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({

    data() {
        return {
            filter: '',
            edit: 'EDIT',
            show: false,
            editing: false,
            min: false,
            isActive: true,
            info: null,
            token: false,
            role: 'admin'
        }
    },
    methods: {
        update() {
            this.editing = false
        },
        deletePost(id) {
            if (window.confirm('Do you want to delete this item?')) {
                axios.delete(window.location.href.replace('/archive', '') + '/' + id)
                setTimeout(() => window.location.href = window.location.href, 1000);
            }
        },
        showPage() {
            window.location.href.includes('#show') ? this.show = false : this.show = true
            window.location.href.includes('#show') ? this.edit = 'SHOW' : this.show = true
            window.matchMedia("(min-width: 768px)").matches ? this.isActive = true : this.isActive = false
        },
        toggle() {
            this.isActive ? this.isActive = false : this.isActive = true;
        },
        shorten(text, max) {
            return text && text.length > max ? text.slice(0, max).split(' ').slice(0, -1).join(' ') + '...' : text
        },
        minimalize() {
            if (this.min == false) {
                this.min = true
                document.querySelector('#page-wrapper').style.marginLeft = "80px";
                document.querySelector('.navbar-side').style.width = "80px";
                document.querySelector('.navbar-brand').style.width = "80px";
                document.querySelectorAll('#main-menu span').forEach(element => element.style.display = "none")
            } else {
                this.min = false
                document.querySelector('#page-wrapper').style.marginLeft = "260px";
                document.querySelector('.navbar-side').style.width = "260px";
                document.querySelector('.navbar-brand').style.width = "260px";
                document.querySelectorAll('#main-menu span').forEach(element => element.style.display = "contents")
            }
        },
        updatePost() {
            axios
                .get('/crm/public/user-json')
                .then(response => (this.info = response.data.token))
            this.token = true
        },
        zavriToken() {
            this.token = false
        }



    },
    mounted() {
        this.showPage()
        if (document.querySelector('.chat-widget-main')) document.querySelector('.chat-widget-main').scrollTo(0, 9999)
        document.querySelectorAll('#index .tdtext').forEach(element => element.innerText = this.shorten(element.innerHTML, 120))
    },

});

import NewProjectPart from './components/NewProjectPart.vue';
app.component('new-project-part', NewProjectPart);

import NewClientPart from './components/NewClientPart.vue';
app.component('new-client-part', NewClientPart);


import NewTaskPart from './components/NewTaskPart.vue';
app.component('new-task-part', NewTaskPart);


import FlashMessage from './components/FlashMessage.vue';
app.component('flash-message', FlashMessage);

import axios from 'axios';
import { remove } from 'lodash';




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');