<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 c0l-sm-12">
                <div class="card">
                    <div class="card-header"><h3>My Profile</h3></div>

                    <div class="card-body">

                     <form @submit.prevent="updateProfile" ref="form">
                    <div class="modal-body">
                        <div class="login-logo">
                            <img :src="this.admin.image" width="100" height="auto" alt="user" class="userImage">
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
        <div class="modal" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title">Upload Profile Picture</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                            <div class="col-6">
                                <label>Profile Picture</label>
                                <input id="file" type="file" name="file" ref="file" accept="image/*" class="form-control" style="border: none" @change="loadImage($event)">
                            </div>
                            <div class="col-6">
                                <img :src="this.image_file" class="uploading-image img-thumbnail" height="128" alt="Preview" />
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" @click="submitImage">Upload <i class="fas fa-user-plus"></i></button>
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
                formData: new FormData(),
                admin: {},
                file: null,
                image_file: '',
                form: new Form({
                    id: '',
                    last_name: '',
                    first_name: '',
                    other_name: '',
                    email: '',
                    dob: '',
                    gender: '',
                    phone_number: '',
                    trying: ''
                }),
            };
        },
        methods:{
            profileInfo(){
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
            },
            loadImage(e){
                //
                this.file = e.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(this.file);
                reader.onload = e =>{
                this.image_file = e.target.result;

                };
                //console.log(this.file);
            },
            submitImage(){

                //Initialize the form data


                //Add the form data we need to submit
                this.formData.append('image', this.file);
                console.log(this.formData);

                //Make the request to the POST /single-file URL
                axios.put( '/data/profile/image',
                    this.formData,
                    {
                        headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                    },
                    this.$Progress.start()
                ).then(function(response){
                    Fire.$emit('profileUpdate');
                    console.log(response.data);
                    this.$Progress.finish();
                    swal.fire(
                        'Update',
                        'Profile Picture Updated Successfully',
                        'success'
                    );

                })
                    .catch(function(error){
                        console.log(error.data);
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
