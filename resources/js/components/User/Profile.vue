<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 c0l-sm-12">
                <div class="card">
                    <div class="card-header">My Profile</div>

                    <div class="card-body">

                        <form @submit.prevent="updateProfile" ref="form">
                            <div class="modal-body">
                                <div class="login-logo">
                                    <img :src="this.out_patient.image" width="100" height="auto" alt="user" class="userImage">
                                    <span class="fas fa-camera" data-toggle="modal" data-target="#profileModal" tooltip="Edit Profile Picture"
                                          style="position: absolute; transform: translate(-70%, 200%); -ms-transform: translate(-70%, 200%); width:20px;"></span>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
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
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" readonly>
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
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
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center">
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
                out_patient : {},
                file: null,
                image_file: '',
                formData: new FormData(),
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
            profileInfo(){
                this.loading = true;
                axios.get('/out_patient/profile')
                    .then(response => {
                        console.log(response.data);
                        this.loading = false;
                        this.out_patient = response.data;
                        this.form.fill(this.out_patient);

                    }).catch(error => {
                        console.log(error.message)
                });
            },

            loadImage(e){
                //
                this.file = e.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(this.file);
                reader.onload = e =>{
                    this.image_file = e.target.result;

                };

            },

            submitImage(){

                //Initialize the form data
                this.formData.append('image', this.file);

                //Add the form data we need to submit

                //Make the request to the POST /single-file URL
                axios.post( '/data/profile/image',
                    this.formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    },
                    this.$Progress.start()
                ).then((response) => {
                    Fire.$emit('profileUpdate');

                    if(response.data == 'Success'){
                        swal.fire(
                            'Update',
                            'Profile Picture Updated Successfully',
                            'success'
                        );
                    }
                    else{
                        swal.fire(
                            'Update',
                            response.data,
                            'warning'
                        );
                    }
                    this.$Progress.finish();

                })
                    .catch(function(error){

                    });
                $('#profileModal').modal('hide');
            },
            updateProfile(){
                this.$Progress.start();
                this.form.put('/data/profile/')
                    .then((response) => {
                        Fire.$emit('profileUpdate');
                        console.log(response.data);
                        this.$Progress.finish();
                        swal.fire(
                            'Update',
                            'User Profile Updated Successfully',
                            'success'
                        );
                    })
                    .catch((error) => {
                        console.log(error.message);
                    });
            }
        },
        created(){
            this.profileInfo();
            Fire.$on('profileUpdate', () => {
                this.profileInfo();
            });
        }
    }
</script>
