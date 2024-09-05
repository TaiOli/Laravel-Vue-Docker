import './bootstrap';

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Import components
import App from './components/App.vue';
import UsuarioCadastro from './components/UsuarioCadastro.vue';
import UsuarioLista from './components/UsuarioLista.vue';
import EditarCadastro from './components/EditarCadastro.vue';
import Swagger from '@/components/Swagger.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: UsuarioLista },
        { path: '/cadastro', component: UsuarioCadastro },
        { path: '/usuarios/:id/edit', name: 'EditarCadastro', component: EditarCadastro },
        {
            path: '/docs',
            name: 'Swagger',
            component: Swagger
        }
    ]
});

const app = createApp(App);
app.use(router);
app.mount('#app');