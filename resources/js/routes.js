import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from './components/ExampleComponent';
import Login from './components/Login';
import Home from './components/Home';
import Register from './components/Register';
import Reset from './components/Reset';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {path: '/home', component: Home},
        {path: '/example', component: ExampleComponent},
        {path: '/login', component: Login},
        {path: '/register', component: Register},
        {path: '/reset', component: Reset},
        {path: '*', redirect: '/home'}
    ],
    mode: 'history'
});

