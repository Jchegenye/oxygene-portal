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
        <!-- email -->
        <a-form-model-item
          prop="email"
          :help="validationErrors ? validationErrors.email : ''"
          :validate-status="error.status"
          has-feedback
        >
          <a-input
            v-model="ruleForm.email"
            type="email"
            placeholder="E-mail *"
            :disabled="true"
          >
            <a-icon
              slot="prefix"
              type="red-envelope"
              style="color: rgba(0, 0, 0, 0.25)"
            />
          </a-input>
        </a-form-model-item>

        <!-- password & confirm -->
        <a-form-model-item>
          <a-form-model-item
            prop="password"
            :help="validationErrors ? validationErrors.password : ''"
            :validate-status="error.status"
            has-feedback
            :style="{ display: 'inline-block', width: 'calc(50% - 12px)' }"
            class="mb-0"
          >
            <a-input
              v-model="ruleForm.password"
              placeholder="Password *"
              type="password"
              autocomplete="off"
            >
              <a-icon
                slot="prefix"
                type="lock"
                style="color: rgba(0, 0, 0, 0.25)"
              />
            </a-input>
          </a-form-model-item>
          <span
            :style="{
              display: 'inline-block',
              width: '24px',
              textAlign: 'center',
            }"
          ></span>
          <a-form-model-item
            prop="password_confirmation"
            has-feedback
            :style="{ display: 'inline-block', width: 'calc(50% - 12px)' }"
            class="mb-0"
          >
            <a-input
              v-model="ruleForm.password_confirmation"
              placeholder="Confirm password *"
              type="password"
              autocomplete="off"
            >
              <a-icon
                slot="prefix"
                type="lock"
                style="color: rgba(0, 0, 0, 0.25)"
              />
            </a-input>
          </a-form-model-item>
        </a-form-model-item>

        <!-- action buttons -->
        <a-form-model-item class="mb-0">
          <NuxtLink to="/authentication/login" class="text-right d-block"
            >login</NuxtLink
          >
          <a-form-model-item class="mb-0">
            <a-button
              html-type="submit"
              :type="loading ? 'danger' : 'primary'"
              :loading="loading"
              @click.prevent="resetPassword('ruleForm')"
            >
              {{ loading ? 'Resetting ...' : 'Reset Password' }}
            </a-button>
            Or
            <NuxtLink to="/authentication/forgot-password"
              >Send another link!</NuxtLink
            >
          </a-form-model-item>
        </a-form-model-item>
      </a-form-model>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ResetPassword',
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
          if (this.ruleForm.password_confirmation !== '') {
            if (this.$refs.ruleForm) {
              this.$refs.ruleForm.validateField('password_confirmation')
            }
          } else if (value < 6) {
            callback(new Error('Password must be greater than 6'))
          } else {
            callback()
          }
        }, 500)
      }
      callback()
    }
    const validatePass2 = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('Please input the password again'))
      } else if (value !== this.ruleForm.password) {
        callback(new Error('Two passwords that you enter is inconsistent!'))
      } else {
        callback()
      }
    }
    return {
      ruleForm: {
        token: this.$route.query.token,
        email: this.$route.query.email,
        password: '',
        password_confirmation: '',
      },
      formItemLayout: {
        labelCol: {
          xs: { span: 24 },
          sm: { span: 8 },
        },
        wrapperCol: {
          xs: { span: 24 },
          sm: { span: 16 },
        },
      },
      rules: {
        password: [{ validator: validatePass, trigger: 'change' }],
        password_confirmation: [
          { validator: validatePass2, trigger: 'change' },
        ],
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
      layout: {
        labelCol: { span: 4 },
        wrapperCol: { span: 14 },
      },
      loading: false,
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
    async resetPassword(formName) {
      try {
        this.loading = true

        setTimeout(() => {
          this.loading = false
        }, 800)

        const result = await this.$refs[formName].validate()
        if (result)
          if (this.error.status !== 'success') {
            //
            this.$notification.warning({
              message: 'Notification',
              description: 'Attempting to reset password, kindly wait ...',
              placement: 'bottom',
            })
          }
        if (this.error.status === 'error') {
          // setTimeout(() => {
          //   this.$notification.error({
          //     message: 'Notification',
          //     description:
          //       'Looks like your form has errors, check and try again!',
          //     placement: 'bottom',
          //   })
          // }, 800)
          //
          setTimeout(() => {
            this.error.status = ''
            this.error.formErrors = {}
          }, 2000)
        }

        await this.$axios
          .$post('reset-password', this.ruleForm)
          .then((response) => {
            this.error = response

            this.error = {
              status: 'success',
              message: 'Password reset successful!',
            }

            // login user
            this.$auth
              .loginWith('laravelPassport', {
                data: {
                  username: this.ruleForm.email,
                  password: this.ruleForm.password,
                },
              })
              .then(() => {
                setTimeout(() => {
                  if (this.$store.$auth.user.length !== 0) {
                    if (!this.$store.$auth.user.data.verified) {
                      this.$notification.info({
                        message: 'Account Verification',
                        description: 'Kindly verify your account ...',
                        placement: 'bottom',
                      })
                      this.$router.push('/profile')
                    } else {
                      if (this.$store.$auth.user.data.role_id === 2) {
                        this.$router.push('/dashboard/admin')
                      } else if (this.$store.$auth.user.data.role_id === 3) {
                        this.$router.push('/dashboard/employee')
                      } else if (this.$store.$auth.user.data.role_id === 4) {
                        this.$router.push('/dashboard/client')
                      } else {
                        this.logout()
                      }
                      // success message
                      if (this.$auth.loggedIn) {
                        this.$notification.success({
                          message: 'Authentication',
                          description:
                            'Successfully logged in as ' +
                            this.$store.$auth.user.data.nickname,
                          placement: 'bottom',
                        })
                      }
                    }
                  }
                }, 3000)
              })
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
