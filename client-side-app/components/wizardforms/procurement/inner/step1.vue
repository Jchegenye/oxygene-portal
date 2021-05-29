<template>
  <span>
    <!-- row 4 -->
    <a-row>
      <hr />
      <a-col :span="24">
        <h4 class="mt-2">Directors contacts</h4>
        <p class="text-danger">
          Please make sure you fill in all the fields for director(s) contacts.
        </p>
        <a-button
          type="danger"
          icon="plus"
          size="small"
          class="mb-2"
          :disabled="formData.step1.list.length < 6 ? false : true"
          @click="addDraggbleItems"
          >Add
        </a-button>
        <a-form-model-item class="mb-0">
          <draggable tag="a-row" :list="formData.step1.list" handle=".handle">
            <a-col
              v-for="(element, idx) in formData.step1.list"
              :key="idx"
              :span="24"
              class="row-underline"
            >
              <a-col v-if="idx != 0" :span="24"><hr /></a-col>

              <a-col :xs="24" :sm="24" :md="24" :lg="2" :xl="2">
                <span class="text">{{ element.name }} </span>
              </a-col>

              <a-col :xs="24" :sm="24" :md="24" :lg="21" :xl="21">
                <a-col :xs="24" :sm="24" :md="24" :lg="8" :xl="8">
                  <a-form-model-item
                    :help="validationErrors ? validationErrors.step1 : ''"
                    :validate-status="error.status"
                    prop="step1.director_name"
                    has-feedback
                    class="mb-0"
                    label="Full Names"
                    :style="{ width: 'calc(100% - 12px)' }"
                  >
                    <a-input v-model="element.director_name">
                      <a-icon
                        slot="prefix"
                        style="color: rgba(0, 0, 0, 0.25)"
                        type="file"
                      />
                    </a-input>
                  </a-form-model-item>
                  <a-form-model-item
                    :help="validationErrors ? validationErrors.step1 : ''"
                    :validate-status="error.status"
                    prop="step1.director_nationality"
                    has-feedback
                    class="mb-0"
                    label="Nationality"
                    :style="{ width: 'calc(100% - 12px)' }"
                  >
                    <a-select
                      v-model="element.director_nationality"
                      show-search
                      option-filter-prop="children"
                      :filter-option="filterNationalities"
                    >
                      <a-select-option
                        v-for="(nationality, index) in nationalities"
                        :key="index"
                        :value="nationality"
                      >
                        {{ nationality }}
                      </a-select-option>
                    </a-select>
                  </a-form-model-item>
                </a-col>
                <a-col :xs="24" :sm="24" :md="24" :lg="8" :xl="8">
                  <a-form-model-item
                    :help="validationErrors ? validationErrors.step1 : ''"
                    :validate-status="error.status"
                    prop="step1.director_email"
                    has-feedback
                    class="mb-0"
                    label="Email Address"
                    :style="{ width: 'calc(100% - 12px)' }"
                  >
                    <a-input v-model="element.director_email" type="email">
                      <a-icon
                        slot="prefix"
                        style="color: rgba(0, 0, 0, 0.25)"
                        type="red-envelope"
                      />
                    </a-input>
                  </a-form-model-item>
                  <a-form-model-item
                    :help="validationErrors ? validationErrors.step1 : ''"
                    :validate-status="error.status"
                    prop="step1.director_postal_address"
                    has-feedback
                    class="mb-0"
                    label="Postal Address"
                    :style="{ width: 'calc(100% - 12px)' }"
                  >
                    <a-textarea
                      v-model="element.director_postal_address"
                      :rows="2"
                    />
                  </a-form-model-item>
                </a-col>
                <a-col :xs="24" :sm="24" :md="24" :lg="8" :xl="8">
                  <a-form-model-item
                    :help="validationErrors ? validationErrors.step1 : ''"
                    :validate-status="error.status"
                    prop="step1.director_id_no"
                    has-feedback
                    class="mb-0"
                    label="ID/Passport No."
                    :style="{ width: 'calc(100% - 12px)' }"
                  >
                    <a-input-number
                      v-model="element.director_id_no"
                      :min="1"
                      class="w-100"
                    />
                  </a-form-model-item>
                  <a-form-model-item
                    :help="validationErrors ? validationErrors.step1 : ''"
                    :validate-status="error.status"
                    prop="step1.list.director_per_shareholder"
                    has-feedback
                    class="mb-0"
                    label="Percentage shareholding (%)"
                    :style="{ width: 'calc(100% - 12px)' }"
                  >
                    <a-input-number
                      v-model="element.director_per_shareholder"
                      :default-value="100"
                      :min="1"
                      :max="100"
                      :formatter="(value) => `${value}%`"
                      :parser="(value) => value.replace('%', '')"
                      class="w-100"
                    />
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

    <a-row
      ><a-col :span="24">
        <hr />
        <!-- validate_array -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          prop="step1.validate_array"
          class="mb-0 mt-4"
          @click="onChecked"
        >
          <a-checkbox
            v-model="formData.step1.validate_array"
            :checked="checked"
            class="d-flex"
            @change="onChecked"
          >
            <span class="d-block text-danger" style="line-height: normal">
              Please verify all the fields above are not empty and that all your
              information is correct.
            </span>
          </a-checkbox>
        </a-form-model-item>
      </a-col></a-row
    >
  </span>
</template>
<script>
import draggable from 'vuedraggable'
export default {
  components: {
    draggable,
  },
  props: {
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
    current: {
      type: [Number],
      required: true,
    },
    currentinnerstep: {
      type: [Number],
      required: true,
    },
  },
  data() {
    return {
      checked: false,
      formData: this.ruleForm,
      currentInnerStep: this.currentinnerstep,
    }
  },
  computed: {
    draggingInfo() {
      return this.dragging ? 'under drag' : ''
    },
    nationalities() {
      return this.$store.state.nationalities.list
    },
  },
  created() {
    if (this.$store.state.nationalities.list.length === 0) {
      this.$store.dispatch('nationalities/fetchNationalities')
    }
  },
  methods: {
    removeAt(idx) {
      this.formData.step1.list.splice(idx, 1)
    },
    addDraggbleItems() {
      let id = this.formData.step1.list.length
      id++
      this.formData.step1.list.push({
        name: 'Director ' + id,
        id,
        director_per_shareholder: '',
        director_nationality: '',
        director_postal_address: '',
        director_id_no: '',
        director_email: '',
        director_name: '',
      })
    },
    filterNationalities(input, option) {
      return option.componentOptions.children[0].text
        .toLowerCase()
        .includes(input.toLowerCase())
    },
    onChecked(e) {
      this.checked = e.target.checked
    },
  },
}
</script>
