import '../css/app.css'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createApp, h, type DefineComponent } from 'vue'
import { initializeTheme } from './composables/useAppearance'

import PrimeVue from 'primevue/config'
import Aura from '@primevue/themes/aura'
import 'primeicons/primeicons.css'


const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
  title: (t) => (t ? `${t} - ${appName}` : appName),
  resolve: (name) =>
    resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(PrimeVue, { ripple: true, theme: { preset: Aura } })
      .mount(el)
  },
  progress: { color: '#4B5563' },
})

initializeTheme()
