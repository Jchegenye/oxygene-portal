export default {
  // Target (https://go.nuxtjs.dev/config-target)
  target: 'static',

  // Global page headers (https://go.nuxtjs.dev/config-head)
  head: {
    title: 'Oxygene Portal',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
    ],
    link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
  },

  // runtime config
  publicRuntimeConfig: {
    apiURL: process.env.API_URL,
  },
  privateRuntimeConfig: {
    apiId: process.env.PASSPORT_CLIENT_ID,
    apiSecret: process.env.PASSPORT_CLIENT_SECRET,
  },

  // Global CSS (https://go.nuxtjs.dev/config-css)
  css: [
    '~/assets/scss/global.scss',
    'ant-design-vue/dist/antd.css', // Global CSS: https://go.nuxtjs.dev/config-css
  ],

  // Plugins to run before rendering page (https://go.nuxtjs.dev/config-plugins)
  plugins: ['@/plugins/antd-ui', '~/plugins/axios', '~/plugins/draggable'],

  // Auto import components (https://go.nuxtjs.dev/config-components)
  components: {
    dirs: ['~/components'], // '~/components/wizardforms'
  },

  // Modules for dev and build (recommended) (https://go.nuxtjs.dev/config-modules)
  buildModules: [
    // https://go.nuxtjs.dev/eslint
    '@nuxtjs/eslint-module',
    '@nuxtjs/google-fonts',
  ],
  googleFonts: {
    families: {
      Lato: [100, 300, 400, 700, 900],
    },
    display: 'swap',
    download: true,
  },

  // Modules (https://go.nuxtjs.dev/config-modules)
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
    'bootstrap-vue/nuxt',
  ],

  // Axios module configuration (https://go.nuxtjs.dev/config-axios)
  axios: {
    proxy: true,
    baseURL: process.env.API_URL,
  },

  proxy: {
    '/api': {
      target: process.env.API_URL,
      pathRewrite: { '^/api': '/' },
    },
  },

  // Content module configuration (https://go.nuxtjs.dev/config-content)
  content: {},

  // Auth module configuration (https://dev.auth.nuxtjs.org/)
  auth: {
    redirect: {
      home: '/profile',
    },
    strategies: {
      'laravelPassport': {
        provider: 'laravel/passport',
        endpoints: {
          logout: '/api/v1/logout',
          user: {
            url: '/api/v1/user',
          },
        },
        url: process.env.API_URL,
        clientId: process.env.PASSPORT_CLIENT_ID,
        clientSecret: process.env.PASSPORT_CLIENT_SECRET,
        grantType: 'password',
      }
    },
  },

  // Build Configuration (https://go.nuxtjs.dev/config-build)
  build: {
    transpile: ['@nuxtjs/auth-next'],
    babel: {
      plugins: [['import', { libraryName: 'ant-design-vue', style: 'css' }]],
    },
  },
}
