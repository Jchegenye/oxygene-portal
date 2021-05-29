<template>
  <div>
    <a-col
      :xs="{ span: 24 }"
      :sm="{ span: 24 }"
      :md="{ span: 24 }"
      :lg="{ span: 20, offset: 2 }"
      :xl="{ span: 20, offset: 2 }"
    >
      <a-row>
        <div id="wizard-form" class="mb-6">
          <!-- STEPS -->
          <a-steps :current="current" size="small" status="error">
            <a-popover
              slot="progressDot"
              slot-scope="{ index, status, prefixCls }"
            >
              <template slot="content">
                <span>step {{ index }} status: {{ status }}</span>
              </template>
              <span :class="`${prefixCls}-icon-dot`" />
            </a-popover>
            <a-step
              v-for="item in steps"
              :key="item.title"
              :title="item.title"
              :description="item.description"
            />
          </a-steps>
          <!-- FORM -->
          <a-form-model
            id="components-form-demo-normal-login"
            ref="ruleForm"
            :model="ruleForm"
            :rules="rules"
          >
            <div class="steps-content">
              <h6 v-if="supplierNo" class="text-right">
                Supplier No.: <span class="text-bold">{{ supplierNo }}</span>
              </h6>
              <hr />
              <FormAlerts :errors="error" />
              <Component
                :is="stepFormComponent"
                :current="current"
                :error="error"
                :rule-form="ruleForm"
                :rules="rules"
                :form-item-layout="formItemLayout"
                :validation-errors="validationErrors"
                :dragging="dragging"
                :next="next"
                :prev="prev"
                :currentinnerstep="currentinnerstep"
              ></Component>
              <hr />
              <span class="text-danger">
                <strong>NOTE:-</strong>
                <ul>
                  <li>
                    Please make sure both your E-mail Address and Mobile Number
                    are correct.
                  </li>
                  <!-- <li>
                    We will attempt to store your data temporarily on your
                    browser as you fill in the form, once you submit
                    successfully, your data will be cleared. This will enable
                    you to continue filling in the form, next time you visit
                    this site from the same browser.
                  </li> -->
                </ul>
              </span>
            </div>
            <!-- BUTTONS -->
            <div class="mt-3">
              <a-button-group>
                <a-button
                  v-if="current < steps.length - 1 && current === 4"
                  html-type="submit"
                  size="small"
                  :type="loading ? 'danger' : 'primary'"
                  :loading="loading"
                  :disabled="ruleForm.step5.acknowledge === true ? false : true"
                  @click.prevent="next('ruleForm')"
                >
                  {{ loading ? 'Processing' : 'Next' }}
                  <a-icon type="right" />
                </a-button>
                <a-button
                  v-else-if="current < steps.length - 1 && current !== 0"
                  html-type="submit"
                  size="small"
                  :type="loading ? 'danger' : 'primary'"
                  :loading="loading"
                  @click.prevent="next('ruleForm')"
                >
                  {{ loading ? 'Processing' : 'Next' }}
                  <a-icon type="right" />
                </a-button>

                <a-button
                  v-if="current == steps.length - 1"
                  html-type="submit"
                  size="small"
                  :type="loading ? 'danger' : 'primary'"
                  :loading="loading"
                  :disabled="ruleForm.step6.acknowledge === true ? false : true"
                  @click.prevent="submitForm('ruleForm')"
                >
                  {{ loading ? 'Submitting ...' : 'Submit' }}
                </a-button>
                <a-button
                  v-if="current > 0"
                  type="dashed"
                  size="small"
                  @click="prev"
                >
                  <a-icon type="left" /> Previous
                </a-button>
              </a-button-group>
              <span
                v-if="current == steps.length - 1"
                class="float-right btntt"
              >
                <a-button
                  type="dashed"
                  size="small"
                  class="mr-2"
                  @click.prevent="exitApplication('ruleForm')"
                >
                  <a-icon type="fullscreen-exit" /> Exit
                </a-button>
                Or
                <NuxtLink to="/" class="ml-2">Go back home</NuxtLink>
              </span>
            </div>
          </a-form-model>
        </div>
      </a-row>
    </a-col>
  </div>
