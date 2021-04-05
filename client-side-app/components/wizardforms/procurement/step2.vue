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
        :file-list="fileList"
        :remove="handleRemove"
        :before-upload="beforeUpload"
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
    fileList: {
      type: [Array],
      required: true,
    },
    handleRemove: {
      type: [Function],
      required: true,
    },
    beforeUpload: {
      type: [Function],
      required: true,
    },
    handleFileUploadChange: {
      type: [Function],
      required: true,
    },
  },
  data() {
    return { formData: this.ruleForm }
  },
  methods: {},
}
</script>
