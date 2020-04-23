<template>
<div class="composer">
    <div class="input-group mb-3">
        <textarea type="text" v-model="message" class="form-control" placeholder="Type Your Message" aria-label="Recipient's username" aria-describedby="button-addon2"></textarea>
        <div class="input-group-append">
            <button class="btn btn-primary bg-health send" type="button" id="button-addon2" @click="send"><span class="fas fa-paper-plane text-white"></span></button>
        </div>
    </div>
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
              if(this.message === ''){
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
.composer textarea{
    width: 100%;
    /*margin: 18px;*/
    resize: none;
    border-radius: 3px;
    border: 1px solid #9561e2;
    padding: 6px;
}

</style>
