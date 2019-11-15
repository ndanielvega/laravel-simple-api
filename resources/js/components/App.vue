<template>
    <div class="container">
        <nav class="box">
          <h2>Productos</h2>
          <div>
              <input v-model="input" type="text" name="" id=""> 
              <div>
                  <input type="radio" name="filtro" value="filtro1" v-model="radioinput"> 1
                  <input type="radio" name="filtro" value="filtro2" v-model="radioinput"> 2
                  <input type="radio" name="filtro" value="filtro3" v-model="radioinput"> 3
                  <input type="radio" name="filtro" value="filtro4" v-model="radioinput"> 4
              </div>
              <button class="btn" @click="addProduct()" >Agregar Producto</button>
          </div> 
          
        </nav>

        <main>
            <div class="filtros">
                <div><input type="checkbox" @change="filtrar('filtro1')" id="filtro1" v-model="filtro1" > <label for="filtro1">Filtro 1</label> </div>
                <div><input type="checkbox" @change="filtrar('filtro2')" id="filtro2" v-model="filtro2" > <label for="filtro2">Filtro 2</label> </div>
                <div><input type="checkbox" @change="filtrar('filtro3')" id="filtro3" v-model="filtro3" > <label for="filtro3">Filtro 3</label> </div>
                <div><input type="checkbox" @change="filtrar('filtro4')" id="filtro4" v-model="filtro4" > <label for="filtro4">Filtro 4</label> </div>
            </div>
            <div class="productos">
                <div  class="producto"  :class="{ invisible: producto.invisible }" v-for="producto in productos" :key="producto.id" >
                    <span>DESCRIPCION: {{producto.descripcion}} FILTRO: {{producto.filtro}}</span>
                    <button class="btn btn-delete" @click="deleteProduct(producto.id)" >Eliminar Producto</button>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import { log } from 'util'
    export default {
        data() {
            return {
                radioinput: '',
                input:'',
                baseUrl: 'http://avances.test/api/',
                filtro1: true,
                filtro2: true,
                filtro3: true,
                filtro4: true,
                productos:[],
                info: null,
            }
        },

        methods:{
            addProduct(){
                if (this.radioinput == '') {
                    this.radioinput = 4;
                }
                if (this.input.length < 4) {
                    this.input = 'holaaaaaa';
                }

                var producto = {
                    descripcion: this.input,
                    fecha: '2000-01-01',
                    filtro: this.radioinput,
                    visible: 1,
                };
                let url = `producto/${producto}`;
                var headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Access-Control-Allow-Origin': '*',
                };

                axios.post(this.baseUrl+url, producto, {"headers": headers})
                .then(response =>{
                    console.log(response.data);
                    this.productos.push(response.data);
                    this.input="";
                })
                .catch(error => {
                    console.log(error);
                })
            },
            deleteProduct(id){
                let url = `producto/${id}`;

                var headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Access-Control-Allow-Origin': '*',
                };
                axios.delete(this.baseUrl+url,{
                    params: {
                        id: id,
                    }
                },{"headers": headers})
                .then(response =>{
                    console.log(response.data);
                    for (let index = 0; index < this.productos.length; index++) {
                        if (this.productos[index].id == id) {
                            this.productos.splice(index, 1);
                        }
                    }
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getData(){
                let url = "producto";
                fetch(this.baseUrl+url)
                .then((response) => {
                        return response.json();
                    })
                .then(
                    data => {
                        this.productos = data;
                    }
                )
                .catch(
                    err => console.log(err)
                );
            },
            filtrar(filtro){
                
                this.productos.forEach(element => {
                    if (filtro === element.filtro) {
                        console.log(filtro);
                        element.invisible = !element.invisible;
                    }
                });
            }
        },
        created() {
            this.getData();
        }
    }
</script>

<style scoped>
    nav {
        background-color: #eee;
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }
    .btn{
        background-color: cadetblue;
        color: white;
        padding: 10px;
        margin: 0;
        border-radius: 5px;
        border: 0;
        cursor: pointer;
    }
    .btn-delete{
        background-color: crimson;
    }
    main{
        padding: 80px 40px;
        justify-content: center;
    }

    .filtros{
        background-color: #eee;
        display: flex;
        justify-content: flex-end;
        padding: 10px;
    }
        .filtros > div {
            margin: 0 5px;
        }
        .filtros label {
            cursor: pointer;
        }
    .productos{
        padding: 10px 5px;
        background-color: #eee;
        display: flex;
        flex-direction: column;
    }
        .producto{
            padding: 10px;
            background-color: white;
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
        }
        .producto span{
            padding: 10px;
        }
        .invisible{
            display: none;
        }
</style>