<template>
  <div>
    <a-col :span="20" :offset="2">
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
              ></Component>
            </div>
            <!-- BUTTONS -->
            <div class="mt-3">
              <a-button-group>
                <a-button
                  v-if="current < steps.length - 1"
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
              <span v-if="current == steps.length - 1" class="float-right">
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
        company_email_address: 'chegenyejackson@gmail.com',
        step1: {
          full_name_organization: 'Mwananchi Village Market',
          physical_address: 'Lenana Rd. 380 street, Kilimani',
          //
          postal_address: 'P.O. BOX 355 - 50103',
          telephone_number: '0711494289',
          kra_pin_no: 'ASU7W0332203',
          company_registration_no: 'COMPNY-29282',
          //
          finance_dept_name: 'Liz K.',
          finance_dept_email: 'liz@mwananchi.com',
          finance_dept_telno: '0700000000',
          legal_entity: 'other',
          legal_entity_other: 'N/A - Legal Entity',
          web_site_address: 'N/A - Web Add',
          //
          list: [
            {
              id: 1,
              name: 'Director 1',
              director_name: 'Johnson G.',
              director_email: 'johnson@gmail.com',
              director_id_no: 20393883, // Numeric default value 1
              director_postal_address: 'P.O BOX - 4950',
              director_nationality: 'Kenyan',
              director_per_shareholder: 80, // Numeric default value 1
            },
            {
              id: 2,
              name: 'Director 2',
              director_name: 'Vincent Ateya',
              director_email: 'vinny29@gmail.com',
              director_id_no: 28373839, // Numeric default value 1
              director_postal_address: 'P.O BOX - 4950',
              director_nationality: 'Kenyan',
              director_per_shareholder: 20, // Numeric default value 1
            },
          ],
          //
          company_name_change: 'yes', // String default value 'no'
          cert_of_changeofname: '',
          reason_of_namechange: 'N/A - reason name change',
          //
          company_directors: 'yes', // String default value 'no'
          cert_of_registration: '',
          reason_of_directorschange: 'N/A - reason directors',
          //
          business_period: '3 years',
          //
          has_oxygene_employee: 'yes', // String default value 'no'
          name_position: 'N/A - name position',
          //
          has_interest_employee: 'yes', // String default value 'no'
          details_of_interest: 'N/A - details of interest',
          //
          contact_person_name: 'Nelly Asumu',
          contact_person_title: 'Procurment Manager',
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
              name: 'Reference 1',
              company_name_addr: 'Brand Capital Africa ',
              contact_person: 'Njuguna K.',
              position: 'Manager',
              office_telno: 1745000000, // Numeric value default 0
              mobile_telno: 1172200001, // Numeric value default 0
              email_addr: 'jugushk@brandcapital.co.ke',
            },
            {
              id: 2,
              name: 'Reference 2',
              company_name_addr: 'Jumia Kenya',
              contact_person: 'Mary Akida',
              position: 'CEO',
              office_telno: 722200045, // Numeric value default 0
              mobile_telno: 721000030, // Numeric value default 0
              email_addr: 'mary@jumia.com',
            },
          ],
        },
        step3: {
          litigation: 'yes', // Numeric value default no
          litigation_file: [],
        },
        step4: {
          evaluation: '',
        },
        step6: {
          signed_sealed: [],
          for_onbehalf_of: '',
          position_in: '',
          company: '',
          date: '',
          acknowledge: false,
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
          // signed_sealed: {
          //   required: true,
          //   message: 'Please input your initials',
          // },
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
  },
  mounted() {
    if (this.$store.state.supplier.number === '') {
      this.$store.dispatch('supplier/fetchSupplierNumber')
    }
    this.ruleForm.supplier_number = this.supplierNo
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
          if (this.error.status !== 'success') {
            this.$notification.info({
              message: 'Supplier Application',
              description:
                'Attempting to submit your application, kindly wait ...',
              placement: 'bottom',
            })
          }

        const formData = new FormData()

        for (const key in this.ruleForm) {
          if (key === 'step4') {
            this.ruleForm[key].evaluation.forEach((file, key1) => {
              formData.append(`step4_file${key1}`, file)
            })
          } else if (key === 'step3') {
            formData.append(`litigation`, this.ruleForm[key].litigation)
            this.ruleForm[key].litigation_file.forEach((file, key1) => {
              formData.append(`step3_file${key1}`, file)
            })
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
          }, 1500)
        } else if (response.status === 'warning') {
          setTimeout(() => {
            this.$notification.warning({
              message: 'Supplier Application',
              description: response.message,
              placement: 'bottom',
              duration: 6,
            })
          }, 1500)
        } else if (response.status === 'error') {
          setTimeout(() => {
            this.$notification.error({
              message: 'Supplier Application',
              description: response.message,
              placement: 'bottom',
              duration: 6,
            })
          }, 1500)
        }
      } catch (error) {
        this.errorFormAlerts(error)
      }
    },
    async next(formName) {
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
              this.error.status = ''
            }
            // this.error.formErrors = {}
          }, 2000)
          //
          this.current++
          //
          this.$store.dispatch('supplier/fetchSupplierNumber')
        }
      } catch (error) {
        console.log(error)
      }
    },
    prev() {
      this.current--
    },
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
