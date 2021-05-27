<template>
  <span>
    <!-- row 1 -->
    <a-row>
      <a-col :span="24">
        <!-- company_email_address -->
        <a-form-model-item
          prop="company_email_address"
          :help="validationErrors ? validationErrors.company_email_address : ''"
          :validate-status="error.status"
          v-bind="formItemLayout"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          class="mb-2"
        >
          <span class="text-danger w-100 text-uppercase"
            ><strong>NOTE:</strong> We will use this email to communicate back
            to you.</span
          >
          <span slot="label" title="jj">
            Company E-Mail Address&nbsp;
            <a-tooltip title="We will use this email to communicate back">
              <a-icon type="question-circle-o" />
            </a-tooltip>
          </span>
          <a-input v-model="formData.company_email_address" />
        </a-form-model-item>

        <!-- Full Name of Organization -->
        <a-form-model-item
          prop="step1.full_name_organization"
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          v-bind="formItemLayout"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          class="mb-2"
        >
          <span slot="label">
            Full Name of Organization&nbsp;
            <a-tooltip title="What would you like us to call you?">
              <a-icon type="question-circle-o" />
            </a-tooltip>
          </span>
          <a-input v-model="formData.step1.full_name_organization" />
        </a-form-model-item>
        <!-- physical Address -->
        <a-form-model-item
          prop="step1.physical_address"
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          v-bind="formItemLayout"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          label="Physical Address/Principal Place of Business State plot No."
          class="mb-2"
        >
          <a-textarea v-model="formData.step1.physical_address" :rows="4" />
        </a-form-model-item>
      </a-col>
    </a-row>
    <!-- row 2 -->
    <a-row>
      <a-col :xs="24" :sm="24" :md="24" :lg="6" :xl="6">
        <!-- Postal Address -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          prop="step1.postal_address"
          has-feedback
          :style="{ width: 'calc(100% - 0px)' }"
          label="Postal Address"
          class="mb-0"
        >
          <a-textarea v-model="formData.step1.postal_address" :rows="3" />
        </a-form-model-item>
      </a-col>
      <a-col :xs="24" :sm="24" :md="24" :lg="18" :xl="16">
        <!-- Mobile Number -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          prop="step1.telephone_number"
          v-bind="formItemLayout"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          class="mb-0"
          label="Mobile Number *"
        >
          <span class="text-danger text-uppercase"
            ><strong>NOTE:</strong> We will use this phone number to communicate
            back to you.</span
          >
          <VuePhoneNumberInput
            v-model="formData.step1.telephone_number"
            default-country-code="KE"
          />
          <!-- <a-input
            v-model="formData.step1.telephone_number"
            type="number"
            min="0"
          >
            <a-icon
              slot="prefix"
              type="number"
              style="color: rgba(0, 0, 0, 0.25)"
            />
          </a-input> -->
        </a-form-model-item>
        <!-- KRA PIN No -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          prop="step1.kra_pin_no"
          v-bind="formItemLayout"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          class="mb-0"
          label="KRA PIN No. *"
        >
          <a-input v-model="formData.step1.kra_pin_no">
            <a-icon
              slot="prefix"
              type="file"
              style="color: rgba(0, 0, 0, 0.25)"
            />
          </a-input>
        </a-form-model-item>
        <!-- company_registration_no -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          prop="step1.company_registration_no"
          v-bind="formItemLayout"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          label="Company registration number"
          class="mb-0"
        >
          <a-input v-model="formData.step1.company_registration_no" />
        </a-form-model-item>
      </a-col>
    </a-row>

    <a-row
      ><a-col :span="24"><hr /></a-col
    ></a-row>

    <!-- row 3 -->
    <a-row>
      <a-col :span="12">
        <!-- Contact details for finance department * -->
        <a-form-model-item>
          <div
            class="mt-4 d-block ant-col ant-form-item-label"
            style="line-height: normal; text-align: center"
          >
            <label> Contact details for finance department * </label>
          </div>
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.finance_dept_name"
            v-bind="formItemLayout"
            has-feedback
            :style="{ width: 'calc(100% - 12px)' }"
            class="mb-0"
            label="Full Names"
          >
            <a-input
              v-model="formData.step1.finance_dept_name"
              placeholder="Full Names"
            >
              <a-icon
                slot="prefix"
                type="user"
                style="color: rgba(0, 0, 0, 0.25)"
              />
            </a-input>
          </a-form-model-item>
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.finance_dept_email"
            has-feedback
            v-bind="formItemLayout"
            :style="{ width: 'calc(100% - 12px)' }"
            class="mb-0"
            label="Email Address"
          >
            <a-input
              v-model="formData.step1.finance_dept_email"
              placeholder="Email Address"
              type="email"
            >
              <a-icon
                slot="prefix"
                type="red-envelope"
                style="color: rgba(0, 0, 0, 0.25)"
              />
            </a-input>
          </a-form-model-item>
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.finance_dept_telno"
            has-feedback
            v-bind="formItemLayout"
            :style="{ width: 'calc(100% - 12px)' }"
            class="mb-0"
            label="Tel/Phone Number:"
          >
            <VuePhoneNumberInput
              v-model="formData.step1.finance_dept_telno"
              default-country-code="KE"
            />
            <!-- <a-input
              v-model="formData.step1.finance_dept_telno"
              placeholder="Tel/Phone Number"
              type="number"
              min="0"
            >
              <a-icon
                slot="prefix"
                type="number"
                style="color: rgba(0, 0, 0, 0.25)"
              />
            </a-input> -->
          </a-form-model-item>
        </a-form-model-item>
      </a-col>
      <a-col :span="12">
        <!-- Legal Entity: (a) Sole proprietor (b) Corporation (c) Partnership (d) Other  && Web Sites Address (if any) -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          label="Legal Entity:"
          prop="step1.legal_entity"
          class="mb-0"
        >
          <a-radio-group v-model="formData.step1.legal_entity">
            <a-radio value="Sole Proprietor" :checked="true">
              Sole proprietor
            </a-radio>
            <a-radio value="Corporation"> Corporation </a-radio>
            <a-radio value="Partnership"> Partnership </a-radio>
            <a-radio value="other"> Other </a-radio>
          </a-radio-group>
        </a-form-model-item>
        <a-form-model-item
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          prop="step1.legal_entity_other"
          has-feedback
          class="mb-0"
          label="Other Description"
          :hidden="formData.step1.legal_entity === 'other' ? false : true"
        >
          <a-input v-model="formData.step1.legal_entity_other" type="textarea">
            <a-icon
              slot="prefix"
              type="file"
              style="color: rgba(0, 0, 0, 0.25)"
            />
          </a-input>
        </a-form-model-item>
        <!-- Web Sites Address (if any) -->
        <a-form-model-item
          prop="step1.web_site_address"
          class="mb-0"
          label="Web Sites Address (if any)"
          ><a-auto-complete
            v-model="formData.step1.web_site_address"
            addon-before="Http://"
            @change="handleWebsiteChange"
          >
            <template slot="dataSource">
              <a-select-option
                v-for="website in autoCompleteResult"
                :key="website"
              >
                {{ website }}
              </a-select-option>
            </template>
            <a-input />
          </a-auto-complete>
          <!-- <a-input v-model="formData.step1.web_site_address" addon-before="Http://" /> -->
        </a-form-model-item>
      </a-col>
    </a-row>
  </span>
</template>
<script>
import VuePhoneNumberInput from 'vue-phone-number-input'
export default {
  components: {
    VuePhoneNumberInput,
  },
  props: {
    error: {
      type: [Object, Boolean, Error],
      required: true,
    },
    formItemLayout: {
      type: [Object],
      required: true,
    },
    validationErrors: {
      type: [Object],
      required: true,
    },
    ruleForm: {
      type: [Object],
      required: true,
    },
    current: {
      type: [Number],
      required: true,
    },
    currentinnerstep: {
      type: [Number],
      required: true,
    },
  },
  data() {
    return {
      formData: this.ruleForm,
      autoCompleteResult: [],
    }
  },
  methods: {
    handleWebsiteChange(value) {
      let autoCompleteResult
      if (!value) {
        autoCompleteResult = []
      } else {
        autoCompleteResult = [
          '.com',
          '.org',
          '.net',
          '.co.ke',
          '.ke',
          '.africa',
          '.ug',
          '.tz',
        ].map((domain) => `${value}${domain}`)
      }
      this.autoCompleteResult = autoCompleteResult
    },
  },
}
</script>
