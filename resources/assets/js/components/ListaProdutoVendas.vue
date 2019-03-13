<template>

<div class='row'>
    <form action="#" @submit.prevent="salvarVenda()">
        <div class="col-md-12">
            <div class="form-row">
                <input v-model="venda.list" type="hidden" name="lista[]" >
                <div class="form-group col-md-4">
                    <label for="data">Data:</label>
                    <input type="date" v-model="venda.data" name="data" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="qtdeitens">Qtde Itens:</label>
                    <input type="text" name="qtdeitens" class="form-control" v-model="venda.totalprodutos"  readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="valortotal">Valor Total:</label>
                    <input type="text"  name="valortotal" class="form-control"  v-model="venda.valortotal" readonly>
                </div>
            </div>
        </div>
    <div class="col-md-12">
    <div class="alert alert-danger" role="alert"  v-if="produtonaoencontrado">
    {{produtonaoencontrado}}
    </div>
    <form action="#" @submit.prevent="createTask()">
        <div class="input-group" style="margin: 5px">
            <input v-model="produto.produto_id" type="text" name="produto_id" class="form-control" autofocus autocomplete="off">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </span>
        </div>
    </form>
    <div class="scroll">
        <ul class="list-group" >
        <li v-if='venda.list.length === 0' style="list-style-type:none">Nenhum produto Adicionado</li>
        <li class="list-group-item" v-for="(p, index) in venda.list" :key="p.id">
            <form action="#" @submit.prevent="deleteTask(index, p.valor)">
                <h5>{{ p.produto_id}} - {{ p.nome }} 
                
                <button  class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash"></i></button>
                 <h4 class="lipreco" style="margin-right: 20px; font-weight: bold;">{{p.valor}}</h4>
                </h5>
            </form>
        </li>
    </ul>
    </div>
    
    </div>
    <hr>
    <span class="col-md-12">
        <button style="margin-top:10px" type="submit" class="btn btn-primary btn-block">Finalizar</button>
    </span>
    </form>

    <!--<div class="col-md-12">
        <span slot="botoes">
            <button form="salvarTudo" type="submit" class="btn btn-primary btn-block">Finalizar</button>
        </span>
    </div>-->
</div>
</template>
<script>
    export default {
          props:['action', 'token'],
        data() {
            return {
                //data: '',
                //totalprodutos: 0,
                //valortotal: 0.00,
                produtonaoencontrado: '',
                venda:{
                    data: '',
                    valortotal: 0.00,
                    totalprodutos: 0.00,
                    list: [{
                        item:'',
                        produto_id: '',
                        nome: '',
                        valor:'',  
                    }],
                },
                produto: {
                    produto_id: '',
                    nome: '',
                    valor:'',
                }
            };
        },
        
        created() {
            this.fetchTaskList();
        },
        
        methods: {
        fetchTaskList() {
            this.venda.list= [
            ]
        },

        salvarVenda(){
            //console.log(this.venda);
            axios.post('salvar', this.venda)
                .then((res) => {
                    //console.log(res.data);
                   window.location.href ='http://127.0.0.1:8000/admin/vendas/';    
                //this.list = res.data
            }).catch((err) => {
                console.error(err)   
                });  
        },
 
        createTask() {
            axios.post('vendas-itens', this.produto)
                .then((res) => {
                    this.venda.valortotal = (parseFloat( this.venda.valortotal) + parseFloat(res.data[0].valor));
                    this.venda.valortotal = (this.venda.valortotal.toFixed(2));
                    this.venda.totalprodutos++;
                    this.venda.list.push({
                        item: this.venda.totalprodutos,
                        produto_id: res.data[0].produto_id,
                        nome: res.data[0].nome,
                        valor: res.data[0].valor
                    })
                    
                    //this.lista(this.venda.list);
                    this.produto.produto_id = '';
                    this.produtonaoencontrado = ''
                })
                .catch((err) => {
                    if(err)
                    {
                        this.produtonaoencontrado = 'Produto não Cadastrado.';
                         this.produto.produto_id = '';
                    }
                    //console.error(err)
                });   
            },
 
            deleteTask(index, valor) {
                this.venda.totalprodutos--;
                this.venda.valortotal = (parseFloat(this.venda.valortotal) - parseFloat(valor));
                this.venda.valortotal = (this.venda.valortotal.toFixed(2));
                this.venda.list.splice(index, 1)
            },
            // lista:function(lista)
            // {
            //     lista.sort(function(a, b){
            //         if(a.item < b.item){
            //             return 1;
            //         }
            //         if(a.item > b.item){
            //             return -1;
            //         }
            //         return 0;
            //     }); 
            // }
        }
    }
</script>

<style media="screen">
.scroll  {
    margin: 5px;
    max-height: 315px; 
    /*min-height: 300px; */
    overflow: auto;
    -webkit-overflow-scrolling: touch;
    display: flex;
    flex-direction: column-reverse;
}
.lipreco{
    float: right;
}
</style>