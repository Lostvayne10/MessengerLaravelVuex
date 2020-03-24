import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        messages: [],
        selectedConversation: null,
        conversations: [],
        querySearch: '',
        user: null
    },
    mutations:{
        setUser(state, user){
            state.user = user;  
        },
        newMessagesList(state, messages){
            state.messages = messages;
        },
        addMessage(state, message){
            const conversation = state.conversations.find(function(conversation){
                return conversation.contact_id == message.from_id 
                        || conversation.contact_id == message.to_id;
            });

            const author = state.user.id === message.from_id ? 'Tú' : conversation.contact_name;
            conversation.last_message = `${author}: ${message.content}`;
            var today = new Date();
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + 
            today.getSeconds();
            var dateTime = date+' '+time;
            conversation.last_time = dateTime;
            console.log('datos', state.selectedConversation);
            console.log('msgdatem',message.from_id);
            if(state.selectedConversation.contact_id == message.from_id
                || state.selectedConversation.contact_id == message.to_id){
               
                state.messages.push(message);
            }
            
        },
        selectConversation(state, conversation){
            state.selectedConversation = conversation;
        },
        newQuerySearch(state, newValue){
            state.querySearch = newValue;
        },
        newContactList(state, contacts){
            state.conversations = contacts;
        }

    },
    actions:{
        getMessages(context, conversation){
            axios.get(`/api/messages?contact_id=${conversation.contact_id}`)
            .then(response => { 
               
                context.commit('selectConversation', conversation);
                context.commit('newMessagesList', response.data);   
               
            }
           );
        },
        getConversations(context){
            axios.get('/api/conversations')
            .then((response) => {
                context.commit('newContactList', response.data);
               
            });
        },
        postMessage(context, newMessage){
            const params = {
                to_id: context.state.selectedConversation.contact_id,
                content: newMessage
            }
            axios.post('/api/messages', params)
            .then((response) => {
               if(response.data.success){
                newMessage = '';
                const message = response.data.message;
                message.written_By_Me = true;
               
                context.commit('addMessage', message);
               }
               
            });
        }
    },
    getters:{
        conversationsFiltered(state){

            return state.conversations.filter(
                (conversations) => conversations.contact_name
                .toLowerCase()
                .includes(state.querySearch)
                );
        },
    }
});