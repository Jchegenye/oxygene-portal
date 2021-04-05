<template>
  <div>
    <!-- Full Name of Organization -->
    <a-form-model-item
      prop="step1.full_name_organization"
      :help="validationErrors ? validationErrors.step1 : ''"
      :validate-status="error.status"
      v-bind="formItemLayout"
      has-feedback
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
      label="Physical Address/Principal Place of Business State plot No."
      class="mb-2"
    >
      <a-textarea v-model="formData.step1.physical_address" :rows="4" />
    </a-form-model-item>
  </div>
</template>
<script>
// import draggable from 'vuedraggable'
export default {
  // components: {
  //   draggable,
  // },
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
    dragging: {
      type: [Boolean],
      required: true,
    },
  },
  data() {
    return {
      formData: this.ruleForm,
    }
  },
  computed: {
    draggingInfo() {
      return this.dragging ? 'under drag' : ''
    },
  },
  methods: {
    removeAt(idx) {
      this.formData.list.splice(idx, 1)
    },
    addDraggbleItems() {
      let id = this.formData.list.length
      id++
      this.formData.list.push({
        name: 'Director ' + id,
        id,
        director_per_shareholder: '',
        director_nationality: '',
        director_id_no: '',
        director_email: '',
        director_name: '',
      })
    },
    handleChange(info) {
      const status = info.file.status
      if (status !== 'uploading') {
        console.log(info.file, info.fileList)
      }
      if (status === 'done') {
        this.$message.success(`${info.file.name} file uploaded successfully.`)
      } else if (status === 'error') {
        this.$message.error(`${info.file.name} file upload failed.`)
      }
    },
  },
}
</script>
