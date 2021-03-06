import Vue from 'vue'
import Router from 'vue-router'
import store from '.././vuex/store'
import iView from 'iview';
import routers from './routers'


Vue.use(Router)

const router = new Router({
  mode: 'history',
  routes: routers
});

// 导航钩子，全局钩子
router.beforeEach((to, from, next) => {
    // 登录页面
    if (to.name == 'login') {
        if (store.getters.user_id != 0) {
            next('/console/index/index');
        }
        else
        {
            next()
        }
    }
    // 其它页面
    else
    {
        if (store.getters.user_id == 0 && to.meta.requiresAuth) {
            next('/console/login');
        }
        else
        {
            next();
        }
    }
})
router.afterEach(to => {
  iView.LoadingBar.finish()
})

export default router