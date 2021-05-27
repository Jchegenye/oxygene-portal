<template>
  <div>
    <h4 class="text-bold">DATA PROTECTION STATEMENT</h4>
    <p>
      Oxygène recognises and agrees that all data collected or received in the
      course of receiving goods and Services including but not limited to the
      names, addresses, telephone numbers, and any other data collected is the
      property and confidential information of the Supplier and shall not use
      the same otherwise other than as for the purpose outlined in this
      Agreement. Oxygène is guided by the Kenya Data Protection Act (2019) which
      it has adopted and incorporated into its Data Protection Policy, 2021. The
      policy which expounds the Company’s processing and management of data
      shall availed to the Supplier during contracting.
    </p>
    <!-- acknowledge -->
    <a-form-model-item
      :help="validationErrors ? validationErrors.step5 : ''"
      :validate-status="error.status"
      prop="step5.acknowledge"
      class="mb-0 mt-4"
      @click="onChecked"
    >
      <a-checkbox
        v-model="formData.step5.acknowledge"
        :checked="checked"
        class="d-flex"
        @change="onChecked"
      >
        <span class="d-block" style="line-height: normal">
          I/We acknowledge.
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
    }
  },
  methods: {
    onChecked(e) {
      this.checked = e.target.checked
    },
  },
}
</script>
