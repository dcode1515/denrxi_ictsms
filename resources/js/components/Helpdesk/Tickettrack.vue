<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <!-- Search Ticket Card -->
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="section-title mb-0">Search Ticket</h3>
          </div>

          <div class="card-body">
            <form @submit.prevent="searchTicket">
              <div class="row">
                <!-- Email -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">
                    Email Address <span class="text-danger">*</span>
                  </label>
                  <div class="form-group-icon">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" class="form-control form-control-icon" placeholder="Enter your email address"
                      v-model.trim="formData.email" />
                  </div>
                </div>

                <!-- Ticket Number -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">
                    Ticket Number <span class="text-danger">*</span>
                  </label>
                  <div class="form-group-icon">
                    <i class="fas fa-ticket-alt input-icon"></i>
                    <input type="text" class="form-control form-control-icon" placeholder="DENR-XI-2023-00123"
                      v-model.trim="formData.ticket_number" />
                  </div>
                </div>
              </div>

              <!-- Error -->
              <div v-if="errorMessage" class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ errorMessage }}
              </div>

              <!-- Success Message -->
              <div v-if="successMessage && !ticket" class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ successMessage }}
              </div>

              <!-- Buttons -->
              <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                <button class="btn btn-denr" type="submit" :disabled="loading">
                  <i class="fas fa-search me-2"></i>
                  {{ loading ? "Searching..." : "Search Ticket Status" }}
                </button>

                <button class="btn btn-outline-denr" type="button" @click="clearForm">
                  <i class="fas fa-eraser me-2"></i> Clear Form
                </button>
              </div>
            </form>

            <!-- Loading -->
            <div v-if="loading" class="loading-spinner text-center mt-4">
              <div class="spinner-border text-denr"></div>
              <p class="mt-3">Searching for ticket information...</p>
            </div>
          </div>
        </div>

        <!-- Results -->

        <div v-if="displayMode && ticket" class="mt-4">
          <div class="card shadow-sm border-0">
            <!-- Header -->
            <div class="card-header d-flex justify-content-between align-items-center bg-light">
              <div>
                <h5 class="mb-0 fw-bold">
                  <i class="fas fa-ticket-alt me-2 text-danger"></i>
                  Ticket #{{ getTicketNumber() }}
                </h5>
                <small class="text-muted">
                  Created: {{ getCreatedDate() }}
                </small>
              </div>

              <span class="badge px-3 py-2" :class="statusBadgeClass(getStatus())">
                {{ getStatus() }}
              </span>
            </div>

            <!-- Body -->
            <div class="card-body">
              <div class="row g-4">
                <!-- REQUESTER INFO -->
                <div class="col-md-6">
                  <div class="info-box">
                    <h6 class="fw-bold mb-3">
                      <i class="fas fa-user me-2"></i>Requester Information
                    </h6>

                    <p class="mb-1">
                      <strong>Name:</strong>
                      {{ ticket.firstname }}
                      {{ ticket.middle_initial }}
                      {{ ticket.lastname }}
                    </p>

                    <p class="mb-1">
                      <strong>Email:</strong>
                      {{ getEmail() }}
                    </p>

                    <p class="mb-1">
                      <strong>Office:</strong>
                      {{ ticket.office.office }}
                    </p>

                    <p class="mb-1">
                      <strong>Category:</strong>
                      {{ ticket.ticket_type.ticket_type }}
                    </p>

                    <p class="mb-0">
                      <strong>Subject:</strong>
                      {{ ticket.ticket_category.ticket_category }}
                    </p>
                  </div>
                </div>

                <!-- ISSUE DETAILS -->
                <div class="col-md-6">
                  <div class="info-box">
                    <h6 class="fw-bold mb-3">
                      <i class="fas fa-exclamation-circle me-2"></i>Issue
                      Details
                    </h6>

                    <p class="mb-2">
                      <strong>Concern:</strong>
                    </p>

                    <p class="text-muted">
                      {{ ticket.issue_concern || "N/A" }}
                    </p>

                    <hr />
                  </div>
                </div>

                <!-- TECHNICIAN -->
                <div class="col-12">
                  <div class="info-box bg-light">
                    <h6 class="fw-bold mb-3">
                      <i class="fas fa-tools me-2"></i>Technician Assigned
                    </h6>

                    <p class="mb-1">
                      <strong>Name:</strong>
                      {{ ticket.technician.firstname }}
                      {{ ticket.technician.middle_initial }}.
                      {{ ticket.technician.lastname }}
                    </p>

                    <p v-if="ticket.resolution" class="mt-2 mb-0">
                      <strong>Resolution:</strong><br />
                      {{ ticket.resolution }}
                    </p>
                    <p class="mb-1">
                      <strong>Date Received:</strong>
                      {{ formatDate(ticket.date_receive) }}
                    </p>

                    <p class="mb-0">
                      <strong>Date Acted:</strong>
                      {{ formatDate(ticket.date_acted) }}
                    </p>
                  </div>
                </div>

                <template v-if="ticket.rate == null">
                  <!-- FEEDBACK FORM -->
                  <div class="col-12">
                    <div class="info-box bg-light">
                      <h6 class="fw-bold mb-3">
                        <i class="fas fa-tools me-2"></i>Feedback Technician
                      </h6>

                      <!-- Rating -->
                      <div class="mb-3">
                        <label class="form-label fw-semibold">Service Rating</label>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="E" v-model="feedback.rating" />
                          <label class="form-check-label">⭐ Excellent</label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="VS" v-model="feedback.rating" />
                          <label class="form-check-label">👍 Very Satisfactory</label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="S" v-model="feedback.rating" />
                          <label class="form-check-label">🙂 Satisfactory</label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="BS" v-model="feedback.rating" />
                          <label class="form-check-label">👎 Below Satisfactory</label>
                        </div>
                      </div>

                      <!-- Remarks -->
                      <div class="mb-3">
                        <label class="form-label fw-semibold">Remarks</label>
                        <textarea class="form-control" rows="3" v-model="feedback.remarks"></textarea>
                      </div>

                      <button class="btn btn-info" @click="submitFeedback">
                        Submit Feedback
                      </button>
                    </div>
                  </div>
                </template>

                <template v-else>
                  <!-- DISPLAY SAVED DATA -->
                  <div class="col-12">
                    <div class="info-box bg-light">
                      <h6 class="fw-bold mb-3">
                        <i class="fas fa-tools me-2"></i>Technician Feedback
                      </h6>

                      <p>
                         <template v-if="ticket.rate && ticket.rate.rate === 'E'">⭐ Excellent</template>
                          <template v-else-if="ticket.rate && ticket.rate.rate === 'VS'">⭐ Very
                            Satisfactory</template>
                          <template v-else-if="ticket.rate && ticket.rate.rate === 'S'">⭐ Satisfactory</template>
                          <template v-else-if="ticket.rate && ticket.rate.rate === 'BS'">⭐ Below
                            Satisfactory</template>
                          <template v-else>No Data Encoded</template>
                      </p>

                      <p>
                        <strong>Remarks:</strong><br />
                        {{ ticket.rate.feedback_remarks || "No remarks provided" }}
                      </p>
                    </div>
                  </div>
                </template>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
  name: "TicketStatusSearch",

  data() {
    return {
      feedback: {
        rating: "",
        remarks: "",
      },
      formData: {
        email: "",
        ticket_number: "",
      },
      loading: false,
      errorMessage: "",
      successMessage: "",
      ticket: null,
      displayMode: true, // Set to false in production
    };
  },

  methods: {
    async submitFeedback() {
      // VALIDATION
      if (!this.feedback.rating) {
        Swal.fire({
          icon: "warning",
          title: "Rating Required",
          text: "Please select a service rating for the technician.",
          confirmButtonText: "OK",
        });
        return;
      }

      if (!this.ticket || !this.ticket.id) {
        Swal.fire({
          icon: "error",
          title: "Invalid Ticket",
          text: "Ticket information is missing.",
          confirmButtonText: "OK",
        });
        return;
      }

      try {
        const payload = {
          ticket_id: this.ticket.id,
          rate: this.feedback.rating,
          feedback_remarks: this.feedback.remarks,
        };

        const response = await axios.post(
          "/api/store/feedback",
          payload
        );

        if (response.data.success) {
          Swal.fire({
            icon: "success",
            title: "Feedback Successfully Submitted 🎉",
            html: `
      <p class="mb-2">
        Thank you for taking the time to share your feedback.
      </p>
      <p class="text-muted mb-3">
        Your response helps us improve the quality of our technical services.
      </p>
      <a 
        href="/ticket/status" 
        class="swal2-confirm swal2-styled"
        style="text-decoration:none;"
      >
        Back to Search Ticket
      </a>
    `,
            showConfirmButton: false,
            allowOutsideClick: false,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Submission Failed",
            text: response.data.message || "Unable to submit feedback.",
          });
        }
      } catch (error) {
        console.error(error);

        // Default message
        let message = "Something went wrong while submitting feedback.";

        // Handle backend validation / conflict message
        if (
          error.response &&
          error.response.data &&
          error.response.data.message
        ) {
          message = error.response.data.message;
        }

        Swal.fire({
          icon: "warning",
          title: "Feedback Not Allowed",
          text: message,
          confirmButtonText: "OK",
        });
      }
    },

    validateForm() {
      this.errorMessage = "";
      this.successMessage = "";

      if (!this.formData.email || !this.formData.ticket_number) {
        this.errorMessage = "Email and Ticket Number are required.";
        return false;
      }

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(this.formData.email)) {
        this.errorMessage = "Please enter a valid email address.";
        return false;
      }

      return true;
    },

    async searchTicket() {
      if (!this.validateForm()) return;

      this.loading = true;
      this.ticket = null;
      this.errorMessage = "";
      this.successMessage = "";

      try {
        console.log("Sending request with data:", this.formData);

        // Try with different endpoints if needed
        const endpoints = ["/api/ticket-status"];

        let response = null;
        let lastError = null;

        // Try each endpoint
        for (const endpoint of endpoints) {
          try {
            console.log(`Trying endpoint: ${endpoint}`);
            response = await axios.post(endpoint, this.formData, {
              timeout: 10000,
              headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
              },
            });
            console.log(`Success from endpoint: ${endpoint}`, response.data);
            break; // Stop if successful
          } catch (err) {
            lastError = err;
            console.log(`Failed from endpoint: ${endpoint}`, err.message);
            continue; // Try next endpoint
          }
        }

        if (!response) {
          throw lastError || new Error("No response from server");
        }

        console.log("Full API Response:", response);
        console.log("Response data:", response.data);

        // Handle different response structures
        if (response.data) {
          // Check if data is in nested property
          if (response.data.success) {
            if (response.data.data) {
              this.ticket = response.data.data;
            } else if (response.data.ticket) {
              this.ticket = response.data.ticket;
            } else if (
              Array.isArray(response.data) &&
              response.data.length > 0
            ) {
              this.ticket = response.data[0]; // Take first if array
            } else {
              this.ticket = response.data;
            }
          } else if (response.data.error) {
            this.errorMessage =
              response.data.message ||
              response.data.error ||
              "No ticket found.";
          } else {
            // Direct data
            this.ticket = response.data;
          }
        }

        if (this.ticket) {
          console.log("Ticket data set:", this.ticket);
          this.successMessage = "Ticket found successfully!";
        } else {
          this.errorMessage = "No ticket found with the provided details.";
        }
      } catch (err) {
        console.error("API Error Details:", err);

        if (err.response) {
          // Server responded with error
          console.error("Status:", err.response.status);
          console.error("Data:", err.response.data);

          if (err.response.status === 404) {
            this.errorMessage =
              "Ticket not found. Please check your email and ticket number.";
          } else if (err.response.status === 400) {
            this.errorMessage =
              err.response.data.message ||
              "Invalid request. Please check your input.";
          } else if (err.response.status === 500) {
            this.errorMessage = "Server error. Please try again later.";
          } else if (err.response.data && err.response.data.message) {
            this.errorMessage = err.response.data.message;
          } else {
            this.errorMessage = `Server error (${err.response.status}). Please try again.`;
          }
        } else if (err.request) {
          // Request was made but no response
          console.error("No response received:", err.request);
          this.errorMessage =
            "No response from server. Please check your network connection.";
        } else {
          // Other errors
          console.error("Error:", err.message);
          this.errorMessage = "Something went wrong. Please try again.";
        }
      } finally {
        this.loading = false;
      }
    },

    // Helper methods for flexible data access
    getTicketNumber() {
      return (
        this.ticket.helpdesk_no ||
        this.ticket.ticket_number ||
        this.ticket.id ||
        this.ticket.code ||
        "N/A"
      );
    },

    getCreatedDate() {
      return this.formatDate(
        this.ticket.created_at ||
        this.ticket.date_created ||
        this.ticket.created_date
      );
    },

    getStatus() {
      return this.ticket.status || this.ticket.ticket_status || "Unknown";
    },

    getEmail() {
      return (
        this.ticket.email || this.ticket.requester_email || this.formData.email
      );
    },

    formatDate(dateString) {
      if (!dateString) return "N/A";
      try {
        const date = new Date(dateString);
        return date.toLocaleDateString("en-US", {
          year: "numeric",
          month: "long",
          day: "numeric",
          hour: "2-digit",
          minute: "2-digit",
        });
      } catch (e) {
        return dateString;
      }
    },

    clearForm() {
      this.formData.email = "";
      this.formData.ticket_number = "";
      this.errorMessage = "";
      this.successMessage = "";
      this.ticket = null;
    },

    statusBadgeClass(status) {
      if (!status) return "bg-secondary";
      const s = status.toLowerCase();
      if (s.includes("open") || s.includes("pending")) return "bg-warning";
      if (s.includes("progress") || s.includes("processing"))
        return "bg-primary";
      if (
        s.includes("close") ||
        s.includes("resolve") ||
        s.includes("completed")
      )
        return "bg-success";
      if (s.includes("cancel") || s.includes("reject")) return "bg-danger";
      return "bg-secondary";
    },
  },
};
</script>

