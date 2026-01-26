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
                    DENR - Manage User List
                  </h5>
                  <p class="text-white-50 mb-0 small">
                    <i class="ri-list-check me-1"></i>
                    Department of Environment and Natural Resources XI
                  </p>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-4 text-end">
              <button
                type="button"
                class="btn btn-light btn-sm"
                @click="openModal('add')"
              >
                <i class="ri-add-circle-line me-1"></i>
                Create User
              </button>
            </div> -->
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
                  @change="getDataUserPending"
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
                  @input="getDataUserPending"
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
                    Name
                  </th>
                  <th>
                    <i class="ri-mail-line me-1"></i>
                    Email Address
                  </th>
                  <th>
                    <i class="ri-building-3-line me-1"></i>
                    Head Office
                  </th>
                  <th>
                    <i class="ri-building-line me-1"></i>
                    Office
                  </th>
                  <th>
                    <i class="ri-leaf-line me-1"></i>
                    Approval Status
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
                <tr v-for="(user, index) in users.data" :key="user.id">
                  <td class="ps-4">
                    {{ (users.current_page - 1) * users.per_page + index + 1 }}
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div>
                        <strong
                          >{{ user.firstname }} {{ user.middle_initial }},
                          {{ user.lastname }}</strong
                        >
                      </div>
                    </div>
                  </td>

                  <td>
                    <div class="d-flex align-items-center">
                      <div>
                        <strong>{{ user.email }}</strong>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div>
                        <strong>{{ user.head_office.head_of_office }}</strong>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div>
                        <strong>{{ user.office.office }}</strong>
                      </div>
                    </div>
                  </td>

                  <td>
                    <span :class="getStatusClass(user.approval_status)">
                      <i
                        :class="getStatusIcon(user.approval_status)"
                        class="me-1"
                      ></i>
                      {{ user.approval_status }}
                    </span>
                  </td>
                  <td>
                    <i class="ri-time-line me-1 text-muted"></i>
                    {{ formatDate(user.created_at) }}
                  </td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <button
                        class="btn btn-sm btn-outline-primary"
                        @click="openModal('edit', user)"
                        title="Edit"
                      >
                        <i class="ri-edit-line"></i>
                      </button>
                      <!-- <button
                        class="btn btn-sm btn-outline-info"
                        @click="viewDetails(user)"
                        title="View"
                      >
                        <i class="ri-eye-line"></i>
                      </button> -->
                    </div>
                  </td>
                </tr>
                <tr v-if="users.data.length === 0">
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
        <div v-if="users.total > 0" class="card-footer bg-white">
          <div class="row align-items-center">
            <div class="col-md-6">
              <span class="text-muted small">
                <i class="ri-file-list-line me-1"></i>
                Showing {{ users.from }} to {{ users.to }} of
                {{ users.total }} entries
              </span>
            </div>
            <div class="col-md-6">
              <nav class="float-end">
                <ul class="pagination pagination-sm mb-0">
                  <li
                    class="page-item"
                    :class="{ disabled: users.current_page === 1 }"
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
                    :class="{ disabled: users.current_page === 1 }"
                  >
                    <button
                      class="page-link"
                      @click="changePage(users.current_page - 1)"
                      title="Previous"
                    >
                      <i class="ri-arrow-left-s-line"></i>
                    </button>
                  </li>

                  <li
                    v-for="page in pages"
                    :key="page"
                    class="page-item"
                    :class="{ active: page === users.current_page }"
                  >
                    <button class="page-link" @click="changePage(page)">
                      {{ page }}
                    </button>
                  </li>

                  <li
                    class="page-item"
                    :class="{
                      disabled: users.current_page === users.last_page,
                    }"
                  >
                    <button
                      class="page-link"
                      @click="changePage(users.current_page + 1)"
                      title="Next"
                    >
                      <i class="ri-arrow-right-s-line"></i>
                    </button>
                  </li>
                  <li
                    class="page-item"
                    :class="{
                      disabled: users.current_page === users.last_page,
                    }"
                  >
                    <button
                      class="page-link"
                      @click="changePage(users.last_page)"
                      title="Last"
                    >
                      <i class="ri-skip-forward-line"></i>
                    </button>
                  </li>
                </ul>
              </nav>
              <div
                class="modal fade zoomIn"
                id="modalApproveUser"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content border-0">
                    <!-- Modal Header -->
                    <div
                      class="modal-header bg-gradient-primary p-4 text-white"
                    >
                      <div class="d-flex align-items-center w-100">
                        <div class="modal-icon-container me-3">
                          <i class="ri-user-shared-line fs-3"></i>
                        </div>
                        <div class="flex-grow-1">
                          <h5
                            class="modal-title fw-semibold mb-0"
                            id="exampleModalLabel"
                            style="color: white"
                          >
                            {{ modalTitle }}
                          </h5>
                          <p class="mb-0 mt-1" style="color: white">
                            {{
                              modalMode === "approve"
                                ? "Review and approve user access"
                                : "Manage user account details"
                            }}
                          </p>
                        </div>
                        <button
                          type="button"
                          class="btn-close btn-close-white"
                          @click="closeModal"
                        ></button>
                      </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body p-5">
                      <!-- Account Information Section -->
                      <div class="mb-4">
                        <h6 class="fw-semibold mb-3 d-flex align-items-center">
                          <i class="ri-information-line me-2 text-primary"></i>
                          Account Information
                        </h6>
                        <div class="row g-3">
                          <!-- Head of Office -->
                          <div class="col-md-6">
                            {{ formData.user_account_name }}
                          </div>
                          <div class="col-md-6">
                            {{ formData.email }}
                          </div>
                          <div class="col-md-6">
                            {{ formData.head_office_name }}
                          </div>
                          <div class="col-md-6">
                            {{ formData.office }}
                          </div>
                          <div class="col-md-6">
                            {{ formatDate(formData.created_at) }}
                          </div>
                        </div>
                      </div>

                      <!-- System Access Section -->
                      <div class="mb-4">
                        <h6 class="fw-semibold mb-3 d-flex align-items-center">
                          <i
                            class="ri-shield-keyhole-line me-2 text-primary"
                          ></i>
                          System Access
                        </h6>
                        <div class="row g-3">
                          <!-- System Type -->
                          <div class="col-md-6">
                            <label class="form-label fw-medium mb-2">
                              System Type
                              <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-custom">
                              <span class="input-group-text bg-light">
                                <i class="ri-computer-line"></i>
                              </span>
                              <select
                                v-model="formData.module_assign_name"
                                class="form-control form-select"
                                :disabled="
                                  modalMode === 'view' ||
                                  modalMode === 'approve'
                                "
                                
                              >
                                <option value="" disabled selected>
                                  Select system type
                                </option>
                                <option
                                  v-for="module in moduled"
                                  :key="module.id"
                                  :value="module.id"
                                >
                                  {{ module.module_assign }}
                                </option>
                              </select>
                            </div>
                            <small class="text-muted mt-1 d-block">
                              System type determines available features and
                              access permissions
                            </small>
                          </div>

                          <!-- Account Status -->
                          <div class="col-md-6">
                            <label class="form-label fw-medium mb-2">
                              Account Status
                              <span class="text-danger">*</span>
                            </label>
                            <div class="status-container">
                              <div class="d-flex flex-wrap gap-2">
                                <!-- Approved Status -->
                                <div class="form-check status-card">
                                  <input
                                    class="form-check-input"
                                    type="radio"
                                    v-model="formData.approval_status"
                                    value="Pending"
                                    id="Pending"
                                  />
                                  <label
                                    class="form-check-label d-flex align-items-center"
                                    for="Pending"
                                  >
                                    <div
                                      class="status-indicator bg-warning me-2"
                                    ></div>
                                    <div>
                                      <span class="fw-medium">Pending</span>
                                      <small class="d-block text-muted"
                                        >Pending access</small
                                      >
                                    </div>
                                  </label>
                                </div>

                                <div class="form-check status-card">
                                  <input
                                    class="form-check-input"
                                    type="radio"
                                    v-model="formData.approval_status"
                                    value="Approved"
                                    id="Approved"
                                  />
                                  <label
                                    class="form-check-label d-flex align-items-center"
                                    for="Approved"
                                  >
                                    <div
                                      class="status-indicator bg-success me-2"
                                    ></div>
                                    <div>
                                      <span class="fw-medium">Approved</span>
                                      <small class="d-block text-muted"
                                        >Active access</small
                                      >
                                    </div>
                                  </label>
                                </div>

                                <!-- Inactive Status -->
                                <!-- Inactive Status -->
                                <div class="form-check status-card">
                                  <input
                                    class="form-check-input"
                                    type="radio"
                                    v-model="formData.approval_status"
                                    value="Inactive"
                                    id="Inactive"
                                  />
                                  <label
                                    class="form-check-label d-flex align-items-center"
                                    for="Inactive"
                                  >
                                    <div
                                      class="status-indicator bg-danger me-2"
                                    ></div>
                                    <div>
                                      <span class="fw-medium">Inactive</span>
                                      <small class="d-block text-muted"
                                        >No access</small
                                      >
                                    </div>
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal Footer -->
                    <!-- Modal Footer -->
                    <div class="modal-footer p-4 border-top">
                      <button
                        type="button"
                        class="btn btn-outline-secondary"
                        @click="closeModal"
                      >
                        <i class="ri-close-line me-1"></i>
                        {{
                          modalMode === "approve" ? "Cancel Approval" : "Cancel"
                        }}
                      </button>

                      <button
                        v-if="modalMode === 'approve'"
                        type="button"
                        class="btn btn-success"
                        @click="approveUser"
                        :disabled="loading"
                      >
                        <i class="ri-check-double-line me-1"></i>
                        <span
                          v-if="loading"
                          class="spinner-border spinner-border-sm me-1"
                        ></span>
                        Approve Account
                      </button>

                      <button
                        v-else-if="modalMode !== 'view'"
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
                        Update Account
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
      moduled: [], // This matches the property used in template
      users: {
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
        user_account_name: "",
        email: "",
        created_at: "",
        approved_status: "",
        module_assign_name: "",
        approval_status: "",
      },
      modalMode: "add",
      modalTitle: "Approve User",
      searchQuery: "",
      perPage: 10,
      loading: false,
    };
  },

  computed: {
    pages() {
      const pages = [];
      const total = this.users.last_page;
      const current = this.users.current_page;
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
    async getDataSystemModules() {
      try {
        const response = await fetch("/denrxi_ictsms/api/get/data/module");
        if (!response.ok) throw new Error("Network response was not ok");

        // Assign to moduled instead of modules
        this.moduled = await response.json();

        console.log("Fetched modules:", this.moduled); // Add this for debugging
      } catch (error) {
        console.error("There was a problem fetching the System:", error);
      }
    },
    async getDataUserPending() {
      try {
        const response = await axios.get(
          "/denrxi_ictsms/api/get/data/user/pending",
          {
            params: {
              page: this.users.current_page,
              per_page: this.perPage,
              search: this.searchQuery,
            },
          }
        );

        this.users = response.data.data;
      } catch (error) {
        this.showError("Failed to load data. Please try again.");
      }
    },

    changePage(page) {
      if (page >= 1 && page <= this.users.last_page) {
        this.users.current_page = page;
        this.getDataUserPending();
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
        case "Aprroved":
          return "badge bg-success bg-opacity-10 text-success";
        case "Inactive":
          return "badge bg-danger bg-opacity-10 text-danger";
        case "Pending":
          return "badge bg-warning bg-opacity-10 text-warning";
        default:
          return "badge bg-secondary bg-opacity-10 text-secondary";
      }
    },

    getStatusIcon(status) {
      switch (status) {
        case "Aprroved":
          return "ri-checkbox-circle-line";
        case "Inactive":
          return "ri-close-circle-line";
        case "Pending":
          return "ri-time-line";
        default:
          return "ri-question-line";
      }
    },

    openModal(mode, user = null) {
      this.modalMode = mode;

      if (mode === "edit") {
        this.modalTitle = "Approved User Account";
        this.formData = {
          id: user.id,
          user_account_name:
          user.firstname + " " + user.middle_initial + " " + user.lastname,
          email: user.email,
          created_at: user.created_at,
          head_office_name: user.head_office.head_of_office,
          office: user.office.office,
          approval_status: user.approval_status || user.approved_status, // Try both
          module_assign_name: user.module_system
            ? user.module_system.id
            : "", // Adjusted to match relationship
         
        };

        console.log("User data:", user); // Debug: check what properties exist
        console.log("Status value:", this.formData.approval_status); // Debug
      }

      $("#modalApproveUser").modal("show");
    },
    closeModal() {
      $("#modalApproveUser").modal("hide");
    },

    viewDetails(user) {
      this.modalMode = "view";
      this.modalTitle = "View Details";
      this.formData = {
        id: user.id,
        user_account_name:
          user.firstname + " " + user.middle_initial + "" + user.lastname,
        email: user.email,
        created_at: user.created_at,
        head_office_name: user.head_office.head_of_office,
        office: user.office.office,
      };
      $("#modalApproveUser").modal("show");
    },

    async submitForm() {
      this.loading = true;
      try {
        let response;

        // Removed "add" condition, only keeping edit/update
        response = await axios.put(
          `/denrxi_ictsms/api/update/user/account/${this.formData.id}`,
          this.formData
        );

        await Swal.fire({
          icon: "success",
          title: "Success",
          text: response.data.message || "Operation completed successfully",
          confirmButtonColor: "#198754",
          confirmButtonText: "OK",
        });

        $("#modalOffice").modal("show");
        (this.formData.head_of_office = ""),
          (this.formData.office = ""),
          this.getDataUserPending();
        $("#modalApproveUser").modal("hide");
      } catch (error) {
        if (error.response?.status === 409) {
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

    async confirmDelete(user) {
      const result = await Swal.fire({
        title: "Delete Record",
        text: `Are you sure you want to delete "${user.head_of_office}"?`,
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
          await axios.delete(`/denrxi_ictsms/api/delete/office/${user.id}`);

          await Swal.fire({
            icon: "success",
            title: "Deleted!",
            text: "Record has been deleted successfully.",
            confirmButtonColor: "#198754",
            timer: 2000,
          });

          this.getDataOffice();
        } catch (error) {
          this.showError("Failed to delete record");
        }
      }
    },

    refreshData() {
      this.getDataUserPending();
      this.showSuccess("Data refreshed successfully!");
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
    this.getDataSystemModules();
    this.getDataUserPending();
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
.modal-header {
  background: linear-gradient(135deg, #198754 0%, #198754 100%);
}

.modal-icon-container {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
}

.input-group-custom .input-group-text {
  border-right: none;
  background-color: #f8f9fa;
}

.input-group-custom .form-control,
.input-group-custom .form-select {
  border-left: none;
  transition: all 0.3s ease;
}

.input-group-custom .form-control:focus,
.input-group-custom .form-select:focus {
  border-color: #4a6cf7;
  box-shadow: 0 0 0 0.2rem rgba(74, 108, 247, 0.25);
}

.status-container {
  background: #f8f9fa;
  border-radius: 8px;
  padding: 16px;
}

.status-card {
  background: white;
  border: 2px solid #e9ecef;
  border-radius: 8px;
  padding: 12px 16px;
  cursor: pointer;
  transition: all 0.3s ease;
  flex: 1;
  min-width: 120px;
}

.status-card:hover {
  border-color: #4a6cf7;
  background: #f8faff;
}

.status-card.selected {
  border-color: #4a6cf7;
  background: #f0f4ff;
}

.status-indicator {
  width: 12px;
  height: 12px;
  border-radius: 50%;
}

.form-check-input:checked {
  background-color: #4a6cf7;
  border-color: #4a6cf7;
}

.card {
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
  border-radius: 10px;
}
</style>