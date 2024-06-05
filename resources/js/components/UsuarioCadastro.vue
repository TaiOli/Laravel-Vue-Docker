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
            <div v-for="(endereco, index) in enderecos" :key="index">
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
            usuario: {
                nome: '',
                email: '',
                cpf: ''
            },
            enderecos: [],
            perfil: {
                nome: ''
            }
        }
    },
    methods: {
        save() {
            if (this.validateForm()) {
                this.saveData();
            } else {
                alert("Por favor, preencha todos os campos obrigatórios.");
            }
        },
        validateForm() {
            if (!this.usuario.nome || !this.usuario.email || !this.usuario.cpf || !this.perfil.nome) {
                return false;
            }
            if (this.enderecos.length === 0) {
                return false;
            }
            for (let endereco of this.enderecos) {
                if (!endereco.rua || !endereco.cidade || !endereco.estado || !endereco.cep) {
                    return false;
                }
            }
            return true;
        },
        saveData() {
            let usuarioId, perfilId, enderecoIds = [];

            axios.post("http://127.0.0.1:8000/api/perfil", this.perfil)
                .then(({ data }) => {
                    perfilId = data.id;

                    return axios.post("http://127.0.0.1:8000/api/usuario", {
                        ...this.usuario,
                        perfil_id: perfilId
                    });
                })
                .then(({ data }) => {
                    usuarioId = data.id;

                    return Promise.all(this.enderecos.map(endereco => {
                        return axios.post("http://127.0.0.1:8000/api/endereco", endereco)
                            .then(({ data }) => {
                                enderecoIds.push(data.id);

                                return axios.post("http://127.0.0.1:8000/api/endereco_usuario", {
                                    usuario_id: usuarioId,
                                    endereco_id: data.id
                                });
                            });
                    }));
                })
                .then(() => {
                    alert("Usuário Cadastrado com sucesso!");
                })
                .catch(error => {
                    console.error("Ocorreu um erro:", error);
                });
        },
        addEndereco() {
            this.enderecos.push({
                rua: '',
                cidade: '',
                estado: '',
                cep: ''
            });
        },
        removeEndereco(index) {
            this.enderecos.splice(index, 1);
        }
    }
}
</script>