<template>
  <div class="container">
      <div class="row">
          <div class="col-md-8">
              <h3 class="mb-5">Lista de Usuarios</h3>
              <table class="table">
                  <thead>
                      <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Nome</th>
                          <th scope="col">Email</th>
                          <th scope="col">CPF</th>
                          <th scope="col">Perfil</th>
                          <th scope="col">Rua</th>
                          <th scope="col">Cidade</th>
                          <th scope="col">Estado</th>
                          <th scope="col">CEP</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr v-for="usuario in usuarios" :key="usuario.id">
                          <td class="text-center">{{ usuario.id }}</td>
                          <td class="text-center">{{ usuario.nome }}</td>
                          <td class="text-center">{{ usuario.email }}</td>
                          <td class="text-center">{{ usuario.cpf }}</td>
                          <td class="text-center">{{ usuario.perfil.nome }}</td>
                          <td class="text-center" v-for="endereco in usuario.enderecos" :key="endereco.id">
                              {{ endereco.rua }}
                          </td>
                          <td class="text-center" v-for="endereco in usuario.enderecos" :key="endereco.id">
                              {{ endereco.cidade }}
                          </td>
                          <td class="text-center" v-for="endereco in usuario.enderecos" :key="endereco.id">
                              {{ endereco.estado }}
                          </td>
                          <td class="text-center" v-for="endereco in usuario.enderecos" :key="endereco.id">
                              {{ endereco.cep }}
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'UsuarioList',

  data () {
      return {
          usuarios: []
      }
  },
  created() {
        this.EnderecoLoad();
        this.PerfilLoad();
        this.UsuarioLoad();
    },
  methods: {
    UsuarioLoad() {
          axios.get("http://127.0.0.1:8000/api/usuario")
          .then(({data})=>{
              this.usuarios = data;
          })
      },
      PerfilLoad() {
          axios.get("http://127.0.0.1:8000/api/perfil")
          .then(({data})=>{
              this.perfil = data;
          })
      },
      EnderecoLoad() {
          axios.get("http://127.0.0.1:8000/api/endereco")
          .then(({data})=>{
              this.endereco = data;
          })
      }
  }
}
</script>
