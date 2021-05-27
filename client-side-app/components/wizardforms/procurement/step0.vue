<template>
  <div>
    <a-steps :current="currentInnerStep">
      <a-step
        v-for="(item, index) in stepsInner"
        :key="index"
        :title="item.title"
      />
    </a-steps>
    <div class="steps-content">
      <Component
        :is="innerStepFormComponent"
        :current="current"
        :currentinnerstep="currentInnerStep"
        :error="error"
        :rule-form="ruleForm"
        :form-item-layout="formItemLayout"
        :validation-errors="validationErrors"
      ></Component>
    </div>
    <div class="steps-action mt-3">
      <a-button
        v-if="currentInnerStep < stepsInner.length - 1"
        html-type="submit"
        type="primary"
        size="small"
        @click="nextStepsParent('ruleForm', true)"
      >
        Next
      </a-button>
      <a-button
        v-if="currentInnerStep == stepsInner.length - 1"
        html-type="submit"
        size="small"
        type="primary"
        @click="nextStepsParent('ruleForm')"
      >
        Continue
      </a-button>
      <a-button
        v-if="currentInnerStep > 0"
        style="margin-left: 8px"
        size="small"
        @click="prevInnerSteps(true)"
      >
        Previous
      </a-button>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    next: {
      type: Function,
      required: true,
    },
    prev: {
      type: Function,
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
      formData: this.ruleForm,
      currentInnerStep: this.currentinnerstep,
      certofChangeofNameData: [],
      certofRegistration: [],
      stepsInner: [
        {
          title: '',
          content: 'First-content',
        },
        {
          title: '',
          content: 'Second-content',
        },
        {
          title: '',
          content: 'Last-content',
        },
      ],
    }
  },
  computed: {
    innerStepFormComponent() {
      return 'ProcurementInnerStep' + this.currentInnerStep
    },
  },
  watch: {
    // watch form current inner steps
    currentinnerstep() {
      this.currentInnerStep = this.currentinnerstep
    },
  },
  methods: {
    prevInnerSteps(innerSelect) {
      this.prev(innerSelect)
    },
    nextStepsParent(formName, innerSelect) {
      this.next(formName, innerSelect)
    },
  },
}
</script>
