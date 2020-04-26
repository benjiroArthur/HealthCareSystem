<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header"> Chat Page</div>
            <div class="card-body">
                <div class="chat-app">
                    <conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"></conversation>
                    <contact-list :onlineUsers="onlineUsers" :contacts="contacts" @selected="startConversationWith"/>
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
                onlineUsers: null,
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
            markAsRead(message){
              axios.put(`/records/messages/${message.id}`, message)
                  .then((response) => {

                  })
            },
            handleIncoming(message){
                if(this.selectedContact && message.from === this.selectedContact.id){
                    this.saveNewMessage(message);
                    this.markAsRead(message);
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

            if(this.$userId !== 0){
                Echo.join('Online')
                    .here((users) => {
                        this.onlineUsers = users;
                    })
                    .joining((user) => {
                        this.onlineUsers.push(user);
                    })
                    .leaving((user) => {
                        this.onlineUsers = this.onlineUsers.filter((u) => {
                            u !== user;
                        });
                    })
            }

        }
    }
</script>
<style lang="scss" scoped>
    .chat-app{
        display: flex;
    }
</style>
