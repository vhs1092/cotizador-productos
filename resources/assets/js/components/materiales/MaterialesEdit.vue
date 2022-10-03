
<template>
    <div>
        <div class="form-group">
            <router-link to="/materiales" class="btn btn-danger">Regresar</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Editar material</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Nombre</label>
                            <input type="text" v-model="product.nombre" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Unitario</label>
                            <input type="checkbox" style="width: 30px;" v-model="product.unitario" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Lineal</label>
                            <input type="checkbox" style="width: 30px;" v-model="product.lineal" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group" v-if="!product.lineal">
                            <label class="control-label">Ancho (metros)</label>
                            <input type="number" step=".01" v-model="product.ancho" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Alto (metros)</label>
                            <input type="number" step=".01" v-model="product.alto" class="form-control">
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
            axios.get('/api/v1/materials/' + id)
                .then(function (resp) {
                    app.product = resp.data;
                })
                .catch(function () {
                    alert("No se pudo cargar el material")
                });
        },
        data: function () {
            return {
                productId: null,
                product: {
                    nombre: '',
                    unitario: 0,
                    ancho: 0,
                    alto: 0,
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newProduct = app.product;
                axios.patch('/api/v1/materials/' + app.productId, newProduct)
                    .then(function (resp) {
                        app.$router.replace('/materiales');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("No se pudo actualizar el material");
                    });
            }
        }
    }
</script>
