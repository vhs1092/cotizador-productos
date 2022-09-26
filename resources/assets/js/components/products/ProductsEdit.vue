
<template>
    <div>
        <div class="form-group">
            <router-link to="/productos" class="btn btn-danger">Regresar</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Editar producto</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Nombre</label>
                            <input type="text" v-model="product.name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Descripción</label>
                            <input type="text" v-model="product.description" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.productId = id;
            axios.get('/api/v1/products/' + id)
                .then(function (resp) {
                    app.product = resp.data;
                })
                .catch(function () {
                    alert("No se pudo cargar el producto")
                });
        },
        data: function () {
            return {
                productId: null,
                product: {
                    name: '',
                    description: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newProduct = app.product;
                axios.patch('/api/v1/products/' + app.productId, newProduct)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("No se pudo editar el producto");
                    });
            }
        }
    }
</script>
