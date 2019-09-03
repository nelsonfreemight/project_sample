<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">HI HELLO</div>

                    <div class="card-body">
                        {{ user.name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'home',
        computed: {
            user() {
                return this.$store.getters.currentUser
            }
        }
    }
</script>