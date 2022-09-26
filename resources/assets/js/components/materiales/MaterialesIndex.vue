<template>
    <div>
        <div class="form-group pull-right">
            <router-link :to="{name: 'createMaterial'}" class="btn btn-primary">Agregar material</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Listado</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Unitario</th>
                        <th>Ancho</th>
                        <th>Alto</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(product, key) in products" :key="key" >
                        <td>{{ product.nombre }}</td>
                        <td>{{ product.unitario ? 'Si' : 'No' }}</td>
                        <td>{{ product.ancho }}</td>
                        <td>{{ product.alto }}</td>
                        <td>
                            <router-link :to="{name: 'editMaterial', params: {id: product.id}}" class="btn btn-xs btn-primary">
                                Editar
                            </router-link>
                            <!--a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(product.id, key)">
                                Delete
                            </a-->
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
            axios.get('/api/v1/materials')
                .then(function (resp) {
                    app.products = resp.data;
                })
                .catch(function (resp) {
                    alert("Error al cargar materiales");
                });
        },
        methods: {
            /*deleteEntry(id, index) {
                if (confirm("Quieres E?")) {
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
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        alert("Could not edit your product");
                    });
            }*/
        }
    }
</script>
