<template>
  <span>
    <!-- row 5 -->
    <a-row>
      <a-col :xs="24" :sm="24" :md="24" :lg="8" :xl="8">
        <a-form-model-item class="question-box">
          <!-- company_name_change -->
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            label="Have you changed your company name over the last 10 years?"
            prop="step1.company_name_change"
            class="mb-0"
          >
            <a-radio-group v-model="formData.step1.company_name_change">
              <a-radio value="yes"> Yes </a-radio>
              <a-radio value="no"> No </a-radio>
            </a-radio-group>
          </a-form-model-item>
          <!-- cert_of_changeofname -->
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.cert_of_changeofname"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Attach certificate of change of name"
            :hidden="
              formData.step1.company_name_change === 'yes' ? false : true
            "
          >
            <a-upload-dragger
              v-model="formData.step1.cert_of_changeofname"
              :multiple="true"
              :file-list="certofChangeofNameData"
              :remove="handleRemove1"
              :before-upload="beforeUpload1"
              :disabled="certofChangeofNameData.length < 2 ? false : true"
              @change="handleFileUploadChange"
            >
              <p class="ant-upload-drag-icon">
                <a-icon type="inbox" />
              </p>
              <p class="ant-upload-text">
                Click or drag file to this area to upload
              </p>
              <small class="ant-upload-hint"
                >Supported file formats pdf, word, png, jgp, jpeg, excel. A
                maximum of 2 files upload.</small
              >
            </a-upload-dragger>
          </a-form-model-item>
          <!-- reason_of_namechange -->
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.reason_of_namechange"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Provide clear details outlining reasons and purpose of name change"
            :hidden="
              formData.step1.company_name_change === 'yes' ? false : true
            "
          >
            <a-textarea
              v-model="formData.step1.reason_of_namechange"
              :rows="3"
            />
          </a-form-model-item>
        </a-form-model-item>
      </a-col>
      <a-col :xs="24" :sm="24" :md="24" :lg="8" :xl="8">
        <!-- company_directors -->
        <a-form-model-item class="question-box">
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            label="Have you changed your company Directors or ownership in the last 10 years?"
            prop="step1.company_directors"
            class="mb-0"
          >
            <a-radio-group v-model="formData.step1.company_directors">
              <a-radio value="yes"> Yes </a-radio>
              <a-radio value="no"> No </a-radio>
            </a-radio-group>
          </a-form-model-item>
          <!-- cert_of_registration -->
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.cert_of_registration"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Attach certificate of registration and/or latest annual returns"
            :hidden="formData.step1.company_directors === 'yes' ? false : true"
          >
            <a-upload-dragger
              v-model="formData.step1.cert_of_registration"
              :multiple="true"
              :file-list="certofRegistration"
              :remove="handleRemove2"
              :before-upload="beforeUpload2"
              :disabled="certofRegistration.length < 2 ? false : true"
              @change="handleFileUploadChange"
            >
              <p class="ant-upload-drag-icon">
                <a-icon type="inbox" />
              </p>
              <p class="ant-upload-text">
                Click or drag file to this area to upload
              </p>
              <small class="ant-upload-hint"
                >Supported file formats pdf, word, png, jgp, jpeg, excel. A
                maximum of 2 files upload.</small
              >
            </a-upload-dragger>
          </a-form-model-item>
          <!-- reason_of_directorschange -->
          <a-form-model-item
            :help="
              validationErrors ? validationErrors.reason_of_directorschange : ''
            "
            :validate-status="error.status"
            prop="step1.reason_of_directorschange"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Provide clear details outlining reasons and purpose of change of Directors"
            :hidden="formData.step1.company_directors === 'yes' ? false : true"
          >
            <a-textarea
              v-model="formData.step1.reason_of_directorschange"
              :rows="3"
            />
          </a-form-model-item>
        </a-form-model-item>
      </a-col>
      <a-col :xs="24" :sm="24" :md="24" :lg="8" :xl="8">
        <!-- business_period -->
        <a-form-model-item class="question-box" help="E.g 1 Month or 10 Years">
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.business_period"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Period in which you have been in business for which you wish to supply us with goods/services."
          >
            <a-input v-model="formData.step1.business_period">
              <a-icon
                slot="prefix"
                type="file"
                style="color: rgba(0, 0, 0, 0.25)"
              />
            </a-input>
          </a-form-model-item>
        </a-form-model-item>
      </a-col>
    </a-row>

    <!-- row 5 -->
    <a-row>
      <a-col :xs="24" :sm="24" :md="24" :lg="8" :xl="8">
        <a-form-model-item class="question-box">
          <!-- has_oxygene_employee -->
          <a-form-model-item
            :help="
              validationErrors ? validationErrors.has_oxygene_employee : ''
            "
            :validate-status="error.status"
            label="Are any of the Directors, Partners, Shareholders or employees, employed by or have relatives who are currently employed by Oxygene Limited?"
            prop="step1.has_oxygene_employee"
            class="mb-0"
          >
            <a-radio-group v-model="formData.step1.has_oxygene_employee">
              <a-radio value="yes"> Yes </a-radio>
              <a-radio value="no"> No </a-radio>
            </a-radio-group>
          </a-form-model-item>
          <!--  name_position -->
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.name_position"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Declare name and position"
            :hidden="
              formData.step1.has_oxygene_employee === 'yes' ? false : true
            "
          >
            <a-textarea v-model="formData.step1.name_position" :rows="4" />
          </a-form-model-item>
        </a-form-model-item>
      </a-col>
      <a-col :xs="24" :sm="24" :md="24" :lg="8" :xl="8">
        <a-form-model-item class="question-box">
          <!-- has_interest_employee -->
          <a-form-model-item
            :help="
              validationErrors ? validationErrors.has_interest_employee : ''
            "
            :validate-status="error.status"
            label="Do any of the Directors, Partners, Shareholders or employees have any other interest (other than what you are seeking to supply) with persons currently employed by Oxygene Limited or other suppliers, partners or Directors of Oxygene Limited?"
            prop="step1.has_interest_employee"
            class="mb-0"
          >
            <a-radio-group
              v-model="formData.step1.has_interest_employee"
              :style="{ width: 'calc(100% - 12px)' }"
            >
              <a-radio value="yes"> Yes </a-radio>
              <a-radio value="no"> No </a-radio>
            </a-radio-group>
          </a-form-model-item>
          <!-- details_of_interest  -->
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.details_of_interest"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Provide full details of interest "
            :hidden="
              formData.step1.has_interest_employee === 'yes' ? false : true
            "
          >
            <a-textarea
              v-model="formData.step1.details_of_interest"
              :rows="4"
            />
          </a-form-model-item>
        </a-form-model-item>
      </a-col>
      <a-col :xs="24" :sm="24" :md="24" :lg="8" :xl="8">
        <a-form-model-item class="question-box">
          <div class="ant-col ant-form-item-label">
            <label>
              Contact persons within your Organization to whom enquiries about
              this application should be directed. (Provide two contact names)
            </label>
          </div>
          <!-- contact_person_name -->
          <a-form-model-item
            help="Separate the names with a comma e.g Joe Doe, Mary Dew"
          >
            <a-form-model-item
              :help="validationErrors ? validationErrors.step1 : ''"
              :validate-status="error.status"
              prop="step1.contact_person_name"
              has-feedback
              class="mb-0"
              label="Names (full names):"
            >
              <a-textarea
                v-model="formData.step1.contact_person_name"
                :rows="4"
              />
            </a-form-model-item>
          </a-form-model-item>
          <!-- contact_person_title -->
          <a-form-model-item
            help="Separate the titles/designations with a comma e.g Accountant, Engineer in order of the names above."
          >
            <a-form-model-item
              :help="
                validationErrors ? validationErrors.contact_person_title : ''
              "
              :validate-status="error.status"
              prop="step1.contact_person_title"
              has-feedback
              class="mb-0"
              label="Title:"
            >
              <a-textarea
                v-model="formData.step1.contact_person_title"
                :rows="4"
              />
            </a-form-model-item>
          </a-form-model-item>
        </a-form-model-item>
      </a-col>
    </a-row>
  </span>
