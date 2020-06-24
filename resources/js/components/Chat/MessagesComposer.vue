<template>
    <div class="card-footer">
            <div class="input-group">
                <textarea-autosize
                    class="form-control"
                    placeholder="Type Message ..."
                    ref="myTextarea"
                    v-model="message"
                    :min-height="20"
                    :max-height="100"
                />
               <!-- <textarea v-model="message" type="text" name="message" placeholder="Type Message ..." class="form-control" rows="1" aria-labelledby="Message"></textarea>-->
                <span class="input-group-append">
                      <button type="button" class="btn bg-health text-white" @click="send">Send</button>
                    </span>
            </div>
    </div>
</template>

<script>
    export default {
        name: "MessagesComposer",
        data(){
            return{
                message: '',
            }
        },
        methods:{
            send(){
                if(this.message === ''){
                    return;
                }
                Fire.$emit('send', this.message);
                this.message = '';
            }
        },
    }
</script>

<style scoped>

</style>
