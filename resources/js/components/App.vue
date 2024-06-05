<template>
    <div class="container">
        <header class="px-3 py-2 bg-white text-white mb-4 mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <router-link to="/" id="home" class="nav-link text-dark">Início</router-link>
                </div>
                <div>
                    <router-link to="/cadastro" id="cadastrar" class="btn btn-primary">Cadastrar</router-link>
                </div>
            </div>
        </header>

        <div class="card mt-3">
            <div class="card-body">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'App'
}
</script>