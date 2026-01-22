<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="card border-0 shadow-sm">
        <!-- DENR Themed Header -->
        <div class="card-header bg-primary border-0">
          <div class="row align-items-center">
            <div class="col-md-8">
              <div class="d-flex align-items-center">
                <div class="bg-white rounded-circle p-2 me-3">
                  <i class="ri-government-line text-primary fs-4"></i>
                </div>
                <div>
                  <h5 class="card-title mb-0 text-white">
                    <i class="ri-building-3-line me-2"></i>
                    DENR - Manage Ticket Type List
                  </h5>
                  <p class="text-white-50 mb-0 small">
                    <i class="ri-list-check me-1"></i>
                    Department of Environment and Natural Resources XI
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 text-end">
              <button
                type="button"
                class="btn btn-light btn-sm"
                @click="openModal('add')"
              >
                <i class="ri-add-circle-line me-1"></i>
                Create Ticket Type
              </button>
            </div>
          </div>
        </div>

        <!-- Filters Section -->
        <div class="card-body border-bottom">
          <div class="row g-3 align-items-center">
            <div class="col-md-3">
              <div class="input-group input-group">
                <span class="input-group-text bg-light">
                  <i class="ri-list-settings-line"></i>
                </span>
                <select
                  class="form-control form-control"
                  v-model="perPage"
                  @change="getDataTickettype"
                >
                  <option value="5">5 per page</option>
                  <option value="10">10 per page</option>
                  <option value="20">20 per page</option>
                  <option value="50">50 per page</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group input-group">
                <span class="input-group-text bg-light">
                  <i class="ri-search-line"></i>
                </span>
                <input
                  v-model="searchQuery"
                  @input="getDataTickettype"
                  type="text"
                  class="form-control"
                  placeholder="Search head of office..."
                />
              </div>
            </div>
            <div class="col-md-3 text-end">
              <button
                @click="refreshData"
                class="btn btn-outline-primary btn-lg me-1"
              >
                <i class="ri-refresh-line"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Table Section -->
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead class="table-light">
                <tr>
                  <th class="ps-4" width="50">
                    <i class="ri-list-check"></i>
                  </th>

                  <th>
                    <i class="ri-user-line me-1"></i>
                    Head of Office
                  </th>
                  <th>
                    <i class="ri-leaf-line me-1"></i>
                    Status
                  </th>
                  <th>
                    <i class="ri-calendar-line me-1"></i>
                    Date Created
                  </th>
                  <th class="text-center">
                    <i class="ri-settings-3-line me-1"></i>
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(ticket, index) in tickets.data" :key="ticket.id">
                  <td class="ps-4">
                    {{
                      (tickets.current_page - 1) * tickets.per_page + index + 1
                    }}
                  </td>

                  <td>
                    <div class="d-flex align-items-center">
                      <div>
                        <strong>{{ ticket.ticket_type }}</strong>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span :class="getStatusClass(ticket.status)">
                      <i :class="getStatusIcon(ticket.status)" class="me-1"></i>
                      {{ ticket.status }}
                    </span>
                  </td>
                  <td>
                    <i class="ri-time-line me-1 text-muted"></i>
                    {{ formatDate(ticket.created_at) }}
                  </td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <button
                        class="btn btn-sm btn-outline-primary"
                        @click="openModal('edit', ticket)"
                        title="Edit"
                      >
                        <i class="ri-edit-line"></i>
                      </button>
                      <button
                        class="btn btn-sm btn-outline-info"
                        @click="viewDetails(ticket)"
                        title="View"
                      >
                        <i class="ri-eye-line"></i>
                      </button>
                      <button
                        class="btn btn-sm btn-outline-danger"
                        @click="confirmDelete(ticket)"
                        title="Delete"
                      >
                        <i class="ri-delete-bin-line"></i>
                      </button>
                    </div>
                  </td>
                </tr>
                <tr v-if="tickets.data.length === 0">
                  <td colspan="6" class="text-center py-5">
                    <div class="text-muted">
                      <i class="ri-search-line display-5"></i>
                      <p class="mt-3 mb-0">No records found</p>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="tickets.total > 0" class="card-footer bg-white">
          <div class="row align-items-center">
            <div class="col-md-6">
              <span class="text-muted small">
                <i class="ri-file-list-line me-1"></i>
                Showing {{ tickets.from }} to {{ tickets.to }} of
                {{ tickets.total }} entries
              </span>
            </div>
            <div class="col-md-6">
              <nav class="float-end">
                <ul class="pagination pagination-sm mb-0">
                  <li
                    class="page-item"
                    :class="{ disabled: tickets.current_page === 1 }"
                  >
                    <button
                      class="page-link"
                      @click="changePage(1)"
                      title="First"
                    >
                      <i class="ri-skip-back-line"></i>
                    </button>
                  </li>
                  <li
                    class="page-item"
                    :class="{ disabled: tickets.current_page === 1 }"
                  >
                    <button
                      class="page-link"
                      @click="changePage(tickets.current_page - 1)"
                      title="Previous"
                    >
                      <i class="ri-arrow-left-s-line"></i>
                    </button>
                  </li>

                  <li
                    v-for="page in pages"
                    :key="page"
                    class="page-item"
                    :class="{ active: page === tickets.current_page }"
                  >
                    <button class="page-link" @click="changePage(page)">
                      {{ page }}
                    </button>
                  </li>

                  <li
                    class="page-item"
                    :class="{
                      disabled: tickets.current_page === tickets.last_page,
                    }"
                  >
                    <button
                      class="page-link"
                      @click="changePage(tickets.current_page + 1)"
                      title="Next"
                    >
                      <i class="ri-arrow-right-s-line"></i>
                    </button>
                  </li>
                  <li
                    class="page-item"
                    :class="{
                      disabled: tickets.current_page === tickets.last_page,
                    }"
                  >
                    <button
                      class="page-link"
                      @click="changePage(tickets.last_page)"
                      title="Last"
                    >
                      <i class="ri-skip-forward-line"></i>
                    </button>
                  </li>
                </ul>
              </nav>
              <div
                class="modal fade zoomIn"
                id="modalTickettype"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-dialog-centered modal">
                  <div class="modal-content border-0">
                    <div class="modal-header bg-light p-3 bg-primary">
                      <h5
                        class="modal-title"
                        id="exampleModalLabel"
                        style="color: white"
                      >
                        {{ modalTitle }}
                      </h5>
                      <button
                        type="button"
                        class="btn-close btn-close-white"
                        @click="closeModal"
                      ></button>
                    </div>
                    <div class="modal-body p-4">
                      <div class="mb-4">
                        <label class="form-label fw-medium mb-2">
                          Ticket Type
                          <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                          <span class="input-group-text bg-light">
                            <i class="ri-user-3-line"></i>
                          </span>
                          <input
                            type="text"
                            class="form-control"
                            v-model="formData.ticket_type"
                            placeholder="Enter Ticket Type"
                            :disabled="modalMode === 'view'"
                          />
                        </div>
                      </div>

                      <div v-if="modalMode === 'edit'" class="mb-3">
                        <label class="form-label fw-medium mb-2">
                          <i class="ri-leaf-line me-1"></i>
                          Status
                        </label>
                        <div>
                          <div class="form-check form-check-inline">
                            <input
                              class="form-check-input"
                              type="radio"
                              v-model="formData.status"
                              value="active"
                              id="active"
                            />
                            <label class="form-check-label" for="active">
                              <i
                                class="ri-checkbox-circle-line me-1 text-success"
                              ></i>
                              Active
                            </label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input
                              class="form-check-input"
                              type="radio"
                              v-model="formData.status"
                              value="inactive"
                              id="inactive"
                            />
                            <label class="form-check-label" for="inactive">
                              <i
                                class="ri-close-circle-line me-1 text-danger"
                              ></i>
                              Inactive
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button
                        type="button"
                        class="btn btn-light"
                        @click="closeModal"
                      >
                        <i class="ri-close-line me-1"></i>
                        Cancel
                      </button>
                      <button
                        v-if="modalMode !== 'view'"
                        type="button"
                        class="btn btn-primary"
                        @click="submitForm"
                        :disabled="loading"
                      >
                        <i class="ri-save-line me-1"></i>
                        <span
                          v-if="loading"
                          class="spinner-border spinner-border-sm me-1"
                        ></span>
                        {{
                          modalMode === "add" ? "Save Record" : "Update Record"
                        }}
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";

