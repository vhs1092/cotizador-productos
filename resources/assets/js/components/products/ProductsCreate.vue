
<template>
    <div>
        <div class="form-group">
            <router-link to="/productos" class="btn btn-danger">Regresar</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Crear Producto</div>
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
                    <hr>
                    <h3>Materiales</h3>
                    <div class="row" style="text-align: right;">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-primary" type="button" @click="addMore()">Agregar otro material</button>
                        </div>
                    </div>
                    <div class="materiales" style="display: flex; margin-top: 20px; align-items: center;" v-for="ma in product.materiales">
                            <div class="col-xs-12 form-group">
                                <label class="control-label">Material</label>
                                <select class="form-control" v-model="ma.id" id="sel1">
                                    <option v-for="material in materiales" :value="material.id">{{material.nombre}}</option>
                                </select>
                            </div>
                            <div class="col-xs-12 form-group">
                                <label class="control-label">Cantidad</label>
                                <input type="numbre" v-model="ma.cantidad" class="form-control">
                            </div>
                           
                    </div>
                    <div class="row pull-right">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Crear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                product: {
                    name: '',
                    description: '',
                    status: 1,
                    materiales: [
                        {
                            id: null,
                            cantidad: 0
                        }
                    ]
                },
                materiales: []
            }
        },
    mounted() {
        var app = this;
        axios.get('/api/v1/materials')
            .then(function (resp) {
                app.materiales = resp.data;
            })
            .catch(function (resp) {
                alert("Error al cargar materiales");
            });

    },
        methods: {
            saveForm() {
                var app = this;
                var newProduct = app.product;
                axios.post('/api/v1/products', newProduct)
                    .then(function (resp) {
                        app.$router.push({path: '/productos'});
                    })
                    .catch(function (resp) {
                        alert("No se pudo crear el producto");
                    });
            },
            addMore() {
                this.product.materiales.push({
                    id: null,
                    cantidad: 0
                });
            }
        }
    }
</script>
