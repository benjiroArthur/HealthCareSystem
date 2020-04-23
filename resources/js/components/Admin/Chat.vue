<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header"> Chat Page</div>
            <div class="card-body">
                <div class="chat-app">
                    <conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"></conversation>
                    <contact-list :contacts="contacts" @selected="startConversationWith"/>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import Conversation from '../ChatExtra/Conversation';
    import ContactList from '../ChatExtra/ContactList';
    export default {
        components:{Conversation, ContactList},
        data(){
            return{
                selectedContact: null,
                messages: [],
                contacts: [],
            }
        },
        methods:{
            startConversationWith(contact){
                axios.get(`/records/messages/chat/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })
            },
            saveNewMessage(chat){
                this.messages.push(chat);
            },
        },
        mounted() {
            axios.get('/records/friends')
                .then((response) => {
                    this.contacts = response.data;
                })
        }
    }
</script>
<style lang="scss" scoped>
    .chat-app{
        display: flex;
    }
</style>
