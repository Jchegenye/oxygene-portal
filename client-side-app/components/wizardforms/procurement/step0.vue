<template>
  <div>
    <!-- row 1 -->
    <a-row>
      <a-col :span="24">
        <!-- Full Name of Organization -->
        <a-form-model-item
          prop="step1.full_name_organization"
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          v-bind="formItemLayout"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
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
          :style="{ width: 'calc(100% - 12px)' }"
          label="Physical Address/Principal Place of Business State plot No."
          class="mb-2"
        >
          <a-textarea v-model="formData.step1.physical_address" :rows="4" />
        </a-form-model-item>
      </a-col>
    </a-row>

    <!-- row 2 -->
    <a-row>
      <a-col :span="6">
        <!-- Postal Address -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          prop="step1.postal_address"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          label="Postal Address"
          class="mb-0"
        >
          <a-textarea v-model="formData.step1.postal_address" :rows="3" />
        </a-form-model-item>
      </a-col>
      <a-col :span="10">
        <!-- Telephone Number -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          prop="step1.telephone_number"
          v-bind="formItemLayout"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          class="mb-0"
          label="Telephone Number *"
        >
          <a-input
            v-model="formData.step1.telephone_number"
            type="number"
            min="0"
            autocomplete="off"
          >
            <a-icon
              slot="prefix"
              type="number"
              style="color: rgba(0, 0, 0, 0.25)"
            />
          </a-input>
        </a-form-model-item>
        <!-- KRA PIN No -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          prop="step1.kra_pin_no"
          v-bind="formItemLayout"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          class="mb-0"
          label="KRA PIN No. *"
        >
          <a-input v-model="formData.step1.kra_pin_no" autocomplete="off">
            <a-icon
              slot="prefix"
              type="file"
              style="color: rgba(0, 0, 0, 0.25)"
            />
          </a-input>
        </a-form-model-item>
        <!-- company_registration_no -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          prop="step1.company_registration_no"
          v-bind="formItemLayout"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          label="Company registration number"
          class="mb-0"
        >
          <a-input v-model="formData.step1.company_registration_no" />
        </a-form-model-item>
      </a-col>
      <a-col :span="8">
        <!-- company_email_address -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.company_email_address : ''"
          :validate-status="error.status"
          prop="company_email_address"
          has-feedback
          :style="{ width: 'calc(100% - 12px)' }"
          class="mb-0"
          label="Company E-Mail Address *"
          description="NOTE: We will use this email to communicate back to you."
        >
          <a-input
            v-model="formData.company_email_address"
            type="email"
            autocomplete="off"
          >
            <a-icon
              slot="prefix"
              type="red-envelope"
              style="color: rgba(0, 0, 0, 0.25)"
            />
          </a-input>
        </a-form-model-item>
      </a-col>
    </a-row>

    <a-row
      ><a-col :span="24"><hr /></a-col
    ></a-row>

    <!-- row 3 -->
    <a-row>
      <a-col :span="12">
        <!-- Contact for finance department(email, Name and Tel no:) * -->
        <a-form-model-item>
          <div
            class="mt-4 d-block ant-col ant-form-item-label"
            style="line-height: normal; text-align: center"
          >
            <label>
              Contact for finance department(email, Name and Tel no:) *
            </label>
          </div>
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.finance_dept_name"
            v-bind="formItemLayout"
            has-feedback
            :style="{ width: 'calc(100% - 12px)' }"
            class="mb-0"
            label="Name"
          >
            <a-input
              v-model="formData.step1.finance_dept_name"
              placeholder="Name"
              autocomplete="off"
            >
              <a-icon
                slot="prefix"
                type="file"
                style="color: rgba(0, 0, 0, 0.25)"
              />
            </a-input>
          </a-form-model-item>
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.finance_dept_email"
            has-feedback
            v-bind="formItemLayout"
            :style="{ width: 'calc(100% - 12px)' }"
            class="mb-0"
            label="Email"
          >
            <a-input
              v-model="formData.step1.finance_dept_email"
              placeholder="Email"
              type="email"
              autocomplete="off"
            >
              <a-icon
                slot="prefix"
                type="red-envelope"
                style="color: rgba(0, 0, 0, 0.25)"
              />
            </a-input>
          </a-form-model-item>
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.finance_dept_telno"
            has-feedback
            v-bind="formItemLayout"
            :style="{ width: 'calc(100% - 12px)' }"
            class="mb-0"
            label="Tel no:"
          >
            <a-input
              v-model="formData.step1.finance_dept_telno"
              placeholder="Tel no"
              type="number"
              min="0"
              autocomplete="off"
            >
              <a-icon
                slot="prefix"
                type="number"
                style="color: rgba(0, 0, 0, 0.25)"
              />
            </a-input>
          </a-form-model-item>
        </a-form-model-item>
      </a-col>
      <a-col :span="12">
        <!-- Legal Entity: (a) Sole proprietor (b) Corporation (c) Partnership (d) Other  && Web Sites Address (if any) -->
        <a-form-model-item
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          label="Legal Entity:"
          prop="step1.legal_entity"
          class="mb-0"
        >
          <a-radio-group v-model="formData.step1.legal_entity">
            <a-radio value="Sole Proprietor" :checked="true">
              Sole proprietor
            </a-radio>
            <a-radio value="Corporation"> Corporation </a-radio>
            <a-radio value="Partnership"> Partnership </a-radio>
            <a-radio value="other"> Other </a-radio>
          </a-radio-group>
        </a-form-model-item>
        <a-form-model-item
          :help="validationErrors ? validationErrors.step1 : ''"
          :validate-status="error.status"
          prop="step1.legal_entity_other"
          has-feedback
          class="mb-0"
          label="Other Description"
          :hidden="formData.step1.legal_entity === 'other' ? false : true"
        >
          <a-input
            v-model="formData.step1.legal_entity_other"
            type="textarea"
            autocomplete="off"
          >
            <a-icon
              slot="prefix"
              type="file"
              style="color: rgba(0, 0, 0, 0.25)"
            />
          </a-input>
        </a-form-model-item>
        <!-- Web Sites Address (if any) -->
        <a-form-model-item
          prop="step1.web_site_address"
          class="mb-0"
          label="Web Sites Address (if any)"
          ><a-auto-complete
            v-model="formData.step1.web_site_address"
            addon-before="Http://"
            @change="handleWebsiteChange"
          >
            <template slot="dataSource">
              <a-select-option
                v-for="website in autoCompleteResult"
                :key="website"
              >
                {{ website }}
              </a-select-option>
            </template>
            <a-input />
          </a-auto-complete>
          <!-- <a-input v-model="formData.step1.web_site_address" addon-before="Http://" /> -->
        </a-form-model-item>
      </a-col>
    </a-row>

    <!-- row 4 -->
    <a-row>
      <hr />
      <a-col :span="24">
        <h4 class="mt-2">Directors contacts</h4>
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
          <table id="mytable" class="table table-border items mt-0">
            <draggable tag="tbody" :list="formData.step1.list" handle=".handle">
              <tr
                v-for="(element, idx) in formData.step1.list"
                :key="idx"
                class="p-0"
              >
                <!-- <td scope="row" class="drag-columns">
                  <a-icon type="pic-left" />
                </td> -->

                <td>
                  <span class="text">{{ element.name }} </span>
                </td>

                <td class="p-0">
                  <tr>
                    <td class="" style="width: 45%">
                      <a-form-model-item
                        :help="validationErrors ? validationErrors.step1 : ''"
                        :validate-status="error.status"
                        prop="step1.director_name"
                        has-feedback
                        class="mb-0"
                      >
                        <a-input
                          v-model="element.director_name"
                          placeholder="Name"
                          autocomplete="off"
                        >
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
                      >
                        <a-input
                          v-model="element.director_nationality"
                          placeholder="Nationality"
                          min="0"
                          autocomplete="off"
                        >
                          <a-icon
                            slot="prefix"
                            style="color: rgba(0, 0, 0, 0.25)"
                            type="flag"
                          />
                        </a-input>
                      </a-form-model-item>
                    </td>
                    <td class="" style="width: 30%">
                      <a-form-model-item
                        :help="validationErrors ? validationErrors.step1 : ''"
                        :validate-status="error.status"
                        prop="step1.director_email"
                        has-feedback
                        class="mb-0"
                      >
                        <a-input
                          v-model="element.director_email"
                          placeholder="Email"
                          type="email"
                          autocomplete="off"
                        >
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
                      >
                        <a-textarea
                          v-model="element.director_postal_address"
                          placeholder="Postal Address"
                          :rows="3"
                        />
                      </a-form-model-item>
                    </td>
                    <td>
                      <a-form-model-item
                        :help="validationErrors ? validationErrors.step1 : ''"
                        :validate-status="error.status"
                        prop="step1.director_id_no"
                        has-feedback
                        class="mb-0"
                      >
                        <a-input
                          v-model="element.director_id_no"
                          placeholder="Identification No."
                          type="number"
                          min="0"
                          autocomplete="off"
                        >
                          <a-icon
                            slot="prefix"
                            style="color: rgba(0, 0, 0, 0.25)"
                            type="number"
                          />
                        </a-input>
                      </a-form-model-item>
                      <a-form-model-item
                        :help="validationErrors ? validationErrors.step1 : ''"
                        :validate-status="error.status"
                        prop="step1.list.director_per_shareholder"
                        has-feedback
                        class="mb-0"
                        label="Maximum shareholding percentage upto 100"
                      >
                        <a-input
                          v-model="element.director_per_shareholder"
                          placeholder="Percentage shareholding (%)"
                          min="1"
                          max="100"
                          type="number"
                        >
                          <a-icon
                            slot="prefix"
                            style="color: rgba(0, 0, 0, 0.25)"
                            type="percentage"
                          />
                        </a-input>
                      </a-form-model-item>
                    </td>
                  </tr>
                </td>

                <td>
                  <span
                    v-if="idx != 0"
                    class="text-danger"
                    @click="removeAt(idx)"
                  >
                    <a-icon slot="prefix" type="close" />
                  </span>
                </td>
              </tr>
            </draggable>
          </table>
        </a-form-model-item>
      </a-col>
    </a-row>

    <a-row
      ><a-col :span="24"><hr /></a-col
    ></a-row>

    <!-- row 5 -->
    <a-row>
      <a-col :span="8">
        <a-form-model-item class="question-box">
          <!-- company_name_change -->
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            label="Have you changed your company name over the last 10 years?"
            prop="step1.company_name_change"
            class="mb-0"
          >
            <a-radio-group v-model="formData.step1.company_name_change">
              <a-radio value="yes"> Yes </a-radio>
              <a-radio value="no"> No </a-radio>
            </a-radio-group>
          </a-form-model-item>
          <!-- cert_of_changeofname -->
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.cert_of_changeofname"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Attach certificate of change of name"
            :hidden="
              formData.step1.company_name_change === 'yes' ? false : true
            "
          >
            <a-upload-dragger
              v-model="formData.step1.cert_of_changeofname"
              :multiple="true"
              :file-list="certofChangeofNameData"
              :remove="handleRemove1"
              :before-upload="beforeUpload1"
              :disabled="certofChangeofNameData.length < 2 ? false : true"
              @change="handleFileUploadChange"
            >
              <p class="ant-upload-drag-icon">
                <a-icon type="inbox" />
              </p>
              <p class="ant-upload-text">
                Click or drag file to this area to upload
              </p>
              <p class="ant-upload-hint">Support for a single upload.</p>
            </a-upload-dragger>
          </a-form-model-item>
          <!-- reason_of_namechange -->
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.reason_of_namechange"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Provide clear details outlining reasons and purpose of name change"
            :hidden="
              formData.step1.company_name_change === 'yes' ? false : true
            "
          >
            <a-textarea
              v-model="formData.step1.reason_of_namechange"
              :rows="3"
            />
          </a-form-model-item>
        </a-form-model-item>
      </a-col>
      <a-col :span="8">
        <!-- company_directors -->
        <a-form-model-item class="question-box">
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            label="Have you changed your company Directors or ownership in the last 10 years?"
            prop="step1.company_directors"
            class="mb-0"
          >
            <a-radio-group v-model="formData.step1.company_directors">
              <a-radio value="yes"> Yes </a-radio>
              <a-radio value="no"> No </a-radio>
            </a-radio-group>
          </a-form-model-item>
          <!-- cert_of_registration -->
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.cert_of_registration"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Attach certificate of registration and/or latest annual returns"
            :hidden="formData.step1.company_directors === 'yes' ? false : true"
          >
            <a-upload-dragger
              v-model="formData.step1.cert_of_registration"
              :multiple="true"
              :file-list="certofRegistration"
              :remove="handleRemove2"
              :before-upload="beforeUpload2"
              :disabled="certofRegistration.length < 2 ? false : true"
              @change="handleFileUploadChange"
            >
              <p class="ant-upload-drag-icon">
                <a-icon type="inbox" />
              </p>
              <p class="ant-upload-text">
                Click or drag file to this area to upload
              </p>
              <p class="ant-upload-hint">Support for a single upload.</p>
            </a-upload-dragger>
          </a-form-model-item>
          <!-- reason_of_directorschange -->
          <a-form-model-item
            :help="
              validationErrors ? validationErrors.reason_of_directorschange : ''
            "
            :validate-status="error.status"
            prop="step1.reason_of_directorschange"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Provide clear details outlining reasons and purpose of change of Directors"
            :hidden="formData.step1.company_directors === 'yes' ? false : true"
          >
            <a-textarea
              v-model="formData.step1.reason_of_directorschange"
              :rows="3"
            />
          </a-form-model-item>
        </a-form-model-item>
      </a-col>
      <a-col :span="8">
        <!-- business_period -->
        <a-form-model-item class="question-box">
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.business_period"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Period in which you have been in business for which you wish to supply us with goods/services"
          >
            <a-input
              v-model="formData.step1.business_period"
              autocomplete="off"
            >
              <a-icon
                slot="prefix"
                type="file"
                style="color: rgba(0, 0, 0, 0.25)"
              />
            </a-input>
          </a-form-model-item>
        </a-form-model-item>
      </a-col>
    </a-row>

    <!-- row 5 -->
    <a-row>
      <a-col :span="8">
        <a-form-model-item class="question-box">
          <!-- has_oxygene_employee -->
          <a-form-model-item
            :help="
              validationErrors ? validationErrors.has_oxygene_employee : ''
            "
            :validate-status="error.status"
            label="Are any of the Directors, Partners, Shareholders or employees, employed by or have relatives who are currently employed by Oxygene Limited?"
            prop="step1.has_oxygene_employee"
            class="mb-0"
          >
            <a-radio-group v-model="formData.step1.has_oxygene_employee">
              <a-radio value="yes"> Yes </a-radio>
              <a-radio value="no"> No </a-radio>
            </a-radio-group>
          </a-form-model-item>
          <!--  name_position -->
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.name_position"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Declare name and position"
            :hidden="
              formData.step1.has_oxygene_employee === 'yes' ? false : true
            "
          >
            <a-textarea v-model="formData.step1.name_position" :rows="4" />
          </a-form-model-item>
        </a-form-model-item>
      </a-col>
      <a-col :span="8">
        <a-form-model-item class="question-box">
          <!-- has_interest_employee -->
          <a-form-model-item
            :help="
              validationErrors ? validationErrors.has_interest_employee : ''
            "
            :validate-status="error.status"
            label="Do any of the Directors, Partners, Shareholders or employees have any other interest (other than what you are seeking to supply) with persons currently employed by Oxygene Limited or other suppliers, partners or Directors of Oxygene Limited?"
            prop="step1.has_interest_employee"
            class="mb-0"
          >
            <a-radio-group
              v-model="formData.step1.has_interest_employee"
              :style="{ width: 'calc(100% - 12px)' }"
            >
              <a-radio value="yes"> Yes </a-radio>
              <a-radio value="no"> No </a-radio>
            </a-radio-group>
          </a-form-model-item>
          <!-- details_of_interest  -->
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.details_of_interest"
            :style="{ width: 'calc(100% - 12px)' }"
            has-feedback
            class="mb-0"
            label="Provide full details of interest "
            :hidden="
              formData.step1.has_interest_employee === 'yes' ? false : true
            "
          >
            <a-textarea
              v-model="formData.step1.details_of_interest"
              :rows="4"
            />
          </a-form-model-item>
        </a-form-model-item>
      </a-col>
      <a-col :span="8">
        <a-form-model-item class="question-box">
          <div class="ant-col ant-form-item-label">
            <label>
              Contact persons within your Organization to whom enquiries about
              this application should be directed. (Provide two contact names)
            </label>
          </div>
          <!-- contact_person_name -->
          <a-form-model-item
            :help="validationErrors ? validationErrors.step1 : ''"
            :validate-status="error.status"
            prop="step1.contact_person_name"
            has-feedback
            class="mb-0"
            label="Names (full names):"
          >
            <a-textarea
              v-model="formData.step1.contact_person_name"
              :rows="4"
            />
          </a-form-model-item>
          <!-- contact_person_title -->
          <a-form-model-item
            :help="
              validationErrors ? validationErrors.contact_person_title : ''
            "
            :validate-status="error.status"
            prop="step1.contact_person_title"
            has-feedback
            class="mb-0"
            label="Title:"
          >
            <a-textarea
              v-model="formData.step1.contact_person_title"
              :rows="4"
            />
          </a-form-model-item>
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
      autoCompleteResult: [],
      certofChangeofNameData: [],
      certofRegistration: [],
    }
  },
  computed: {
    draggingInfo() {
      return this.dragging ? 'under drag' : ''
    },
  },
  watch: {
    //
    certofChangeofNameData() {
      if (this.certofChangeofNameData.length !== 0) {
        this.formData.step1.cert_of_changeofname = this.certofChangeofNameData
      } else {
        this.formData.step1.cert_of_changeofname = this.certofChangeofNameData
      }
    },
    'formData.step1.company_name_change'() {
      if (this.formData.step1.company_name_change === 'no') {
        this.formData.step1.cert_of_changeofname = []
      } else {
        this.formData.step1.cert_of_changeofname = this.certofChangeofNameData
      }
    },
    //
    certofRegistration() {
      if (this.certofRegistration.length !== 0) {
        this.formData.step1.cert_of_registration = this.certofRegistration
      } else {
        this.formData.step1.cert_of_registration = this.certofRegistration
      }
    },
    'formData.step1.company_directors'() {
      if (this.formData.step1.company_directors === 'no') {
        this.formData.step1.cert_of_registration = []
      } else {
        this.formData.step1.cert_of_registration = this.certofRegistration
      }
    },
  },
  created() {
    if (this.formData.step1.cert_of_changeofname !== '') {
      this.certofChangeofNameData = this.formData.step1.cert_of_changeofname
    }
    if (this.formData.step1.cert_of_registration !== '') {
      this.certofRegistration = this.formData.step1.cert_of_registration
    }
  },
  methods: {
    handleFileUploadChange() {
      if (this.certofChangeofNameData.length !== 0) {
        this.formData.step1.cert_of_changeofname = this.certofChangeofNameData
      }
      if (this.certofRegistration.length !== 0) {
        this.formData.step1.cert_of_registration = this.certofRegistration
      }
    },
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
    handleWebsiteChange(value) {
      let autoCompleteResult
      if (!value) {
        autoCompleteResult = []
      } else {
        autoCompleteResult = [
          '.com',
          '.org',
          '.net',
          '.co.ke',
          '.ke',
          '.africa',
          '.ug',
          '.tz',
        ].map((domain) => `${value}${domain}`)
      }
      this.autoCompleteResult = autoCompleteResult
    },
    beforeUpload1(file) {
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
        this.certofChangeofNameData = [...this.certofChangeofNameData, file]
      }
      return false
      // return isJpgOrPng && isLt2M
    },
    beforeUpload2(file) {
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
        this.certofRegistration = [...this.certofRegistration, file]
      }
      return isJpgOrPng && isLt2M
    },
    handleRemove1(file) {
      // 1
      const index = this.certofChangeofNameData.indexOf(file)
      const newFileList = this.certofChangeofNameData.slice()
      newFileList.splice(index, 1)
      this.certofChangeofNameData = newFileList
    },
    handleRemove2(file) {
      // 2
      const index = this.certofRegistration.indexOf(file)
      const newFileList = this.certofRegistration.slice()
      newFileList.splice(index, 1)
      this.certofRegistration = newFileList
    },
  },
}
</script>
