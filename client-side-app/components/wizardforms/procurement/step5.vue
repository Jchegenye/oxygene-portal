<template>
  <div>
    <!-- signed_sealed -->
    <!-- <a-form-model-item :help="validationErrors ? validationErrors.step6 : ''">
      <a-form-model-item
        help="Kindly input your initials i.e J.D"
        :validate-status="error.status"
        v-bind="formItemLayout"
        prop="step6.signed_sealed"
        has-feedback
        :style="{ width: 'calc(50% - 12px)' }"
        label="Initials: "
        class="mb-0"
      >
        <a-input v-model="formData.step6.signed_sealed" autocomplete="off">
          <a-icon
            slot="prefix"
            type="file"
            style="color: rgba(0, 0, 0, 0.25)"
          />
        </a-input>
      </a-form-model-item>
    </a-form-model-item> -->

    <!-- signature -->
    <a-form-model-item
      :help="validationErrors ? validationErrors.step6 : ''"
      :validate-status="error.status"
      prop="step6.signed_sealed"
      :style="{ width: 'calc(100% - 12px)' }"
      has-feedback
      class="mb-4"
      label="Signature"
    >
      <a-upload-dragger
        v-model="formData.step6.signed_sealed"
        :multiple="false"
        :file-list="certofChangeofNameData"
        :remove="handleRemove1"
        :before-upload="beforeUpload1"
        :disabled="certofChangeofNameData.length < 2 ? false : true"
        @change="handleFileUploadChange"
      >
        <p class="ant-upload-drag-icon">
          <a-icon type="inbox" />
        </p>
        <p class="ant-upload-text text-danger">
          Take a screenshot of your signature using your phone or using online
          tools, click or drag it to this area to upload
        </p>
        <small class="ant-upload-hint"
          >Supported file formats include png, jgp, jpeg. A maximum of 1 file
          upload.</small
        >
      </a-upload-dragger>
    </a-form-model-item>

    <!-- for_onbehalf_of -->
    <a-form-model-item
      :help="validationErrors ? validationErrors.step6 : ''"
      :validate-status="error.status"
      v-bind="formItemLayout"
      prop="step6.for_onbehalf_of"
      has-feedback
      :style="{ width: 'calc(50% - 12px)' }"
      label="For and on Behalf of "
      class="mb-0"
    >
      <a-input v-model="formData.step6.for_onbehalf_of" autocomplete="off">
        <a-icon slot="prefix" type="file" style="color: rgba(0, 0, 0, 0.25)" />
      </a-input>
    </a-form-model-item>

    <!-- position_in -->
    <a-form-model-item
      :help="validationErrors ? validationErrors.step6 : ''"
      :validate-status="error.status"
      v-bind="formItemLayout"
      prop="step6.position_in"
      has-feedback
      :style="{ width: 'calc(50% - 12px)' }"
      label="Position in "
      class="mb-0"
    >
      <a-input v-model="formData.step6.position_in" autocomplete="off">
        <a-icon slot="prefix" type="file" style="color: rgba(0, 0, 0, 0.25)" />
      </a-input>
    </a-form-model-item>

    <!-- company -->
    <a-form-model-item
      :help="validationErrors ? validationErrors.step6 : ''"
      :validate-status="error.status"
      v-bind="formItemLayout"
      prop="step6.company"
      has-feedback
      :style="{ width: 'calc(50% - 12px)' }"
      label="Company"
      class="mb-0"
    >
      <a-input v-model="formData.step6.company" autocomplete="off">
        <a-icon slot="prefix" type="file" style="color: rgba(0, 0, 0, 0.25)" />
      </a-input>
    </a-form-model-item>

    <!-- date -->
    <a-form-model-item
      :help="validationErrors ? validationErrors.step6 : ''"
      :validate-status="error.status"
      v-bind="formItemLayout"
      prop="step6.date"
      has-feedback
      :style="{ width: 'calc(50% - 12px)' }"
      label="Date"
      class="mb-0"
    >
      <a-date-picker
        v-model="formData.step6.date"
        type="date"
        placeholder="Pick a date"
        style="width: 100%"
        :disabled-date="disabledDate"
      />
    </a-form-model-item>

    <!-- acknowledge -->
    <a-form-model-item
      :help="validationErrors ? validationErrors.step6 : ''"
      :validate-status="error.status"
      prop="step6.acknowledge"
      class="mb-0 mt-4"
      @click="onChecked"
    >
      <a-checkbox
        v-model="formData.step6.acknowledge"
        :checked="checked"
        class="d-flex"
        @change="onChecked"
      >
        <span class="d-block" style="line-height: normal">
          I/We declare that to the best of my/our knowledge the answers
          submitted in this form and any supporting documentation attached
          herewith are correct and can be substantiated if requested to do so.
          I/We understand that any misrepresentations will be regarded as
          fraudulent with intention to commit a fraudulent act against Oxygene
          Limited. Such misrepresentation shall form grounds for termination of
          the qualification process and/or blacklisting from Oxygene suppliers
          register or an application of any legal means to safeguard Oxygene
          interests. I/We further hereby give Limited or its Agents authority to
          seek any references it may deem fit to carry out the evaluation.
        </span>
      </a-checkbox>
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
  },
  data() {
    return {
      checked: false,
      formData: this.ruleForm,
      certofChangeofNameData: [],
    }
  },
  watch: {
    //
    certofChangeofNameData() {
      if (this.certofChangeofNameData.length !== 0) {
        this.formData.step6.signed_sealed = this.certofChangeofNameData
      } else {
        this.formData.step6.signed_sealed = this.certofChangeofNameData
      }
    },
  },
  created() {
    if (this.formData.step6.signed_sealed !== '') {
      this.certofChangeofNameData = this.formData.step6.signed_sealed
    }
  },
  methods: {
    handleFileUploadChange() {
      if (this.certofChangeofNameData.length !== 0) {
        this.formData.step6.signed_sealed = this.certofChangeofNameData
      }
    },
    beforeUpload1(file) {
      const isJpgOrPng =
        file.type === 'image/jpeg' ||
        file.type === 'image/jpg' ||
        file.type === 'image/png'

      const isLt2M = file.size / 1024 / 1024 < 2

      if (!isJpgOrPng) {
        this.$notification.error({
          message: 'File Upload',
          description: 'Sorry that file type is NOT accepted!',
          placement: 'bottomLeft',
          duration: 5,
        })
      } else if (!isLt2M) {
        this.$notification.warning({
          message: 'File Upload',
          description: 'Image must smaller than 2MB!',
          placement: 'bottomLeft',
          duration: 5,
        })
      } else {
        this.certofChangeofNameData = [...this.certofChangeofNameData, file]
      }
      return false
      // return isJpgOrPng && isLt2M
    },
    handleRemove1(file) {
      // 1
      const index = this.certofChangeofNameData.indexOf(file)
      const newFileList = this.certofChangeofNameData.slice()
      newFileList.splice(index, 1)
      this.certofChangeofNameData = newFileList
    },
    disabledDate(current) {
      // Can not select days before today
      return (
        current && current - 1 < this.$moment().endOf('day').subtract(1, 'days')
      )
    },
    onChecked(e) {
      this.checked = e.target.checked
    },
  },
}
</script>