<style scoped>
.form-group-icon {
  position: relative;
}

.input-icon {
  position: absolute;
  top: 50%;
  left: 12px;
  transform: translateY(-50%);
  color: #999;
}

.form-control-icon {
  padding-left: 40px;
}

.info-box {
  border: 1px solid #e5e5e5;
  border-radius: 8px;
  padding: 15px;
  background: #fafafa;
  transition: all 0.3s ease;
  height: 100%;
}

.info-box:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-header h4 {
  font-weight: 600;
}

.badge {
  font-size: 0.9rem;
  font-weight: 500;
}

.section-title {
  color: #2c3e50;
  font-weight: 600;
}

.btn-denr {
  background-color: #228b22;
  border-color: #228b22;
  color: white;
}

.btn-denr:hover {
  background-color: #1e7a1e;
  border-color: #1e7a1e;
}

.btn-outline-denr {
  color: #228b22;
  border-color: #228b22;
}

.btn-outline-denr:hover {
  background-color: #228b22;
  color: white;
}

.alert-light {
  background-color: #f8f9fa;
  border-left: 4px solid #6c757d;
}

pre {
  font-size: 12px;
  background: #f8f9fa;
  padding: 10px;
  border-radius: 4px;
  max-height: 300px;
  overflow-y: auto;
}
</style>