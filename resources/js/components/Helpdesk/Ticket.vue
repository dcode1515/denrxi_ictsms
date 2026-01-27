<template>
  <div>
    <div class="card mb-5 section-spacing" id="submitTicket">
      <div class="card-header">
        <h4 class="section-title mb-0">
          <i class="fas fa-ticket-alt me-2 text-denr"></i>
          New Helpdesk Ticket
        </h4>
      </div>
      <div class="card-body">
        <form action="#" method="POST">
          <!-- Ticket Details -->
          <div class="row mb-4">
            <div class="col-md-6 mb-3">
              <label for="ticketType" class="form-label required-field"
                >Ticket Type</label
              >
              <div class="form-group-icon">
                <i class="fas fa-cog input-icon"></i>
                <select
                  class="form-select form-control-icon"
                  v-model="formData.ticket_type"
                  name="ticketType"
                  @change="getDataTicketCategory"
                >
                  <option value="" selected disabled>Select issue type</option>
                  <option
                    v-for="ticket in tickettypes"
                    :key="ticket.id"
                    :value="ticket.id"
                  >
                    {{ ticket.ticket_type }}
                  </option>
                </select>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="ticketType" class="form-label required-field"
                >Ticket Category</label
              >
              <div class="form-group-icon">
                <i class="fas fa-cog input-icon"></i>
                <select
                  class="form-select form-control-icon"
                  v-model="formData.category"
                  name="ticketType"
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
              </div>
            </div>
          </div>

          <!-- Personal Information -->
          <div class="row mb-4">
            <div class="col-md-3 mb-3">
              <label for="name" class="form-label required-field"
                >Firstname</label
              >
              <div class="form-group-icon">
                <i class="fas fa-user input-icon"></i>
                <input
                  type="text"
                  class="form-control form-control-icon"
                  id="name"
                  name="name"
                  placeholder="Enter your full name"
                  required
                />
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="name" class="form-label required-field"
                >Middle Initial</label
              >
              <div class="form-group-icon">
                <i class="fas fa-user input-icon"></i>
                <input
                  type="text"
                  class="form-control form-control-icon"
                  id="name"
                  name="name"
                  placeholder="Enter your full name"
                  required
                />
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="name" class="form-label required-field"
                >Lastname</label
              >
              <div class="form-group-icon">
                <i class="fas fa-user input-icon"></i>
                <input
                  type="text"
                  class="form-control form-control-icon"
                  id="name"
                  name="name"
                  placeholder="Enter your full name"
                  required
                />
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="name" class="form-label required-field"
                >Extension</label
              >
              <div class="form-group-icon">
                <i class="fas fa-user input-icon"></i>
                <input
                  type="text"
                  class="form-control form-control-icon"
                  id="name"
                  name="name"
                  placeholder="Enter your full name"
                  required
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
                  id="email"
                  name="email"
                  placeholder="name@denr.gov.ph"
                  required
                />
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
                  id="position"
                  name="position"
                  placeholder="Enter your position"
                  required
                />
              </div>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-6 mb-3">
              <label for="office" class="form-label required-field"
                >Head Office</label
              >
              <div class="form-group-icon">
                <i class="fas fa-building input-icon"></i>
                <select
                  class="form-select form-control-icon"
                  id="office"
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
                  id="office"
                  v-model="formData.office"
                  :disabled="!formData.head_office"
                >
                  <option
                    v-for="office in offices"
                    :key="office.id"
                    :value="office.id"
                  >
                    {{ office.office }}
                  </option>
                </select>
              </div>
            </div>
          </div>

          <!-- Issue Description -->
          <div class="mb-4">
            <label for="concern" class="form-label required-field"
              >Issue Description</label
            >
            <div class="form-group-icon">
              <i class="fas fa-comment-dots input-icon"></i>
              <textarea
                class="form-control form-control-icon"
                id="concern"
                name="concern"
                rows="5"
                placeholder="Please describe your ICT concern in detail..."
                required
                maxlength="1000"
              ></textarea>
            </div>
            <div class="text-muted small mt-1">Maximum 1000 characters</div>
          </div>

          <!-- File Upload -->
          <div class="mb-4">
            <label class="form-label">Attachments (Optional)</label>
            <div class="file-upload-area">
              <div class="mb-3">
                <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
              </div>
              <h5>Click to upload files</h5>
              <p class="text-muted small">
                Maximum file size: 5MB. Supported formats: JPG, PNG, PDF, DOC
              </p>
              <input type="file" id="fileInput" class="form-control" multiple />
            </div>
          </div>

          <!-- Agreement -->
          <div class="form-check mb-4">
            <input
              class="form-check-input"
              type="checkbox"
              id="agreement"
              name="agreement"
              required
            />
            <label class="form-check-label" for="agreement">
              I confirm that the information provided is accurate and I
              understand that false reports may be subject to appropriate
              action.
            </label>
          </div>

          <!-- Form Buttons -->
          <div
            class="d-flex flex-column flex-md-row justify-content-between gap-3"
          >
            <div class="d-flex flex-column flex-sm-row gap-2">
              <button
                type="reset"
                class="btn btn-outline-secondary btn-responsive"
              >
                <i class="fas fa-eraser me-1"></i> Clear Form
              </button>
            </div>
            <div class="d-flex flex-column flex-sm-row gap-2">
              <button type="submit" class="btn btn-denr btn-responsive">
                <i class="fas fa-paper-plane me-1"></i> Submit Ticket
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <button
      type="button"
      class="btn btn-denr check-status-btn animate-pulse"
      data-bs-toggle="modal"
      data-bs-target="#checkStatusModal"
    >
      <i class="fas fa-search me-2"></i> Check Ticket Status
    </button>

    <div
      class="modal fade modal-denr"
      id="checkStatusModal"
      tabindex="-1"
      aria-labelledby="checkStatusModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="checkStatusModalLabel">
              <i class="fas fa-search me-2"></i> Check Ticket Status
            </h5>
            <button
              type="button"
              class="btn-close close-btn"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="text-center mb-4">
              <div class="mb-3">
                <i class="fas fa-ticket-alt fa-3x text-denr"></i>
              </div>
              <h4>Track Your Ticket Status</h4>
              <p class="text-muted">
                Enter your email address and ticket number to check the current
                status of your request.
              </p>
            </div>

            <form id="checkStatusForm">
              <div class="row mb-4">
                <div class="col-md-6 mb-3">
                  <label for="statusEmail" class="form-label required-field"
                    >Email Address</label
                  >
                  <div class="form-group-icon">
                    <i class="fas fa-envelope input-icon"></i>
                    <input
                      type="email"
                      class="form-control form-control-icon"
                      id="statusEmail"
                      name="statusEmail"
                      placeholder="Enter the email used when submitting ticket"
                      required
                    />
                  </div>
                  <small class="text-muted"
                    >Must match the email used when submitting the ticket</small
                  >
                </div>
                <div class="col-md-6 mb-3">
                  <label for="ticketNumber" class="form-label required-field"
                    >Ticket Number</label
                  >
                  <div class="form-group-icon">
                    <i class="fas fa-hashtag input-icon"></i>
                    <input
                      type="text"
                      class="form-control form-control-icon"
                      id="ticketNumber"
                      name="ticketNumber"
                      placeholder="e.g., DENR-2023-00123"
                      required
                    />
                  </div>
                  <small class="text-muted">Format: DENR-YYYY-XXXXX</small>
                </div>
              </div>

              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-denr px-5">
                  <i class="fas fa-search me-2"></i> Check Status
                </button>
              </div>
            </form>

         
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-outline-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              class="btn btn-outline-denr"
              onclick="printTicketStatus()"
            >
              <i class="fas fa-print me-2"></i> Print Status
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    fetchHeadOffices() {
      axios
        .get("/denrxi_ictsms/api/ticket/head-offices")
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
        .get(`/denrxi_ictsms/api/ticket/offices/${this.formData.head_office}`)
        .then((response) => {
          this.offices = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    getDataTicketTypes() {
      axios
        .get("/denrxi_ictsms/api/ticket/type")
        .then((response) => {
          this.tickettypes = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    getDataTicketCategory() {
      this.formData.category = "";
      this.categories = [];

      if (!this.formData.ticket_type) return;

      axios
        .get(
          `/denrxi_ictsms/api/ticket/categories/${this.formData.ticket_type}`
        )
        .then((response) => {
          this.categories = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
  data() {
    return {
      tickettypes: [],
      categories: [],
      headOffices: [],
      offices: [],
      formData: {
        ticket_type: "",
        head_office:"",
        office:"",
      },
    };
  },
  created() {},
  mounted() {
    this.fetchHeadOffices();
    this.getDataTicketTypes();
    console.log("Component Mounted");
  },
};
</script>

<style>
</style>