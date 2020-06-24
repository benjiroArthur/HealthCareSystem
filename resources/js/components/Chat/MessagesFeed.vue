<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to === contact.id ? ' sent' : ' received'} `" :key="message.id">
                <!--<span class="text-sm">{{message.from_now}}</span><br>-->
                <div class="text">
                    {{ message.chat }} <br>
                    <span class="text-right">{{ message.from_now }}</span>
                </div>
            </li>

        </ul>
    </div>

</template>

<script>
    export default {
        name: "MessagesFeed",
        props:{
            contact:{
                type: Object,
            },
            messages:{
                type: Array,
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
        max-height: 500px;
        min-height: 500px;
        overflow-y: scroll;
        overflow-x: hidden;
        ul{
            list-style: none;
            padding-left: 0;
            padding-right: 10px;
            li{
                &.message{
                    margin: 5px;
                    width: 100%;
                    padding-top: 10px;
                    .text{
                        max-width: 70%;
                        border-radius: 5px;
                        padding: 6px;
                        display: inline-block;
                    }
                    &.received{
                        text-align: left;
                        .text{
                            background: #515050;
                            color: white;
                        }
                    }
                    &.sent{
                        text-align: right;
                        .text{
                            background: #b35cf5;
                            color: white;
                        }
                    }
                }
            }
        }
    }
</style>
