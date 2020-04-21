<template>
    <div class="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'} `" :key="message.id"></li>
            <div class="text">
                {{message.chat}}
            </div>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "Feed",
        props:{
            contact: {
                type: Object
            },
            messages:{
                type: Array,
                required: true
            }
        },
    }
</script>

<style scoped>

</style>
