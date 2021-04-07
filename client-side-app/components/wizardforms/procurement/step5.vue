<template>
  <div>
    <!-- signed_sealed -->
    <a-form-model-item
      :help="validationErrors ? validationErrors.step6 : ''"
      :validate-status="error.status"
      v-bind="formItemLayout"
      prop="step6.signed_sealed"
      has-feedback
      :style="{ width: 'calc(50% - 12px)' }"
      label="Signed and Sealed: "
      class="mb-0"
    >
      <a-input v-model="formData.step6.signed_sealed" autocomplete="off">
        <a-icon slot="prefix" type="file" style="color: rgba(0, 0, 0, 0.25)" />
      </a-input>
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
        show-time
        :disabled-date="disabledDate"
        type="date"
        placeholder="Pick a date"
        style="width: 100%"
      />
    </a-form-model-item>

    <!-- acknowledge -->
    <a-form-model-item>
      <a-form-model-item
        :help="validationErrors ? validationErrors.step6 : ''"
        :validate-status="error.status"
        label=""
        prop="step6.acknowledge"
        class="mb-0"
      >
        <a-checkbox-group v-model="formData.step6.acknowledge">
          <a-checkbox name="type" value="0">
            I/We declare that to the best of my/our knowledge the answers
            submitted in this form and any supporting documentation attached
            herewith are correct and can be substantiated if requested to do so.
            I/We understand that any misrepresentations will be regarded as
            fraudulent with intention to commit a fraudulent act against Oxygene
            Limited. Such misrepresentation shall form grounds for termination
            of the qualification process and/or blacklisting from Oxygene
            suppliers register or an application of any legal means to safeguard
            Oxygene interests. I/We further hereby give Limited or its Agents
            authority to seek any references it may deem fit to carry out the
            evaluation.
          </a-checkbox>
        </a-checkbox-group>
      </a-form-model-item>
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
    return { formData: this.ruleForm }
  },
  methods: {
    disabledDate(current) {
      // Can not select days before today and today
      return current && current < this.$moment().endOf('day')
    },
  },
}
</script>
