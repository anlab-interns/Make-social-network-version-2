require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    data: {
    	msg:'Click on user from left side',
    	content:'',
        privsteMsgs: [],
        singleMsgs: [],
        msgFrom:'',
        conID:'',
        friend_id: '',
        seen: false,
        newMsgFrom: '',
        qry:'',
        results: []
    },

	ready: function(){
	   this.created();
	},

    created() {
    	axios.get('http://localhost/www/framework/SocialNetwork/public/getMessages')
		.then(response => {
			console.log(response); //show if success
			app.privsteMsgs=response.data; 
		})
		.catch(function (error) {
			console.log(error);
		});
    },

    methods: {
    	messages: function(id){
            axios.get('http://localhost/www/framework/SocialNetwork/public/getMessages/' +id)
            .then(response => {
                console.log(response); //show if success
                app.singleMsgs=response.data; 
                app.conID=response.data[0].conversation_id; 
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        inputHandler(e){
            if(e.keyCode ===13 && !e.shiftKey){
                e.preventDefault();
                this.sendMsg();
            }
        },

        sendMsg(){
            axios.post('http://localhost/www/framework/SocialNetwork/public/sendMessage',{
                conID: this.conID,
                msg: this.msgFrom
            })
            .then(function (response) {
                console.log(response.data); //show if success
                if (response.status===200) {
                    app.singleMsgs=response.data;
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        friendID: function(id){
            app.friend_id = id;
        },

        sendNewMsg(){
            axios.post('http://localhost/www/framework/SocialNetwork/public/sendNewMessage', {
                friend_id: this.friend_id,
                msg: this.newMsgFrom,
            })
            .then(function (response) {
                console.log(response.data); 
                if(response.status===200){
                    window.location.replace('http://localhost/www/framework/SocialNetwork/public/messages');
                    app.msg = 'your message has been sent successfully';
                }
            })
            .catch(function (error) {
                    console.log(error); 
            });
        },

        autoComplete(){
            //alert(this.qry);
            this.results=[];
            axios.post('http://localhost/www/framework/SocialNetwork/public/search', {
                qry: this.qry
            })
            .then(function (response) {
                console.log(response.data); 
                app.results=response.data;
            });
        }
    }
});
