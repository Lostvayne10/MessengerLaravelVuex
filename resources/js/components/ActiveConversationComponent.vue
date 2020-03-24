<template>
    <b-row  class="h-100">
        <b-col cols="8">
            <b-card no-body
                footer-bg-variant="info"
                footer-border-variant="dark"
                class="h-100"
              >
                <b-card-body class="card-body-scroll">

                    <message-conversation-component   
                        v-for="message in messages"
                        :key="message.id"
                        :writtenByMe =  "message.written_By_Me"
                        :image="message.written_By_Me ? myImage : selectedConversation.contact_image">
                        {{ message.content }}
                    </message-conversation-component> 

                </b-card-body> 

                <div slot="footer">
                    <b-form class="mb-0" @submit.prevent="postMessages" autocomplete="off">

                        <b-input-group>
                            <b-form-input class="text-center"
                            type="text"
                            v-model="newMessage"
                            placeholder="Escribe un mensaje...">
                            </b-form-input>
                            <b-input-group-append>
                                <b-button type="submit" variant="primary">Enviar</b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </b-form>
                </div>
            </b-card>
        </b-col>
        <b-col cols="4">
            <b-img :src="selectedConversation.contact_image" rounded="circle"   width="60" height="60"   alt="img" class="mb-0"></b-img>
            <p>{{ selectedConversation.contact_name }}</p>
            <hr>
            <b-form-checkbox> 
                Desactivar Notificaciones
            </b-form-checkbox>
        </b-col>
    </b-row>
</template>

<style >
    .card-body-scroll{
        max-height : calc(100vh - 63px);
        overflow-y: auto;
    }
</style>

<script>
export default {
        props: {
            myImage: String
        },
        data(){
            return{
                newMessage: ''
                
            };
        },
        mounted() {
          this.scrollToBottom();
        },
        methods: {
            
            postMessages(){
                
               this.$store.dispatch('postMessage', this.newMessage);
                this.newMessage = '';
            },
            scrollToBottom(){
                const el = document.querySelector('.card-body-scroll');
                el.scrollTop = el.scrollHeight;
            }
        },
        updated(){
            this.scrollToBottom();
        },
        computed: {
            messages() {
                return this.$store.state.messages;
            },
            selectedConversation(){
                console.log(this.$store.state.selectedConversation);
                return this.$store.state.selectedConversation;
            }
        }

    }
</script>