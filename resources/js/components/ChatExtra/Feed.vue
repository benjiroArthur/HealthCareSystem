<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to === contact.id ? ' sent' : ' received'} `" :key="message.id">
                <span>{{message.from_now}}</span>
                <div class="text">
                    {{ message.chat }}
                </div>
            </li>

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
        methods:{
            scrollToBottom(){
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            }
        },
        watch: {
            contact(contact){
                this.scrollToBottom();
            },
            messages(messages){
                this.scrollToBottom();
            },
        },
    }
</script>

<style lang="scss" scoped>
.feed{
    background: #f8f8f8;
    height: 100%;
    max-height: 476px;
    overflow-y: scroll;
    overflow-x: hidden;
    ul{
        list-style: none;
        padding: 5px;

        li{
            &.message{
                margin: 10px;
                width: 100%;

                .text{
                    max-width: 70%;
                    border-radius: 5px;
                    padding: 6px;
                    display: inline-block;
                }

                &.received{
                    text-align: left;
                    .text{
                        background: #4c0ab8;
                        color: white;
                    }
                }
                &.sent{
                    text-align: right;
                    .text{
                        background: #9561e2;
                        color: white;
                    }
                }
            }
        }
    }
}
</style>