</template>

<script>
export default {
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
      currentInnerStep: this.currentinnerstep,
      certofChangeofNameData: [],
      certofRegistration: [],
    }
  },
  computed: {
    innerStepFormComponent() {
      return 'ProcurementInnerStep' + this.currentInnerStep
    },
  },
  watch: {
    //
    certofChangeofNameData() {
      if (this.certofChangeofNameData.length !== 0) {
        this.formData.step1.cert_of_changeofname = this.certofChangeofNameData
      } else {
        this.formData.step1.cert_of_changeofname = this.certofChangeofNameData
      }
    },
    'formData.step1.company_name_change'() {
      if (this.formData.step1.company_name_change === 'no') {
        this.formData.step1.cert_of_changeofname = []
      } else {
        this.formData.step1.cert_of_changeofname = this.certofChangeofNameData
      }
    },
    //
    certofRegistration() {
      if (this.certofRegistration.length !== 0) {
        this.formData.step1.cert_of_registration = this.certofRegistration
      } else {
        this.formData.step1.cert_of_registration = this.certofRegistration
      }
    },
    'formData.step1.company_directors'() {
      if (this.formData.step1.company_directors === 'no') {
        this.formData.step1.cert_of_registration = []
      } else {
        this.formData.step1.cert_of_registration = this.certofRegistration
      }
    },
  },
  created() {
    if (this.formData.step1.cert_of_changeofname !== '') {
      this.certofChangeofNameData = this.formData.step1.cert_of_changeofname
    }
    if (this.formData.step1.cert_of_registration !== '') {
      this.certofRegistration = this.formData.step1.cert_of_registration
    }
  },
  methods: {
    handleFileUploadChange() {
      if (this.certofChangeofNameData.length !== 0) {
        this.formData.step1.cert_of_changeofname = this.certofChangeofNameData
      }
      if (this.certofRegistration.length !== 0) {
        this.formData.step1.cert_of_registration = this.certofRegistration
      }
    },
    beforeUpload1(file) {
      const isJpgOrPng =
        file.type === 'image/jpeg' ||
        file.type === 'image/png' ||
        file.type === 'application/pdf' ||
        file.type === 'application/vnd.ms-excel' ||
        file.type ===
          'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ||
        file.type === 'application/msword' ||
        file.type ===
          'application/vnd.openxmlformats-officedocument.wordprocessingml.document'

      const isLt2M = file.size / 1024 / 1024 < 2

      if (!isJpgOrPng) {
        this.$notification.error({
          message: 'File Upload',
          description: 'Sorry that file type is NOT accepted!',
          placement: 'bottomLeft',
          duration: 6,
        })
      } else if (!isLt2M) {
        this.$notification.warning({
          message: 'File Upload',
          description: 'Image must smaller than 2MB!',
          placement: 'bottomLeft',
          duration: 6,
        })
      } else {
        this.certofChangeofNameData = [...this.certofChangeofNameData, file]
      }
      return false
    },
    beforeUpload2(file) {
      const isJpgOrPng =
        file.type === 'image/jpeg' ||
        file.type === 'image/png' ||
        file.type === 'application/pdf' ||
        file.type === 'application/vnd.ms-excel' ||
        file.type ===
          'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ||
        file.type === 'application/msword' ||
        file.type ===
          'application/vnd.openxmlformats-officedocument.wordprocessingml.document'

      const isLt2M = file.size / 1024 / 1024 < 2

      if (!isJpgOrPng) {
        this.$notification.error({
          message: 'File Upload',
          description: 'Sorry that file type is NOT accepted!',
          placement: 'bottomLeft',
          duration: 6,
        })
      } else if (!isLt2M) {
        this.$notification.warning({
          message: 'File Upload',
          description: 'Image must smaller than 2MB!',
          placement: 'bottomLeft',
          duration: 6,
        })
      } else {
        this.certofRegistration = [...this.certofRegistration, file]
      }
      return false
    },
    handleRemove1(file) {
      // 1
      const index = this.certofChangeofNameData.indexOf(file)
      const newFileList = this.certofChangeofNameData.slice()
      newFileList.splice(index, 1)
      this.certofChangeofNameData = newFileList
    },
    handleRemove2(file) {
      // 2
      const index = this.certofRegistration.indexOf(file)
      const newFileList = this.certofRegistration.slice()
      newFileList.splice(index, 1)
      this.certofRegistration = newFileList
    },
  },
}
</script>
