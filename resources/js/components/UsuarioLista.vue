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
              <th scope="col" class="text-center">Ações</th>
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
              <td>
                <router-link :to="`/usuarios/${usuario.id}/edit`"
                  class="p-2 col border btn btn-success">Editar</router-link>
                <button type="button" class="btn btn-danger" @click="deleteUsuario(usuario.id)">Deletar</button>
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
      // Array que irá armazenar os usuários carregados
      usuarios: []
    }
  },
  created() {
    this.loadUsuarios();
  },
  methods: {
    // Carrega a lista de usuários
    loadUsuarios() {
      axios.get("http://127.0.0.1:8000/api/usuario")
        .then(({ data }) => {
          this.usuarios = data;
        })
        .catch(error => {
          console.error("Erro ao carregar usuários:", error);
        });
    },
    // Método para excluir um usuário
    deleteUsuario(id) {
      if (confirm('Tem certeza que deseja excluir este usuário?')) {
        axios.delete(`http://127.0.0.1:8000/api/usuario/${id}`)
          .then(() => {
            this.usuarios = this.usuarios.filter(usuario => usuario.id !== id);
            alert("Usuário excluído com sucesso!");
          })
          .catch(error => {
            console.error("Ocorreu um erro ao excluir o usuário:", error);
          });
      }
    }
  }
}
</script>