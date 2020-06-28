<template>
    <div class="container">
            <!-- DIRECT CHAT SUCCESS -->
            <div class="chat-app card card-success card-outline direct-chat direct-chat-success">
                <!--header-->
                <chat-header :contact="selectedContact"></chat-header>
                <!-- /.card-header -->

                <div class="card-body">
                    <conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"></conversation>
                    <!-- Contacts are loaded here -->
                    <contact-list :contacts="contacts" :onlineUsers="onlineUsers" @selected="startConversationWith"></contact-list>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <messages-composer @send="sendMessage"></messages-composer>
                <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->



    </div>
</template>

<script>
    import Conversation from "./Conversation";
    import MessagesComposer from "./MessagesComposer";
    import ChatHeader from "./ChatHeader";
    import ContactList from "./ContactList";
    export default {
        name: "Chat",
        components: {Conversation, MessagesComposer, ChatHeader, ContactList},
       /* props:{
            user:{
                type: Object,
                required: true,
            }
        },*/
        data(){
            return{
                selectedContact: null,
                messages: [],
                contacts: [],
                contact:[],
                onlineUsers: null,
            }
        },
        methods:{
            getContact(){
                axios.get('/records/friends')
                .then((response)=>{
                    this.contacts = response.data;
                })
                .catch((error)=>{
                    console.log(error.message)
                })
            },
            sendMessage(message){
                if(!this.selectedContact) return;

                axios.post('/records/messages', {
                    to: this.selectedContact.id,
                    chat: message
                }).then((response)=>{
                    this.messages.push(response.data);
                }).catch((error)=>{
                    console.log(error.message)
                })
            },

            startConversationWith(contact){
                this.updateUnreadContact(contact, true);
                axios
                .get(`/records/messages/chat/${contact.id}`)
                .then((response) => {
                    this.messages = response.data;
                    this.selectedContact = contact;
                })
                .catch((error)=>{})
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
            this.getContact();

            Fire.$on('selected', (contact)=>{
                this.startConversationWith(contact);
            });

            Fire.$on('send', (message)=>{
                this.sendMessage(message);
            });

            //listen to message event
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
        },
        created() {

        }
    }
</script>

<style lang="scss" scoped>
    .chat-app{
        /*min-height: 600px;
        max-height: 600px;*/
    }
</style>
