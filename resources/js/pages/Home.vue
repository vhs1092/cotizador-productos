<template>
<div>
    <div class="row xs-column-reverse">
        <div class="col-lg-12">
            <div class="mr-4">
                <blogs></blogs>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Blogs from "@/components/blog/Blogs";

export default {
    name: "Home",
    components: {
        Blogs
    },
    methods: {
        showSignIn() {
            this.$eventBus.signIn();
        }
    }
};
</script>

<style scoped>
.searchBox {
    width: 100%;
}
.search-head{
    background: #807e7e;
    color: white;
}
@media only screen and (max-width: 768px) {
    .searchBox {
        margin-left: 5%;
        margin-right: 5%;
    }
}
</style>
