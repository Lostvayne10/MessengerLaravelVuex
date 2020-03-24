<template>
    <div>
        <b-row no-gutters class="h-100">
        <b-col cols="3" md="4">
            <contact-form-component />
            <contact-list-component />
        </b-col>
        <b-col cols="9" md="8">
            <active-conversation-component
                v-if="selectedConversarion"
                :my-image="MyImageUrl"
            >


            </active-conversation-component>
        </b-col>
    </b-row>
    </div>
        
</template>

<script>
    export default {
        props: {
            user : Object
        },
        data(){
            return{
            };
        },
        mounted() {
            this.$store.dispatch('getConversations');
            this.$store.commit('setUser', this.user);
            Echo.private(`users.${this.user.id}`)
		    .listen('MessageSent', (data) => {
                const message = data.message;		 
                message.written_By_Me = false;   	
                 this.$store.commit('addMessage', message);
            });
            
            
            Echo.join(`messenger`)
		    .here((users) => {
                console.log(users);
                users.forEach(user =>
                this.changeStatus(user, true));
            })
            .joining(
                user => 
                this.changeStatus(user,true)
            )
            .leaving(
                user =>
                 this.changeStatus(user,false)
            );
            
        },
        methods: {
           changeActiveConversation(conversation){
               this.getMessages();
           },
           
            changeStatus(user, status){
                
                const index = this.$store.state.conversations.findIndex((conversation) => {
                    return conversation.contact_id == user.id;
                });
                if(index >= 0)
                    this.$set(this.$store.state.conversations[index], 'online', status );
            }
        },
        computed:{
            selectedConversarion(){
                return this.$store.state.selectedConversation;
            },
            MyImageUrl(){
                return `/users/${this.user.image}`;
            }
        }
    }
</script>
