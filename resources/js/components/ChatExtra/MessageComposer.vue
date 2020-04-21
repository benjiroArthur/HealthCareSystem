<template>
<div class="composer">
    <textarea v-model="message" name="" id="" placeholder="Type Your Message"></textarea>
    <button class="btn btn-primary send" @click="send"><span class="fas fa-paper-plane"></span></button>
</div>
</template>

<script>
    export default {
        name: "MessageComposer",
        data(){
            return{
                message:'',
            }
        },
        methods:{
          send(){
              if(this.message == ''){
                  return;
              }
              this.$emit('send', this.message);
              this.message = '';
          }
        },
    }
</script>

<style scoped>
.composer{
    display: flex;
}
.composer textares{
    flex: 1 auto;
}
.composer button{
    border-radius: 50%;
}
</style>
