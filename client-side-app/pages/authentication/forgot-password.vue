<template>
  <div id="container-wrapper" class="o2forms">
    <div>
      <Logo />
      <Tagline />
      <FormAlerts :errors="error" />

      <a-form-model
        id="components-form-demo-normal-login"
        ref="ruleForm"
        :model="ruleForm"
        :rules="rules"
        class="login-form"
      >
        <a-form-model-item
          prop="email"
          :help="validationErrors ? validationErrors.email : ''"
          :validate-status="error.status"
          has-feedback
          class="mb-0"
        >
          <a-input v-model="ruleForm.email" type="email" placeholder="E-mail *">
            <a-icon
              slot="prefix"
              type="red-envelope"
              style="color: rgba(0, 0, 0, 0.25)"
            />
          </a-input>
        </a-form-model-item>

        <a-form-model-item class="mb-0">
          <NuxtLink to="/authentication/registration" class="text-right d-block"
            >Register</NuxtLink
          >
          <a-button
            html-type="submit"
            class="login-form-button"
            :type="loading ? 'danger' : 'primary'"
            :loading="loading"
            @click.prevent="login('ruleForm')"
          >
            {{ loading ? 'Processing ...' : 'Forgot Password' }}
          </a-button>
          Or
          <NuxtLink to="/authentication/login">login!</NuxtLink>
        </a-form-model-item>
      </a-form-model>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ForgotPassword',
  layout: 'base',
  middleware: ['guest'],
  data() {
    let checkPending
    const validatePass = (rule, value, callback) => {
      clearTimeout(checkPending)
      if (value === '') {
        callback(new Error('Please input your password'))
      } else {
        checkPending = setTimeout(() => {
          if (value < 6) {
            callback(new Error('Password must be greater than 6'))
          } else {
            callback()
          }
        }, 500)
      }
      callback()
    }
    return {
      ruleForm: {
        email: '', // jtechinfo3@gmail.com
      },
      rules: {
        password: [{ validator: validatePass, trigger: 'change' }],
        email: [
          {
            type: 'email',
            message: 'The input is not valid E-mail!',
          },
          {
            required: true,
            message: 'Please input your E-mail!',
          },
        ],
      },
      loading: false,
      checked: true,
      error: {},
    }
  },
  computed: {
    validationErrors() {
      if (Object.keys(this.error).length !== 0) {
        return this.error.formErrors
      } else {
        return {}
      }
    },
  },
  methods: {
    async login(formName) {
      try {
        setTimeout(() => {
          this.loading = false
        }, 800)
        this.loading = true

        const result = await this.$refs[formName].validate()
        if (result)
          if (this.error.status !== 'success') {
            //
            this.$notification.warning({
              message: 'Notification',
              description: 'Processing, kindly wait ...',
              placement: 'bottom',
            })
          }
        if (this.error.status === 'error') {
          setTimeout(() => {
            this.$notification.error({
              message: 'Notification',
              description:
                'Looks like your form has errors, check and try again!',
              placement: 'bottom',
            })
          }, 800)
          //
          setTimeout(() => {
            this.error.status = ''
            this.error.formErrors = {}
          }, 2000)
        }
        await this.$axios
          .$post('forgot-password', this.ruleForm)
          .then((response) => {
            this.error = response

            setTimeout(() => {
              this.error = {
                status: 'success',
                message: 'Kindly check your email ...',
              }
            }, 3000)
            //
            setTimeout(() => {
              this.$router.push('/authentication/login')
            }, 5500)
          })
          .catch((err) => {
            this.errorFormAlerts(err)
          })
      } catch (error) {}
    },
    // Error
    errorFormAlerts(response) {
      this.error = response
    },
  },
}
</script>
