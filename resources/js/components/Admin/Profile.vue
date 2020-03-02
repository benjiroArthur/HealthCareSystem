<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 c0l-sm-12">
                <div class="card">
                    <div class="card-header">My Profile</div>

                    <div class="card-body">
                        
                            <form @submit.prevent="UpdateUser" ref="form">
                    <div class="modal-body">
                        <div class="login-logo">
                            <img src="" width="100" height="auto" alt="user">
                        </div>
                        <div class="form-group">
                        <label>Last Name</label>
                        <input v-model="form.last_name" type="text" name="last_name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('last_name') }">
                        <has-error :form="form" field="last_name"></has-error>
                        </div>
                        <div class="form-group">
                        <label>Firat Name</label>
                        <input v-model="form.first_name" type="text" name="first_name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }">
                        <has-error :form="form" field="first_name"></has-error>
                        </div>
                        <div class="form-group">
                        <label>Other Name</label>
                        <input v-model="form.other_name" type="text" name="other_name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('other_name') }">
                        <has-error :form="form" field="other_name"></has-error>
                        </div>
                        <div class="form-group">
                        <label>Email</label>
                        <input v-model="form.email" type="email" name="email"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                        </div>


                        <div class="form-group">
                            <label>Date Of Birth</label>
                            <input v-model="form.dob" type="date" name="dob"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('dob') }">
                            <has-error :form="form" field="dob"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select v-model="form.gender" type="text" name="gender"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }" >
                                <option>Male</option>
                                <option>Female</option>

                            </select>
                            <has-error :form="form" field="gender"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input v-model="form.phone_number" type="text" name="phone_number"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('phone_number') }">
                            <has-error :form="form" field="phone_number"></has-error>
                        </div>

                    </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                       <button type="submit" class="btn btn-success">Update <i class="fas fa-upload"></i></button>
                    </div>
                    </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                admin: {},
                form: new Form({
                    id: '',
                    last_name: '',
                    first_name: '',
                    other_name: '',
                    email: '',
                    dob: '',
                    gender: '',
                    phone_number: '',
                    image: '',
                    trying: ''
                }),
            };
        },
        created(){
          
            this.loading = true;
            axios
                .get('/data/profile')
                .then(response => {
                     this.loading = false;
                    this.admin = response.data;
                    console.log(response.data);
                    this.form.fill(this.admin);

                }).catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
            });

        }
    }
</script>
