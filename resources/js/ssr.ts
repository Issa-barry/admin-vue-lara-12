import { createInertiaApp } from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createSSRApp, h, type DefineComponent } from 'vue'
import { renderToString } from 'vue/server-renderer'

import PrimeVue from 'primevue/config'
import Aura from '@primevue/themes/aura'
import 'primeicons/primeicons.css'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createServer(
  (page) =>
    createInertiaApp({
      page,
      render: renderToString,
      title: (t) => (t ? `${t} - ${appName}` : appName),
      resolve: (name) =>
        resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
      setup: ({ App, props, plugin }) =>
        createSSRApp({ render: () => h(App, props) })
          .use(plugin)
          .use(PrimeVue, { ripple: true, theme: { preset: Aura } }),
    }),
  { cluster: true }
)
