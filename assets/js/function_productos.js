var url= "../core/class/function_productos.php";
var appProductos = new Vue({    
el: "#appProductos",   
data:{
     productos:[],          
     menu:[],          
     submenu:[],          
     submenuArray:[],
     ventas:[], 
     total_productos:0,
     select:'0', 
     selectComo:'0',
     selecta:'0', 
     selecUnique:'0', 
     search:'', 
     search_tracking:'',
     num_results:10,
     pag:1,
     pageCount:0,
     /*exportar excel*/
     uri :'data:application/vnd.ms-excel;base64,',
     template:'<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
     base64: function(s){ return window.btoa(unescape(encodeURIComponent(s))) },
     format: function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) },
    /*fin exportar excel*/
 },
methods:{
    //BOTONES        
    btnEditar:async function(codigoERP){},        
    //PROCEDIMIENTOS
    listarProductos:function(){
        axios.post(url, {opcion:1}).then(response =>{
           this.productos = response.data;
        });
    }, 
    listarMenu:function(){
        axios.post(url, {opcion:2}).then(response =>{
           this.menu = response.data;
        });
    },
    ventasEcommerce:function(){
      axios.post(url, {opcion:6}).then(response =>{
           this.ventas = response.data;
        });
    },
    fetchsubmenu:function(IDproducto){
      var comodin = this.select;
      var res = comodin.split("-", 1);                          
      var res2 = comodin.split("-", 2);
      res= res2[0];
      res2= res2[1];
      if (IDproducto===res2) {
        this.select=comodin;
        this.selecUnique=IDproducto;
        this.selectComo=res;
      }
    },

    submenuSave:function(codigoERP){
      axios.post(url, {opcion:5 ,IDsubmenu : this.selecta , codigoERP:codigoERP}).then(response =>{
        console.log(response.data);
        if (response.data===1){
          this.listarProductos();
          this.selecta=0;
        }
      });
    },
    tableToExcel(table, name){
      if (!table.nodeType) table = this.$refs.table
      var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
      window.location.href = this.uri + this.base64(this.format(this.template, ctx))
    },
    listarSubMenu:function(){
        axios.post(url, {opcion:3}).then(response =>{
            this.submenu = response.data;
            function groupBy(list, keyGetter) {
                const map = new Map();
                list.forEach((item) => {
                     const key = keyGetter(item);
                     const collection = map.get(key);
                     if (!collection) {
                         map.set(key, [item]);
                     } else {
                         collection.push(item);
                     }
                });
                return map;
            }
            const grouped = groupBy(this.submenu, submena => submena.IDmenu);
            this.menu.forEach(dato => {const {IDmenu} = dato;
              this.submenuArray[dato.IDmenu]=grouped.get(dato.IDmenu);
            });
        });
    }
},
created: function(){            
   this.listarProductos();
   this.listarMenu();
   this.listarSubMenu();
   this.ventasEcommerce();
},
computed:{
    totalProductos(){
    this.total_productos=0;
    for(producto of this.filteredProductos){
      this.total_productos=this.total_productos+1;
    }
    return this.total_productos;
  },
  filteredProductos(){
    this.pag=1;
      return this.productos.filter(producto => {
        return producto.codigoERP.match(this.search.toLowerCase()) || producto.nombre.toLowerCase().match(this.search.toLowerCase());
      })
  },
  paginationProductos(){
    this.pageCount = (this.filteredProductos.length) / (this.num_results);
    this.pageCount=Math.ceil(this.pageCount);
  },
  headVentas(){
    let hash = {};
    return this.headVentas = this.ventas.filter(o => hash[o.n_orden] ? false : hash[o.n_orden] = true);
  },
  filteredVenta(){
    return this.headVentas.filter(ventar => {
      return ventar.n_orden.toLowerCase().match(this.search_tracking.toLowerCase()) || ventar.email.toLowerCase().match(this.search_tracking.toLowerCase()) ;
    })
  }
}
}).$mount('#appProductos');

/* Module Importar Excel .CSV and .XLS */

new Vue({
  data(){
    return{
      tableData:[],
      tableRow: []
    }
  },
  mounted(){
    window.addEventListener('load',  this.onLoad())
  },
  methods:{
    handleDrop(f){
      var reader = new FileReader(),
          name = f.name, vm = this;
      reader.onload =  (e) =>{
        var data = e.target.result,
            workbook = XLSX.read(data, { type: 'binary' }),
            sheetName = workbook.SheetNames[0],
            sheet = workbook.Sheets[sheetName];
        var temp = []
        for (var row = 2; ; row++) {
          if (sheet['A' + row] == null) {
            break;
          }
          for (var col = 65; col <= 90; col++) {
            var c = String.fromCharCode(col);
            var key = '' + c + row;
            if (sheet[key] == null) {
              break;
            }
            vm.tableRow.push(sheet[key]['v']);
          }
          vm.tableData.push(vm.tableRow);
          vm.tableRow = []
        }
      };
      reader.readAsBinaryString(f);
    },
    onLoad(){
      var target = this.$refs.target;
      target.addEventListener('dragenter', function () {
        this.classList.remove('hover');
      });
      target.addEventListener('dragleave', function () {
        this.classList.add('hover');
      });
      target.addEventListener('dragover', function (e) {
        this.classList.remove('hover');
        e.preventDefault();
      });
      target.addEventListener('drop',  (e) => {
        e.preventDefault();
        this.handleDrop(e.dataTransfer.files[0]);
      });
    },

    updateIDsubmenu:function(tableData){
      tableData.forEach(dato => {
        const codigoERP = dato[1];
        const IDsubmenu = dato[3];
          axios.post(url, {opcion:5 ,IDsubmenu : IDsubmenu , codigoERP:codigoERP}).then(response =>{
            console.log(response.data);
            if (response.data===1){
              this.appProductos.listarProductos();
              /*this.terms=false;*/
              this.tableData=[];
            }
          });
      });
    }

  }
}).$mount("#app")



