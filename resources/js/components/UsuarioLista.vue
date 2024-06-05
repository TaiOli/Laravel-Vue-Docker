<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="mb-5">Lista de Usuarios</h3>
        <table class="table">
          <thead>
            <tr>
              <th scope="col" class="text-center">ID</th>
              <th scope="col" class="text-center">Nome</th>
              <th scope="col" class="text-center">Email</th>
              <th scope="col" class="text-center">CPF</th>
              <th scope="col" class="text-center">Perfil</th>
              <th scope="col" class="text-center">Rua</th>
              <th scope="col" class="text-center">Cidade</th>
              <th scope="col" class="text-center">Estado</th>
              <th scope="col" class="text-center">CEP</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="usuario in usuarios" :key="usuario.id">
              <td class="text-center">{{ usuario.id }}</td>
              <td class="text-center">{{ usuario.nome }}</td>
              <td class="text-center">{{ usuario.email }}</td>
              <td class="text-center">{{ usuario.cpf }}</td>
              <td class="text-center">{{ usuario.perfil.nome }}</td>
              <td class="text-center">
                <div v-for="endereco in usuario.enderecos" :key="endereco.id">
                  {{ endereco.rua }}<br>
                </div>
              </td>
              <td class="text-center">
                <div v-for="endereco in usuario.enderecos" :key="endereco.id">
                  {{ endereco.cidade }}<br>
                </div>
              </td>
              <td class="text-center">
                <div v-for="endereco in usuario.enderecos" :key="endereco.id">
                  {{ endereco.estado }}<br>
                </div>
              </td>
              <td class="text-center">
                <div v-for="endereco in usuario.enderecos" :key="endereco.id">
                  {{ endereco.cep }}<br>
                </div>
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
  data() {
    return {
      usuarios: []
    }
  },
  created() {
    this.loadUsuarios();
  },
  methods: {
    loadUsuarios() {
      axios.get("http://127.0.0.1:8000/api/usuario")
        .then(({ data }) => {
          this.usuarios = data;
        })
        .catch(error => {
          console.error("Erro ao carregar usuários:", error);
        });
    }
  }
}
</script>