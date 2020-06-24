<template>
    <!-- Conversations are loaded here -->
    <messages-feed :contact="contact" :messages="messages"></messages-feed>
    <!--/.direct-chat-messages-->

</template>

<script>
    import MessagesFeed from "./MessagesFeed";
    export default {
        name: "Conversation",
        components: {MessagesFeed},
        props:{
            contact:{
                type: Object,
                default: null,
            },
            messages: {
                type: Array,
                default: [],
            },
        },
        data(){
            return{

            }
        },
    }
</script>

<style scoped>

</style>
