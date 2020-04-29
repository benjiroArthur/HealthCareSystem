<template>
<div class="contact-list">
    <input v-model="searchContact" class="form-control form-control-navbar" type="text" placeholder="Search Contact" aria-label="Search Contact">
    <ul>
        <li v-for="(contact) in sortedContacts" :key="contact.id" @click="selectedContact(contact)" :class="{ 'selected' : contact === selected }">
            <div class="avatar">
                <img :src="contact.userable.image" :alt="contact.userable.first_name">
            </div>
            <div class="contact">
                <p class="name">{{contact.userable.full_name}}</p>
                <p>{{contact.role.name === 'doctor' ? 'Doctor' : contact.role.name === 'pharmacy' ? 'Pharmacy' : contact.role.name === 'admin' ? 'Admin' : 'Patient'}}</p>
            </div>
            <span class="unread" v-if="contact.unread">{{ contact.unread }}</span>
            <online-user :contact="contact" :onlineusers="onlineUsers"></online-user>
        </li>
    </ul>
</div>
</template>

<script>
    import OnlineUser from '../ChatExtra/OnlineUser';
    export default {
        components:{ OnlineUser },
        name: "ContactList",
        props:{
            contacts:{
                type: Array,
            },
            onlineUsers:{},
        },
        data(){
            return{
                selected: this.contacts.length ? this.contacts[0] : null,
                searchContact:'',
            }
        },
        methods:{
            selectedContact(contact){
                this.selected = contact;
                this.$emit('selected', contact);
            },

        },
        computed:{
            sortedContacts(){
                return _.sortBy(this.filteredContact, [(contact) => {
                    if(contact === this.selected){
                        return Infinity;
                    }
                    return contact.unread;
                }]).reverse();
            },
            filteredContact(){
                return this.contacts.filter((contact) => {
                    return contact.userable.full_name.toLowerCase().match(this.searchContact.toLowerCase()) ||
                        contact.role.name.toLowerCase().match(this.searchContact.toLowerCase());
                });


                /*return this.contacts.filter((contact) => {
                    return contact.userable.full_name.toLowerCase().match(this.searchContact.toLowerCase()) ||
                        contact.role.name.toLowerCase().match(this.searchContact.toLowerCase());
                });*/
            }
        }
    }
</script>

<style lang="scss" scoped>
    .contact-list{
        flex: 2;
        max-height: 600px;
        min-height: 600px;
        overflow-y: scroll;
        overflow-x: hidden;
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
            &.selected{
                background: #c7a3e2 !important;
                color: white;
            }

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
            span.unread{
                background: #4c0ab8;
                color: #fff;
                position: absolute;
                top: 20px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 3px;
            }

            span.online{
                background: #0eb815;
                color: #0eb815;
                position: absolute;
                top: 20px;
                right: 2px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
            }
        }

    }

</style>
