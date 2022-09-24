const eventBus = {
    install(Vue, options) {
        Vue.prototype.$eventBus = new Vue({
            methods: {
                signIn() {
                    this.$emit('sign-in')
                },
                userLoggedIn() {
                  this.$emit('user-logged-in')
                },
                search(value) {
                    this.$emit('search', value)
                },
                newComment(value) {
                    this.$emit('new-comment', value)
                }
            }
        })

    }
}

export default eventBus