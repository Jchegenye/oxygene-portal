<template>
  <div>
    <h4>Your Bank References</h4>
    <a-form-model-item
      :help="validationErrors ? validationErrors.step2 : ''"
      :validate-status="error.status"
      prop="step2.bank_references.bank_name"
      has-feedback
      :style="{ width: 'calc(50% - 12px)' }"
      class="mb-0"
    >
      <a-input
        v-model="formData.step2.bank_references.bank_name"
        placeholder="Bank name."
        autocomplete="off"
      >
        <a-icon slot="prefix" type="" style="color: rgba(0, 0, 0, 0.25)" />
      </a-input>
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
    return { formData: this.ruleForm }
  },
  computed: {
    draggingInfo() {
      return this.dragging ? 'under drag' : ''
    },
    // getValidationErrorsWithArray() {
    //   return this.ruleForm.bank_references
    // },
  },
  methods: {
    removeAt(idx) {
      this.formData.trade_references.splice(idx, 1)
    },
    addDraggbleItems() {
      let id = this.formData.trade_references.length
      id++
      this.formData.trade_references.push({
        name: 'Reference ' + id,
        id,
        company_name_addr: '',
        contact_person: '',
        position: '',
        office_telno: '',
        mobile_telno: '',
        email_addr: '',
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
