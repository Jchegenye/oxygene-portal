<template>
  <div>
    <h4>Your Bank References</h4>
    <!-- row 1 -->
    <a-row>
      <a-col :span="8">
        <!-- bank_name -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step2 : ''"
          :validate-status="error.status"
          prop="step2.bank_references.bank_name"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          class="mb-0"
          label="Bank name"
        >
          <a-input v-model="formData.step2.bank_references.bank_name">
            <a-icon
              slot="prefix"
              type="file"
              style="color: rgba(0, 0, 0, 0.25)"
            />
          </a-input>
        </a-form-model-item>

        <!-- branch -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step2 : ''"
          :validate-status="error.status"
          prop="step2.bank_references.branch"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          class="mb-0"
          label="Branch"
        >
          <a-input v-model="formData.step2.bank_references.branch">
            <a-icon
              slot="prefix"
              style="color: rgba(0, 0, 0, 0.25)"
              type="file"
            />
          </a-input>
        </a-form-model-item>

        <!-- ac_no -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step2 : ''"
          :validate-status="error.status"
          prop="step2.bank_references.ac_no"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          class="mb-0"
          label="A/C NO"
        >
          <a-input v-model="formData.step2.bank_references.ac_no" type="number">
            <a-icon
              slot="prefix"
              style="color: rgba(0, 0, 0, 0.25)"
              type="file"
            />
          </a-input>
        </a-form-model-item>

        <!-- name_title -->
        <a-form-model-item label="Primary contact person:">
          <a-form-model-item
            :help="validationErrors ? validationErrors.step2 : ''"
            :validate-status="error.status"
            v-bind="formItemLayout"
            prop="step2.bank_references.name_title"
            has-feedback
            :style="{ width: 'calc(100% - 12px)' }"
            class="mb-0"
            label="Name & Title"
          >
            <a-textarea
              v-model="formData.step2.bank_references.name_title"
              :rows="3"
            />
          </a-form-model-item>
        </a-form-model-item>

        <!-- email_telno -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step2 : ''"
          :validate-status="error.status"
          v-bind="formItemLayout"
          prop="step2.bank_references.email_telno"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          class="mb-0"
          label="Email/telephoneno:"
        >
          <a-textarea
            v-model="formData.step2.bank_references.email_telno"
            :rows="3"
          />
        </a-form-model-item>
      </a-col>
      <a-col :span="16">
        <h4 class="mt-2">Trade References</h4>
        <a-button
          type="danger"
          icon="plus"
          size="small"
          class="mb-2"
          :disabled="formData.step2.trade_references.length < 3 ? false : true"
          @click="addDraggbleItems"
          >Add
        </a-button>

        <!-- trade_references -->
        <a-form-model-item class="mb-0">
          <draggable
            tag="a-row"
            :trade_references="formData.step2.trade_references"
            handle=".handle"
          >
            <a-col
              v-for="(element, idx) in formData.step2.trade_references"
              :key="idx"
              class="p-0"
              :span="24"
            >
              <a-col v-if="idx != 0" :span="24"><hr /></a-col>

              <a-col :xs="24" :sm="24" :md="24" :lg="2" :xl="2">
                <span class="text">{{ element.name }} </span>
              </a-col>

              <a-col :xs="24" :sm="24" :md="24" :lg="21" :xl="21">
                <a-col :xs="24" :sm="24" :md="24" :lg="8" :xl="8">
                  <a-form-model-item
                    :help="validationErrors ? validationErrors.step2 : ''"
                    :validate-status="error.status"
                    prop="step2.trade_references.company_name_addr"
                    has-feedback
                    class="mb-0"
                    label="Company Name & Address:"
                    :style="{ width: 'calc(100% - 12px)' }"
                  >
                    <a-textarea v-model="element.company_name_addr" :rows="2" />
                  </a-form-model-item>
                  <a-form-model-item
                    :help="validationErrors ? validationErrors.step2 : ''"
                    :validate-status="error.status"
                    prop="step2.trade_references.office_telno"
                    has-feedback
                    class="mb-0"
                    label="Office Tel. No:"
                    :style="{ width: 'calc(100% - 12px)' }"
                  >
                    <a-input-number
                      v-model="element.office_telno"
                      :min="0"
                      class="w-100"
                    />
                  </a-form-model-item>
                </a-col>
                <a-col :xs="24" :sm="24" :md="24" :lg="8" :xl="8">
                  <a-form-model-item
                    :help="validationErrors ? validationErrors.step2 : ''"
                    :validate-status="error.status"
                    prop="step2.trade_references.contact_person"
                    has-feedback
                    class="mb-0"
                    label="Full Names (Contact Person)"
                    :style="{ width: 'calc(100% - 12px)' }"
                  >
                    <a-input v-model="element.contact_person">
                      <a-icon
                        slot="prefix"
                        style="color: rgba(0, 0, 0, 0.25)"
                        type="file"
                      />
                    </a-input>
                  </a-form-model-item>
                  <a-form-model-item
                    :help="validationErrors ? validationErrors.step2 : ''"
                    :validate-status="error.status"
                    prop="step2.trade_references.mobile_telno"
                    has-feedback
                    class="mb-0"
                    label="Mobile No:"
                    :style="{ width: 'calc(100% - 12px)' }"
                  >
                    <a-input-number
                      v-model="element.mobile_telno"
                      :min="0"
                      class="w-100"
                    />
                  </a-form-model-item>
                </a-col>
                <a-col :xs="24" :sm="24" :md="24" :lg="8" :xl="8">
                  <a-form-model-item
                    :help="validationErrors ? validationErrors.step2 : ''"
                    :validate-status="error.status"
                    prop="step2.trade_references.position"
                    has-feedback
                    class="mb-0"
                    label="Position:"
                    :style="{ width: 'calc(100% - 12px)' }"
                  >
                    <a-input v-model="element.position">
                      <a-icon
                        slot="prefix"
                        style="color: rgba(0, 0, 0, 0.25)"
                        type="file"
                      />
                    </a-input>
                  </a-form-model-item>
                  <a-form-model-item
                    :help="validationErrors ? validationErrors.step2 : ''"
                    :validate-status="error.status"
                    prop="step2.trade_references.email_addr"
                    has-feedback
                    class="mb-0"
                    label="Email address:"
                    :style="{ width: 'calc(100% - 12px)' }"
                  >
                    <a-input v-model="element.email_addr">
                      <a-icon
                        slot="prefix"
                        style="color: rgba(0, 0, 0, 0.25)"
                        type="file"
                      />
                    </a-input>
                  </a-form-model-item>
                </a-col>
              </a-col>

              <a-col :xs="24" :sm="24" :md="24" :lg="1" :xl="1">
                <span
                  v-if="idx != 0"
                  class="text- cursor-pointer btn btn-warning"
                  @click="removeAt(idx)"
                >
                  <a-icon slot="prefix" type="close" />
                </span>
              </a-col>
            </a-col>
          </draggable>
        </a-form-model-item>
      </a-col>
    </a-row>
  </div>
</template>
<script>
import draggable from 'vuedraggable'
export default {
  components: {
    draggable,
  },
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
      this.formData.step2.trade_references.splice(idx, 1)
    },
    addDraggbleItems() {
      let id = this.formData.step2.trade_references.length
      id++
      this.formData.step2.trade_references.push({
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
        // console.log(info.file, info.fileList)
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
