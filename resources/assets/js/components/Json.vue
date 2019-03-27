<template>

 <div class="container">
  <h4>{{titulo}}
      <div class="pull-right">
          <button v-on:click="limpaFormulario()" type="button" class="btn btn-primary" 
                data-toggle="modal" v-bind:data-target="'#ModalSalvar'">Novo
          </button>
      </div>
      </h4><hr>

  <section v-if="errored">
    <p>Pedimos desculpas, não estamos conseguindo recuperar as informações no momento. Por favor, tente novamente mais tarde.</p>
  </section>  

  <section v-else>
    <div v-if="loading">Carregando...</div>

    <div
      v-else>

      <table class="table table-striped">
          <thead>
            <tr>    
                <th v-for="(item) in titulotabela" :key="item.id">{{item}}</th>
                <th v-if="detalhe || editar || deletar">Ação</th>
            </tr>
          </thead>
          <tbody>
              <tr v-for="(user) in dados.data" :key="user.id">
                <td v-for="u in user" :key="u.id">{{u}}</td>
                 <td v-if="editar || deletar">
                    <button v-on:click="preencheFormulario(user.id)"  v-if="editar && modal" type="button" class="btn btn-primary" 
                       data-toggle="modal" v-bind:data-target="'#ModalEditar'">Editar
                       </button>
                    <button v-on:click="Excluir(user.id)"  v-if="deletar" type="button" class="btn btn-danger">Excluir
                      </button>
                </td>
            </tr>
          </tbody>
    </table>
    </div>
  </section>
  <modal nome="adcionar" id="ModalSalvar"  titulo="Adicionar">
    <form action="#" @submit.prevent="SalvarPost()">
      <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Nome" v-model="usuario.name">
      </div>
      <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" class="form-control" name="email" placeholder="E-mail" v-model="usuario.email">
      </div>
      <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" class="form-control" name="password" v-model="usuario.password">
      </div>
      <button style="margin-top:10px" type="submit" class="btn btn-primary btn-block">Salvar</button>
    </form>
  </modal>

  <modal nome="editar" id="ModalEditar"  titulo="Editar">
    <form action="#" @submit.prevent="EditarPut()">
      <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" name="name" placeholder="Nome" v-model="usuario.name">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" name="email" placeholder="E-mail"  v-model="usuario.email">
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" name="password" v-model="usuario.password">
            </div>
        <button style="margin-top:10px" type="submit" class="btn btn-primary btn-block">Salvar</button>
    </form>
  </modal>
  
</div>

</template>

<script>
    export default {
      props:['titulo', 'titulotabela', 'detalhe', 'editar', 'deletar', 'criar', 'modal' ],
      data () {
        return {
          url: 'http://127.0.0.1:8000/api/usuarios/',
          dados: null,
          loading: true,
          errored: false,
          usuario: {
            //id:'',
            name:'',
            email:'',
            password:''
          }
        }
      },
      mounted () {
       this.Listar();
      },
      methods: {
        Listar(){
           axios
          .get(this.url)
          .then(response => {
            this.dados = response.data
          })
          .catch(error => {
            console.log(error)
            this.errored = true
          })
          .finally(() => this.loading = false) 
        },
        limpaFormulario(){
          this.usuario= {
            //id:'',
            name:'',
            email:'',
            password:''
          }
        },
        SalvarPost(){
          axios.post(this.url, this.usuario)
            .then((res) => {
                $('#ModalSalvar').modal('hide');
                this.Listar(); 
          }).catch((err) => {
              console.error(err)   
          });
        },
         preencheFormulario:function(id){
             axios.get(this.url+id).then(res => {
              this.usuario = res.data.data;
            });
        },
        EditarPut(){
          axios.put(this.url+this.usuario.id, this.usuario)
              .then((res) => {
                 $('#ModalEditar').modal('hide');
                  this.Listar(); 
          }).catch((err) => {
              console.error(err)   
          });
        },
        Excluir(id){
          axios.delete(this.url+id)
              .then((res) => {
                this.Listar(); 
          }).catch((err) => {
              console.error(err)   
          });
        }
      }
    }
</script>
