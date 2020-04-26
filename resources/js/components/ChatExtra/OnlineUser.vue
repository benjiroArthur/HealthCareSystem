<template>
    <div>
        <span class="fas fa-circle pull-right text-success" v-show="this.checkUser"></span>
        <!--<span class="fas fa-circle pull-right text-danger" v-else></span>-->
    </div>
</template>

<script>
    export default {
        name: "OnlineUser",
        props: ['contact', 'onlineusers'],
        data(){
          return{

          }
        },
        computed:{
            checkUser: function() {
                return _.some(this.onlineusers, {'id': this.contact.id});
            },
        },


    }
</script>

<style scoped>

</style>
