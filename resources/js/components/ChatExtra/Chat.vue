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
                this.updateUnreadContact(contact, true);
                axios.get(`/records/messages/chat/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })
            },
            saveNewMessage(message){
                this.messages.push(message);
            },
            handleIncoming(message){
                if(this.selectedContact && message.from === this.selectedContact.id){
                    this.saveNewMessage(message);
                    return;
                }
                this.updateUnreadContact(message.from_contact, false);

            },
            updateUnreadContact(contact, reset){
                this.contacts = this.contacts.map((single) => {
                    if(single.id !== contact.id){
                        return single;
                    }
                    if(reset)
                        single.unread = 0;
                    else
                        single.unread += 1;

                    return single;
                })
            },
        },
        mounted() {
            axios.get('/records/friends')
                .then((response) => {
                    this.contacts = response.data;
                });

            Echo.private(`messages.${this.$userId}`)
                .listen('NewMessage', (e) => {
                    this.handleIncoming(e.message);
                });

        }
    }
</script>
<style lang="scss" scoped>
    .chat-app{
        display: flex;
    }
</style>
