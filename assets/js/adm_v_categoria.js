
var url= "../controller/producto/getProductsListActive2.php";
var seguridad = 123456;
var appVCategoria = new Vue({
el: "#page-content-wrapper",   
html: {
    //query: {attrs: "img:src img:srcset"}
},
data:{
     productos:[],
     checkedProductos:[],
     security: seguridad,
     showModal: false,
     active: false,
     show: false,
     findText: '',
     listaProductos: [],
     productoSeleccionado: [],
     tipo_sku_seleccionado: 0,
 },
methods:{
    getProducts(){
      axios.post(url, { pro_buscar_sku: this.findText }).then(response =>{
        this.productos = response.data.lista;
      });
    },
    invocarPrefijo(){
        return "pro_";
    },
    invocarRutaImagen(){
        return "../../assets/upload/producto/";
    },
    seleccionarSku(sku){
        if(this.tipo_sku_seleccionado == 1){
            document.getElementById("pro_sku_1").value = sku;
        }else if(this.tipo_sku_seleccionado == 2){
            document.getElementById("pro_sku_2").value = sku;
        }else{
            console.log(sku);
        }
    },
    toggleModal(valor) {
        //console.log(valor);

        this.tipo_sku_seleccionado = valor;

        const body = document.querySelector("body");
        this.active = !this.active;
        this.active
          ? body.classList.add("modal-open")
          : body.classList.remove("modal-open");
        setTimeout(() => (this.show = !this.show), 10);
    },
    findSkuByName(){
        //console.log(this.findText);

        axios.post(url, { pro_buscar_sku: this.findText }).then(response =>{
            this.listaProductos = response.data.lista;
        });
    },
    formFindSkuByName(e){
        e.preventDefault();
    }
},
created: function(){
   this.getProducts();
},
computed:{

    }
}).$mount('#page-content-wrapper');


