<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 c0l-sm-12">
                <div class="card">
                    <div class="card-header">My Profile ( {{this.pharmacy.srn}} )</div>

                    <div class="card-body">

                        <form @submit.prevent="updateProfile" ref="form">
                            <div class="modal-body">
                                <div class="login-logo">
                                    <img :src="this.pharmacy.image" width="100" height="auto" :alt="this.pharmacy.initials" class="userImage img-circle">
                                    <span class="fas fa-camera" data-toggle="modal" data-target="#profileModal" tooltip="Edit Profile Picture"
                                          style="position: absolute; transform: translate(-70%, 200%); -ms-transform: translate(-70%, 200%); width:20px;"></span>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Pharmacy Name</label>
                                            <input v-model="form.pharmacy_name" type="text" name="pharmacy_name"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('pharmacy_name') }">
                                            <has-error :form="form" field="pharmacy_name"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input v-model="form.email" type="email" name="email"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" readonly>
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input v-model="form.phone_number" type="text" name="phone_number"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('phone_number') }">
                                            <has-error :form="form" field="phone_number"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Region</label>
                                            <select v-model="addressForm.region" name="region" v-on:change="getCity"
                                                    class="form-control" :class="{ 'is-invalid': addressForm.errors.has('region') }" >
                                                <option disabled value="">Select Region</option>
                                                <option v-for="region in regions">{{region.name}}</option>


                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <select v-model="addressForm.city" name="city"
                                                    class="form-control" :class="{ 'is-invalid': addressForm.errors.has('city') }" >
                                                <option v-if="addressForm.city !== ''" selected>{{addressForm.city}}</option>
                                                <option v-else disabled value="">Select City</option>
                                                <option v-for="city in cities">{{city.name}}</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Ghana Post GPS Location</label>
                                            <input v-model="addressForm.gp_digital_address" type="text" name="gp_digital_address"
                                                   class="form-control" :class="{ 'is-invalid': addressForm.errors.has('gp_digital_address') }">
                                            <has-error :form="addressForm" field="location"></has-error>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-danger" @click="profileInfo">Reset</button>
                                <button type="submit" class="btn btn-success">Update <i class="fas fa-upload"></i></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--modal for profile image starts here-->
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

                                    <input ref="image"  id="image" type="file" name="image" accept="image/*" class="form-control" style="border: none" @change="loadImage($event)">
                                </div>
                                <div class="col-6">
                                    <img :src="this.image_file" class="uploading-image img-thumbnail" height="128" alt="Preview" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" @click="submitImage">Upload <i class="fas fa-user-plus"></i></button>
                    </div>

                </div>
            </div>
        </div>
        <!--modal for profile image ends here-->
    </div>
</template>

<script>
    export default {
        data(){
            return{
                cities: [],
                regions: [],
                pharmacy : {},
                address : {},
                file: null,
                image_file: '',
                formData: new FormData(),
                form:  new Form({
                    id: '',
                    pharmacy_name: '',
                    email: '',
                    srn: '',
                    phone_number: ''
                }),
                addressForm:  new Form({
                    region: '',
                    city: '',
                    gp_digital_address: ''
                }),
            }
        },
        methods:{
            profileInfo(){

                axios.get('/records/pharmacy/'+ this.$parent.userId)
                    .then(response => {
                        let records = response.data;
                        this.pharmacy = records.userable;
                        this.address = records.address;
                        this.form.fill(this.pharmacy);
                        this.addressForm.fill(this.address);

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
                axios.post( '/data/user/profile/image',
                    this.formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    },
                    this.$Progress.start()
                ).then((response) => {
                    Fire.$emit('profileUpdate');

                    if(response.data === 'Success'){
                        Swal.fire(
                            'Update',
                            'Profile Picture Updated Successfully',
                            'success'
                        );
                    }
                    else{
                        Swal.fire(
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
                axios.put('/records/profile/'+ this.$parent.userId, {
                    userData: this.form,
                    address: this.addressForm
                })
                    .then((response) => {
                        if(response.data === 'success'){
                            Fire.$emit('profileUpdate');
                            console.log(response.data);
                            this.$Progress.finish();
                            Swal.fire(
                                'Update',
                                'Pharmacy Profile Updated Successfully',
                                'success'
                            );
                        }
                    })
                    .catch((error) => {
                        console.log(error.message);
                    });
            },
            getRegion(){
                this.loading = true;
                axios
                    .get('/records/region')
                    .then(response => {
                        this.loading = false;
                        this.regions = response.data;

                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
            getCity(){
                let re = this.addressForm.region;
                this.loading = true;
                axios
                    .get('/records/city/'+re)
                    .then(response => {
                        this.loading = false;
                        this.cities = response.data;

                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
        },
        created(){
            this.profileInfo();
            this.getRegion();
            Fire.$on('profileUpdate', () => {
                this.profileInfo();
            });
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
