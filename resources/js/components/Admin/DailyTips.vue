<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 c0l-sm-12">
                <div class="card">
                    <div class="card-header">Daily Tips</div>

                    <div class="card-body">
                        <form @submit.prevent="contact" ref="form">
                            <div class="form-group"><input v-model="form.full_name" type="text" name="name" placeholder="Full Name" required class="form-control"/></div>
                            <div class="form-group"><input v-model="form.email" type="email" name="email" placeholder="Email" required class="form-control"/></div>
                            <div class="form-group"><textarea v-model="form.message" name="message" class="form-control" cols="8" placeholder="Message"></textarea></div>
                            <div class="form-group justify-content-center">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Submit <i class="fas fa-upload"></i></button>
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
        name: "DailyTips"
    }
</script>

<style scoped>

</style>