
<template>
    <div>
        <div class="form-group">
            <router-link to="/materiales" class="btn btn-danger pull-right mb-4">Regresar</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Crear Material</div>
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
                            <label class="control-label">Ancho (centímetros)</label>
                            <input type="number" step=".01" v-model="product.ancho" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Alto (centímetros)</label>
                            <input type="number" step=".01" v-model="product.alto" class="form-control">
                        </div>
                    </div>
                    <div class="row">
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
            axios.post('/api/v1/materials', newProduct)
                .then(function (resp) {
                    app.$router.push({ path: '/materiales' });
                })
                .catch(function (resp) {
                    alert("No se pudo agregar el material");
                });
        }
    }
}
</script>
