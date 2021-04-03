export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'client-side-app',
    htmlAttrs: {
      lang: 'en',
    },
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

  // server: {
  //     port: process.env.PORT,
  //     host: process.env.HOST,
  //     serverUrl: process.env.API_URL
  //   },

  //   env: {
  //   serverUrl: process.env.API_URL
  // },

  /*
   ** Global CSS
   */
  css: [
    '~/assets/scss/global.scss',
    'ant-design-vue/dist/antd.css', // Global CSS: https://go.nuxtjs.dev/config-css
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '@/plugins/antd-ui',
    '~/plugins/axios',
    '~/plugins/draggable',
    '~/plugins/gravatar',
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: {
    dirs: ['~/components'], // '~/components/wizardforms'
  },

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
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

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    '@nuxtjs/axios', // https://go.nuxtjs.dev/axios
    '@nuxtjs/auth-next',
    'bootstrap-vue/nuxt',
  ],

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    // proxy: true,
    baseURL: process.env.API_URL,
  },

  // proxy: {
  //   '/api': {
  //     target: process.env.API_URL,
  //     pathRewrite: { '^/api': '/' },
  //   },
  // },

  // Laravel Passport conf
  auth: {
    strategies: {
      laravelPassport: {
        name: 'laravelPassport',
        provider: 'laravel/passport',
        endpoints: {
          logout: {
            url: '/api/v1/logout',
          },
          user: {
            url: '/api/v1/user',
          },
        },
        url: process.env.BASE_URL,
        clientId: process.env.PASSPORT_CLIENT_ID,
        clientSecret: process.env.PASSPORT_CLIENT_SECRET,
        grantType: 'password',
      },
    },
    redirect: {
      login: '/authentication/login',
      home: '/dashboard',
    },
  },

  // env variable for accessing either local or production api
  env: {
    baseUrl:
      process.env.NODE_ENV === 'development'
        ? 'http://oxygene-portal.test:3000'
        : 'https://app.oxygene.co.ke',
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    transpile: ['@nuxtjs/auth-next'],
    babel: {
      plugins: [['import', { libraryName: 'ant-design-vue', style: 'css' }]],
    },
  },
  // https://nuxtjs.org/blog/going-full-static
  target: 'static',
}
