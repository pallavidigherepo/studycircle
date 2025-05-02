import { createPinia } from 'pinia'

import modules from './modules'

const pinia = createPinia({
  modules,
  // Enable strict mode in development to get a warning
  // when mutating state outside of a mutation.
  // https://vuex.vuejs.org/guide/strict.html
  strict: import.meta.env.MODE === 'development',
})

export default pinia

