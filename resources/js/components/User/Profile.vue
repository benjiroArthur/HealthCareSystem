<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 c0l-sm-12">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        User Profile
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
                profile : {}
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
            axios.get('api/profile')
                .then(({data}) => (this.profile.fill(data)));
        }
    }
</script>
