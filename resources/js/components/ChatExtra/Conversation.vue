<template>
<div class="conversation">
    <div class="title">
        <h3>{{contact ? contact.userable.srn : 'Select a Contact'}}</h3>
    </div>
    <feed :contact="contact" :messages="messages"/>
    <message-composer @send="sendMessage"/>
</div>
</template>

<script>
    import Feed from '../ChatExtra/Feed';
    import MessageComposer from '../ChatExtra/MessageComposer';
    export default {
        name: "Conversation",
        components:{Feed, MessageComposer},
        props: {
            contact: {
                type: Object,
            },
            messages: {
                type: Array,
            }
        },
        data(){
            return{

            }
        },
        methods:{
            sendMessage(chat){
                if(!this.contact){
                    return;
                }
                axios
                    .post('/records/messages',{
                        to: this.contact.id,
                        chat: chat
                    })
                    .then((response) => {
                        this.$emit('new', response.data);
                    })
                    .catch()
            }
        },
        created() {
        }
    }
</script>

<style lang="scss" scoped>
    .conversation{
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    h1{
        font-size: 20px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed lightgrey;
    }
</style>
