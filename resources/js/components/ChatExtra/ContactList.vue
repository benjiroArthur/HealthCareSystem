<template>
<div class="contact-list">
    <ul>
        <li v-for="(contact, index) in contacts" :key="contact.id" @click="selectedContact(index, contact)" :class="{ 'selected' : index === selected }">
            <div class="avatar">
                <img :src="contact.userable.image" :alt="contact.userable.first_name">
            </div>
            <div class="contact">
                <p class="name">{{contact.userable.full_name}}</p>
                <p>{{contact.role.name}}</p>
            </div>
        </li>
    </ul>
</div>
</template>

<script>
    export default {
        name: "ContactList",
        props:{
            contacts:{
                type: Array,
            },
        },
        data(){
            return{
                selected: 0,
            }
        },
        methods:{
            selectedContact(index, contact){
                this.selected = index;
                this.$emit('selected', contact);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .contact-list{
        flex: 2;
        max-height: 600px;
        overflow: scroll;
        border-left: 1px solid #a6a6a6;
    }
    ul{
        list-style: none;
        padding-left: 0;
        li{
            display: flex;
            border-bottom: 1px solid #a6a6a6;
            padding: 2px;
            height: 80px;
            position: relative;
            cursor: pointer;

            .avatar{
                flex: 1;
                display: flex;
                align-items: center;
                img{
                    width: 35px;
                    border-radius: 50%;
                    margin: 0 auto;
                }
            }
            .contact{
                flex: 3;
                font-size: 10px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;

                p{
                    margin: 0;

                    &.name{
                        font-weight: bold;
                    }
                }
            }
        }

    }

</style>
