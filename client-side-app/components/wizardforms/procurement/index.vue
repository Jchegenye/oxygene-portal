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
            class="login-form"
          >
            <div class="steps-content">
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
                :file-list="fileList"
                :handle-remove="handleRemove"
                :before-upload="beforeUpload"
                :handle-file-upload-change="handleFileUploadChange"
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
            </div>
          </a-form-model>
        </div>
      </a-row>
    </a-col>
  </div>
</template>
<script>
export default {
  data() {
    const validateFileUpload = (rule, value, callback) => {
      // add more propertie here using || annotation e.g. ruleForm.step3.
      if (value === null && this.ruleForm.step3.litigation === 'yes') {
        callback(new Error('Please attach file.'))
      } else {
        callback()
      }
    }
    return {
      fileList: [],
      ruleForm: {
        step1: {
          full_name_organization: 'Mwananchi Village Market',
          physical_address: 'Lenana Rd. 257 Street',
        },
        step2: {
          bank_references: {
            bank_name: 'Equity',
            // branch: '',
            // ac_no: '',
            // name_title: '',
            // email_telno: '',
          },
        },
        step3: {
          litigation: 'no',
          litigation_file: null,
        },
        // legal_entity_other: '',
        // postal_address: '',
        // telephone_number: '',
        // kra_pin_no: '',
        // company_registration_no: '',
        // company_email_address: '',
        // finance_dept_name: '',
        // finance_dept_email: '',
        // finance_dept_telno: '',
        // legal_entity: '',
        // web_site_address: '',
        // list: [
        //   {
        //     id: 1,
        //     name: 'Director 1',
        //     director_per_shareholder: '',
        //     director_nationality: '',
        //     director_id_no: '',
        //     director_email: '',
        //     director_name: '',
        //   },
        //   {
        //     id: 2,
        //     name: 'Director 2',
        //     director_per_shareholder: '',
        //     director_nationality: '',
        //     director_id_no: '',
        //     director_email: '',
        //     director_name: '',
        //   },
        // ],
        // company_name_change: 'no',
        // cert_of_changeofname: '',
        // reason_of_namechange: '',
        // //
        // company_directors: 'no',
        // cert_of_registration: '',
        // reason_of_directorschange: '',
        // //
        // business_period: '',
        // //
        // has_oxygene_employee: 'no',
        // name_position: '',
        // //
        // has_interest_employee: 'no',
        // details_of_interest: '',
        // //
        // contact_person_name: '',
        // contact_person_title: '',
        // trade_references: [
        //   {
        //     id: 1,
        //     name: 'Reference 1',
        //     company_name_addr: '',
        //     contact_person: '',
        //     position: '',
        //     office_telno: '',
        //     mobile_telno: '',
        //     email_addr: '',
        //   },
        //   {
        //     id: 2,
        //     name: 'Reference 2',
        //     company_name_addr: '',
        //     contact_person: '',
        //     position: '',
        //     office_telno: '',
        //     mobile_telno: '',
        //     email_addr: '',
        //   },
        //   {
        //     id: 3,
        //     name: 'Reference 3',
        //     company_name_addr: '',
        //     contact_person: '',
        //     position: '',
        //     office_telno: '',
        //     mobile_telno: '',
        //     email_addr: '',
        //   },
        // ],
        // evaluation: {
        //   eval_1: '',
        //   eval_2: '',
        //   eval_3: '',
        //   eval_4: '',
        //   eval_5: '',
        //   eval_6: '',
        //   eval_7: '',
        //   eval_8: '',
        //   eval_9: '',
        //   eval_10: '',
        //   eval_11: '',
        //   eval_12: '',
        //   eval_13: '',
        //   eval_14: '',
        //   eval_15: '',
        //   eval_16: '',
        //   eval_17: '',
        // },
        // declaration: {
        //   signed_sealed: '',
        //   for_onbehalf_of: '',
        //   position_in: '',
        //   company: '',
        //   date: '',
        //   acknowledge: [],
        // },
      },
      dragging: true,
      rules: {
        // email: [
        //   {
        //     type: 'email',
        //     message: 'The input is not valid E-mail',
        //   },
        //   {
        //     required: true,
        //     message: 'Please input your E-mail',
        //   },
        // ],
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
        },
        step2: {
          bank_references: {
            bank_name: {
              required: true,
              message: 'Please input Full Name of Organization',
            },
            // branch: '',
            // ac_no: '',
            // name_title: '',
            // email_telno: '',
          },
        },
        step3: {
          litigation_file: { validator: validateFileUpload, trigger: 'change' },
        },
        // postal_address: [
        //   {
        //     required: true,
        //     message: 'Please input Postal Address',
        //   },
        // ],
        // telephone_number: [
        //   {
        //     required: true,
        //     message: 'Please input your Telephone Number',
        //   },
        // ],
        // kra_pin_no: [
        //   {
        //     required: true,
        //     message: 'Please input KRA PIN No.',
        //   },
        // ],
        // company_registration_no: [
        //   {
        //     required: true,
        //     message: 'Please input Company registration number',
        //   },
        // ],
        // company_email_address: [
        //   {
        //     type: 'email',
        //     message: 'The input is not valid Company E-Mail Address',
        //   },
        //   {
        //     required: true,
        //     message: 'Please input your Company E-Mail Address',
        //   },
        // ],
        // finance_dept_name: [
        //   {
        //     required: true,
        //     message: 'Please input your Name',
        //   },
        // ],
        // finance_dept_email: [
        //   {
        //     type: 'email',
        //     message: 'The input is not valid Company E-Mail Address',
        //   },
        //   {
        //     required: true,
        //     message: 'Please input your E-Mail Address',
        //   },
        // ],
        // finance_dept_telno: [
        //   {
        //     required: true,
        //     message: 'Please input your Telephone Number',
        //   },
        // ],
        // legal_entity: [
        //   {
        //     required: true,
        //     message: 'Please select legal entity',
        //     trigger: 'change',
        //   },
        // ],
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
  },
  watch: {
    fileList() {
      if (Object.keys(this.fileList).length === 0) {
        this.ruleForm.step3.litigation_file = null
      } else {
        this.ruleForm.step3.litigation_file = this.fileList
      }
    },
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
          //
          setTimeout(() => {
            this.error.status = ''
            this.error.formErrors = {}
          }, 2000)

        await this.$axios
          .$post('supplier-form', this.ruleForm)
          .then((response) => {
            this.error = response

            setTimeout(() => {
              this.error = {
                status: 'warning',
                message: 'Sending email ...',
              }
            }, 1500)
          })
          .catch((err) => {
            this.errorFormAlerts(err)
          })
      } catch (error) {}
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
            this.error.status = ''
            this.error.formErrors = {}
          }, 2000)

          this.current++
        }
      } catch (error) {
        console.log(error)
      }
    },
    prev() {
      this.current--
    },
    // Error
    errorFormAlerts(response) {
      this.error = response
    },
    // FILEs
    handleRemove(file) {
      const index = this.fileList.indexOf(file)
      const newFileList = this.fileList.slice()
      newFileList.splice(index, 1)
      this.fileList = newFileList
    },
    beforeUpload(file) {
      this.fileList = [...this.fileList, file]
      return false
    },
    handleFileUploadChange() {
      // FILEs
      // 1.attach file_1
      if (Object.keys(this.fileList).length > 0) {
        this.ruleForm.step3.litigation_file = this.fileList
      }
    },
  },
}
</script>
