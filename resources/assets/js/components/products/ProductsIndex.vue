<template>
    <div>
        <div class="form-group pull-right">
            <router-link :to="{name: 'createProduct'}" class="btn btn-primary">Crear nuevo producto</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Listado de productos</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th width="200">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(product, key) in products" :key="key" >
                        <td>{{ product.name }}</td>
                        <td v-if="product.status == 1" ><button class="btn btn-xs btn-success" v-on:click="changeStatus(key, product.id, 0)">Activo</button></td>
                        <td v-else ><button class="btn btn-xs btn-danger" v-on:click="changeStatus(key, product.id, 1)">Inactivo</button></td>
                        <td>
                            <router-link :to="{name: 'editProduct', params: {id: product.id}}" class="btn btn-xs btn-default">
                                Editar
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(product.id, key)">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                products: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/products')
                .then(function (resp) {
                    app.products = resp.data;
                })
                .catch(function (resp) {
                    alert("Could not load products");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/v1/products/' + id)
                        .then(function (resp) {
                            app.products.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete product");
                        });
                }
            },
            changeStatus(index, id, status){
                var app = this;
                app.products[index].status = status;
                var editProduct = app.products[index];
                axios.patch('/api/v1/products/' + id, editProduct)
                    .then(function (resp) {
                        app.$router.replace('/productos');
                    })
                    .catch(function (resp) {
                        alert("Could not edit your product");
                    });
            }
        }
    }
</script>
