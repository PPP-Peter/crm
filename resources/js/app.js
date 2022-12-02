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
            message: 'Vue',
            filter: '',
            value: 20,
            newDude: '',
            show: true,
            pole: ['pole1', 'pole2', 'pole3'],
            editing: false,
        }
    },
    methods: {
        add() {
            this.pole.push(
                this.newDude
            )
        },
        remove(dude) {
            this.pole = this.pole.filter(item => item !== dude)
        },
        update() {
            this.editing = false
        },

        deletePost(id) {
            axios.delete(window.location.href + '/' + id)
                .then(response => {
                    console.log(response);
                });
            setTimeout(() => window.location.href = window.location.href, 1000);

            // console.log(this.$el)
            //this.$el.querySelector('.label-danger').parentElement.parentElement.style.display = 'none';
            // this.$el.style.display = 'none';


        },
    },
    mounted() {
        console.log('spustene Vue');
    },

});

import NewProjectPart from './components/NewProjectPart.vue';
app.component('new-project-part', NewProjectPart);

import NewClientPart from './components/NewClientPart.vue';
app.component('new-client-part', NewClientPart);

import NewTaskPart from './components/NewTaskPart.vue';
app.component('new-task-part', NewTaskPart);

import FlashMessage from './components/FlashMessage.vue';
import axios from 'axios';
import { remove } from 'lodash';
app.component('flash-message', FlashMessage);



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