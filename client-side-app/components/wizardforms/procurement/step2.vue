<template>
  <div>
    <p>
      Have you, any of the Directors or the company itself, had any litigation
      concerning any contract/LPO you have executed in the last 5 years? If yes,
      provide/attach details in a separate sheet showing client, cause and
      matter in dispute and current status of suit
    </p>
    <a-form-model-item
      :help="validationErrors ? validationErrors.step3 : ''"
      :validate-status="error.status"
      label=""
      prop="step3.litigation"
      class="mb-0"
    >
      <a-radio-group v-model="formData.step3.litigation">
        <a-radio value="yes">Yes</a-radio>
        <a-radio value="no"> No </a-radio>
      </a-radio-group>
    </a-form-model-item>
    <a-form-model-item
      :help="validationErrors ? validationErrors.step3 : ''"
      :validate-status="error.status"
      prop="step3.litigation_file"
      :has-feedback="formData.step3.litigation === 'yes' ? false : true"
      class="mb-0"
      label=""
      :hidden="formData.step3.litigation === 'yes' ? false : true"
    >
      <!-- litigation_file -->
      <a-upload-dragger
        v-model="formData.step3.litigation_file"
        :multiple="true"
        :file-list="fileLitigationData"
        :remove="handleRemove"
        :before-upload="beforeUpload"
        :disabled="fileLitigationData.length < 2 ? false : true"
        @change="handleFileUploadChange"
      >
        <p class="ant-upload-drag-icon">
          <a-icon type="inbox" />
        </p>
        <p class="ant-upload-text">Click or drag file to this area to upload</p>
        <p class="ant-upload-hint">Support for a single upload.</p>
      </a-upload-dragger>
    </a-form-model-item>
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
      type: [Object],
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
    return { formData: this.ruleForm, fileLitigationData: [] }
  },
  watch: {
    fileLitigationData() {
      if (this.fileLitigationData.length !== 0) {
        this.formData.step3.litigation_file = this.fileLitigationData
      } else {
        this.formData.step3.litigation_file = this.fileLitigationData
      }
    },
    'formData.step3.litigation'() {
      if (this.formData.step3.litigation === 'no') {
        this.formData.step3.litigation_file = []
      } else {
        this.formData.step3.litigation_file = this.fileLitigationData
      }
    },
  },
  created() {
    if (this.formData.step3.litigation_file !== '') {
      this.fileLitigationData = this.formData.step3.litigation_file
    }
  },
  methods: {
    handleFileUploadChange() {
      if (this.fileLitigationData.length !== 0) {
        this.formData.step3.litigation_file = this.fileLitigationData
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
        this.fileLitigationData = [...this.fileLitigationData, file]
      }
      return false
      // return isJpgOrPng && isLt2M
    },
    handleRemove(file) {
      const index = this.fileLitigationData.indexOf(file)
      const newFileList = this.fileLitigationData.slice()
      newFileList.splice(index, 1)
      this.fileLitigationData = newFileList
    },
  },
}
</script>
