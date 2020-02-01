require('./bootstrap')

import { InertiaApp } from '@inertiajs/inertia-vue'
import Vue from 'vue'

Vue.use(InertiaApp)

let app = document.getElementById('app')

if(app) {
  new Vue({
    render: h => h(InertiaApp, {
      props: {
        initialPage: JSON.parse(app.dataset.page),
        resolveComponent: (name) => {
          return import(`@/Pages/${name}`).then(module => module.default)
        },
      },
    }),
  }).$mount(app)

}