export default {
  data() {
    return {
      tickets: {
        data: [],
        current_page: 1,
        from: 1,
        to: 1,
        last_page: 1,
        per_page: 10,
        total: 0,
      },
      formData: {
        id: "",
        ticket_type: "",
        status: "active",
      },
      modalMode: "add",
      modalTitle: "Add Ticket Type",
      searchQuery: "",
      perPage: 10,
      loading: false,
    };
  },

  computed: {
    pages() {
      const pages = [];
      const total = this.tickets.last_page;
      const current = this.tickets.current_page;
      const maxVisible = 5;

      if (total <= maxVisible) {
        for (let i = 1; i <= total; i++) pages.push(i);
      } else {
        let start = Math.max(1, current - 2);
        let end = Math.min(total, start + maxVisible - 1);

        if (end - start + 1 < maxVisible) {
          start = Math.max(1, end - maxVisible + 1);
        }

        for (let i = start; i <= end; i++) pages.push(i);
      }

      return pages;
    },
  },

  methods: {
    async getDataTickettype() {
      try {
        const response = await axios.get(
          "/denrxi_ictsms/api/get/data/ticket/type",
          {
            params: {
              page: this.tickets.current_page,
              per_page: this.perPage,
              search: this.searchQuery,
            },
          }
        );

        this.tickets = response.data.data;
      } catch (error) {
        this.showError("Failed to load data. Please try again.");
      }
    },

    changePage(page) {
      if (page >= 1 && page <= this.tickets.last_page) {
        this.tickets.current_page = page;
        this.getDataTickettype();
      }
    },

    formatDate(dateString) {
      if (!dateString) return "";
      const date = new Date(dateString);
      return date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "short",
        day: "numeric",
      });
    },

    getStatusClass(status) {
      switch (status) {
        case "active":
          return "badge bg-success bg-opacity-10 text-success";
        case "inactive":
          return "badge bg-danger bg-opacity-10 text-danger";
        case "pending":
          return "badge bg-warning bg-opacity-10 text-warning";
        default:
          return "badge bg-secondary bg-opacity-10 text-secondary";
      }
    },

    getStatusIcon(status) {
      switch (status) {
        case "active":
          return "ri-checkbox-circle-line";
        case "inactive":
          return "ri-close-circle-line";
        case "pending":
          return "ri-time-line";
        default:
          return "ri-question-line";
      }
    },

    openModal(mode, ticket = null) {
      this.modalMode = mode;

      if (mode === "add") {
        this.modalTitle = "Add Ticket Type";
        this.formData = { id: "", ticket_type: "", status: "active" };
      } else if (mode === "edit") {
        this.modalTitle = "Edit Ticket Type";
        this.formData = {
          id: ticket.id,
          ticket_type: ticket.ticket_type,
          status: ticket.status || "active",
        };
      }

      $("#modalTickettype").modal("show");
    },
    closeModal() {
      $("#modalTickettype").modal("hide");
    },

    viewDetails(ticket) {
      this.modalMode = "view";
      this.modalTitle = "View Details";
      this.formData = {
        id: ticket.id,
        ticket_type: ticket.ticket_type,
        status: ticket.status || "active",
      };
      $("#modalTickettype").modal("show");
    },

    async submitForm() {
      if (!this.formData.ticket_type.trim()) {
        this.showError("Please enter Ticket Type");
        return;
      }

      this.loading = true;
      try {
        let response;

        if (this.modalMode === "add") {
          response = await axios.post(
            "/denrxi_ictsms/api/store/ticket/type",
            this.formData
          );
        } else {
          response = await axios.post(
            `/denrxi_ictsms/api/update/ticket/type/${this.formData.id}`,
            this.formData
          );
        }

        await Swal.fire({
          icon: "success",
          title: "Success",
          text: response.data.message || "Operation completed successfully",
          confirmButtonColor: "#198754",
          confirmButtonText: "OK",
        });

      $("#modalTickettype").modal("show");
       
        this.formData.ticket_type = "",
        this.getDataTickettype();
      } catch (error) {
        if (error.response?.status === 409) {
          this.showError("This Ticket Type is already exists");
        } else if (error.response?.data?.errors) {
          const errors = error.response.data.errors;
          const errorMessage = Object.values(errors).flat().join(", ");
          this.showError(errorMessage);
        } else {
          this.showError("Something went wrong. Please try again.");
        }
      } finally {
        this.loading = false;
      }
    },

    async confirmDelete(ticket) {
      const result = await Swal.fire({
        title: "Delete Record",
        text: `Are you sure you want to delete "${ticket.ticket_type}"?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel",
        reverseButtons: true,
      });

      if (result.isConfirmed) {
        try {
          await axios.delete(
            `/denrxi_ictsms/api/delete/ticket/type/${ticket.id}`
          );

          await Swal.fire({
            icon: "success",
            title: "Deleted!",
            text: "Record has been deleted successfully.",
            confirmButtonColor: "#198754",
            timer: 2000,
          });

          this.getDataTickettype();
        } catch (error) {
          this.showError("Failed to delete record");
        }
      }
    },

    refreshData() {
      this.getDataTickettype();
      this.showSuccess("Data refreshed successfully!");
    },

    exportData() {
      this.showInfo("Export feature will be available soon!");
    },

    showError(message) {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: message,
        confirmButtonColor: "#dc3545",
      });
    },

    showSuccess(message) {
      Swal.fire({
        icon: "success",
        title: "Success",
        text: message,
        confirmButtonColor: "#198754",
        timer: 1500,
      });
    },

    showInfo(message) {
      Swal.fire({
        icon: "info",
        title: "Information",
        text: message,
        confirmButtonColor: "#0dcaf0",
      });
    },
  },

  mounted() {
    this.getDataTickettype();
  },
};
</script>

<style scoped>
.card {
  border-radius: 10px;
}

.card-header {
  border-radius: 10px 10px 0 0 !important;
  padding: 1.2rem 1.5rem;
}

.table th {
  background-color: #f8fafc;
  font-weight: 600;
  padding: 1rem;
  border-bottom: 2px solid #e9ecef;
}

.table td {
  padding: 1rem;
  vertical-align: middle;
}

.badge {
  padding: 0.35rem 0.7rem;
  border-radius: 6px;
  font-weight: 500;
}

.btn-group .btn {
  border-radius: 6px;
  margin: 0 2px;
}

.btn-outline-primary {
  border-color: #198754;
  color: #198754;
}

.btn-outline-primary:hover {
  background-color: #198754;
  color: white;
}

.page-link {
  color: #198754;
  border: 1px solid #dee2e6;
}

.page-item.active .page-link {
  background-color: #198754;
  border-color: #198754;
  color: white;
}

.page-link:hover {
  color: #146c43;
  background-color: #e9ecef;
}

.modal-content {
  border-radius: 10px;
}

.input-group-text {
  background-color: #f8f9fa;
  border-color: #dee2e6;
}

.form-check-input:checked {
  background-color: #198754;
  border-color: #198754;
}

.bg-primary {
  background-color: #198754 !important;
}

.text-primary {
  color: #198754 !important;
}
</style>