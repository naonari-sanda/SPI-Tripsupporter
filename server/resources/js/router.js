import Vue from 'vue'
import Router from 'vue-router'
import Home from './components/pages/HomeComponent'
import Login from './components/pages/LoginComponent'
import Register from './components/pages/RegisterComponent'

import Ranking from './components/pages/RankingComponent'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/ranking',
            name: 'ranking',
            component: Ranking
        },
    ]
})