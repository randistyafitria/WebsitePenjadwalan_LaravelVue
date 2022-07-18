//import vue router
import { createRouter, createWebHistory } from "vue-router";
//import Router from 'vue-router'
import NProgress from 'nprogress'
 
//define a routes
const routes = [
    {
        path: '/login',
        name: 'login',
        component: () => import( /* webpackChunkName: "login" */ '@/views/auth/Login.vue')
    },
    {
        path: '/register',
        name: 'register',
        component: () => import( /* webpackChunkName: "register" */ '@/views/auth/Register.vue')
    },
    {
        path: '/',
        name: 'dashboard',
        component: () => import( /* webpackChunkName: "dashboard" */ '@/views/dashboard/Dashboard.vue')
    },
    {
        path: '/dosen',
        name: 'dosen.index',
        component: () => import( /* webpackChunkName: "dosen.index" */ '@/views/dosen/Index.vue')
    },
    {
        path: '/create',
        name: 'dosen.create',
        component: () => import( /* webpackChunkName: "dosen.create" */ '@/views/dosen/Create.vue')
    },
    {
        path: '/edit/:id',
        name: 'dosen.edit',
        component: () => import( /* webpackChunkName: "dosen.edit" */ '@/views/dosen/Edit.vue')
    },
    {
        path: '/index',
        name: 'post.index',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/post/Index.vue') //jam
    },
    {
        path: '/create',
        name: 'post.create',
        component: () => import( /* webpackChunkName: "post.create" */ '@/views/post/Create.vue') //jam
    },
    {
        path: '/edit/:id',
        name: 'post.edit',
        component: () => import( /* webpackChunkName: "post.edit" */ '@/views/post/Edit.vue') //jam
    },
    {
        path: '/pengampu',
        name: 'pengampu.index',
        component: () => import( /* webpackChunkName: "pengampu.index" */ '@/views/pengampu/Index.vue')
    },
    {
        path: '/pengampu/create',
        name: 'pengampu.create',
        component: () => import( /* webpackChunkName: "pengampu.create" */ '@/views/pengampu/Create.vue')
    },
    {
        path: '/pengampu/edit/:id',
        name: 'pengampu.edit',
        component: () => import( /* webpackChunkName: "pengampu.edit" */ '@/views/pengampu/Edit.vue')
    },
    {
        path: '/',
        name: 'post.dashboard',
        component: () => import( /* webpackChunkName: "post.dashboard" */ '@/views/post/Dashboard.vue') //jam
    },
]

//create router
const router = createRouter({
    history: createWebHistory(),
    routes  // config routes
})

router.beforeEach((to, from, next) => {
    NProgress.start()
    NProgress.set(0.5)
    next()
  })
  router.afterEach(() => {
    setTimeout(() => NProgress.done(), 20)
  })
 
export default router
