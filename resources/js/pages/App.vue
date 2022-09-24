<template>
    <div>
        <notifications group="app" />
        <router-view name="header"></router-view>
        <div class="container mt-4">
            <router-view></router-view>
        </div>
        <router-view name="footer"></router-view>
        <sign-in></sign-in>
    </div>
</template>

<script>
    import SignIn from '@/components/SignIn'

    export default {
        name: "App",
        components:{
            SignIn
        }
    }
</script>

<style scoped>
    .mt-4 {
        margin-top: 50px !important;
    }
</style>