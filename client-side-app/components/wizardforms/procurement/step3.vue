<template>
  <div>
    <a-alert
      message="Intsructions:-"
      description="Kindly attach a maximum of 17 documents as show in the list below, in that order."
      type="info"
      show-icon
    />
    <ol class="mt-4">
      <li>Company Personal Identification Number (PIN) (Copy)</li>
      <li>Certificate of Tax Compliance (Copy)</li>
      <li>VAT Registration/certificate (Copy)</li>
      <li>Current Business License/Certificate (Copy)</li>
      <li>
        Names of all Directors and Partners (In a company letterhead paper and
        duly signed by one director)
      </li>
      <li>Directors Identity Card (ID) (Certified copies)</li>
      <li>Directors Personal Identification Number (PIN) (Copies)</li>
      <li>Company CR12 document (Less than 6 months from date of issue)</li>
      <li>Certificate of Company name change if any</li>
      <li>
        Passport photos of all Directors of the company (Certified photos)
      </li>
      <li>Memorandum and Articles of Association (Copy)</li>
      <li>
        Certificate of incorporation/Partnership deed/ Business Certificate
        (Copy)
      </li>
      <li>Latest Audited Financial Accounts - Last two years (Copies)</li>
      <li>Detailed Business Profile</li>
      <li>Latest Company Returns (2020) (Copy)</li>
      <li>Reference letters from your business references</li>
      <li>
        Bank reference and bank account information letter from your bankers
      </li>
    </ol>
    <div class="border border-right-0 border-left-0 py-4 mb-4 clearfix">
      <a-form-model-item
        :help="validationErrors ? validationErrors.step2 : ''"
        :validate-status="error.status"
        prop="step4.evaluation"
        has-feedback
        class="mb-0"
      >
        <a-upload
          v-model="formData.step4.evaluation"
          :multiple="true"
          list-type="picture"
          :file-list="fileEvaluationData"
          :remove="handleRemove"
          :before-upload="beforeUpload"
          @change="handleFileUploadChange"
        >
          <a-button :disabled="fileEvaluationData.length < 17 ? false : true">
            <a-icon type="upload" /> Click to Upload
          </a-button>
        </a-upload>
      </a-form-model-item>
    </div>
    <h6 class="text-bold">
      PLEASE NOTE THE ABOVE DOCUMENTS ATTACHED FOLLOWING THE SEQUENCE ABOVE
    </h6>
    <h6 class="text-bold">General Requirements</h6>
    <ul>
      <li>
        Oxygene Limited will examine the documents to determine completeness,
        general orderliness andsufficiency in responsiveness.
      </li>
      <li>
        The applicants should have registered offices and Oxygene Limited
        reserves the discretion of visiting the physical premises from which the
        applicant conducts business.
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  props: {
    current: {
      type: [Number],
      required: true,
    },
    error: {
      type: [Object, Boolean],
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
  },
  data() {
    return {
      formData: this.ruleForm,
      fileEvaluationData: [],
    }
  },
  watch: {
    fileEvaluationData() {
      if (this.fileEvaluationData.length !== 0) {
        this.formData.step4.evaluation = this.fileEvaluationData
      } else {
        this.formData.step4.evaluation = this.fileEvaluationData
      }
    },
  },
  created() {
    if (this.formData.step4.evaluation !== '') {
      this.fileEvaluationData = this.formData.step4.evaluation
    }
  },
  methods: {
    handleFileUploadChange() {
      if (Object.keys(this.fileEvaluationData).length > 0) {
        this.formData.step4.evaluation = this.fileEvaluationData
      }
    },
    beforeUpload(file) {
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
        this.fileEvaluationData = [...this.fileEvaluationData, file]
        // 1. Limit the number of uploaded files
        // Only to show two recent uploaded files, and old ones will be replaced by the new
        this.fileEvaluationData = this.fileEvaluationData.slice(-17)
      }
      return false
      // return isJpgOrPng && isLt2M
    },
    handleRemove(file) {
      const index = this.fileEvaluationData.indexOf(file)
      const newFileList = this.fileEvaluationData.slice()
      newFileList.splice(index, 1)
      this.fileEvaluationData = newFileList
    },
  },
}
</script>
