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
                <br />
                <h5>All Ticket Request</h5>
                <br />

                <div class="table-responsive">
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
                    <tbody v-if="tickets.data && tickets.data.length > 0">
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
                        <td v-if="ticket.technician">
                          {{ ticket.technician.firstname }}
                          {{ ticket.technician.middle_initial }}.
                          {{ ticket.technician.lastname }}
                        </td>

                        <td v-else>
                          <span style="color: red">
                            No assigned technician for this ticket
                          </span>
                        </td>

                        <td class="text-center">
                          <span
                            class="badge"
                            :class="statusClass(ticket.status)"
                          >
                            {{ ticket.status }}
                          </span>
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
                            <template v-if="ticket.status === 'Pending'">
                              <button
                                class="btn btn-sm btn-outline-success"
                                @click="receiveTicket(ticket)"
                              >
                                <i class="ri-check-line"></i>
                              </button>
                            </template>
                            <template v-if="ticket.status === 'In-Progress'">
                              <button
                                class="btn btn-sm btn-outline-success"
                                @click="updateTicket(ticket)"
                                data-bs-toggle="modal"
                                data-bs-target="#updateTicketModal"
                              >
                                <i class="ri-check-line"></i>
                              </button>
                            </template>

                            <!-- Cancel Button -->
                            <button
                              class="btn btn-sm btn-outline-danger"
                              @click="cancelItem(ticket)"
                            >
                              <i class="ri-close-line"></i>
                            </button>
                          </div>
                        </td>
                      </tr>

                      <!-- Add more rows as needed -->
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="11" class="text-center py-5">
                          <i
                            class="ri-file-text-line fs-3 text-muted d-block mb-2"
                          ></i>
                          <span class="text-muted"
                            >No ticket requests found.</span
                          >
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <div
                    class="modal fade zoomIn"
                    id="updateTicketModal"
                    tabindex="-1"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                  >
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                        <div
                          class="modal-header p-3"
                          style="background-color: #198754"
                        >
                          <h5
                            class="modal-title text-white"
                            id="exampleModalLabel"
                          >
                            Update Ticket Request
                          </h5>
                          <button
                            type="button"
                            class="btn-close btn-close-white"
                            @click="closeModal"
                          ></button>
                        </div>

                        <div class="modal-body p-0">
                          <div class="p-4 border-bottom bg-light">
                            <div class="row align-items-center">
                              <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                  <div
                                    class="bg-white rounded p-2 me-3 shadow-sm"
                                    style="border: 2px solid #006747"
                                  >
                                    <i
                                      class="ri-user-settings-line fs-4"
                                      style="color: #006747"
                                    ></i>
                                  </div>
                                  <div>
                                    <small class="text-muted d-block"
                                      >TICKET NUMBER</small
                                    >
                                    <h4
                                      class="mb-0 fw-bold"
                                      style="color: #006747"
                                    >
                                      {{ selectedUpdatedTicket.helpdesk_no }}
                                    </h4>
                                    <h4
                                      class="mb-0 fw-bold"
                                      style="color: #006747"
                                    >
                                      {{ selectedUpdatedTicket.firstname }}
                                      {{
                                        selectedUpdatedTicket.middle_initial
                                      }}. {{ selectedUpdatedTicket.lastname }}
                                    </h4>
                                    <small>{{
                                      selectedUpdatedTicket.status
                                    }}</small>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div
                                  class="d-flex align-items-center justify-content-end"
                                >
                                  <div class="text-end">
                                    <small class="text-muted d-block"
                                      >Date Received</small
                                    >
                                    <span class="fw-bold">{{
                                      formatDate(
                                        selectedUpdatedTicket.date_receive
                                      )
                                    }}</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="p-4">
                            <!-- Two Column Layout -->
                            <div class="row g-4">
                              <!-- Left Column - Requester Information -->
                              <div class="row g-4 mt-0">
                                <div class="col-md-12">
                                  <label class="small text-muted mb-2 d-block">
                                    <i class="ri-user-star-line me-1"></i>Assign
                                    Technician
                                  </label>
                                  <div class="d-flex align-items-center">
                                    <div
                                      class="bg-light rounded p-2 me-3 shadow-sm"
                                      style="border: 1px solid #dee2e6"
                                    >
                                      <img
                                        v-if="
                                          selectedUpdatedTicket.technician &&
                                          selectedUpdatedTicket.technician
                                            .firstname &&
                                          selectedUpdatedTicket.technician
                                            .lastname &&
                                          selectedUpdatedTicket.technician.photo
                                        "
                                        :src="`/denrxi_ictsms/public/user/profile/${selectedUpdatedTicket.technician.firstname}_${selectedUpdatedTicket.technician.lastname}/${selectedUpdatedTicket.technician.photo}`"
                                        class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow"
                                        alt="user-profile-image"
                                      />
                                      <!-- Add a fallback when conditions aren't met -->
                                      <img
                                        v-else
                                        :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(
                                          getTechnicianFullName(
                                            selectedUpdatedTicket.technician ||
                                              {}
                                          )
                                        )}&background=random&color=fff`"
                                        class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow"
                                        alt="user-profile-image"
                                      />
                                    </div>

                                    <!-- Technician name display -->
                                    <div>
                                      <h6
                                        class="mb-1"
                                        v-if="selectedUpdatedTicket.technician"
                                      >
                                        {{
                                          getTechnicianFullName(
                                            selectedUpdatedTicket.technician
                                          )
                                        }}
                                      </h6>
                                      <h6 class="mb-1 text-muted" v-else>
                                        No Technician Assigned
                                      </h6>
                                      <small
                                        class="text-muted"
                                        v-if="selectedUpdatedTicket.technician"
                                      >
                                        Technician
                                      </small>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="mb-3">
                                <label class="small text-muted mb-2 d-block"
                                  >Select New Status</label
                                >
                                <select
                                  class="form-control"
                                  v-model="formData.status"
                                >
                                  <option value="">-- Select Status --</option>
                                  <option value="Resolved">✅ Resolved</option>
                                  <option value="Unresolved">
                                    ❌ Unresolved
                                  </option>
                                </select>
                                <small class="text-muted mt-1 d-block">
                                  <i class="ri-information-line me-1"></i>
                                  Changing status will update the ticket
                                  workflow
                                </small>
                              </div>
                            </div>

                            <!-- TECHNICIAN ASSIGNMENT SECTION - Added here -->

                            <div class="mt-4">
                              <label class="small text-muted mb-2 d-block">
                                <i class="ri-chat-3-line me-1"></i>Resolution
                                Notes / Remarks
                              </label>
                              <textarea
                                v-model="formData.resolution"
                                class="form-control"
                                rows="4"
                                placeholder="Enter resolution details, steps taken, or any important remarks..."
                                style="resize: none"
                              ></textarea>
                              <div
                                class="d-flex justify-content-between align-items-center mt-2"
                              >
                                <small class="text-muted">
                                  <i class="ri-information-line me-1"></i>
                                  Add detailed notes about the resolution or
                                  status change
                                </small>
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
                            type="button"
                            class="btn text-white"
                            style="background-color: #006747"
                            @click="
                              updateTicketRequest(selectedUpdatedTicket.id)
                            "
                          >
                            <i class="ri-save-line me-1"></i>
                            Update Ticket Request
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

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
                                                  selectedTicket.status || "N/A"
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
                <br />
                <h5>Resovled Ticket</h5>
                <br />
                <div class="table-responsive">
                  <div class="row g-3 align-items-center">
                    <div class="col-md-3">
                      <div class="input-group input-group">
                        <span class="input-group-text bg-light">
                          <i class="ri-list-settings-line"></i>
                        </span>
                        <select
                          class="form-control form-control"
                          v-model="perPage"
                          @change="getDataAllResolved"
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
                          @input="getDataAllResolved"
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
                          @click="refreshDataResolved"
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
                          <i class="ri-user-line me-1"></i> Requester
                        </th>
                        <th width="250" class="text-center">
                          <i class="ri-user-line me-1"></i> Office
                        </th>

                        <th width="120" class="text-center">
                          <i class="ri-folder-line me-1"></i> Date Received
                        </th>
                        <th width="120" class="text-center">
                          <i class="ri-folder-line me-1"></i> Date Acted
                        </th>
                        <th width="120" class="text-center">
                          <i class="ri-folder-line me-1"></i> Technician Assign
                        </th>
                        <th width="50" class="text-center">
                          <i class="ri-folder-line me-1"></i> Actual Turn Around
                          Time
                        </th>
                        <th width="100" class="text-center">
                          <i class="ri-information-line me-1"></i> Status
                        </th>
                        <th width="80" class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody v-if="resolveds.data && resolveds.data.length > 0">
                      <tr
                        v-for="(resolved, index) in resolveds.data"
                        :key="resolved.id"
                      >
                        <td class="text-center fw-bold">
                          {{
                            (resolveds.current_page - 1) * resolveds.per_page +
                            index +
                            1
                          }}
                        </td>
                        <td>
                          <span class="badge bg-secondary">{{
                            resolved.helpdesk_no
                          }}</span>
                        </td>

                        <td class="text-center">
                          {{ resolved.firstname }}
                          {{ resolved.middle_initial }}.
                          {{ resolved.lastname }}
                        </td>
                        <td class="text-center">
                          {{ resolved.office.office }}
                        </td>

                        <td class="text-center">
                          {{ formatDate(resolved.date_receive) }}
                        </td>
                        <td class="text-center">
                          {{ formatDate(resolved.date_acted) }}
                        </td>
                        <td v-if="resolved.technician">
                          {{ resolved.technician.firstname }}
                          {{ resolved.technician.middle_initial }}.
                          {{ resolved.technician.lastname }}
                        </td>
                        <td class="text-center">
                          {{
                            calculateWorkingDays(
                              resolved.date_receive,
                              resolved.date_acted
                            )
                          }}
                        </td>

                        <td class="text-center">
                          <span
                            class="badge"
                            :class="statusClass(resolved.status)"
                          >
                            {{ resolved.status }}
                          </span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group" role="group">
                            <!-- View Info Button -->
                            <button
                              class="btn btn-sm btn-outline-primary"
                              @click="viewTicket(resolved)"
                              data-bs-toggle="modal"
                              data-bs-target="#viewTicketModal"
                              title="View Information"
                            >
                              <i class="ri-information-line me-1"></i> View
                            </button>

                            <!-- Print Form Button -->
                           
                          </div>
                        </td>
                      </tr>

                      <!-- Add more rows as needed -->
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="11" class="text-center py-5">
                          <i
                            class="ri-file-text-line fs-3 text-muted d-block mb-2"
                          ></i>
                          <span class="text-muted"
                            >No ticket requests found.</span
                          >
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <div v-if="resolveds.total > 0" class="card-footer bg-white">
                    <div class="row align-items-center">
                      <div class="col-md-6">
                        <span class="text-muted small">
                          <i class="ri-file-list-line me-1"></i>
                          Showing {{ resolveds.from }} to {{ resolveds.to }} of
                          {{ resolveds.total }} entries
                        </span>
                      </div>
                      <div class="col-md-6">
                        <nav class="float-end">
                          <ul class="pagination pagination-sm mb-0">
                            <li
                              class="page-item"
                              :class="{
                                disabled: resolveds.current_page === 1,
                              }"
                            >
                              <button
                                class="page-link"
                                @click="changePageResolved(1)"
                                title="First"
                              >
                                <i class="ri-skip-back-line"></i>
                              </button>
                            </li>
                            <li
                              class="page-item"
                              :class="{
                                disabled: resolveds.current_page === 1,
                              }"
                            >
                              <button
                                class="page-link"
                                @click="
                                  changePageResolved(resolveds.current_page - 1)
                                "
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
                                active: page === resolveds.current_page,
                              }"
                            >
                              <button
                                class="page-link"
                                @click="changePageResolved(page)"
                              >
                                {{ page }}
                              </button>
                            </li>

                            <li
                              class="page-item"
                              :class="{
                                disabled:
                                  resolveds.current_page ===
                                  resolveds.last_page,
                              }"
                            >
                              <button
                                class="page-link"
                                @click="
                                  changePageResolved(resolveds.current_page + 1)
                                "
                                title="Next"
                              >
                                <i class="ri-arrow-right-s-line"></i>
                              </button>
                            </li>
                            <li
                              class="page-item"
                              :class="{
                                disabled:
                                  resolveds.current_page ===
                                  resolveds.last_page,
                              }"
                            >
                              <button
                                class="page-link"
                                @click="changePageResolved(resolveds.last_page)"
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
                                                  selectedTicket.status || "N/A"
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

              <!-- Unresolved Tickets Tab -->
              <div class="tab-pane fade" id="unresolvedTickets" role="tabpanel">
                <h5>Unresolved Tickets</h5>
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
                          @change="getDataAllUnResolved"
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
                          @input="getDataAllUnResolved"
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
                          @click="refreshDataUnResolved"
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
                          <i class="ri-user-line me-1"></i> Requester
                        </th>
                        <th width="250" class="text-center">
                          <i class="ri-user-line me-1"></i> Office
                        </th>

                        <th width="120" class="text-center">
                          <i class="ri-folder-line me-1"></i> Date Received
                        </th>
                        <th width="120" class="text-center">
                          <i class="ri-folder-line me-1"></i> Date Acted
                        </th>
                        <th width="120" class="text-center">
                          <i class="ri-folder-line me-1"></i> Technician Assign
                        </th>
                        <th width="50" class="text-center">
                          <i class="ri-folder-line me-1"></i> Actual Turn Around
                          Time
                        </th>
                        <th width="100" class="text-center">
                          <i class="ri-information-line me-1"></i> Status
                        </th>
                        <th width="80" class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody
                      v-if="unresolveds.data && unresolveds.data.length > 0"
                    >
                      <tr
                        v-for="(unresolved, index) in unresolveds.data"
                        :key="unresolved.id"
                      >
                        <td class="text-center fw-bold">
                          {{
                            (unresolveds.current_page - 1) *
                              unresolveds.per_page +
                            index +
                            1
                          }}
                        </td>
                        <td>
                          <span class="badge bg-secondary">{{
                            unresolved.helpdesk_no
                          }}</span>
                        </td>

                        <td class="text-center">
                          {{ unresolved.firstname }}
                          {{ unresolved.middle_initial }}.
                          {{ unresolved.lastname }}
                        </td>
                        <td class="text-center">
                          {{ unresolved.office.office }}
                        </td>

                        <td class="text-center">
                          {{ formatDate(unresolved.date_receive) }}
                        </td>
                        <td class="text-center">
                          {{ formatDate(unresolved.date_acted) }}
                        </td>
                        <td v-if="unresolved.technician">
                          {{ unresolved.technician.firstname }}
                          {{ unresolved.technician.middle_initial }}.
                          {{ unresolved.technician.lastname }}
                        </td>
                        <td class="text-center">
                          {{
                            calculateWorkingDays(
                              unresolved.date_receive,
                              unresolved.date_acted
                            )
                          }}
                        </td>

                        <td class="text-center">
                          <span
                            class="badge"
                            :class="statusClass(unresolved.status)"
                          >
                            {{ unresolved.status }}
                          </span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group" role="group">
                            <!-- View Info Button -->
                            <button
                              class="btn btn-sm btn-outline-primary"
                              @click="viewTicket(unresolved)"
                              data-bs-toggle="modal"
                              data-bs-target="#viewTicketModal"
                              title="View Information"
                            >
                              <i class="ri-information-line me-1"></i> View 
                            </button>

                        
                           
                          </div>
                        </td>
                      </tr>

                      <!-- Add more rows as needed -->
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="11" class="text-center py-5">
                          <i
                            class="ri-file-text-line fs-3 text-muted d-block mb-2"
                          ></i>
                          <span class="text-muted"
                            >No Unresolved Tickets Found.</span
                          >
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <div
                    v-if="unresolveds.total > 0"
                    class="card-footer bg-white"
                  >
                    <div class="row align-items-center">
                      <div class="col-md-6">
                        <span class="text-muted small">
                          <i class="ri-file-list-line me-1"></i>
                          Showing {{ unresolveds.from }} to
                          {{ unresolveds.to }} of
                          {{ unresolveds.total }} entries
                        </span>
                      </div>
                      <div class="col-md-6">
                        <nav class="float-end">
                          <ul class="pagination pagination-sm mb-0">
                            <li
                              class="page-item"
                              :class="{
                                disabled: unresolveds.current_page === 1,
                              }"
                            >
                              <button
                                class="page-link"
                                @click="changePageUnResolveds(1)"
                                title="First"
                              >
                                <i class="ri-skip-back-line"></i>
                              </button>
                            </li>
                            <li
                              class="page-item"
                              :class="{
                                disabled: unresolveds.current_page === 1,
                              }"
                            >
                              <button
                                class="page-link"
                                @click="
                                  changePageUnResolveds(
                                    unresolveds.current_page - 1
                                  )
                                "
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
                                active: page === unresolveds.current_page,
                              }"
                            >
                              <button
                                class="page-link"
                                @click="changePageUnResolveds(page)"
                              >
                                {{ page }}
                              </button>
                            </li>

                            <li
                              class="page-item"
                              :class="{
                                disabled:
                                  unresolveds.current_page ===
                                  unresolveds.last_page,
                              }"
                            >
                              <button
                                class="page-link"
                                @click="
                                  changePageUnResolveds(
                                    unresolveds.current_page + 1
                                  )
                                "
                                title="Next"
                              >
                                <i class="ri-arrow-right-s-line"></i>
                              </button>
                            </li>
                            <li
                              class="page-item"
                              :class="{
                                disabled:
                                  unresolveds.current_page ===
                                  unresolveds.last_page,
                              }"
                            >
                              <button
                                class="page-link"
                                @click="
                                  changePageUnResolveds(unresolveds.last_page)
                                "
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
                                                  selectedTicket.status || "N/A"
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

              <!-- Feedback Tickets Tab -->
              <div class="tab-pane fade" id="feedbackTickets" role="tabpanel">
                <h5>Feedbacks</h5>
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
                        @change="getDataAllUnResolved"
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
                        @input="getDataAllFeedbacks"
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
                        @click="refreshDataFeedbacks"
                      >
                        <i class="ri-refresh-line"></i> Refresh Data
                      </button>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table
                    class="table table-bordered table-hover table-striped align-middle mb-0"
                    style="font-size: 0.875rem"
                  >
                    <thead class="table-info">
                      <tr>
                        <th width="50" class="text-center">#</th>
                        <th width="200" class="text-center">Helpdesk #</th>
                        <th width="130">Category</th>
                        <th width="250">Subject</th>
                        <th width="200" class="text-center">Requester</th>
                        <th width="180" class="text-center">Date Acted</th>
                        <th width="100" class="text-center">Rating</th>
                        <th>Feedback</th>
                          <th>Date Feedback</th>
                        <th width="80" class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody v-if="feedbacks.data && feedbacks.data.length > 0">
                      <tr
                        v-for="(feedback, index) in feedbacks.data"
                        :key="feedback.id"
                      >
                        <td class="text-center fw-bold">
                          {{
                            (feedbacks.current_page - 1) * feedbacks.per_page +
                            index +
                            1
                          }}
                        </td>
                        <td>{{ feedback.helpdesk_no }}</td>
                        <td>{{ feedback.ticket_type.ticket_type }}</td>

                        <td>{{ feedback.ticket_category.ticket_category }}</td>
                        <td>
                          {{ feedback.firstname }}
                          {{ feedback.middle_initial }}. {{ feedback.lastname }}
                        </td>
                        <td>{{ feedback.date_acted }}</td>
                        <td>
                          {{
                            feedback.rate
                              ? feedback.rate.rate
                              : "No Data Encoded"
                          }}
                        </td>

                        <td>
                          {{
                            feedback.rate
                              ? feedback.rate.feedback_remarks
                              : "No Data Encoded"
                          }}
                        </td>
                         <td>
                          {{
                            feedback.rate
                              ? feedback.rate.date_feedback
                              : "No Data Encoded"
                          }}
                        </td>
                        <td class="text-center">
                          <button
                              class="btn btn-sm btn-outline-success"
                              @click="printTicketForm(feedback.id)"
                              title="Print Form"
                            >
                              <i class="ri-printer-line me-1"></i> Print
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
    printTicketForm(id) {
      const url = "/denrxi_ictsms/print/forms/" + id;
      window.open(url, "_blank"); // opens in a new tab
    },

    calculateWorkingDays(startDate, endDate) {
      if (!startDate || !endDate) return "N/A";

      const start = new Date(startDate);
      const end = new Date(endDate);

      // Validate dates
      if (isNaN(start.getTime()) || isNaN(end.getTime())) return "Invalid Date";

      // Swap if start date is after end date
      if (start > end) {
        [start, end] = [end, start];
      }

      let workingDays = 0;
      const current = new Date(start);

      // Loop through each day
      while (current <= end) {
        const dayOfWeek = current.getDay();
        // Skip Saturdays (6) and Sundays (0)
        if (dayOfWeek !== 0 && dayOfWeek !== 6) {
          workingDays++;
        }
        // Move to next day
        current.setDate(current.getDate() + 1);
      }

      return `${workingDays} day${workingDays !== 1 ? "s" : ""}`;
    },

    getTechnicianFullName(technician) {
      if (!technician) return "N/A";

      let fullName = technician.firstname || "";

      if (technician.middle_initial) {
        fullName += " " + technician.middle_initial + ".";
      }

      if (technician.lastname) {
        fullName += " " + technician.lastname;
      }

      return fullName.trim();
    },

    statusClass(status) {
      const statusMap = {
        Pending: "bg-warning",
        "In-Progress": "bg-primary",
        Resolved: "bg-primary",
        UnResolved: "bg-warning",
      };
      return statusMap[status] || "bg-light text-dark";
    },
    async receiveTicket(ticket) {
      try {
        const result = await Swal.fire({
          title: "Receive Ticket?",
          html: `
        <div style="font-size:15px">
          <p>Are you sure you want to receive this ticket?</p>
          <p class="mt-2">
            <strong>Ticket No:</strong>
            <span class="badge bg-primary">${ticket.helpdesk_no}</span>
          </p>
          <p>
            <strong>Requester:</strong>
            ${ticket.firstname} ${ticket.middle_initial || ""} ${
            ticket.lastname
          }
          </p>
          ${
            ticket.subject
              ? `<p><strong>Subject:</strong> ${ticket.subject}</p>`
              : ""
          }
        </div>
      `,
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Yes, Receive",
          cancelButtonText: "Cancel",
          confirmButtonColor: "#198754",
          cancelButtonColor: "#6c757d",
          reverseButtons: true,
          focusCancel: true,
        });

        if (!result.isConfirmed) return;

        // Show loading state
        Swal.fire({
          title: "Processing...",
          html: "Please wait while we assign the ticket to you.",
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });

        await new Promise((resolve) => setTimeout(resolve, 2000));

        try {
          // 👉 call API
          const response = await axios.post(
            `/denrxi_ictsms/api/get/data/receive/${ticket.id}`
          );

          // Close loading modal first
          Swal.close();

          // Check if success
          if (response.data.success) {
            // 👉 success alert, wait for OK click
            await Swal.fire({
              icon: "success",
              title: "Ticket Received",
              html: `
            <div class="text-center">
              <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
              <h5>Successfully Assigned</h5>
              <p>Ticket <strong>${
                ticket.helpdesk_no
              }</strong> is now assigned to you.</p>
              <div class="mt-3">
                <p class="text-muted mb-1">
                  <i class="fas fa-user-check me-2"></i>
                  Received by: <strong>${
                    response.data.received_by || "You"
                  }</strong>
                </p>
                <p class="text-muted">
                  <i class="fas fa-clock me-2"></i>
                  At: ${new Date(response.data.received_at).toLocaleString()}
                </p>
              </div>
            </div>
          `,
              confirmButtonText: "Continue to Tickets",
              confirmButtonColor: "#198754",
            });

            // 👉 redirect after clicking OK
            window.location.href = "/denrxi_ictsms/ticket";
          }
        } catch (error) {
          // Close loading modal
          Swal.close();

          if (error.response) {
            const { status, data } = error.response;

            // Handle specific error cases
            if (status === 409 && data.already_assigned) {
              // Ticket already assigned to someone else
              await Swal.fire({
                icon: "warning",
                title: "Ticket Already Assigned",
                html: `
              <div style="text-align: left;">
                <p class="mb-3">
                  <i class="fas fa-user-check text-warning me-2"></i>
                  This ticket has already been assigned to another technician.
                </p>
                <div class="alert alert-warning">
                  <p class="mb-1"><strong>Assigned To:</strong> ${
                    data.received_by
                  }</p>
                  <p class="mb-1"><strong>Assigned On:</strong> ${new Date(
                    data.received_at
                  ).toLocaleString()}</p>
                  ${
                    data.technician_email
                      ? `<p class="mb-0"><strong>Email:</strong> ${data.technician_email}</p>`
                      : ""
                  }
                </div>
                <p class="text-muted mt-2 small">
                  <i class="fas fa-info-circle me-1"></i>
                  Current status: <span class="badge bg-secondary">${
                    data.current_status
                  }</span>
                </p>
              </div>
            `,
                confirmButtonText: "View Available Tickets",
                confirmButtonColor: "#6c757d",
              });

              // Refresh to show updated ticket status
              window.location.reload();
            } else if (status === 404) {
              await Swal.fire({
                icon: "error",
                title: "Ticket Not Found",
                text:
                  data.error ||
                  "The ticket you're trying to receive no longer exists.",
                confirmButtonText: "OK",
              });
            } else {
              await Swal.fire({
                icon: "error",
                title: "Error",
                text:
                  data.error ||
                  "Something went wrong while receiving the ticket.",
                confirmButtonText: "OK",
              });
            }
          } else if (error.request) {
            // Network error
            const retryResult = await Swal.fire({
              icon: "error",
              title: "Network Error",
              text: "Unable to connect to server. Please check your internet connection.",
              confirmButtonText: "Retry",
              showCancelButton: true,
              cancelButtonText: "Cancel",
            });

            if (retryResult.isConfirmed) {
              this.receiveTicket(ticket);
            }
          } else {
            // Other errors
            await Swal.fire({
              icon: "error",
              title: "Error",
              text: "Something went wrong while receiving the ticket.",
              confirmButtonText: "OK",
            });
          }
        }
      } catch (error) {
        console.error("Error in receiveTicket:", error);

        // Show generic error if something unexpected happens
        Swal.fire({
          icon: "error",
          title: "Unexpected Error",
          text: "An unexpected error occurred. Please try again.",
          confirmButtonText: "OK",
        });
      }
    },

    async updateTicketRequest(id) {
      if (
        !this.formData.status ||
        this.formData.status === "Required" ||
        !this.formData.resolution ||
        this.formData.resolution === "Required"
      ) {
        Swal.fire({
          icon: "warning",
          title: "Missing Information",
          text: "Please select a Status and Enter a resolution before updating the ticket.",
          confirmButtonColor: "#198754",
        });
        return;
      }

      try {
        // Get form data
        const status = this.formData.status;
        const resolution = this.formData.resolution || "";

        // Create the confirmation message with ticket details
        const confirmationHtml = `
      <div style="font-size:15px">
        <p class="mb-4">Are you sure you want to update this ticket?</p>
        
        <div class="ticket-summary mb-4 p-3 border rounded bg-light">
          <div class="d-flex align-items-center mb-3">
            <div>
              <small class="text-muted">TICKET NUMBER</small>
              <h5 class="mb-1 fw-bold" style="color: #006747">${
                this.selectedUpdatedTicket.helpdesk_no
              }</h5>
            
            </div>
          </div>
          
          <div class="row">
            <div class="col-6">
              <p class="mb-2">
                <strong><i class="ri-user-line me-1"></i>Requester:</strong><br>
                <span class="text-dark">
                  ${this.selectedUpdatedTicket.firstname} ${
          this.selectedUpdatedTicket.middle_initial || ""
        } ${this.selectedUpdatedTicket.lastname}
                </span>
              </p>
            </div>
            <div class="col-6">
              <p class="mb-2">
                <strong><i class="ri-calendar-line me-1"></i>Date Received:</strong><br>
                <span class="text-dark">${this.formatDate(
                  this.selectedUpdatedTicket.date_receive
                )}</span>
              </p>
            </div>
          </div>
        </div>

        <div class="status-change-section mb-4">
          <h6 class="border-bottom pb-2 mb-3 fw-bold">STATUS UPDATE</h6>
          <div class="d-flex align-items-center justify-content-between">
            <div class="text-center">
              <p class="small text-muted mb-1">Current Status</p>
              <span class="badge ${
                this.selectedUpdatedTicket.status === "Resolved"
                  ? "bg-success"
                  : this.selectedUpdatedTicket.status === "Unresolved"
                  ? "bg-danger"
                  : "bg-warning"
              } px-3 py-2 fs-6">
                ${this.selectedUpdatedTicket.status}
              </span>
            </div>
            <div class="mx-3">
              <i class="ri-arrow-right-line fs-3 text-muted"></i>
            </div>
            <div class="text-center">
              <p class="small text-muted mb-1">New Status</p>
              <span class="badge ${
                status === "Resolved" ? "bg-success" : "bg-danger"
              } px-3 py-2 fs-6">
                ${status}
              </span>
            </div>
          </div>
        </div>

        ${
          resolution
            ? `
        <div class="resolution-section">
          <h6 class="border-bottom pb-2 mb-3 fw-bold">
            <i class="ri-chat-3-line me-1"></i>RESOLUTION NOTES
          </h6>
          <div class="alert border p-3" style="font-size: 14px; max-height: 150px; overflow-y: auto;">
            <div class="d-flex">
              <div class="me-2">
                <i class="ri-chat-quote-line text-muted"></i>
              </div>
              <div class="flex-grow-1">
                ${resolution}
              </div>
            </div>
          </div>
        </div>
        `
            : ""
        }
      </div>
    `;

        const result = await Swal.fire({
          title: "Update Ticket Request?",
          html: confirmationHtml,
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Yes, Update",
          cancelButtonText: "Cancel",
          confirmButtonColor: "#006747",
          cancelButtonColor: "#6c757d",
          reverseButtons: true,
          focusCancel: true,
          width: "600px",
          customClass: {
            popup: "border border-2 border-success",
            title: "text-success fw-bold",
          },
        });

        if (!result.isConfirmed) return;

        // Show loading state
        Swal.fire({
          title: "Processing...",
          html: "Please wait while we update the ticket.",
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          },
          customClass: {
            popup: "border border-2 border-info",
          },
        });

        // 👉 First: Wait for 2 seconds
        await new Promise((resolve) => setTimeout(resolve, 2000));

        // Prepare data for API call
        const formData = {
          ticket_id: id,
          status: status,
          resolution: resolution,
          date_acted: new Date().toISOString().slice(0, 19).replace("T", " "),
          updated_by: "current_user_id",
        };

        try {
          // 👉 call API to update ticket
          const response = await axios.post(
            `/denrxi_ictsms/api/get/update/ticket/request/${id}`,
            formData
          );

          // Close loading modal
          Swal.close();

          // Check if success
          if (response.data.success) {
            // 👉 success alert
            await Swal.fire({
              icon: "success",
              title: "Ticket Updated Successfully",
              html: `
            <div class="text-center">
              <div class="success-icon mb-3">
                <i class="ri-checkbox-circle-fill fs-1" style="color: #28a745"></i>
              </div>
              
              <div class="alert alert-success border-success bg-success-subtle mb-4">
                <h5 class="mb-2">
                  <i class="ri-ticket-line me-2"></i>
                  ${this.selectedUpdatedTicket.helpdesk_no}
                </h5>
                <p class="mb-0">Ticket has been successfully updated</p>
              </div>
              
              <div class="ticket-details text-start">
                <div class="row mb-3">
                  <div class="col-6">
                    <p class="mb-1 text-muted">
                      <i class="ri-user-line me-1"></i>
                      <small>Requester</small>
                    </p>
                    <p class="fw-bold">
                      ${this.selectedUpdatedTicket.firstname} ${
                this.selectedUpdatedTicket.middle_initial || ""
              } ${this.selectedUpdatedTicket.lastname}
                    </p>
                  </div>
                  <div class="col-6">
                    <p class="mb-1 text-muted">
                      <i class="ri-calendar-line me-1"></i>
                      <small>Date Acted</small>
                    </p>
                    <p class="fw-bold">${new Date().toLocaleString()}</p>
                  </div>
                </div>
                
                <div class="status-update mb-3">
                  <p class="mb-1 text-muted">
                    <i class="ri-clipboard-line me-1"></i>
                    <small>New Status</small>
                  </p>
                  <span class="badge ${
                    status === "Resolved" ? "bg-success" : "bg-danger"
                  } px-3 py-2 fs-6">
                    <i class="ri-check-line me-1"></i>${status}
                  </span>
                </div>
                
                ${
                  resolution
                    ? `
                <div class="resolution-notes">
                  <p class="mb-1 text-muted">
                    <i class="ri-sticky-note-line me-1"></i>
                    <small>Resolution Notes</small>
                  </p>
                  <div class="alert alert-light border p-2" style="font-size: 14px;">
                    ${resolution}
                  </div>
                </div>
                `
                    : ""
                }
              </div>
            </div>
          `,
              confirmButtonText: "Continue",
              confirmButtonColor: "#006747",
              width: "550px",
              customClass: {
                popup: "border border-2 border-success",
                title: "text-success fw-bold",
              },
            });

            // 👉 Close modal and refresh data
            this.closeModal();
            (this.formData.status = ""),
              (this.formData.resolution = ""),
              this.getDataAllRequest();
          }
        } catch (error) {
          // Close loading modal
          Swal.close();

          if (error.response) {
            const { status, data } = error.response;

            // Handle specific error cases
            if (status === 400) {
              // Validation error
              await Swal.fire({
                icon: "error",
                title: "Validation Error",
                html: `
              <div class="text-start">
                <div class="alert alert-danger border-danger bg-danger-subtle mb-3">
                  <h6 class="mb-1">
                    <i class="ri-error-warning-line me-2"></i>
                    Please correct the following errors:
                  </h6>
                </div>
                <ul class="list-group">
                  ${Object.values(data.errors || {})
                    .map(
                      (error) => `
                      <li class="list-group-item border-0 py-2">
                        <i class="ri-close-circle-fill text-danger me-2"></i>
                        ${error}
                      </li>
                    `
                    )
                    .join("")}
                </ul>
              </div>
            `,
                confirmButtonText: "OK",
                confirmButtonColor: "#6c757d",
                width: "500px",
              });
            } else if (status === 404) {
              await Swal.fire({
                icon: "error",
                title: "Ticket Not Found",
                html: `
              <div class="text-center">
                <i class="ri-search-eye-line fs-1 text-danger mb-3"></i>
                <p class="mb-2">The ticket you're trying to update no longer exists.</p>
                <div class="alert alert-warning mt-3">
                  <p class="mb-1"><strong>Ticket Number:</strong> ${
                    this.selectedUpdatedTicket.helpdesk_no
                  }</p>
                  <p class="mb-0"><strong>Status:</strong> ${
                    data.error || "Not found"
                  }</p>
                </div>
              </div>
            `,
                confirmButtonText: "OK",
                confirmButtonColor: "#6c757d",
              });
            } else {
              await Swal.fire({
                icon: "error",
                title: "Update Failed",
                html: `
              <div class="text-center">
                <i class="ri-close-circle-fill fs-1 text-danger mb-3"></i>
                <p class="mb-3">${
                  data.error ||
                  "Something went wrong while updating the ticket."
                }</p>
                <div class="alert alert-light border">
                  <p class="mb-1"><small class="text-muted">Ticket:</small> ${
                    this.selectedUpdatedTicket.helpdesk_no
                  }</p>
                  <p class="mb-0"><small class="text-muted">Attempted:</small> ${new Date().toLocaleTimeString()}</p>
                </div>
              </div>
            `,
                confirmButtonText: "OK",
                confirmButtonColor: "#6c757d",
              });
            }
          } else if (error.request) {
            // Network error
            const retryResult = await Swal.fire({
              icon: "error",
              title: "Network Connection Error",
              html: `
            <div class="text-center">
              <i class="ri-wifi-off-line fs-1 text-danger mb-3"></i>
              <p class="mb-3">Unable to connect to server. Please check your internet connection.</p>
              <div class="alert alert-light border">
                <p class="mb-1">
                  <i class="ri-information-line me-1"></i>
                  Ensure you are connected to the network and try again.
                </p>
              </div>
            </div>
          `,
              confirmButtonText: "Retry",
              showCancelButton: true,
              cancelButtonText: "Cancel",
              confirmButtonColor: "#006747",
              cancelButtonColor: "#6c757d",
              width: "500px",
            });

            if (retryResult.isConfirmed) {
              this.updateTicketRequest(id);
            }
          } else {
            // Other errors
            await Swal.fire({
              icon: "error",
              title: "Unexpected Error",
              html: `
            <div class="text-center">
              <i class="ri-bug-line fs-1 text-danger mb-3"></i>
              <p class="mb-3">Something went wrong while updating the ticket.</p>
              <div class="alert alert-light border small">
                <p class="mb-1"><strong>Error:</strong> ${
                  error.message || "Unknown error"
                }</p>
                <p class="mb-0"><strong>Time:</strong> ${new Date().toLocaleTimeString()}</p>
              </div>
            </div>
          `,
              confirmButtonText: "OK",
              confirmButtonColor: "#6c757d",
            });
          }
        }
      } catch (error) {
        console.error("Error in updateTicketRequest:", error);

        // Show generic error
        await Swal.fire({
          icon: "error",
          title: "Unexpected Error",
          html: `
        <div class="text-center">
          <i class="ri-alarm-warning-line fs-1 text-danger mb-3"></i>
          <p class="mb-3">An unexpected error occurred. Please try again.</p>
          <div class="alert alert-light border small">
            <p class="mb-0">If the problem persists, contact system administrator.</p>
          </div>
        </div>
      `,
          confirmButtonText: "OK",
          confirmButtonColor: "#6c757d",
        });
      }
    },

    viewTicket(ticket) {
      this.selectedTicket = { ...ticket };
    },
    updateTicket(ticket) {
      this.selectedUpdatedTicket = { ...ticket };
    },
    closeModal() {
      $("#updateTicketModal").modal("hide");
      this.formData.status = "";
      this.formData.resolution = "";
    },
    refreshData() {
      this.getDataAllRequest();
      this.showSuccess("Data refreshed successfully!");
    },
    refreshDataResolved() {
      this.getDataAllResolved();
      this.showSuccess("Data refreshed successfully!");
    },
    refreshDataFeedbacks() {
      this.getDataAllFeedbacks();
      this.showSuccess("Data refreshed successfully!");
    },
    refreshDataUnResolved() {
      this.getDataAllUnResolved();
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
    async getDataAllResolved() {
      try {
        const response = await axios.get(
          "/denrxi_ictsms/api/get/all/resolved/ticket",
          {
            params: {
              page: this.resolveds.current_page,
              per_page: this.perPage,
              search: this.searchQuery,
            },
          }
        );

        this.resolveds = response.data.data;
      } catch (error) {
        this.showError("Failed to load data. Please try again.");
      }
    },
    async getDataAllUnResolved() {
      try {
        const response = await axios.get(
          "/denrxi_ictsms/api/get/all/unresolved/ticket",
          {
            params: {
              page: this.unresolveds.current_page,
              per_page: this.perPage,
              search: this.searchQuery,
            },
          }
        );

        this.unresolveds = response.data.data;
      } catch (error) {
        this.showError("Failed to load data. Please try again.");
      }
    },
    async getDataAllFeedbacks() {
      try {
        const response = await axios.get(
          "/denrxi_ictsms/api/get/all/feedback",
          {
            params: {
              page: this.feedbacks.current_page,
              per_page: this.perPage,
              search: this.searchQuery,
            },
          }
        );

        this.feedbacks = response.data.data;
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
    changePageResolveds(page) {
      if (page >= 1 && page <= this.resolveds.last_page) {
        this.resolveds.current_page = page;
        this.getDataAllResolved();
      }
    },
    changePageUnResolveds(page) {
      if (page >= 1 && page <= this.unresolveds.last_page) {
        this.unresolveds.current_page = page;
        this.getDataAllUnResolved();
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
      formData: {
        id: "",
        status: "",
        resolution: "",
      },
      tickets: {
        data: [],
        current_page: 1,
        from: 1,
        to: 1,
        last_page: 1,
        per_page: 10,
        total: 0,
      },
      feedbacks: {
        data: [],
        current_page: 1,
        from: 1,
        to: 1,
        last_page: 1,
        per_page: 10,
        total: 0,
      },
      resolveds: {
        data: [],
        current_page: 1,
        from: 1,
        to: 1,
        last_page: 1,
        per_page: 10,
        total: 0,
      },
      unresolveds: {
        data: [],
        current_page: 1,
        from: 1,
        to: 1,
        last_page: 1,
        per_page: 10,
        total: 0,
      },
      selectedTicket: {},
      selectedUpdatedTicket: {},
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
    pages_resolved() {
      const pages = [];
      const total = this.resolveds.last_page;
      const current = this.resolveds.current_page;
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
    this.getDataAllResolved();
    this.getDataAllUnResolved();
    this.getDataAllFeedbacks();
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