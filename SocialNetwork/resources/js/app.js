
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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
    	msg: 'update new post',
    	content:'',
    	posts: [],
    },

	ready: function(){
	   this.created();
	},

    created() {
    	axios.get('http://localhost/www/framework/SocialNetwork/public/posts')
		.then(response => {
			console.log(response); //show if success
			this.posts=response.data; //we are putting data into our posts array
		})
		.catch(function (error) {
			console.log(error);
		});
    },

    methods: {
    	addPost(){
    		//alert('test function');
    		axios.post('http://localhost/www/framework/SocialNetwork/public/addPost', {
    			content: this.content
    		})
    		.then(response => {
    			this.content="";
    			console.log('saved successfully'); //show if success
    			if(response.status===200){
              		app.posts = response.data;
				}
    		})
    		.catch(function (error) {
    			console.log(error);
    		});
    	}
    }
});
