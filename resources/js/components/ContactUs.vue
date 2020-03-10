<template>

        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-10">
                <div class="card">
                    <div class="card-header">CONTACT US</div>
                    <div class="card-body">
                        <form @submit.prevent="" ref="form">
                        </form>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
    export default {
        name: "ContactUs",

        data(){
            return{
                form:  new Form({
                    id: '',
                    last_name: '',
                    first_name: '',
                    other_name: '',
                    email: '',
                    dob: '',
                    gender: '',
                    phone_number: ''
                }),
            }
        },
        methods:{

        },

        created(){

        }
    }
</script>

<style scoped>

</style>
