<template>
  <div>
    <div class="page-header">
      <div class="page-header-left d-flex align-items-center">
        <div class="page-header-title">
          <h5 class="m-b-10">Head of Office</h5>
        </div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Head of Office</li>
        </ul>
      </div>
      <div class="page-header-right ms-auto">
        <div class="page-header-right-items">
          <div class="d-flex d-md-none">
            <a href="javascript:void(0)" class="page-header-right-close-toggle">
              <i class="feather-arrow-left me-2"></i>
              <span>Back</span>
            </a>
          </div>
          <div
            class="d-flex align-items-center gap-2 page-header-right-items-wrapper"
          >
            <button @click="openModal('add')" class="btn btn-primary">
              <i class="feather-plus me-2"></i>
              <span>Create Head of Office</span>
            </button>
          </div>
        </div>
        <div class="d-md-none d-flex align-items-center">
          <a href="javascript:void(0)" class="page-header-right-open-toggle">
            <i class="feather-align-right fs-20"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="modal-overlay" >
      <div class="modal-container">
        <div class="modal-content">
          <div class="modal-header">
            <h4>{{ modalTitle }}</h4>
            <button @click="closeModal" class="btn-close"></button>
          </div>
          <div class="modal-body">
            <!-- Your form content -->
          </div>
          <div class="modal-footer">
            <!-- Your buttons -->
          </div>
        </div>
      </div>
    </div>

    <div class="main-content">
      <div class="row">
        <div class="col-lg-12">
          <div class="card stretch stretch-full">
            <div
              class="card-header d-flex align-items-center justify-content-between"
            >
              <h5 class="card-title mb-0">Head of Office List</h5>
              <div class="d-flex gap-2">
                <input
                  v-model="searchQuery"
                  type="text"
                  class="form-control form-control-sm"
                  placeholder="Search..."
                  style="width: 200px"
                />
                <select
                  v-model="perPage"
                  class="form-select form-select-sm"
                  style="width: 100px"
                >
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                </select>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover" id="proposalList">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Head of Office</th>
                      <th>Status</th>
                      <th class="text-end">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="single-item">
                      <td>
                        <a href="javascript:void(0);" class="fw-bold"
                          >#357895</a
                        >
                      </td>
                      <td>Test</td>
                      <td>Active</td>

                      <td>
                        <div class="hstack gap-2 justify-content-end">
                          <a
                            href="javascript:void(0)"
                            class="avatar-text avatar-md"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#proposalSent"
                          >
                            <i class="feather feather-send"></i>
                          </a>
                          <a
                            href="proposal-view.html"
                            class="avatar-text avatar-md"
                          >
                            <i class="feather feather-eye"></i>
                          </a>
                          <div class="dropdown">
                            <a
                              href="javascript:void(0)"
                              class="avatar-text avatar-md"
                              data-bs-toggle="dropdown"
                              data-bs-offset="0,21"
                            >
                              <i class="feather feather-more-horizontal"></i>
                            </a>
                            <ul class="dropdown-menu">
                              <li>
                                <a
                                  class="dropdown-item"
                                  href="proposal-edit.html"
                                >
                                  <i class="feather feather-edit-3 me-3"></i>
                                  <span>Edit</span>
                                </a>
                              </li>
                              <li>
                                <a
                                  class="dropdown-item printBTN"
                                  href="javascript:void(0)"
                                >
                                  <i class="feather feather-printer me-3"></i>
                                  <span>Print</span>
                                </a>
                              </li>
                              <li>
                                <a
                                  class="dropdown-item"
                                  href="javascript:void(0)"
                                >
                                  <i class="feather feather-clock me-3"></i>
                                  <span>Remind</span>
                                </a>
                              </li>
                              <li class="dropdown-divider"></li>
                              <li>
                                <a
                                  class="dropdown-item"
                                  href="javascript:void(0)"
                                >
                                  <i class="feather feather-archive me-3"></i>
                                  <span>Archive</span>
                                </a>
                              </li>
                              <li>
                                <a
                                  class="dropdown-item"
                                  href="javascript:void(0)"
                                >
                                  <i
                                    class="feather feather-alert-octagon me-3"
                                  ></i>
                                  <span>Report Spam</span>
                                </a>
                              </li>
                              <li class="dropdown-divider"></li>
                              <li>
                                <a
                                  class="dropdown-item"
                                  href="javascript:void(0)"
                                >
                                  <i class="feather feather-trash-2 me-3"></i>
                                  <span>Delete</span>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    openModal(mode, headoffice) {
      this.formData = {
        id: "",
        head_of_office: "",
      };

      this.modalMode = mode;
      this.modalTitle =
        mode === "add"
          ? "Add Head of Office"
          : mode === "edit"
          ? "Edit Head of Office"
          : "View Head of Office";

      if (mode === "edit" || mode === "view") {
        this.formData.id = headoffice.id;
        this.formData.head_of_office = headoffice.head_of_office;
      }

      $("#modalHeadoffice").modal("show");
    },
  },
  data() {
    return {
      modalTitle: "",
      modalMode: "add",
      searchQuery: "",
      perPage: 10,
      formData: {
        head_of_office: "",
      },
    };
  },

  mounted() {
    // Click outside to close modal
  },
};
</script>

<style scoped>
/* Fix for blurry modal */
.modal {
  backdrop-filter: none !important;
}

/* Remove blur effect from modal backdrop */
.modal-backdrop {
  backdrop-filter: none !important;
}

/* Fix for focused elements */
.form-control:focus {
  outline: none;
  box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
  border-color: #86b7fe;
}

/* Ensure modal content is crisp */
.modal-content {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  transform: translateZ(0); /* Force hardware acceleration */
}

/* Animation fix */
@keyframes modalFadeIn {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Additional fix for text rendering */
.modal * {
  text-rendering: optimizeLegibility;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>