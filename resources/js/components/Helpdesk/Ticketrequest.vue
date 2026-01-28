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
                    DENR - Manage All Ticket Request
                  </h5>
                  <p class="text-white-50 mb-0 small">
                    <i class="ri-list-check me-1"></i>
                    Department of Environment and Natural Resources XI
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-body border-bottom">
          <div class="card-header bg-denr-gradient border-bottom-0">
            <ul
              class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0"
              role="tablist"
            >
              <li class="nav-item">
                <a
                  class="nav-link active"
                  data-bs-toggle="tab"
                  href="#allTickets"
                  role="tab"
                  aria-controls="allTickets"
                  aria-selected="true"
                >
                  <i class="ri-list-check-2 me-2"></i>
                  <span class="d-none d-md-inline">All Request Tickets</span>
                  <span
                    class="badge bg-primary rounded-pill ms-1 d-none d-md-inline"
                    >24</span
                  >
                </a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  data-bs-toggle="tab"
                  href="#resolvedTickets"
                  role="tab"
                  aria-controls="resolvedTickets"
                  aria-selected="false"
                >
                  <i class="ri-checkbox-circle-line me-2 text-success"></i>
                  <span class="d-none d-md-inline">Resolved Tickets</span>
                  <span
                    class="badge bg-success rounded-pill ms-1 d-none d-md-inline"
                    >18</span
                  >
                </a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  data-bs-toggle="tab"
                  href="#unresolvedTickets"
                  role="tab"
                  aria-controls="unresolvedTickets"
                  aria-selected="false"
                >
                  <i class="ri-alarm-warning-line me-2 text-warning"></i>
                  <span class="d-none d-md-inline">Unresolved Tickets</span>
                  <span
                    class="badge bg-warning rounded-pill ms-1 d-none d-md-inline"
                    >4</span
                  >
                </a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  data-bs-toggle="tab"
                  href="#feedbackTickets"
                  role="tab"
                  aria-controls="feedbackTickets"
                  aria-selected="false"
                >
                  <i class="ri-chat-feedback-line me-2 text-info"></i>
                  <span class="d-none d-md-inline">Feedback Tickets</span>
                  <span
                    class="badge bg-info rounded-pill ms-1 d-none d-md-inline"
                    >2</span
                  >
                </a>
              </li>
            </ul>

            <div class="tab-content pt-4">
              <div
                class="tab-pane fade show active"
                id="allTickets"
                role="tabpanel"
              >
                <div class="table-responsive">
                  <br />
                  <div class="row g-3 align-items-center">
                    <div class="col-md-3">
                      <div class="input-group input-group">
                        <span class="input-group-text bg-light">
                          <i class="ri-list-settings-line"></i>
                        </span>
                        <select
                          class="form-control form-control"
                          v-model="perPage"
                          @change="getDataAllRequest"
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
                          @input="getDataAllRequest"
                          type="text"
                          class="form-control"
                          placeholder="Search Anything..."
                        />
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="input-group input-group">
                        <button
                          type="button"
                          class="btn btn-info"
                          @click="refreshData"
                        >
                          <i class="ri-refresh-line"></i> Refresh Data
                        </button>
                      </div>
                    </div>
                  </div>
                  <table
                    class="table table-bordered table-hover table-striped align-middle mb-0"
                    style="font-size: 0.875rem"
                  >
                    <thead class="table-light">
                      <tr>
                        <th width="50" class="text-center">#</th>
                        <th width="5%">
                          <i class="ri-ticket-line me-1"></i> Helpdesk #
                        </th>
                        <th width="150" class="text-center">
                          <i class="ri-calendar-line me-1"></i>Subject
                        </th>
                        <th width="150" class="text-center">
                          <i class="ri-user-line me-1"></i> Requester
                        </th>
                        <th width="250" class="text-center">
                          <i class="ri-user-line me-1"></i> Office
                        </th>
                        <th width="200" class="text-center">
                          <i class="ri-calendar-line me-1"></i> Date Created
                        </th>

                        <th width="120" class="text-center">
                          <i class="ri-folder-line me-1"></i> Category
                        </th>
                        <th width="120" class="text-center">
                          <i class="ri-folder-line me-1"></i> Technician Assign
                        </th>
                        <th width="100" class="text-center">
                          <i class="ri-information-line me-1"></i> Status
                        </th>
                        <th width="80" class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(ticket, index) in tickets.data"
                        :key="ticket.id"
                      >
                        <td class="text-center fw-bold">
                          {{
                            (tickets.current_page - 1) * tickets.per_page +
                            index +
                            1
                          }}
                        </td>
                        <td>
                          <span class="badge bg-secondary">{{
                            ticket.helpdesk_no
                          }}</span>
                        </td>
                        <td>
                          {{ ticket.ticket_category.ticket_category }}
                        </td>

                        <td class="text-center">
                          {{ ticket.firstname }} {{ ticket.middle_initial }}.
                          {{ ticket.lastname }}
                        </td>
                        <td class="text-center">
                          {{ ticket.office.office }}
                        </td>
                        <td class="text-center">
                          {{ formatDate(ticket.date_created) }}
                        </td>

                        <td class="text-center">
                          {{ ticket.ticket_type.ticket_type }}
                        </td>
                        <td></td>
                        <td class="text-center">
                          <span class="badge bg-warning">{{
                            ticket.status
                          }}</span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group" role="group">
                            <!-- View Button -->
                            <!-- Replace the existing View button in your table: -->
                            <button
                              class="btn btn-sm btn-outline-primary"
                              @click="viewTicket(ticket)"
                              data-bs-toggle="modal"
                              data-bs-target="#viewTicketModal"
                            >
                              <i class="ri-eye-line"></i>
                            </button>

                            <!-- Receive Button -->
                            <button
                              class="btn btn-sm btn-outline-success"
                              @click="receiveItem(item)"
                            >
                              <i class="ri-check-line"></i>
                            </button>

                            <!-- Cancel Button -->
                            <button
                              class="btn btn-sm btn-outline-danger"
                              @click="cancelItem(item)"
                            >
                              <i class="ri-close-line"></i>
                            </button>
                          </div>
                        </td>
                      </tr>

                      <!-- Add more rows as needed -->
                    </tbody>
                  </table>

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
                              :class="{
                                disabled: tickets.current_page === 1,
                              }"
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
                              :class="{
                                disabled: tickets.current_page === 1,
                              }"
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
                              :class="{
                                active: page === tickets.current_page,
                              }"
                            >
                              <button
                                class="page-link"
                                @click="changePage(page)"
                              >
                                {{ page }}
                              </button>
                            </li>

                            <li
                              class="page-item"
                              :class="{
                                disabled:
                                  tickets.current_page === tickets.last_page,
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
                                disabled:
                                  tickets.current_page === tickets.last_page,
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

                        <!-- View Ticket Modal -->

                        <div
                          class="modal fade zoomIn"
                          id="viewTicketModal"
                          tabindex="-1"
                          aria-labelledby="exampleModalLabel"
                          aria-hidden="true"
                        >
                          <div
                            class="modal-dialog modal-lg modal-dialog-centered"
                          >
                            <div class="modal-content border-0 shadow">
                              <!-- Modal Header -->
                              <div class="modal-header bg-primary text-white">
                                <div class="d-flex align-items-center w-100">
                                  <div>
                                    <h5
                                      class="modal-title mb-0"
                                      style="color: white"
                                    >
                                      Ticket Details
                                    </h5>
                                    <p class="mb-0 small text-white-50">
                                      <i class="ri-information-line me-1"></i>
                                      Complete ticket information
                                    </p>
                                  </div>
                                </div>
                                <button
                                  type="button"
                                  class="btn-close btn-close-white"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>

                              <!-- Modal Body -->
                              <div class="modal-body p-0">
                                <!-- Ticket Header Info -->
                                <div class="border-bottom p-4">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div
                                        class="d-flex align-items-center mb-3"
                                      >
                                        <div class="bg-light rounded p-2 me-3">
                                          <i
                                            class="ri-ticket-line text-primary"
                                          ></i>
                                        </div>
                                        <div>
                                          <small class="text-muted d-block"
                                            >Ticket ID</small
                                          >
                                          <span class="fw-bold fs-5">{{
                                            selectedTicket.helpdesk_no || "N/A"
                                          }}</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="d-flex align-items-center">
                                        <div class="bg-light rounded">
                                          <i
                                            class="ri-calendar-line text-primary"
                                          ></i>
                                        </div>
                                        <div>
                                          <small class="text-muted d-block"
                                            >Date Created</small
                                          >
                                          <span class="fw-bold">{{
                                            selectedTicket.date_created
                                              ? formatDate(
                                                  selectedTicket.date_created
                                                )
                                              : "N/A"
                                          }}</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <!-- Main Content -->
                                <div class="p-4">
                                  <!-- Ticket Information Card -->
                                  <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-light">
                                      <h6 class="mb-0">
                                        <i class="ri-information-line me-2"></i
                                        >Basic Information
                                      </h6>
                                    </div>
                                    <div class="card-body">
                                      <div class="row g-3">
                                        <!-- Requester Info -->
                                        <div class="col-md-6">
                                          <label class="small text-muted mb-1">
                                            <i class="ri-user-line me-1"></i
                                            >Requester
                                          </label>
                                          <div
                                            class="d-flex align-items-center"
                                          >
                                            <div
                                              class="bg-primary bg-opacity-10 rounded-circle p-2 me-3"
                                            >
                                              <i
                                                class="ri-user-3-line text-primary"
                                              ></i>
                                            </div>
                                            <div>
                                              <p class="mb-0 fw-bold">
                                                {{
                                                  selectedTicket.firstname || ""
                                                }}
                                                {{
                                                  selectedTicket.middle_initial
                                                    ? selectedTicket.middle_initial +
                                                      "."
                                                    : ""
                                                }}
                                                {{
                                                  selectedTicket.lastname || ""
                                                }}
                                              </p>
                                              <small class="text-muted">
                                                {{
                                                  selectedTicket.office
                                                    ? selectedTicket.office
                                                        .office
                                                    : "N/A"
                                                }}
                                              </small>
                                            </div>
                                          </div>
                                        </div>

                                        <!-- Contact Info -->
                                        <div class="col-md-6">
                                          <label class="small text-muted mb-1">
                                            <i class="ri-phone-line me-1"></i
                                            >Contact Information
                                          </label>
                                          <div
                                            class="d-flex align-items-center"
                                          >
                                            <div
                                              class="bg-success bg-opacity-10 rounded-circle p-2 me-3"
                                            >
                                              <i
                                                class="ri-mail-line text-success"
                                              ></i>
                                            </div>
                                            <div>
                                              <p class="mb-0 fw-bold">
                                                {{
                                                  selectedTicket.email || "N/A"
                                                }}
                                              </p>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <label class="small text-muted mb-1">
                                            <i class="ri-phone-line me-1"></i
                                            >Subject
                                          </label>
                                          <div
                                            class="d-flex align-items-center"
                                          >
                                            <div
                                              class="bg-success bg-opacity-10 rounded-circle p-2 me-3"
                                            >
                                              <i
                                                class="ri-mail-line text-success"
                                              ></i>
                                            </div>
                                            <div>
                                              <p
                                                class="mb-0 fw-bold"
                                                v-if="
                                                  selectedTicket.ticket_category
                                                "
                                              >
                                                {{
                                                  selectedTicket.ticket_category
                                                    .ticket_category
                                                }}
                                              </p>
                                              <p
                                                class="mb-0 fw-bold text-muted"
                                                v-else
                                              >
                                                N/A
                                              </p>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <label class="small text-muted mb-1">
                                            <i class="ri-phone-line me-1"></i
                                            >Category
                                          </label>
                                          <div
                                            class="d-flex align-items-center"
                                          >
                                            <div
                                              class="bg-success bg-opacity-10 rounded-circle p-2 me-3"
                                            >
                                              <i
                                                class="ri-mail-line text-success"
                                              ></i>
                                            </div>
                                            <div>
                                              <p
                                                class="mb-0 fw-bold"
                                                v-if="
                                                  selectedTicket.ticket_type
                                                "
                                              >
                                                {{
                                                  selectedTicket.ticket_type
                                                    .ticket_type
                                                }}
                                              </p>
                                              <p
                                                class="mb-0 fw-bold text-muted"
                                                v-else
                                              >
                                                N/A
                                              </p>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <label class="small text-muted mb-1">
                                            <i class="ri-phone-line me-1"></i
                                            >Status
                                          </label>
                                          <div
                                            class="d-flex align-items-center"
                                          >
                                            <div
                                              class="bg-success bg-opacity-10 rounded-circle p-2 me-3"
                                            >
                                              <i
                                                class="ri-mail-line text-success"
                                              ></i>
                                            </div>
                                            <div>
                                              <p class="mb-0 fw-bold">
                                                {{
                                                  selectedTicket.status ||
                                                  "N/A"
                                                }}
                                              </p>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <label class="small text-muted mb-1">
                                            <i class="ri-phone-line me-1"></i
                                            >Issues/Concern
                                          </label>
                                          <div
                                            class="d-flex align-items-center"
                                          >
                                            <div
                                              class="bg-success bg-opacity-10 rounded-circle p-2 me-3"
                                            >
                                              <i
                                                class="ri-mail-line text-success"
                                              ></i>
                                            </div>
                                            <div>
                                              <p class="mb-0 fw-bold">
                                                {{
                                                  selectedTicket.issue_concern ||
                                                  "N/A"
                                                }}
                                              </p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div
                                    class="card border-0 shadow-sm mb-4"
                                    v-if="selectedTicket.description"
                                  >
                                    <div class="card-header bg-light">
                                      <h6 class="mb-0">
                                        <i class="ri-file-text-line me-2"></i
                                        >Description
                                      </h6>
                                    </div>
                                    <div class="card-body">
                                      <div class="bg-light rounded p-3">
                                        <p
                                          class="mb-0"
                                          style="white-space: pre-line"
                                        >
                                          {{ selectedTicket.description }}
                                        </p>
                                      </div>
                                    </div>
                                  </div>

                                  <!-- Attachments Card -->
                                  <div
                                    class="card border-0 shadow-sm"
                                    v-if="
                                      selectedTicket.attachments &&
                                      selectedTicket.attachments.length > 0
                                    "
                                  >
                                    <div class="card-header bg-light">
                                      <h6 class="mb-0">
                                        <i class="ri-attachment-line me-2"></i
                                        >Attachments
                                      </h6>
                                    </div>
                                    <div class="card-body">
                                      <div class="row g-2">
                                        <div
                                          class="col-auto"
                                          v-for="(
                                            attachment, index
                                          ) in selectedTicket.attachments"
                                          :key="index"
                                        >
                                          <div
                                            class="border rounded p-2 d-flex align-items-center"
                                          >
                                            <i class="ri-file-line me-2"></i>
                                            <span class="small">{{
                                              attachment.name
                                            }}</span>
                                            <button
                                              class="btn btn-sm btn-link ms-2"
                                            >
                                              <i class="ri-download-line"></i>
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <!-- No Data Message -->
                                  <div
                                    v-if="!selectedTicket.id"
                                    class="text-center py-5"
                                  >
                                    <div class="text-muted mb-3">
                                      <i class="ri-inbox-line fs-1"></i>
                                    </div>
                                    <p class="mb-0">No ticket selected</p>
                                  </div>
                                </div>
                              </div>

                              <!-- Modal Footer -->
                              <div class="modal-footer border-top">
                                <div
                                  class="w-100 d-flex justify-content-between align-items-center"
                                >
                                  <div>
                                    <small class="text-muted">
                                      <i class="ri-time-line me-1"></i>
                                      Last updated:
                                      {{
                                        selectedTicket.updated_at
                                          ? formatDate(
                                              selectedTicket.updated_at
                                            )
                                          : "N/A"
                                      }}
                                    </small>
                                  </div>
                                  <div>
                                    <button
                                      type="button"
                                      class="btn btn-secondary me-2"
                                      data-bs-dismiss="modal"
                                    >
                                      <i class="ri-close-line me-1"></i>Close
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
              </div>

              <!-- Resolved Tickets Tab -->
              <div class="tab-pane fade" id="resolvedTickets" role="tabpanel">
                <div class="table-responsive">
                  <table
                    class="table table-bordered table-hover table-striped align-middle mb-0"
                    style="font-size: 0.875rem"
                  >
                    <thead class="table-success">
                      <tr>
                        <th width="50" class="text-center">#</th>
                        <th width="120" class="text-center">Ticket ID</th>
                        <th>Subject</th>
                        <th width="120" class="text-center">Requester</th>
                        <th width="120" class="text-center">Date Created</th>
                        <th width="120" class="text-center">Date Resolved</th>
                        <th width="100" class="text-center">Resolution Time</th>
                        <th width="80" class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center fw-bold"></td>
                        <td class="text-center"></td>
                        <td></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center">
                          <span class="badge bg-success"></span>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-outline-success">
                            <i class="ri-eye-line"></i>
                          </button>
                        </td>
                      </tr>
                      <!-- More resolved tickets -->
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- Unresolved Tickets Tab -->
              <div class="tab-pane fade" id="unresolvedTickets" role="tabpanel">
                <div class="table-responsive">
                  <table
                    class="table table-bordered table-hover table-striped align-middle mb-0"
                    style="font-size: 0.875rem"
                  >
                    <thead class="table-warning">
                      <tr>
                        <th width="50" class="text-center">#</th>
                        <th width="120" class="text-center">Ticket ID</th>
                        <th>Subject</th>
                        <th width="120" class="text-center">Requester</th>
                        <th width="120" class="text-center">Date Created</th>
                        <th width="100" class="text-center">Priority</th>
                        <th width="100" class="text-center">Days Open</th>
                        <th width="80" class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center fw-bold">1</td>
                        <td class="text-center"></td>
                        <td></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center">
                          <span class="badge bg-danger"></span>
                        </td>
                        <td class="text-center">
                          <span class="badge bg-warning"></span>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-outline-warning">
                            <i class="ri-eye-line"></i>
                          </button>
                        </td>
                      </tr>
                      <!-- More unresolved tickets -->
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- Feedback Tickets Tab -->
              <div class="tab-pane fade" id="feedbackTickets" role="tabpanel">
                <div class="table-responsive">
                  <table
                    class="table table-bordered table-hover table-striped align-middle mb-0"
                    style="font-size: 0.875rem"
                  >
                    <thead class="table-info">
                      <tr>
                        <th width="50" class="text-center">#</th>
                        <th width="120" class="text-center">Ticket ID</th>
                        <th>Subject</th>
                        <th width="120" class="text-center">Requester</th>
                        <th width="120" class="text-center">Date Resolved</th>
                        <th width="100" class="text-center">Rating</th>
                        <th>Feedback</th>
                        <th width="80" class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center fw-bold"></td>
                        <td class="text-center"></td>
                        <td></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center">
                          <span class="badge bg-success">
                            <i class="ri-star-fill"></i>
                          </span>
                        </td>
                        <td></td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-outline-info">
                            <i class="ri-eye-line"></i>
                          </button>
                        </td>
                      </tr>
                      <!-- More feedback tickets -->
                    </tbody>
                  </table>
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
  methods: {
    viewTicket(ticket) {
      this.selectedTicket = { ...ticket };
    },
    refreshData() {
      this.getDataAllRequest();
      this.showSuccess("Data refreshed successfully!");
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

    formatDate(dateString) {
      if (!dateString) return "N/A";

      try {
        const date = new Date(dateString);

        // Format: January 28, 2026 at 2:30 PM
        const monthNames = [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ];

        const month = monthNames[date.getMonth()];
        const day = date.getDate();
        const year = date.getFullYear();

        // Format time with AM/PM
        let hours = date.getHours();
        const minutes = date.getMinutes().toString().padStart(2, "0");
        const ampm = hours >= 12 ? "PM" : "AM";

        // Convert to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // Convert 0 to 12

        return `${month} ${day}, ${year} at ${hours}:${minutes} ${ampm}`;
      } catch (error) {
        console.error("Error formatting date:", error);
        return "Invalid date";
      }
    },
    async getDataAllRequest() {
      try {
        const response = await axios.get(
          "/denrxi_ictsms/api/get/all/ticket/request",
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
        this.getDataAllRequest();
      }
    },
    showError(message) {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: message,
        confirmButtonColor: "#dc3545",
      });
    },
  },
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
      selectedTicket: {},
      technicians: [], // You'll need to populate this from your API
      searchQuery: "",
      perPage: 10,
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

  mounted() {
    this.getDataAllRequest();
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
/* Excel-like Table Styling */
.table {
  border-collapse: separate;
  border-spacing: 0;
  border: 1px solid #dee2e6;
}

.table thead th {
  background-color: #f8f9fa;
  border-bottom: 2px solid #dee2e6;
  font-weight: 600;
  color: #495057;
  text-transform: uppercase;
  font-size: 0.8rem;
  letter-spacing: 0.5px;
  padding: 12px 8px;
  white-space: nowrap;
}

.table tbody td {
  padding: 10px 8px;
  vertical-align: middle;
  border-top: 1px solid #dee2e6;
  border-right: 1px solid #f0f0f0;
}

.table tbody tr:hover {
  background-color: #f8fafc;
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(0, 0, 0, 0.02);
}

.table-bordered {
  border: 2px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}

/* Tab-specific header colors */
.table-success thead th {
  background-color: #d1e7dd;
  color: #0f5132;
}

.table-warning thead th {
  background-color: #fff3cd;
  color: #856404;
}

.table-info thead th {
  background-color: #cff4fc;
  color: #055160;
}

/* Badge styling */
.badge {
  font-weight: 500;
  padding: 4px 8px;
  font-size: 0.75rem;
}

/* Action buttons */
.btn-sm {
  padding: 4px 8px;
  font-size: 0.75rem;
}

/* Pagination styling */
.btn-group .btn {
  border-radius: 0;
}

.btn-group .btn:first-child {
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}

.btn-group .btn:last-child {
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}

/* Excel-like grid lines */
.table tbody td {
  border-right: 1px solid #f0f0f0;
}

.table tbody td:last-child {
  border-right: 1px solid #dee2e6;
}

/* Column header with sort indicators */
.table thead th.sortable {
  cursor: pointer;
  position: relative;
  padding-right: 20px;
}

.table thead th.sortable:after {
  content: "↕";
  position: absolute;
  right: 8px;
  opacity: 0.5;
  font-size: 12px;
}

/* Zebra striping for better readability */
.table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.table tbody tr:hover {
  background-color: #e8f4ff;
}

/* Frozen column effect (optional) */
.table-fixed thead th:first-child,
.table-fixed tbody td:first-child {
  position: sticky;
  left: 0;
  background-color: white;
  z-index: 10;
  box-shadow: 2px 0 5px -2px rgba(0, 0, 0, 0.1);
}

/* Flat Modal Styling */
.modal-content {
  border-radius: 12px;
  border: none;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.modal-header {
  border-radius: 12px 12px 0 0;
  padding: 1.5rem;
}

.modal-body {
  padding: 0;
}

.modal-footer {
  padding: 1rem 1.5rem;
}

/* Card styling inside modal */
.card {
  border: 1px solid #e9ecef;
  border-radius: 8px;
}

.card-header {
  background-color: #f8f9fa;
  border-bottom: 1px solid #e9ecef;
  padding: 0.75rem 1rem;
}

/* Badge enhancements */
.badge {
  font-weight: 500;
  letter-spacing: 0.3px;
}

/* Icon containers */
.bg-light {
  background-color: #f8f9fa !important;
}

.bg-primary.bg-opacity-10 {
  background-color: rgba(25, 135, 84, 0.1) !important;
}

.bg-success.bg-opacity-10 {
  background-color: rgba(25, 135, 84, 0.1) !important;
}

.bg-info.bg-opacity-10 {
  background-color: rgba(13, 202, 240, 0.1) !important;
}

.bg-warning.bg-opacity-10 {
  background-color: rgba(255, 193, 7, 0.1) !important;
}

.bg-danger.bg-opacity-10 {
  background-color: rgba(220, 53, 69, 0.1) !important;
}

/* Hover effects */
.btn-outline-primary:hover {
  transform: translateY(-1px);
  transition: all 0.2s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .modal-dialog {
    margin: 0.5rem;
  }

  .modal-body {
    padding: 1rem;
  }
}
</style>