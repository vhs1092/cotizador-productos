<template>
    <div id="app">
        <div class="container-sm">
            <h4>Cotizador</h4>
            <form class="frm">
                <div class="row" v-for="(product, counter) in products" v-bind:key="counter">
                    <div class="form-group col-md-12">
                        <br />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="title" class="control-label mb-2">Producto</label>
                        <select class="form-select form-select-sm form-control form-control-sm" v-model.lazy="product.name"
                            aria-label=".form-select-sm example">
                            <option v-for="product in allProducts" :value="product.id">{{product.name}}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-2">Ancho</label>
                        <input type="number" v-model.lazy="product.width" class="form-control form-control-sm" id="fname"
                            placeholder="Ancho" />
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-2">Alto</label>
                        <input type="number" v-model.lazy="product.height" class="form-control form-control-sm" id="fname"
                            placeholder="Alto" />
                    </div>
                    <div class="form-group col-md-1">
                        <label class="control-label mb-2">Cantidad</label>
                        <input type="number" v-model.lazy="product.unit" class="form-control form-control-sm" id="fname"
                             />
                    </div>
                    <div class="form-group col-md-2 text-end">
                        <label class="control-label mb-2 d-block">Eliminar producto</label>
                        <button @click="deleteProduct(counter)" type="button" class="btn btn-danger remove d-inline"
                            style="font-size: 22px; line-height: 0; border-radius: 50px; width: 40px; height: 40px;">-</button>
                    </div>
                </div>
                <div class="form-group col-md-12 mt-4 text-end">
                    <button @click="addProduct" type="button" class="btn btn-danger add d-inline"
                        style="font-size: 22px; line-height: 0; border-radius: 50px; width: 40px; height: 40px;">+</button>
                </div>

                <div class="form-group col-md-12 mt-4 text-end">
                    <button type="button" @click="handleClick()" class="btn btn-danger">Cotizar</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    name: 'App',
    components: {
    },
    data() {
        return {
            products: [
                {
                    name: '',
                    unit: null,
                    width: '',
                    height: ''
                }
            ],
            allProducts: []
        }
    },
    mounted() {
        var app = this;
        axios.get('/api/v1/products')
            .then(function (resp) {
                app.allProducts = resp.data;
            })
            .catch(function (resp) {
                alert("Could not load products");
            });
    },
    methods: {
        addProduct() {
            this.products.push({
                name: '',
                width: '',
                height: ''
            })
        },
        deleteProduct(counter) {
            this.products.splice(counter, 1);
        },
        handleClick() {
            const productsMaterials = [
                {
                    name: 'puerta-pvc',
                    materials: [
                        {
                            id: '1',
                            name: 'visagra',
                            isUnitary: true,
                            cant: 2
                        },
                        {
                            id: "2",
                            name: 'pvc',
                            isUnitary: false,
                            width: 1,
                            height: 0.50
                        },
                        {
                            id: '3',
                            name: 'vidrio',
                            isUnitary: false,
                            width: 1,
                            height: 0.50
                        }
                    ]
                },
                {
                    name: 'ventana-pvc',
                    materials: [
                        {
                            id: '1',
                            name: 'visagra',
                            isUnitary: true,
                            cant: 2
                        },
                        {
                            id: "2",
                            name: 'pvc',
                            isUnitary: false,
                            width: 1,
                            height: 0.50
                        },
                        {
                            id: '3',
                            name: 'vidrio',
                            isUnitary: false,
                            width: 1,
                            height: 0.50
                        }
                    ]
                },
                {
                    name: 'puerta-aluminio',
                    materials: [
                        {
                            id: '1',
                            name: 'visagra',
                            isUnitary: true,
                            cant: 2
                        },
                        {
                            id: "2",
                            name: 'aluminio',
                            isUnitary: false,
                            width: 1,
                            height: 0.50
                        },
                        {
                            id: '3',
                            name: 'vidrio',
                            isUnitary: false,
                            width: 1,
                            height: 0.50
                        }
                    ]
                },
                {
                    name: 'ventana-aluminio',
                    materials: [
                        {
                            id: '1',
                            name: 'visagra',
                            isUnitary: true,
                            cant: 2
                        },
                        {
                            id: "2",
                            name: 'aluminio',
                            isUnitary: false,
                            width: 1,
                            height: 0.50
                        },
                        {
                            id: '3',
                            name: 'vidrio',
                            isUnitary: false,
                            width: 1,
                            height: 0.50
                        }
                    ]
                },
            ]

            console.log(this.allProducts)
          
            const materials = {};
            const planchas = {};

            this.products.map((product) => {
                const findProduct = this.allProducts.find(prod => prod.name === product.name)
                findProduct.materiales.map(material => {

                    const findMaterial = Object.keys(materials).find(element => materials[element].name == material.material.name)
                    if (!findMaterial) {
                        materials[material.material.id] = {
                            name: material.material.name,
                            unit: null,
                            lineal: null,
                        }
                    } 

                    if (material.material.unitario) {
                        materials[findMaterial.id]['unit'] = materials[findMaterial.id].unit ? materials[findMaterial.id]['unit'] + 1 : 1;
                    } else {
                        if (material.material.lineal) {
                            const defaultLarge = material.material.alto - (product.width * 2);

                            if (!materials[findMaterial.id]['lineal']) {
                                let sheet = 1;
                                const widthCount = 1;
                                const heightCount = 0;
                                const allWaste = [];

                                let waste = defaultLarge;
                              
                                while (widthCount <= 2 && heightCount <= 2) {
                                    if (heightCount < 2 && product.width < waste) {
                                        waste = waste - product.width;
                                    } else if (heightCount < 2 && product.height < waste) {
                                        waste = waste - product.width;
                                    } else {
                                        sheet = sheet + 1;
                                        allWaste.push(waste)
                                        waste = defaultLarge;
                                    }
                                }

                                materials[findMaterial.id]['lineal'] = {
                                    waste,
                                    sheet
                                }
                            }
                            materials[findMaterial.id]['lineal'] = materials[findMaterial.id].unit ? materials[findMaterial.id]['unit'] + mts : mts;
                        }
                    }
                })
            })
            console.info(this.products)
        }
    }
}
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}

</style>