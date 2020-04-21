<template>
<div class="conversation">
    <div class="title">
        <h3>{{contact ? contact.userable.full_name : 'Select a Contact'}}</h3>
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
            sendMessage(text){
                console.log(text);
            }
        },
        created() {
        }
    }
</script>

<style lang="scss" scoped>
    .conversation{
        flex: 5;
    }
</style>
