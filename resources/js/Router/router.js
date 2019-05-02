import Vue from 'vue';
import VueRouter from "vue-router";
import Login from '../components/login/Login';
import Logout from '../components/login/Logout';
import SignUp from '../components/login/SignUp';
import Forum from '../components/forum/Forum';
import Read from '../components/forum/Read';
import Create from '../components/forum/Create';
import CreateCategory from '../components/category/create';

Vue.use(VueRouter);

const routes = [
    { path: '/login', component: Login },
    { path: '/logout', component: Logout },
    { path: '/signup', component: SignUp },
    { path: '/forum', component: Forum, name: 'forum' },
    { path: '/question/:slug', component: Read, name: 'read' },
    { path: '/ask', component: Create, name: 'create' },
    { path: '/category', component: CreateCategory, name: 'createCategory' },
];


const router = new VueRouter({
    routes,
    mode: 'history',
});


export default router;
