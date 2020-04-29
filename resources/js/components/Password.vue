<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="login-box">
                <!-- /.login-logo -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Change Password</p>

                        <form class="main-login-form" @submit.prevent="updatePassword">


                            <div class="input-group mb-3">
                                <input v-model="passwordForm.old_password" type="password" class="form-control" placeholder="Old Password"
                                      :class="{ 'is-invalid': passwordForm.errors.has('old_password') }" name="old_password" id="old_password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                 <has-error :form="passwordForm" field="old_password"></has-error>
                            </div>
                            <div class="input-group mb-3">
                                <input v-model="passwordForm.password" placeholder="New Password" id="password" type="password"
                                      :class="{ 'is-invalid': passwordForm.errors.has('password') }" class="form-control" name="password" required autocomplete="new-password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                 <has-error :form="passwordForm" field="password"></has-error>
                            </div>
                            <div class="input-group mb-3">
                                <input v-model="passwordForm.password_confirmation" placeholder="Confirm Password" id="password-confirm" type="password"
                                      :class="{ 'is-invalid': passwordForm.errors.has('password_confirmation') }" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                 <has-error :form="passwordForm" field="password_confirmation"></has-error>
                            </div>
                            <div class="row">
                                <!-- /.col -->

                                    <button type="submit" class="btn btn-primary bg-health btn-block">Submit</button>

                                <!-- /.col -->
                            </div>
                        </form>

                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
            <!-- /.login-box -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "Password",
        data(){
            return{
                passwordForm: new Form({
                    old_password: '',
                    password: '',
                    password_confirmation: ''
                }),
                errors:{},
            }
        },
        methods:{
            updatePassword(){
                axios
                    .post(`/records/password/update/${this.$userId}`, this.passwordForm)
                    .then((response) => {
                        if(response.data === 'success'){
                            Swal.fire(
                                'Update',
                                'Password Updated Successfully',
                                'success'
                            );
                        }
                        alert(response.data);
                    })
                    .catch((error) => {
                        Swal.fire(
                            'Update',
                            error.message,
                            'success'
                        );
                    })
            },
        },
    }
</script>

<style scoped>

</style>
