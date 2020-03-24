<template>
       
        <b-list-group>
            <contact-component v-for="conversation in conversationsFiltered"
                                :key="conversation.id"
                                :conversation="conversation"
                                :selected="isSelected(conversation)"
                                @click.native="SelectConversation(conversation)">
            </contact-component>
        </b-list-group>
    
        
</template>

<script>
    export default {
       
        methods: {
            
            SelectConversation(conversation){
                this.$router.push(`/chat/${conversation.id}`)
                this.$store.dispatch('getMessages', conversation);
            },
            isSelected(conversation){
                console.log(this.selectedConversation);
                if(this.selectedConversation)
                    return this.selectedConversation.id === conversation.id;

                return false;
            }
        },
        computed: {
            selectedConversation(){
                
                return this.$store.state.selectedConversation;
            },
            conversationsFiltered(){
                return this.$store.getters.conversationsFiltered;
            }
        }
    }
</script>
