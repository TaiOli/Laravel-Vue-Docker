<template>
  <div>
    <h3 class="mb-5">Editar Usuário</h3>
    <form @submit.prevent="update" class="form-group">
      <p class="mb-3">Dados Pessoais:</p>
      <label for="nome">Nome:</label>
      <input type="text" id="nome" v-model="usuario.nome" class="form-control mb-3 rounded-input">

      <label for="email">Email:</label>
      <input type="email" id="email" v-model="usuario.email" class="form-control mb-3 rounded-input">

      <label for="cpf">CPF:</label>
      <input type="text" id="cpf" v-model="usuario.cpf" class="form-control mb-3 rounded-input">

      <p class="mb-3 mt-5">Endereço:</p>
      <div v-for="(endereco, index) in usuario.enderecos" :key="index">
        <label for="rua">Rua:</label>
        <input type="text" v-model="endereco.rua" class="form-control mb-3 rounded-input">

        <label for="cidade">Cidade:</label>
        <input type="text" v-model="endereco.cidade" class="form-control mb-3 rounded-input">

        <label for="estado">Estado:</label>
        <input type="text" v-model="endereco.estado" class="form-control mb-3 rounded-input">

        <label for="cep">CEP:</label>
        <input type="text" v-model="endereco.cep" class="form-control mb-3 rounded-input">

        <button type="button" @click="removeEndereco(index)" class="btn btn-danger d-flex justify-content-between mb-3">Remover Endereço</button>
      </div>
      <button type="button" @click="addEndereco" class="btn btn-primary">Adicionar Endereço</button>

      <p class="mb-3 mt-5">Tipo de Perfil:</p>
      <label for="perfil">Perfil:</label>
      <select id="perfil" v-model="usuario.perfil.nome" class="form-control mb-3 rounded-input">
        <option value="Administrador">Administrador</option>
        <option value="Usuário">Usuário</option>
      </select>

      <button type="submit" class="btn btn-primary btn-block">Salvar</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'EditarUsuario',
  data() {
    return {
      // Dados do usuário a serem editados
      usuario: {
        nome: '',
        email: '',
        cpf: '',
        perfil: {
          nome: ''
        },
        enderecos: []
      }
    }
  },
  created() {
    this.loadUsuario();
  },
  methods: {
    // Carrega os dados do usuário
    loadUsuario() {
      const userId = this.$route.params.id;
      axios.get(`http://127.0.0.1:8000/api/usuario/${userId}`)
        .then(({ data }) => {
          this.usuario = data;
        })
        .catch(error => {
          console.error("Erro ao carregar usuário:", error);
        });
    },
    // Atualiza os dados do usuário
    update() {
      if (this.validateForm()) {
        this.updateData();
      } else {
        alert("Por favor, preencha todos os campos obrigatórios.");
      }
    },
    // validando o formulário
    validateForm() {
      if (!this.usuario.nome || !this.usuario.email || !this.usuario.cpf || !this.usuario.perfil.nome) {
        return false;
      }
      if (this.usuario.enderecos.length === 0) {
        return false;
      }
      for (let endereco of this.usuario.enderecos) {
        if (!endereco.rua || !endereco.cidade || !endereco.estado || !endereco.cep) {
          return false;
        }
      }
      return true;
    },
    // Envia os dados atualizados do usuário
    updateData() {
      const userId = this.$route.params.id;

      axios.put(`http://127.0.0.1:8000/api/usuario/${userId}`, this.usuario)
        .then(response => {
          alert("Usuário atualizado com sucesso!");
        })
        .catch(error => {
          console.error("Ocorreu um erro:", error);
        });
    },
    // Adiciona um novo endereço à lista de endereços do usuário
    addEndereco() {
      this.usuario.enderecos.push({
        rua: '',
        cidade: '',
        estado: '',
        cep: ''
      });
    },
    // Remove um endereço da lista de endereços do usuário
    removeEndereco(index) {
      this.usuario.enderecos.splice(index, 1);
    }
  }
}
</script>