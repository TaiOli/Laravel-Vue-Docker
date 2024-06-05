<template>
    <div>
        <h3 class="mb-5">Cadastro de Usuário</h3>
        <form @submit.prevent="save" class="form-group">

            <p class="mb-3">Dados Pessoais:</p>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" v-model="usuario.nome" class="form-control mb-3 rounded-input">

            <label for="email">Email:</label>
            <input type="email" id="email" v-model="usuario.email" class="form-control mb-3 rounded-input">

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" v-model="usuario.cpf" class="form-control mb-3 rounded-input">

            <p class="mb-3 mt-5">Endereço:</p>
            <label for="rua">Rua:</label>
            <input type="text" id="rua" v-model="endereco.rua" class="form-control mb-3 rounded-input">

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" v-model="endereco.cidade" class="form-control mb-3 rounded-input">

            <label for="estado">Estado:</label>
            <input type="text" id="estado" v-model="endereco.estado" class="form-control mb-3 rounded-input">

            <label for="cep">CEP:</label>
            <input type="text" id="cep" v-model="endereco.cep" class="form-control mb-3 rounded-input">
            
            <p class="mb-3 mt-5">Tipo de Perfil:</p>
            <label for="perfil">Perfil:</label>
            <select id="perfil" v-model="perfil.nome" class="form-control mb-3 rounded-input">
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
    name: 'Usuario,Endereco,Perfil',
    data() {
        return {
            result: {},
            usuario: {
                id: '',
                nome: '',
                email: '',
                cpf: ''
            },
            endereco: {
                id: '',
                rua: '',
                cidade: '',
                estado: '',
                cep: ''
            },
            perfil: {
                id: '',
                nome: ''
            }
        }
    },
    methods: {
        save() {
            if (this.endereco.id == '' || this.perfil.id == '' || this.usuario.id == '') {
                this.saveData();
            }
        },
        saveData() {
            let usuarioId, enderecoId;

            axios.post("http://127.0.0.1:8000/api/perfil", this.perfil)
                .then(({ data }) => {

                    this.perfil.nome = '';
                    this.perfil.id = '';

                    this.usuario.perfil_id = data.id;

                    return axios.post("http://127.0.0.1:8000/api/usuario", this.usuario);
                })
                .then(({ data }) => {

                    usuarioId = data.id;

                    this.usuario.nome = '';
                    this.usuario.email = '';
                    this.usuario.cpf = '';

                    return axios.post("http://127.0.0.1:8000/api/endereco", this.endereco);
                })
                .then(({ data }) => {

                    enderecoId = data.id;

                    this.endereco.rua = '';
                    this.endereco.cidade = '';
                    this.endereco.estado = '';
                    this.endereco.cep = '';
                    this.endereco.id = '';

                    return axios.post("http://127.0.0.1:8000/api/endereco_usuario", {
                        usuario_id: usuarioId,
                        endereco_id: enderecoId
                    });
                })
                .then(({ data }) => {
                    alert("Usuário Cadastrado com sucesso!");
                })
                .catch(error => {
                    console.error("Ocorreu um erro:", error);
                });
        }
    }
}
</script>