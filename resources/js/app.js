/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',
    data() {
        return {
            showPreview: false,
            imagePreview: '',
            tweetLeftChars: 255
        }
    },
    mounted() {

        if ( this.$refs.notification ) {
            console.log('notification');
            var notification = this.$refs.notification;
            setTimeout(function(){
                notification.remove();
            }, 2000);
        }
    },
    computed: {
        tweetCharsBackground: function() {
            return {
                'bg-gray-200': this.tweetLeftChars >= 200,
                'bg-orange-200': this.tweetLeftChars >= 100 && this.tweetLeftChars < 200,
                'bg-red-200': this.tweetLeftChars < 100
            }
        }
    },
    methods: {
        updateTweetLeftChars(e) {
            if ( 255 >= e.target.value.length ) {
                this.tweetLeftChars = 255 - e.target.value.length;
            } else {
                this.tweetLeftChars = 0;
                e.target.value = e.target.value.substr(0, 255);
            }

        },
        clearTweetImage() {
            this.$refs.file.value='';
            this.imagePreview = '';
            this.showPreview = false;
        },
        handleFilePreview(){

            /*
             Set the local file variable to what the user has selected.
             */
            this.file = this.$refs.file.files[0];

            /*
             Initialize a File Reader object
             */
            let reader  = new FileReader();

            /*
             Add an event listener to the reader that when the file
             has been loaded, we flag the show preview as true and set the
             image to be what was read from the reader.
             */
            reader.addEventListener("load", function () {
                this.showPreview = true;
                this.imagePreview = reader.result;
            }.bind(this), false);

            /*
             Check to see if the file is not empty.
             */
            if( this.file ){
                /*
                 Ensure the file is an image file.
                 */
                if ( /\.(jpe?g|png|gif)$/i.test( this.file.name ) ) {
                    /*
                     Fire the readAsDataURL method which will read the file in and
                     upon completion fire a 'load' event which we will listen to and
                     display the image in the preview.
                     */
                    reader.readAsDataURL( this.file );
                }
            }
        }
    }
});
