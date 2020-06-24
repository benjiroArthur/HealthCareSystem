<template>
    <div class="card-header">
        <!--<h3 v-if="contact !== null" class="card-title" >{{contact.userable.full_name}}</h3>
        <h3 v-show="contact === null" class="card-title">Select A Contact</h3>-->
        <h3 class="text-sm">{{contact ? contact.userable.srn : 'Select a Contact'}}</h3>

        <div class="card-tools">
            <span v-show="unreadCount > 0" data-toggle="tooltip" :title="unreadCount + 'New Messages'" class="badge bg-success">{{this.unreadCount}}</span>
            <!--<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>-->
            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"
                    data-widget="chat-pane-toggle">
                <i class="fas fa-user-circle h3"></i></button>
            <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>-->
        </div>
    </div>
</template>

<script>
    export default {
        name: "Header",
        props:{
            contact:{
                type: Object,
                default: null,
            },
        },
        data(){
           return{
               selectedContact:{},
               unreadCount: 0,
           }
        },
        methods:{

        },
        mounted() {
            /*Fire.$on('contactSelected', (contact)=>{
                this.selectedContact = contact;
            });*/
        }
    }
</script>

<style scoped>

</style>