</template>
<script>
export default {
  async asyncData(context) {
    if (context.store.state.nationalities.list.length === 0) {
      await context.store.dispatch('nationalities/fetchNationalities')
    }
    if (context.store.state.supplier.number === '') {
      await context.store.dispatch('supplier/fetchSupplierNumber')
    }
  },
  data() {
    const validateFileUploadYesNo = (rule, value, callback) => {
      // add more propertie here using || annotation e.g. ruleForm.step3.
      if (value.length === 0 && this.ruleForm.step3.litigation === 'yes') {
        // || value === ''
        callback(new Error('Please attach file.'))
      } else {
        callback()
      }
    }
    const validateFileUploadYesNoCompanyNameChange = (
      rule,
      value,
      callback
    ) => {
      // add more propertie here using || annotation e.g. ruleForm.step3.
      if (
        value.length === 0 &&
        this.ruleForm.step1.company_name_change === 'yes'
      ) {
        // || value === ''
        callback(new Error('Please attach file.'))
      } else {
        callback()
      }
    }
    const validateFileUploadYesNoCompanyCompanyDirc = (
      rule,
      value,
      callback
    ) => {
      // add more propertie here using || annotation e.g. ruleForm.step3.
      if (
        value.length === 0 &&
        this.ruleForm.step1.company_directors === 'yes'
      ) {
        // || value === ''
        callback(new Error('Please attach file.'))
      } else {
        callback()
      }
    }
    const validateFileUploadYesNoLegalEntity = (rule, value, callback) => {
      // add more propertie here using || annotation e.g. ruleForm.step3.
      if (value === '' && this.ruleForm.step1.legal_entity === 'other') {
        callback(new Error('Please input Other Legal Entity.'))
      } else {
        callback()
      }
    }
    const validateFileUploadYesNoNormal = (rule, value, callback) => {
      if (value === '' && this.ruleForm.step1.company_name_change === 'yes') {
        callback(new Error('Please input requred value.'))
      } else {
        callback()
      }
    }
    const validateFileUploadYesNoNormalCompanyDirc = (
      rule,
      value,
      callback
    ) => {
      if (value === '' && this.ruleForm.step1.company_directors === 'yes') {
        callback(new Error('Please input requred value.'))
      } else {
        callback()
      }
    }
    const validateFileUploadYesNoNormalO2Employe = (rule, value, callback) => {
      if (value === '' && this.ruleForm.step1.has_oxygene_employee === 'yes') {
        callback(new Error('Please input requred value.'))
      } else {
        callback()
      }
    }
    const validateFileUploadYesNoNormalIntreEmploy = (
      rule,
      value,
      callback
    ) => {
      if (value === '' && this.ruleForm.step1.has_interest_employee === 'yes') {
        callback(new Error('Please input requred value.'))
      } else {
        callback()
      }
    }
    const validateFileUploadNormal = (rule, value, callback) => {
      // add more propertie here using || annotation e.g. ruleForm.step3.
      if (value.length === 0 || value === '') {
        callback(new Error('Please attach file.'))
      } else {
        callback()
      }
    }
    return {
      ruleForm: {
        supplier_number: '',
        company_email_address: '',
        step1: {
          full_name_organization: '',
          physical_address: '',
          //
          postal_address: '',
          telephone_number: '',
          kra_pin_no: '',
          company_registration_no: '',
          //
          finance_dept_name: '',
          finance_dept_email: '',
          finance_dept_telno: '',
          legal_entity: '', //
          legal_entity_other: '',
          web_site_address: '',
          //
          list: [
            {
              id: 1,
              name: 'Director 1', // default Director 1
              director_name: '',
              director_email: '',
              director_id_no: 1, // Numeric default value 1
              director_postal_address: '',
              director_nationality: 'Kenyan', // default Kenyan
              director_per_shareholder: 1, // Numeric default value 1
            },
          ],
          //
          company_name_change: 'no', // String default value 'no'
          cert_of_changeofname: [],
          reason_of_namechange: '',
          //
          company_directors: 'no', // String default value 'no'
          cert_of_registration: [],
          reason_of_directorschange: '',
          //
          business_period: '3 years',
          //
          has_oxygene_employee: 'no', // String default value 'no'
          name_position: '',
          //
          has_interest_employee: 'no', // String default value 'no'
          details_of_interest: '',
          //
          contact_person_name: '',
          contact_person_title: '',
        },
        step2: {
          bank_references: {
            bank_name: 'Kenya Commercial Bank',
            branch: 'Kimathi Street',
            ac_no: 1221212121212, // Numeric value default 1
            name_title: 'Jackson Asumu',
            email_telno: '0711494289',
          },
          trade_references: [
            {
              id: 1,
              name: 'Reference 1', // default Reference 1
              company_name_addr: '',
              contact_person: '',
              position: '',
              office_telno: 0, // Numeric value default 0
              mobile_telno: 0, // Numeric value default 0
              email_addr: '',
            },
          ],
        },
        step3: {
          litigation: 'no', // Numeric value default no
          litigation_file: [],
        },
        step4: {
          evaluation: [],
        },
        step5: {
          acknowledge: false, // Default value: false
        },
        step6: {
          signed_sealed: [],
          for_onbehalf_of: '',
          position_in: '',
          company: '',
          date: '',
          acknowledge: false, // Default value: false
        },
      },
      dragging: true,
      rules: {
        //
        company_email_address: [
          {
            type: 'email',
            message: 'Looks like your E-mail address is invalid.',
          },
          {
            required: true,
            message: 'Please make sure your E-mail address is correct.',
          },
        ],
        //
        step1: {
          full_name_organization: {
            required: true,
            message: 'Please input Full Name of Organization',
          },
          physical_address: {
            required: true,
            message:
              'Please input Physical Address/Principal Place of Business State plot No.',
          },
          postal_address: {
            required: true,
            message: 'Please input Postal Address',
          },
          telephone_number: {
            required: true,
            message: 'Please make sure your Mobile Number in correct.',
          },
          kra_pin_no: { required: true, message: 'Please input KRA PIN No.' },
          company_registration_no: {
            required: true,
            message: 'Please input Company registration No.',
          },
          //
          finance_dept_name: { required: true, message: 'Please input Name' },
          finance_dept_email: [
            { required: true, message: 'Please input Email' },
            {
              type: 'email',
              message: 'Looks like your E-mail address is invalid.',
            },
          ],
          finance_dept_telno: {
            required: true,
            message: 'Please input Tel No.',
          },
          legal_entity: {
            required: true,
            message: 'Please select Legal Entity',
          },
          legal_entity_other: {
            validator: validateFileUploadYesNoLegalEntity,
            trigger: 'change',
          },
          // // Director
          // list: {
          //   director_per_shareholder: {
          //     required: true,
          //     message: 'Please input Percentage Shareholding',
          //   },
          // },
          // list: {
          //   director_nationality: {
          //     required: true,
          //     message: 'Please input Nationality',
          //   },
          // },
          // director_id_no: { required: true, message: 'Please input ID No.' },
          // director_email: [
          //   { required: true, message: 'Please input Email' },
          //   {
          //     type: 'email',
          //     message: 'Looks like your E-mail address is invalid.',
          //   },
          // ],
          // director_name: { required: true, message: 'Please input Name' },

          //
          cert_of_changeofname: {
            validator: validateFileUploadYesNoCompanyNameChange,
            trigger: 'change',
          },
          reason_of_namechange: {
            validator: validateFileUploadYesNoNormal,
            trigger: 'change',
          },
          //
          cert_of_registration: {
            validator: validateFileUploadYesNoCompanyCompanyDirc,
            trigger: 'change',
          },
          reason_of_directorschange: {
            validator: validateFileUploadYesNoNormalCompanyDirc,
            trigger: 'change',
          },
          //
          business_period: { required: true, message: 'Please input value' },
          //
          name_position: {
            validator: validateFileUploadYesNoNormalO2Employe,
            trigger: 'change',
          },
          //
          details_of_interest: {
            validator: validateFileUploadYesNoNormalIntreEmploy,
            trigger: 'change',
          },

          contact_person_name: { required: true, message: 'Please input name' },
          contact_person_title: {
            required: true,
            message: 'Please input title',
          },
        },
        //
        step2: {
          bank_references: {
            bank_name: {
              required: true,
              message: 'Please input bank name',
            },
            branch: {
              required: true,
              message: 'Please input Branch',
            },
            ac_no: {
              required: true,
              message: 'Please input Account No.',
            },
            name_title: {
              required: true,
              message: 'Please input Name & Title',
            },
            email_telno: {
              required: true,
              message: 'Please input email & telephone',
            },
          },
        },
        //
        step3: {
          litigation_file: {
            validator: validateFileUploadYesNo,
            trigger: 'change',
          },
        },
        //
        step4: {
          evaluation: {
            validator: validateFileUploadNormal,
            trigger: 'change',
          },
        },
        //
        step6: {
          signed_sealed: {
            validator: validateFileUploadNormal,
            trigger: 'change',
          },
          for_onbehalf_of: {
            required: true,
            message: 'Please input For and on Behalf of',
          },
          position_in: {
            required: true,
            message: 'Please input your Position in',
          },
          company: {
            required: true,
            message: 'Please input your Company',
          },
          date: {
            required: true,
            message: 'Please pick a Date',
          },
        },
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
      loading: false,
      checked: true,
      error: {},
      current: 0,
      currentinnerstep: 0,
      steps: [
        {
          title: 'Business/ Corporate Information',
        },
        {
          title: 'References',
        },
        {
          title: 'Litigation History',
        },
        {
          title: 'Evaluation',
        },
        {
          title: 'Data Protection Statment',
        },
        {
          title: 'Declaration',
          description: '',
        },
      ],
      duration: 0,
    }
  },
  computed: {
    validationErrors() {
      if (this.error.formErrors !== undefined) {
        return this.error.formErrors
      } else {
        return {}
      }
    },
    stepFormComponent() {
      return 'ProcurementStep' + this.current
    },
    supplierNo() {
      return this.$store.state.supplier.number
    },
  },
  watch: {
    supplierNo() {
      this.ruleForm.supplier_number = this.supplierNo
    },
    currentinnerstep() {},
  },
  mounted() {
    if (this.$store.state.supplier.number === '') {
      this.$store.dispatch('supplier/fetchSupplierNumber')
    }
    this.ruleForm.supplier_number = this.supplierNo

    // window.addEventListener('ruleForm-localstorage-changed', (event) => {
    //   this.ruleForm = JSON.parse(event.detail.storage)
    //   console.log('', this.ruleForm)
    // })
    // if (localStorage.getItem('ruleForm') !== null) {
    //   this.ruleForm = JSON.parse(localStorage.getItem('ruleForm'))
    //   console.log('b', this.ruleForm)
    // }
  },
  methods: {
    async submitForm(formName) {
      try {
        setTimeout(() => {
          this.loading = false
        }, 800)
        this.loading = true

        const result = await this.$refs[formName].validate()
        if (result)
          if (
            Object.keys(this.error).length === 0 &&
            this.error.status !== 'success'
          ) {
            this.$notification.info({
              message: 'Supplier Application',
              description:
                'Attempting to submit your application. This might take a while uploading your files to our database, kindly be patient ...',
              placement: 'bottom',
              duration: 30,
            })
            const hide = this.$message.loading('Processing your data...', 0)
            setTimeout(hide, 60000)
          }

        // attach form data & files
        const formData = new FormData()

        for (const key in this.ruleForm) {
          if (key === 'step1') {
            // 1.1 get cert_of_changeofname file
            this.ruleForm[key].cert_of_changeofname.forEach((file, key1) => {
              formData.append(`step1by1_file${key1}`, file)
            })
            // 1.2 get cert_of_registration file
            this.ruleForm[key].cert_of_registration.forEach((file, key1) => {
              formData.append(`step1by2_file${key1}`, file)
            })
            // 2. get all data in step1
            formData.append(`basicinfo`, JSON.stringify(this.ruleForm[key]))
          } else if (key === 'step4') {
            this.ruleForm[key].evaluation.forEach((file, key1) => {
              formData.append(`step4_file${key1}`, file)
            })
          } else if (key === 'step3') {
            formData.append(`litigation`, this.ruleForm[key].litigation)
            this.ruleForm[key].litigation_file.forEach((file, key1) => {
              formData.append(`step3_file${key1}`, file)
            })
          } else if (key === 'step6') {
            // 2.1 get signed_sealed file
            this.ruleForm[key].signed_sealed.forEach((file, key1) => {
              formData.append(`step6_file${key1}`, file)
            })
            // 3. get all data in step1
            formData.append(`declaration`, JSON.stringify(this.ruleForm[key]))
          } else {
            formData.append(key, JSON.stringify(this.ruleForm[key]))
          }
        }

        const response = await this.$axios.$post(
          'supplier-application',
          formData,
          {
            'Content-Type': 'multipart/form-data',
          }
        )

        //
        this.error = response

        if (response.status === 'success') {
          setTimeout(() => {
            this.$notification.success({
              message: 'Supplier Application',
              description: response.message,
              placement: 'bottom',
              duration: 6,
            })
          }, 2000)
          setTimeout(() => {
            this.$message.destroy()
            this.$notification.destroy('info')
          }, 1500)
          // Delete stored data on browser
          // localStorage.removeItem('ruleForm', this.ruleForm)
          //
          // for (let index = 0; index < this.steps.length; index++) {
          //   const indexMinus = index + 1
          //   if (indexMinus === 6) {
          //     const hide = this.$message.loading(
          //       'All temporarily data has been cleared from your browser.',
          //       0
          //     )
          //     setTimeout(hide, 3000)
          //   }
          // }
        } else if (response.status === 'warning') {
          setTimeout(() => {
            this.$notification.warning({
              message: 'Supplier Application',
              description: response.message,
              placement: 'bottom',
              duration: 6,
            })
          }, 2000)
          setTimeout(() => {
            this.$message.destroy()
            this.$notification.destroy('info')
          }, 1500)
        } else if (response.status === 'error') {
          setTimeout(() => {
            this.$notification.error({
              message: 'Supplier Application',
              description: response.message,
              placement: 'bottom',
              duration: 6,
            })
          }, 2000)
          setTimeout(() => {
            this.$message.destroy()
            this.$notification.destroy('info')
          }, 1500)
        }
      } catch (error) {
        this.errorFormAlerts(error)
        setTimeout(() => {
          this.$notification.error({
            message: 'Supplier Application',
            description:
              'A critical error occured or one of your fields are empty!',
            placement: 'bottom',
            duration: 6,
          })
        }, 2000)
        setTimeout(() => {
          this.$message.destroy()
          this.$notification.destroy('info')
        }, 1500)
      }
    },
    async next(formName, innerSelect) {
      try {
        setTimeout(() => {
          this.loading = false
        }, 800)
        this.loading = true

        const result = await this.$refs[formName].validate()
        if (result) {
          //
          setTimeout(() => {
            if (this.error.status !== undefined) {
              // this.error.status = ''
              this.error = {}
            }
            // this.error.formErrors = {}
          }, 2000)
          //
          if (innerSelect === true) {
            this.currentinnerstep++
          } else {
            this.current++
          }
          //
          this.$store.dispatch('supplier/fetchSupplierNumber')

          // // Store data on browser
          // const formDataArr = this.ruleForm

          // // convert files Object to Array
          // formDataArr.step1.cert_of_changeofname = this.stringifyFile(
          //   this.ruleForm.step1.cert_of_changeofname
          // )
          // formDataArr.step1.cert_of_registration = this.stringifyFile(
          //   this.ruleForm.step1.cert_of_registration
          // )

          // formDataArr.step3.litigation_file = this.stringifyFile(
          //   this.ruleForm.step3.litigation_file
          // )
          // formDataArr.step4.evaluation = this.stringifyFile(
          //   this.ruleForm.step4.evaluation
          // )
          // formDataArr.step6.signed_sealed = this.stringifyFile(
          //   this.ruleForm.step6.signed_sealed
          // )

          // formDataArr.step6.date = null

          // localStorage.setItem('ruleForm', JSON.stringify(formDataArr))
          // window.dispatchEvent(
          //   new CustomEvent('ruleForm-localstorage-changed', {
          //     detail: {
          //       storage: localStorage.getItem('ruleForm'),
          //     },
          //   })
          // )

          // for (let index = 0; index < this.steps.length; index++) {
          //   const title = this.steps[index].title
          //   const indexMinus = index + 1
          //   if (indexMinus === this.current) {
          //     const hide = this.$message.loading(
          //       'Temporarily saving ' + title + ' form data on your browser.',
          //       0
          //     )
          //     setTimeout(hide, 3000)
          //   }
          // }
        }
      } catch (error) {
        console.log(error)
      }
    },
    prev(innerSelect) {
      if (innerSelect === true) {
        this.currentinnerstep--
      } else {
        this.current--
      }
      this.error = {}
    },
    // stringifyFile(originalFile) {
    //   const arrData = []
    //   for (let i = 0; i < originalFile.length; i++) {
    //     const file = originalFile[i]
    //     const obj = URL.createObjectURL(file)
    //     arrData.push(obj)
    //   }
    //   return arrData
    // },
    exitApplication(formName) {
      this.current = 0
      this.$refs[formName].resetFields()
      this.$store.dispatch('supplier/fetchSupplierNumber')
    },
    // Error
    errorFormAlerts(response) {
      this.error = response
    },
  },
}
</script>
