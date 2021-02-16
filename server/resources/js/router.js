import Vue from 'vue'
import Router from 'vue-router'
import Home from './components/pages/HomeComponent'
import Login from './components/pages/LoginComponent'
import Register from './components/pages/RegisterComponent'

import Ranking from './components/pages/RankingComponent'
import Detail from './components/pages/DetailComponent'
import Users from './components/pages/UserListComponent'
import User from './components/pages/UserComponent'

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
            path: '/detail/:countryId',
            name: 'detail',
            component: Detail,
            props: true
        },
        {
            path: '/ranking',
            name: 'ranking',
            component: Ranking
        },
        {
            path: '/user',
            name: 'users',
            component: Users
        },
        {
            path: '/user/:userId',
            name: 'user',
            component: User,
            props: true
        },
    ]
})