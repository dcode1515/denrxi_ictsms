<template>
  <div>
    <!-- New Ticket Wizard -->
    <div class="card mb-5 section-spacing" id="submitTicket">
      <div class="card-header">
        <h4 class="section-title mb-0">
          <i class="fas fa-ticket-alt me-2 text-denr"></i>
          New Helpdesk Ticket
        </h4>
      </div>
      <div class="card-body">
        <!-- Step Indicators -->
        <div class="wizard-steps mb-5">
          <div
            class="step"
            :class="{ active: currentStep === 1, completed: currentStep > 1 }"
          >
            <div class="step-circle">1</div>
            <div class="step-label">Ticket Info</div>
          </div>
          <div class="step-line"></div>
          <div
            class="step"
            :class="{ active: currentStep === 2, completed: currentStep > 2 }"
          >
            <div class="step-circle">2</div>
            <div class="step-label">User Info</div>
          </div>
          <div class="step-line"></div>
          <div
            class="step"
            :class="{ active: currentStep === 3, completed: currentStep > 3 }"
          >
            <div class="step-circle">3</div>
            <div class="step-label">Issue Details</div>
          </div>
          <div class="step-line"></div>
          <div class="step" :class="{ active: currentStep === 4 }">
            <div class="step-circle">4</div>
            <div class="step-label">Confirmation</div>
          </div>
        </div>

        <form @submit.prevent="handleTicketRequest">
          <!-- Step 1: Ticket Information -->
          <div v-show="currentStep === 1" class="step-content animate-fade">
            <div class="step-category-header mb-4">
              <h5 class="step-title mb-0">
                <i class="fas fa-info-circle me-2 text-denr"></i>
                Ticket Information
              </h5>
              <span class="step-badge">Required</span>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="ticketType" class="form-label required-field"
                  >Ticket Type</label
                >
                <div class="form-group-icon">
                  <i class="fas fa-ticket-alt input-icon"></i>
                  <select
                    class="form-select form-control-icon"
                    v-model="formData.ticket_type"
                    :class="{ 'is-invalid': errors.ticket_type }"
                    @change="getDataTicketCategory"
                  >
                    <option value="" selected disabled>
                      Select issue type
                    </option>
                    <option
                      v-for="ticket in tickettypes"
                      :key="ticket.id"
                      :value="ticket.id"
                    >
                      {{ ticket.ticket_type }}
                    </option>
                  </select>
                  <div v-if="errors.ticket_type" class="invalid-feedback">
                    {{ errors.ticket_type }}
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="ticketCategory" class="form-label required-field"
                  >Ticket Category</label
                >
                <div class="form-group-icon">
                  <i class="fas fa-list-alt input-icon"></i>
                  <select
                    class="form-select form-control-icon"
                    v-model="formData.ticket_category"
                    :class="{ 'is-invalid': errors.ticket_category }"
                    :disabled="!formData.ticket_type"
                  >
                    <option value="" selected disabled>
                      Select Ticket Category
                    </option>
                    <option
                      v-for="category in categories"
                      :key="category.id"
                      :value="category.id"
                    >
                      {{ category.ticket_category }}
                    </option>
                  </select>
                  <div v-if="errors.ticket_category" class="invalid-feedback">
                    {{ errors.ticket_category }}
                  </div>
                </div>
              </div>

              <div class="col-md-12 mb-3">
                <label for="propertyNumber" class="form-label required-field"
                  >Property #</label
                >
                <div class="form-group-icon">
                  <i class="fas fa-tag input-icon"></i>
                  <input
                    type="text"
                    class="form-control form-control-icon"
                    v-model="formData.property_number"
                    placeholder="Enter Property Number"
                  />
                </div>
              </div>
            </div>
          </div>

          <!-- Step 2: User Information -->
          <div v-show="currentStep === 2" class="step-content animate-fade">
            <div class="step-category-header mb-4">
              <h5 class="step-title mb-0">
                <i class="fas fa-user-circle me-2 text-denr"></i>
                User Information
              </h5>
              <span class="step-badge">Required</span>
            </div>

            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="firstname" class="form-label required-field"
                  >Firstname</label
                >
                <div class="form-group-icon">
                  <i class="fas fa-user input-icon"></i>
                  <input
                    type="text"
                    class="form-control form-control-icon"
                    :class="{ 'is-invalid': errors.firstname }"
                    v-model="formData.firstname"
                    placeholder="Enter your first name"
                  />
                  <div v-if="errors.firstname" class="invalid-feedback">
                    {{ errors.firstname }}
                  </div>
                </div>
              </div>

              <div class="col-md-3 mb-3">
                <label for="middleinitial" class="form-label"
                  >Middle Initial</label
                >
                <div class="form-group-icon">
                  <i class="fas fa-user-circle input-icon"></i>
                  <input
                    type="text"
                    class="form-control form-control-icon"
                    v-model="formData.middle_initial"
                    placeholder="Enter Middle Initial"
                    maxlength="1"
                  />
                </div>
              </div>

              <div class="col-md-3 mb-3">
                <label for="lastname" class="form-label required-field"
                  >Lastname</label
                >
                <div class="form-group-icon">
                  <i class="fas fa-user-tag input-icon"></i>
                  <input
                    type="text"
                    class="form-control form-control-icon"
                    :class="{ 'is-invalid': errors.lastname }"
                    v-model="formData.lastname"
                    placeholder="Enter your last name"
                  />
                  <div v-if="errors.lastname" class="invalid-feedback">
                    {{ errors.lastname }}
                  </div>
                </div>
              </div>

              <div class="col-md-3 mb-3">
                <label for="extension" class="form-label">Extension</label>
                <div class="form-group-icon">
                  <i class="fas fa-user-plus input-icon"></i>
                  <input
                    type="text"
                    class="form-control form-control-icon"
                    v-model="formData.extension"
                    placeholder="Jr., Sr., III, etc."
                  />
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="email" class="form-label required-field"
                  >Email Address</label
                >
                <div class="form-group-icon">
                  <i class="fas fa-envelope input-icon"></i>
                  <input
                    type="email"
                    class="form-control form-control-icon"
                    :class="{ 'is-invalid': errors.email }"
                    v-model="formData.email"
                    placeholder="name@denr.gov.ph"
                  />
                  <div v-if="errors.email" class="invalid-feedback">
                    {{ errors.email }}
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="position" class="form-label required-field"
                  >Position</label
                >
                <div class="form-group-icon">
                  <i class="fas fa-briefcase input-icon"></i>
                  <input
                    type="text"
                    class="form-control form-control-icon"
                    :class="{ 'is-invalid': errors.position }"
                    v-model="formData.position"
                    placeholder="Enter your position"
                  />
                  <div v-if="errors.position" class="invalid-feedback">
                    {{ errors.position }}
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="headOffice" class="form-label required-field"
                  >Head Office</label
                >
                <div class="form-group-icon">
                  <i class="fas fa-building input-icon"></i>
                  <select
                    class="form-select form-control-icon"
                    :class="{ 'is-invalid': errors.head_office }"
                    v-model="formData.head_office"
                    @change="fetchOffices"
                  >
                    <option value="" selected disabled>
                      Select your Head Office
                    </option>
                    <option
                      v-for="head in headOffices"
                      :key="head.id"
                      :value="head.id"
                    >
                      {{ head.head_of_office }}
                    </option>
                  </select>
                  <div v-if="errors.head_office" class="invalid-feedback">
                    {{ errors.head_office }}
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="office" class="form-label required-field"
                  >Office</label
                >
                <div class="form-group-icon">
                  <i class="fas fa-building input-icon"></i>
                  <select
                    class="form-select form-control-icon"
                    :class="{ 'is-invalid': errors.office }"
                    v-model="formData.office"
                    :disabled="!formData.head_office"
                  >
                    <option value="" disabled>Select Office</option>
                    <option
                      v-for="office in offices"
                      :key="office.id"
                      :value="office.id"
                    >
                      {{ office.office }}
                    </option>
                  </select>
                  <div v-if="errors.office" class="invalid-feedback">
                    {{ errors.office }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Step 3: Issue Details -->
          <div v-show="currentStep === 3" class="step-content animate-fade">
            <div class="step-category-header mb-4">
              <h5 class="step-title mb-0">
                <i class="fas fa-comment-dots me-2 text-denr"></i>
                Issue Details
              </h5>
              <span class="step-badge">Required</span>
            </div>

            <div class="mb-4">
              <label for="concern" class="form-label required-field"
                >Issue Description</label
              >
              <div class="form-group-icon">
                <i class="fas fa-comment-dots input-icon"></i>
                <textarea
                  class="form-control form-control-icon"
                  :class="{ 'is-invalid': errors.concern }"
                  v-model="formData.concern"
                  @input="updateCharacterCount"
                  rows="5"
                  placeholder="Please describe your ICT concern in detail..."
                  maxlength="1000"
                ></textarea>
                <div v-if="errors.concern" class="invalid-feedback">
                  {{ errors.concern }}
                </div>
              </div>
              <div class="text-muted small mt-1 d-flex justify-content-between">
                <div>
                  {{ characterCount }} / 1000 characters
                  <span v-if="characterCount > 900" class="text-warning">
                    ({{ 1000 - characterCount }} remaining)
                  </span>
                  <span v-if="characterCount === 1000" class="text-danger">
                    (Maximum reached)
                  </span>
                </div>
                <div v-if="characterCount > 0" class="text-muted">
                  {{ wordCount }} word{{ wordCount !== 1 ? "s" : "" }}
                </div>
              </div>
            </div>

            <div class="mb-4">
              <div class="step-category-header mb-3">
                <label class="form-label mb-0">Attachments</label>
                <span class="step-badge bg-secondary">Optional</span>
              </div>
              <div class="file-upload-area" @click="$refs.fileInput.click()">
                <div class="mb-3">
                  <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                </div>
                <h5>Click to upload files</h5>
                <p class="text-muted small">
                  Maximum file size: 5MB. Supported formats: JPG, PNG, PDF, DOC
                </p>
                <input
                  type="file"
                  ref="fileInput"
                  @change="handleFileUpload"
                  class="d-none"
                />
              </div>

              <!-- File error display -->
              <div
                v-if="errors.attachment"
                class="alert alert-danger alert-sm mt-3"
              >
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ errors.attachment }}
              </div>

              <!-- Display single file -->
              <div v-if="formData.attachment" class="mt-3">
                <div class="attachment-preview">
                  <div class="attachment-preview-info">
                    <i class="fas fa-paperclip me-2"></i>
                    <span>{{ formData.attachment.name }}</span>
                    <span class="attachment-preview-size">
                      ({{ formatFileSize(formData.attachment.size) }})
                    </span>
                  </div>
                  <button
                    type="button"
                    class="btn-remove-attachment"
                    @click="removeAttachment"
                  >
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Step 4: Confirmation & Terms -->
          <div v-show="currentStep === 4" class="step-content animate-fade">
            <div class="step-category-header mb-4">
              <h5 class="step-title mb-0">
                <i class="fas fa-eye me-2 text-denr"></i>
                Review & Confirmation
              </h5>
              <span class="step-badge bg-warning">Final Step</span>
            </div>

            <!-- Review Section -->
            <div class="review-card mb-4">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="review-section-title">Ticket Information</h6>
                  <div class="review-item">
                    <span class="review-label">Type:</span>
                    <span class="review-value">{{
                      getTicketTypeName(formData.ticket_type)
                    }}</span>
                  </div>
                  <div class="review-item">
                    <span class="review-label">Category:</span>
                    <span class="review-value">{{
                      getCategoryName(formData.ticket_category)
                    }}</span>
                  </div>
                  <div class="review-item">
                    <span class="review-label">Property #:</span>
                    <span class="review-value">{{
                      formData.property_number
                    }}</span>
                  </div>
                  <div class="review-item">
                    <span class="review-label">Head Office:</span>
                    <span class="review-value">{{
                      getHeadOfficeName(formData.head_office)
                    }}</span>
                  </div>
                  <div class="review-item">
                    <span class="review-label">Office:</span>
                    <span class="review-value">{{
                      getOfficeName(formData.office)
                    }}</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <h6 class="review-section-title">User Information</h6>
                  <div class="review-item">
                    <span class="review-label">Name:</span>
                    <span class="review-value">{{ formatFullName() }}</span>
                  </div>
                  <div class="review-item">
                    <span class="review-label">Email:</span>
                    <span class="review-value">{{ formData.email }}</span>
                  </div>
                  <div class="review-item">
                    <span class="review-label">Position:</span>
                    <span class="review-value">{{ formData.position }}</span>
                  </div>
                </div>
              </div>

              <div class="mt-4">
                <h6 class="review-section-title">Issue Description</h6>
                <div class="review-concern">
                  {{ formData.concern || "No description provided" }}
                </div>
              </div>

              <div v-if="formData.attachment" class="mt-4">
                <h6 class="review-section-title">Attachments</h6>
                <div class="d-flex flex-wrap gap-2">
                  <div class="attachment-review">
                    <i class="fas fa-paperclip me-1"></i>
                    {{ formData.attachment.name }}
                    <span class="text-muted small ms-2">
                      ({{ formatFileSize(formData.attachment.size) }})
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Terms and Agreement -->
            <div class="terms-card">
              <div class="terms-header">
                <h6 class="mb-0">
                  <i class="fas fa-file-contract me-2"></i>
                  Terms and Conditions
                </h6>
              </div>
              <div class="terms-body">
                <div class="terms-content">
                  <p>By submitting this ticket, you agree to the following:</p>
                  <ul>
                    <li>
                      I confirm that the information provided is accurate and
                      complete
                    </li>
                    <li>
                      I understand that false or misleading information may
                      result in appropriate disciplinary action
                    </li>
                    <li>
                      I acknowledge that all ICT resources are for official use
                      only
                    </li>
                    <li>
                      I agree to comply with DENR ICT policies and procedures
                    </li>
                    <li>
                      I understand that ticket response times may vary based on
                      priority and workload
                    </li>
                    <li>
                      I consent to receive email notifications regarding my
                      ticket status
                    </li>
                  </ul>
                </div>

                <div class="form-check mt-3">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="agree_terms"
                    v-model="formData.agree_terms"
                    :class="{ 'is-invalid': errors.agree_terms }"
                  />
                  <label class="form-check-label" for="agree_terms">
                    <strong
                      >I have read, understood, and agree to the terms and
                      conditions above</strong
                    >
                  </label>
                  <div
                    v-if="errors.agree_terms"
                    class="invalid-feedback d-block"
                  >
                    {{ errors.agree_terms }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Navigation Buttons -->
          <div class="d-flex justify-content-between mt-5">
            <button
              type="button"
              class="btn btn-outline-secondary"
              @click="prevStep"
              v-show="currentStep > 1"
            >
              <i class="fas fa-arrow-left me-2"></i> Back
            </button>

            <div class="ms-auto d-flex gap-2">
              <button
                type="button"
                class="btn btn-outline-secondary"
                @click="resetForm"
                v-show="currentStep === 1"
              >
                <i class="fas fa-eraser me-1"></i> Clear Form
              </button>

              <button
                type="button"
                class="btn btn-denr"
                @click="nextStep"
                v-show="currentStep < 4"
              >
                Continue <i class="fas fa-arrow-right ms-2"></i>
              </button>

              <button
                type="button"
                class="btn btn-success"
                @click="submitForm"
                v-show="currentStep === 4"
                :disabled="loading"
              >
                <i v-if="!loading" class="fas fa-paper-plane me-2"></i>
                <span v-if="!loading">Submit Ticket</span>
                <span v-else>
                  <span
                    class="spinner-border spinner-border-sm me-2"
                    role="status"
                  ></span>
                  Processing...
                </span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Check Status Button -->
    <!-- <a
      :href="'/ticket/status'"
      type="button"
      class="btn btn-denr check-status-btn animate-pulse"
     
    >
      <i class="fas fa-search me-2"></i> Check Ticket Status
    </a> -->

    <!-- Check Status Modal -->
    <div
      class="modal fade modal-denr"
      id="checkStatusModal"
      tabindex="-1"
      aria-labelledby="checkStatusModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-denr text-white">
            <h5 class="modal-title" id="checkStatusModalLabel">
              <i class="fas fa-ticket-alt me-2"></i>Check Ticket Status
            </h5>
            <button
              type="button"
              class="btn-close btn-close-white"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body p-4">
            <div class="text-center mb-4">
              <div class="denr-icon-circle mb-3">
                <i class="fas fa-search-location fa-2x text-denr"></i>
              </div>
              <p class="text-muted">
                Enter your email and ticket number to track your request status
              </p>
            </div>

            <form id="checkStatusForm">
              <!-- Email Input -->
              <div class="mb-4">
                <label for="statusEmail" class="form-label fw-semibold">
                  <i class="fas fa-envelope me-2 text-denr"></i>Email Address
                </label>
                <div class="input-group">
                  <span class="input-group-text bg-light">
                    <i class="fas fa-user text-muted"></i>
                  </span>
                  <input
                    type="email"
                    class="form-control"
                    id="statusEmail"
                    placeholder="name@example.com"
                    required
                  />
                </div>
                <div class="form-text">
                  Enter the email you used when submitting the ticket
                </div>
              </div>

              <!-- Ticket Number Input -->
              <div class="mb-4">
                <label for="ticketNumber" class="form-label fw-semibold">
                  <i class="fas fa-hashtag me-2 text-denr"></i>Ticket Number
                </label>
                <div class="input-group">
                  <span class="input-group-text bg-light">
                    <i class="fas fa-ticket text-muted"></i>
                  </span>
                  <input
                    type="text"
                    class="form-control"
                    id="ticketNumber"
                    placeholder="e.g., DENR-2024-00123"
                    required
                  />
                </div>
                <div class="form-text">
                  Enter your unique ticket reference number
                </div>
              </div>

              <!-- Search Button -->
              <div class="d-grid gap-2 mt-4">
                <button
                  type="submit"
                  class="btn btn-denr btn-lg d-flex align-items-center justify-content-center"
                  id="searchTicketBtn"
                >
                  <i class="fas fa-search me-2"></i>
                  <span class="fw-semibold">Search Ticket Status</span>
                  <i
                    class="fas fa-spinner fa-spin ms-2 d-none"
                    id="searchSpinner"
                  ></i>
                </button>

                <button
                  type="button"
                  class="btn btn-outline-denr"
                  id="resetSearchBtn"
                >
                  <i class="fas fa-redo me-2"></i>Clear Fields
                </button>
              </div>
            </form>

            <!-- Help Text -->
            <div class="alert alert-light border-denr mt-4">
              <div class="d-flex">
                <i class="fas fa-info-circle text-denr mt-1 me-3"></i>
                <div>
                  <small class="text-muted">
                    <strong>Need help?</strong> If you've lost your ticket
                    number, please contact our support team at
                    <a href="mailto:support@denr.gov.ph" class="text-denr"
                      >support@denr.gov.ph</a
                    >
                  </small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Ticket Submission Success Modal -->
  </div>
</template>

<script>
import Swal from "sweetalert2";
import "bootstrap";

export default {
  data() {
    return {
      currentStep: 1,
      loading: false,
      characterCount: 0,
      wordCount: 0,

      tickettypes: [],
      categories: [],
      headOffices: [],
      offices: [],
      errors: {},
      formData: {
        ticket_type: "",
        ticket_category: "",
        head_office: "",
        property_number: "",
        firstname: "",
        middle_initial: "",
        lastname: "",
        extension: "",
        email: "",
        position: "",
        office: "",
        concern: "",
        agree_terms: false,
        attachment: null,
      },
      ticketSuccess: {
        helpdesk_no: "",
        email: "",
        date_created: "",
        status: "",
        ticket_id: null,
      },
    };
  },
  methods: {
    // Step Navigation
    nextStep() {
      if (this.validateCurrentStep()) {
        // Additional file validation for step 3
        if (this.currentStep === 3 && this.formData.attachment) {
          const file = this.formData.attachment;
          const maxSize = 5 * 1024 * 1024; // 5MB in bytes

          // Check file type
          if (!this.isValidFileType(file)) {
            this.errors.attachment =
              "Invalid file type. Only JPG, PNG, PDF, and Word documents are allowed.";
            this.scrollToFirstError();
            return;
          }

          // Check file size
          if (file.size > maxSize) {
            this.errors.attachment = "File is too large. Maximum size is 5MB.";
            this.scrollToFirstError();
            return;
          }
        }

        this.errors = {};
        if (this.currentStep < 4) {
          this.currentStep++;
          // Scroll to top of form
          document
            .getElementById("submitTicket")
            .scrollIntoView({ behavior: "smooth" });
        }
      } else {
        // Scroll to first error
        this.scrollToFirstError();
      }
    },

    prevStep() {
      if (this.currentStep > 1) {
        this.currentStep--;
        // Scroll to top of form
        document
          .getElementById("submitTicket")
          .scrollIntoView({ behavior: "smooth" });
      }
    },

    // Validation
    validateCurrentStep() {
      this.errors = {};
      let isValid = true;

      switch (this.currentStep) {
        case 1:
          if (!this.formData.ticket_type) {
            this.errors.ticket_type = "Please select a ticket type";
            isValid = false;
          }
          if (!this.formData.ticket_category) {
            this.errors.ticket_category = "Please select a ticket category";
            isValid = false;
          }
          break;

        case 2:
          if (!this.formData.firstname?.trim()) {
            this.errors.firstname = "First name is required";
            isValid = false;
          }
          if (!this.formData.lastname?.trim()) {
            this.errors.lastname = "Last name is required";
            isValid = false;
          }
          if (!this.formData.email?.trim()) {
            this.errors.email = "Email address is required";
            isValid = false;
          } else if (!this.isValidEmail(this.formData.email)) {
            this.errors.email = "Please enter a valid email address";
            isValid = false;
          }
          if (!this.formData.position?.trim()) {
            this.errors.position = "Position is required";
            isValid = false;
          }
          if (!this.formData.head_office) {
            this.errors.head_office = "Please select your head office";
            isValid = false;
          }
          if (!this.formData.office) {
            this.errors.office = "Please select your office";
            isValid = false;
          }
          break;

        case 3:
          if (!this.formData.concern?.trim()) {
            this.errors.concern = "Please describe your issue";
            isValid = false;
          } else if (this.formData.concern.trim().length < 10) {
            this.errors.concern =
              "Please provide more details (minimum 10 characters)";
            isValid = false;
          }

          // Validate attachment if it exists
          if (this.formData.attachment) {
            if (!this.isValidFileType(this.formData.attachment)) {
              this.errors.attachment =
                "Invalid file type. Only JPG, PNG, PDF, and Word documents are allowed.";
              isValid = false;
            }

            const maxSize = 5 * 1024 * 1024; // 5MB in bytes
            if (this.formData.attachment.size > maxSize) {
              this.errors.attachment =
                "File is too large. Maximum size is 5MB.";
              isValid = false;
            }
          }
          break;

        case 4:
          if (!this.formData.agree_terms) {
            this.errors.agree_terms =
              "You must agree to the terms and conditions before submitting";
            isValid = false;
          }
          break;
      }

      return isValid;
    },

    scrollToFirstError() {
      this.$nextTick(() => {
        const firstError = document.querySelector(".is-invalid, .alert-danger");
        if (firstError) {
          firstError.scrollIntoView({ behavior: "smooth", block: "center" });
          firstError.focus();
        }
      });
    },

    isValidEmail(email) {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email);
    },

    isValidFileType(file) {
      // Allowed file types
      const allowedTypes = [
        "image/jpeg",
        "image/jpg",
        "image/png",
        "application/pdf",
        "application/msword",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
      ];

      // Also check file extension as fallback
      const fileExtension = file.name.toLowerCase().split(".").pop();
      const allowedExtensions = ["jpg", "jpeg", "png", "pdf", "doc", "docx"];

      return (
        allowedTypes.includes(file.type) ||
        allowedExtensions.includes(fileExtension)
      );
    },

    // Form Submission
    async submitForm() {
      // Validate final step
      if (!this.validateCurrentStep()) {
        this.scrollToFirstError();
        return;
      }

      this.loading = true;

      try {
        // Prepare form data
        const formData = new FormData();

        // Add all form fields
        Object.keys(this.formData).forEach((key) => {
          if (key !== "agree_terms") {
            formData.append(key, this.formData[key]);
          }
        });

        // Add agree_terms separately (as 1/0 for backend)
        formData.append("agree_terms", this.formData.agree_terms ? "1" : "0");
        formData.append("attachment", this.formData.attachment);

        const response = await axios.post(
          "/api/store/request/ticket",
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );

        if (response.data.status === true) {
          window.location.href =
            "/ticket-success/" + response.data.ticketID;
        } else {
          throw new Error(response.data.message || "Submission failed");
        }
      } catch (error) {
        console.error("Submission error:", error);

        if (error.response) {
          if (error.response.status === 422) {
            // Laravel validation errors
            const errors = error.response.data.errors;

            // Convert to our error format
            Object.keys(errors).forEach((key) => {
              this.errors[key] = errors[key][0];
            });

            // Find the first step with errors
            this.goToStepWithErrors();

            // Show error alert
            const errorMessages = Object.values(errors).flat().join("\n");
            Swal.fire({
              icon: "error",
              title: "Validation Error",
              text: errorMessages,
              confirmButtonColor: "#e74c3c",
            });
          } else {
            const message =
              error.response.data.message ||
              "Something went wrong while submitting your ticket.";
            Swal.fire({
              icon: "error",
              title: "Submission Failed",
              text: message,
              confirmButtonColor: "#e74c3c",
            });
          }
        }
        // Network errors are silently logged to console only
      } finally {
        this.loading = false;
      }
    },

    goToStepWithErrors() {
      // Determine which step has errors
      if (
        this.errors.ticket_type ||
        this.errors.ticket_category ||
        this.errors.property_number ||
        this.errors.head_office ||
        this.errors.office
      ) {
        this.currentStep = 1;
      } else if (
        this.errors.firstname ||
        this.errors.lastname ||
        this.errors.email ||
        this.errors.position
      ) {
        this.currentStep = 2;
      } else if (this.errors.concern || this.errors.attachment) {
        this.currentStep = 3;
      } else if (this.errors.agree_terms) {
        this.currentStep = 4;
      }

      // Scroll to form
      this.$nextTick(() => {
        document
          .getElementById("submitTicket")
          .scrollIntoView({ behavior: "smooth" });
      });
    },

    resetForm() {
      this.currentStep = 1;

      this.errors = {};
      this.formData = {
        ticket_type: "",
        ticket_category: "",
        head_office: "",
        property_number: "",
        firstname: "",
        middle_initial: "",
        lastname: "",
        extension: "",
        email: "",
        position: "",
        office: "",
        concern: "",
        agree_terms: false,
        attachment: null,
      };
      this.characterCount = 0;
      this.wordCount = 0;

      // Clear file input
      if (this.$refs.fileInput) {
        this.$refs.fileInput.value = "";
      }
    },

    printTicket() {
      window.print();
    },

    downloadTicket() {
      // This would typically call an API endpoint to generate a PDF
      const content = `
        DENR ICT HELP DESK TICKET RECEIPT
        =================================
        
        Ticket Number: ${this.ticketSuccess.helpdesk_no}
        Date: ${this.ticketSuccess.date_created}
        Status: ${this.ticketSuccess.status}
        Email: ${this.ticketSuccess.email}
        
        IMPORTANT:
        ----------
        1. Save this ticket number for reference
        2. ICT Support will contact you regarding your request
        3. Check status anytime using the online portal
        
        Thank you for using DENR ICT Help Desk System.
      `;

      const blob = new Blob([content], { type: "text/plain" });
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement("a");
      a.href = url;
      a.download = `DENR-Ticket-${this.ticketSuccess.helpdesk_no}.txt`;
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
      window.URL.revokeObjectURL(url);

      Swal.fire({
        icon: "success",
        title: "Ticket Downloaded!",
        text: "Ticket details have been saved to your device.",
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
      });
    },

    copyTicketNumber() {
      navigator.clipboard
        .writeText(this.ticketSuccess.helpdesk_no)
        .then(() => {
          Swal.fire({
            icon: "success",
            title: "Copied!",
            text: "Ticket number copied to clipboard.",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
          });
        })
        .catch((err) => {
          console.error("Failed to copy: ", err);
        });
    },

    formatFullName() {
      let name = `${this.formData.firstname || ""}`;
      if (this.formData.middle_initial) {
        name += ` ${this.formData.middle_initial}.`;
      }
      name += ` ${this.formData.lastname || ""}`;
      if (this.formData.extension) {
        name += ` ${this.formData.extension}`;
      }
      return name.trim();
    },

    getTicketTypeName(id) {
      const type = this.tickettypes.find((t) => t.id === id);
      return type ? type.ticket_type : "Not selected";
    },

    getCategoryName(id) {
      const category = this.categories.find((c) => c.id === id);
      return category ? category.ticket_category : "Not selected";
    },

    getHeadOfficeName(id) {
      const head = this.headOffices.find((h) => h.id === id);
      return head ? head.head_of_office : "Not selected";
    },

    getOfficeName(id) {
      const office = this.offices.find((o) => o.id === id);
      return office ? office.office : "Not selected";
    },

    // File handling
    handleFileUpload(event) {
      if (event.target.files.length > 0) {
        const file = event.target.files[0];

        // Validate file type immediately
        if (!this.isValidFileType(file)) {
          // Show error and clear file input
          Swal.fire({
            icon: "error",
            title: "Invalid File Type",
            text: "Only JPG, PNG, PDF, and Word documents are allowed.",
            confirmButtonColor: "#e74c3c",
          });

          // Clear the file input
          event.target.value = "";
          this.formData.attachment = null;
          return;
        }

        // Validate file size (5MB = 5 * 1024 * 1024 bytes)
        const maxSize = 5 * 1024 * 1024; // 5MB in bytes
        if (file.size > maxSize) {
          Swal.fire({
            icon: "error",
            title: "File Too Large",
            text: "Maximum file size is 5MB.",
            confirmButtonColor: "#e74c3c",
          });

          // Clear the file input
          event.target.value = "";
          this.formData.attachment = null;
          return;
        }

        // File is valid, set it
        this.formData.attachment = file;

        // Clear any previous attachment errors
        if (this.errors.attachment) {
          this.errors.attachment = null;
        }
      }
    },

    removeAttachment() {
      this.formData.attachment = null;
      // Also clear the file input value to allow re-uploading same file
      if (this.$refs.fileInput) {
        this.$refs.fileInput.value = "";
      }

      // Clear attachment error if exists
      if (this.errors.attachment) {
        this.errors.attachment = null;
      }
    },

    formatFileSize(bytes) {
      if (bytes === 0) return "0 Bytes";
      const k = 1024;
      const sizes = ["Bytes", "KB", "MB", "GB"];
      const i = Math.floor(Math.log(bytes) / Math.log(k));
      return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + " " + sizes[i];
    },

    updateCharacterCount() {
      this.characterCount = this.formData.concern.length;
      const words = this.formData.concern.trim().split(/\s+/);
      this.wordCount = this.formData.concern.trim() === "" ? 0 : words.length;
    },

    // API Calls
    fetchHeadOffices() {
      axios
        .get("/api/ticket/head-offices")
        .then((response) => {
          this.headOffices = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },

    fetchOffices() {
      this.formData.office = "";
      this.offices = [];

      if (!this.formData.head_office) return;

      axios
        .get(`/api/ticket/offices/${this.formData.head_office}`)
        .then((response) => {
          this.offices = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },

    getDataTicketTypes() {
      axios
        .get("/api/ticket/type")
        .then((response) => {
          this.tickettypes = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },

    getDataTicketCategory() {
      this.formData.ticket_category = "";
      this.categories = [];

      if (!this.formData.ticket_type) return;

      axios
        .get(
          `/api/ticket/categories/${this.formData.ticket_type}`
        )
        .then((response) => {
          this.categories = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
  mounted() {
    this.fetchHeadOffices();
    this.getDataTicketTypes();

    // Initialize check status modal events
    document.addEventListener("DOMContentLoaded", function () {
      const form = document.getElementById("checkStatusForm");
      const resetBtn = document.getElementById("resetSearchBtn");
      const searchBtn = document.getElementById("searchTicketBtn");
      const spinner = document.getElementById("searchSpinner");

      if (form && resetBtn && searchBtn && spinner) {
        // Reset form
        resetBtn.addEventListener("click", function () {
          form.reset();
        });

        // Form submission
        form.addEventListener("submit", function (e) {
          e.preventDefault();

          // Show loading spinner
          spinner.classList.remove("d-none");
          searchBtn.disabled = true;

          // Simulate API call
          setTimeout(() => {
            // Hide spinner
            spinner.classList.add("d-none");
            searchBtn.disabled = false;

            // Here you would typically make an API call
            const email = document.getElementById("statusEmail").value;
            const ticketNo = document.getElementById("ticketNumber").value;

            console.log("Searching for:", { email, ticketNo });
            // Add your API call logic here

            // Example success notification
            alert(`Searching ticket: ${ticketNo}\nEmail: ${email}`);
          }, 1500);
        });
      }
    });
  },
};
</script>

<style scoped>
/* Step Categorization */
.step-category-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 0.75rem;
  border-bottom: 2px solid var(--denr-light);
  margin-bottom: 1.5rem;
}

.step-badge {
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  background-color: var(--denr-primary);
  color: white;
}

.step-badge.bg-secondary {
  background-color: #6c757d;
}

.step-badge.bg-warning {
  background-color: #ffc107;
  color: #212529;
}

/* Terms and Conditions */
.terms-card {
  border: 1px solid #dee2e6;
  border-radius: 10px;
  overflow: hidden;
}

.terms-header {
  background-color: #f8f9fa;
  padding: 1rem 1.5rem;
  border-bottom: 1px solid #dee2e6;
}

.terms-header h6 {
  color: var(--denr-primary);
  margin: 0;
}

.terms-body {
  padding: 1.5rem;
}

.terms-content {
  max-height: 200px;
  overflow-y: auto;
  padding: 1rem;
  background-color: #f8f9fa;
  border-radius: 5px;
  border: 1px solid #e9ecef;
}

.terms-content ul {
  margin: 1rem 0;
  padding-left: 1.5rem;
}

.terms-content li {
  margin-bottom: 0.5rem;
  line-height: 1.5;
}

/* Review Section Enhancements */
.review-card {
  background: #f8f9fa;
  border-radius: 10px;
  padding: 1.5rem;
  border: 1px solid #dee2e6;
}

.review-section-title {
  color: var(--denr-primary);
  font-weight: 600;
  margin-bottom: 1rem;
  padding-bottom: 0.5rem;
  border-bottom: 1px solid #dee2e6;
}

.review-item {
  display: flex;
  justify-content: space-between;
  margin-bottom: 0.75rem;
  padding-bottom: 0.5rem;
  border-bottom: 1px dashed #dee2e6;
}

.review-label {
  font-weight: 500;
  color: #495057;
}

.review-value {
  color: #212529;
  text-align: right;
  max-width: 60%;
}

.review-concern {
  background: white;
  padding: 1rem;
  border-radius: 5px;
  border: 1px solid #dee2e6;
  white-space: pre-wrap;
  max-height: 200px;
  overflow-y: auto;
}

/* File Upload */
.file-upload-area {
  border: 2px dashed #dee2e6;
  border-radius: 10px;
  padding: 2rem;
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease;
}

.file-upload-area:hover {
  border-color: var(--denr-primary);
  background: rgba(41, 128, 185, 0.05);
}

.attachment-preview {
  background: white;
  border: 1px solid #dee2e6;
  border-radius: 5px;
  padding: 0.5rem 1rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 0.875rem;
}

.attachment-preview-info {
  display: flex;
  align-items: center;
  flex: 1;
}

.attachment-preview-size {
  color: #6c757d;
  font-size: 0.8rem;
  margin-left: auto;
  margin-right: 10px;
}

.attachment-review {
  background: #e9ecef;
  border-radius: 5px;
  padding: 0.5rem 1rem;
  font-size: 0.875rem;
  display: flex;
  align-items: center;
}

.btn-remove-attachment {
  background: none;
  border: none;
  color: #dc3545;
  margin-left: 0.5rem;
  padding: 0;
  font-size: 0.875rem;
  cursor: pointer;
}

/* Alert styles */
.alert-sm {
  padding: 0.5rem 1rem;
  font-size: 0.875rem;
  margin-bottom: 0;
}

/* Wizard Steps */
.wizard-steps {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
  position: relative;
}

.step {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
  z-index: 2;
  flex: 1;
}

.step-circle {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #e9ecef;
  color: #6c757d;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  margin-bottom: 0.5rem;
  transition: all 0.3s ease;
}

.step.active .step-circle {
  background: var(--denr-primary);
  color: white;
  transform: scale(1.1);
  box-shadow: 0 0 0 5px rgba(41, 128, 185, 0.2);
}

.step.completed .step-circle {
  background: #28a745;
  color: white;
}

.step-label {
  font-size: 0.875rem;
  color: #6c757d;
  text-align: center;
  font-weight: 500;
}

.step.active .step-label {
  color: var(--denr-primary);
  font-weight: 600;
}

.step-line {
  flex: 1;
  height: 2px;
  background: #e9ecef;
  margin: 0 10px;
  position: relative;
  top: -20px;
}

.step.completed + .step-line {
  background: #28a745;
}

/* Success Modal Styles */
.success-icon {
  animation: bounceIn 0.6s ease;
}

@keyframes bounceIn {
  0% {
    opacity: 0;
    transform: scale(0.3);
  }
  50% {
    opacity: 1;
    transform: scale(1.05);
  }
  70% {
    transform: scale(0.9);
  }
  100% {
    transform: scale(1);
  }
}

.ticket-detail-item {
  padding: 0.5rem 0;
}

.ticket-detail-label {
  display: block;
  font-size: 0.875rem;
  color: #6c757d;
  margin-bottom: 0.25rem;
  font-weight: 500;
}

.ticket-detail-value {
  font-size: 1rem;
  color: #212529;
  font-weight: 600;
}

.bg-success-subtle {
  background-color: rgba(25, 135, 84, 0.1) !important;
}

/* Ticket Badge */
.badge.bg-success {
  font-size: 1.1rem;
  padding: 0.5rem 1rem;
  letter-spacing: 1px;
}

/* DENR Styles */
.denr-icon-circle {
  width: 80px;
  height: 80px;
  margin: 0 auto;
  background: linear-gradient(135deg, #1b5e20, #2e7d32);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  box-shadow: 0 4px 12px rgba(27, 94, 32, 0.2);
}

.btn-denr {
  background: linear-gradient(135deg, #1b5e20, #2e7d32);
  border: none;
  color: white;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.btn-denr:hover {
  background: linear-gradient(135deg, #2e7d32, #388e3c);
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(27, 94, 32, 0.3);
}

.btn-outline-denr {
  color: #1b5e20;
  border: 2px solid #1b5e20;
  background: transparent;
  transition: all 0.3s ease;
}

.btn-outline-denr:hover {
  background: #1b5e20;
  color: white;
  border-color: #1b5e20;
}

.modal-denr .modal-header {
  background: linear-gradient(135deg, #1b5e20, #2e7d32);
  border-bottom: none;
}

.form-control:focus {
  border-color: #2e7d32;
  box-shadow: 0 0 0 0.25rem rgba(46, 125, 50, 0.25);
}

.input-group-text {
  transition: all 0.3s ease;
}

.form-control:focus + .input-group-text {
  border-color: #2e7d32;
  background-color: rgba(46, 125, 50, 0.05);
}

.alert.border-denr {
  border: 1px solid rgba(27, 94, 32, 0.2);
  background: rgba(27, 94, 32, 0.05);
}

.check-status-btn {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 1000;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.animate-pulse {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% {
    box-shadow: 0 0 0 0 rgba(27, 94, 32, 0.4);
  }
  70% {
    box-shadow: 0 0 0 10px rgba(27, 94, 32, 0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(27, 94, 32, 0);
  }
}

/* Responsive Design */
@media (max-width: 768px) {
  .wizard-steps {
    flex-wrap: wrap;
  }

  .step {
    flex: 0 0 25%;
    margin-bottom: 1rem;
  }

  .step-line {
    display: none;
  }

  .step-circle {
    width: 35px;
    height: 35px;
    font-size: 0.875rem;
  }

  .step-label {
    font-size: 0.75rem;
  }

  .review-item {
    flex-direction: column;
  }

  .review-value {
    text-align: left;
    max-width: 100%;
    margin-top: 0.25rem;
  }

  .attachment-preview {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
  }

  .attachment-preview-info {
    width: 100%;
    justify-content: space-between;
  }

  .attachment-preview-size {
    margin-left: 0;
  }

  .info-item {
    flex-direction: column;
  }

  .info-item .value {
    text-align: left;
    margin-top: 0.25rem;
  }
}

@media (max-width: 576px) {
  .step {
    flex: 0 0 50%;
  }

  .step-category-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
  }

  .step-badge {
    align-self: flex-start;
  }

  .btn-responsive {
    width: 100%;
    margin-bottom: 0.5rem;
  }

  .d-flex.justify-content-between {
    flex-direction: column;
  }

  .d-flex.justify-content-between > * {
    width: 100%;
  }

  .check-status-btn {
    bottom: 10px;
    right: 10px;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
  }
}

/* Animations */
.animate-fade {
  animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Required field indicator */
.required-field::after {
  content: " *";
  color: #dc3545;
}

/* Form validation */
.is-invalid {
  border-color: #dc3545;
}

.invalid-feedback {
  display: block;
  color: #dc3545;
  font-size: 0.875rem;
  margin-top: 0.25rem;
}

/* Modal styles */
.modal-denr .modal-header {
  background-color: var(--denr-primary);
  color: white;
}

/* Scrollbar styling */
.terms-content::-webkit-scrollbar,
.review-concern::-webkit-scrollbar {
  width: 6px;
}

.terms-content::-webkit-scrollbar-track,
.review-concern::-webkit-scrollbar-track {
  background: #f1f1f1;
}

.terms-content::-webkit-scrollbar-thumb,
.review-concern::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

.terms-content::-webkit-scrollbar-thumb:hover,
.review-concern::-webkit-scrollbar-thumb:hover {
  background: #a1a1a1;
}

/* Print Styles */
@media print {
  .modal-backdrop,
  .modal-header .btn-close,
  .card .btn,
  .check-status-btn {
    display: none !important;
  }

  .modal {
    position: absolute !important;
    left: 0;
    top: 0;
    margin: 0;
    padding: 0;
    opacity: 1 !important;
    visibility: visible !important;
  }

  .modal-dialog {
    max-width: 100% !important;
    margin: 0 !important;
  }

  .modal-content {
    border: none !important;
    box-shadow: none !important;
  }
}
</style>