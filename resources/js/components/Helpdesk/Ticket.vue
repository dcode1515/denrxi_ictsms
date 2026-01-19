<template>
  <div>
    <header class="denr-header">
      <div class="container">
        <div class="d-flex align-items-center">
          <div class="denr-logo">
            <i class="fas fa-tree denr-logo-icon"></i>
          </div>
          <div class="header-title">
            <h1>DENR REGION XI</h1>
            <p>ICT Service Management System - Ticketing Portal</p>
          </div>
        </div>
      </div>
    </header>
    <main class="container my-5">
      <!-- Progress Steps -->
      <div class="progress-steps">
        <div class="step completed">
          <div class="step-icon">
            <i class="fas fa-info-circle"></i>
          </div>
          <div class="step-label">Ticket Details</div>
        </div>
        <div class="step active">
          <div class="step-icon">2</div>
          <div class="step-label">Submit Request</div>
        </div>
        <div class="step">
          <div class="step-icon">3</div>
          <div class="step-label">Confirmation</div>
        </div>
      </div>

      <!-- Ticket Form Card -->
      <div class="denr-card mb-5">
        <div class="card-header-custom">
          <h3>
            <i class="fas fa-ticket-alt me-2"></i> Submit a New ICT Service
            Request
          </h3>
        </div>
        <div class="card-body p-4">
          <form id="ticketForm" novalidate>
            <div class="row mb-4">
              <div class="col-md-12 mb-3">
                <label class="form-label-custom"
                  >Ticket Type <span class="required-star">*</span></label
                >
                <select
                  class="form-select form-control-custom"
                  id="ticketType"
                  required
                >
                  <option value="" selected disabled>Select ticket type</option>
                  <option value="hardware">Hardware Issue</option>
                  <option value="software">Software/Application</option>
                  <option value="network">Network/Internet</option>
                  <option value="account">Account Access</option>
                  <option value="printer">Printer/Peripherals</option>
                  <option value="email">Email Issue</option>
                  <option value="website">Website/Portal</option>
                  <option value="other">Other Concerns</option>
                </select>
              </div>
              
            </div>

            <div class="row mb-4">
              <div class="col-md-6 mb-3">
                <label for="fullName" class="form-label-custom"
                  >Full Name <span class="required-star">*</span></label
                >
                <input
                  type="text"
                  class="form-control form-control-custom"
                  id="fullName"
                  placeholder="Enter your full name"
                  required
                />
              </div>
              <div class="col-md-6 mb-3">
                <label for="position" class="form-label-custom"
                  >Position/Designation
                  <span class="required-star">*</span></label
                >
                <input
                  type="text"
                  class="form-control form-control-custom"
                  id="position"
                  placeholder="Enter your position"
                  required
                />
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-md-6 mb-3">
                <label for="office" class="form-label-custom"
                  >Office/Division <span class="required-star">*</span></label
                >
                <select
                  class="form-select form-control-custom"
                  id="office"
                  required
                >
                  <option value="" selected disabled>
                    Select office/division
                  </option>
                  <option value="LRMPS">
                    Land Resource Management & Planning Services
                  </option>
                  <option value="PAS">Protected Area Services</option>
                  <option value="PAWB">
                    Protected Areas & Wildlife Bureau
                  </option>
                  <option value="MGB">Mines & Geosciences Bureau</option>
                  <option value="EMB">Environmental Management Bureau</option>
                  <option value="RADO">
                    Regional Administrative Division Office
                  </option>
                  <option value="TED">Technical Education Division</option>
                  <option value="Finance">Finance Division</option>
                  <option value="Legal">Legal Division</option>
                  <option value="PMD">Planning & Management Division</option>
                  <option value="ICT">ICT Unit</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="email" class="form-label-custom"
                  >Email Address <span class="required-star">*</span></label
                >
                <input
                  type="email"
                  class="form-control form-control-custom"
                  id="email"
                  placeholder="name@denr.gov.ph"
                  required
                />
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-12 mb-3">
                <label for="concernDescription" class="form-label-custom"
                  >Description of Concern
                  <span class="required-star">*</span></label
                >
                <textarea
                  class="form-control form-control-custom"
                  id="concernDescription"
                  rows="5"
                  placeholder="Please provide a detailed description of the issue, including error messages, when it started, and steps to reproduce the problem."
                  required
                ></textarea>
                <div class="form-text">
                  Be as specific as possible to help us resolve your issue
                  faster.
                </div>
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-12 mb-3">
                <label class="form-label-custom">Attach Supporting Files</label>
                <div class="file-upload-area" id="dropZone">
                  <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                  </div>
                  <h5>Drag & drop files here or click to browse</h5>
                  <p class="text-muted">
                    Supports: JPG, PNG, PDF, DOC up to 10MB
                  </p>
                  <input
                    type="file"
                    id="fileInput"
                    class="d-none"
                    accept="image/*,.pdf,.doc,.docx"
                    multiple
                  />
                  <button
                    type="button"
                    class="btn btn-outline-primary mt-2"
                    id="browseBtn"
                  >
                    <i class="fas fa-folder-open me-2"></i>Browse Files
                  </button>
                </div>
                <div
                  class="file-preview-container"
                  id="filePreviewContainer"
                ></div>
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-12">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="termsAgreement"
                    required
                  />
                  <label class="form-check-label" for="termsAgreement">
                    I acknowledge that this request will be processed according
                    to DENR ICT Service policies and I agree to provide accurate
                    information.
                  </label>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
              <button
                type="button"
                class="btn btn-denr-secondary"
                id="clearBtn"
              >
                <i class="fas fa-eraser me-2"></i>Clear Form
              </button>
              <button type="submit" class="btn btn-denr" id="submitBtn">
                <i class="fas fa-paper-plane me-2"></i>Submit Ticket Request
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Information Card -->
      <div class="denr-card">
        <div class="card-body p-4">
          <h5 class="mb-3">
            <i class="fas fa-info-circle text-primary me-2"></i>What happens
            after submission?
          </h5>
          <div class="row">
            <div class="col-md-3 mb-3">
              <div class="text-center p-3">
                <div class="mb-3">
                  <i class="fas fa-envelope fa-2x text-primary"></i>
                </div>
                <h6>Confirmation Email</h6>
                <p class="small text-muted">
                  You'll receive a ticket number and confirmation email
                </p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="text-center p-3">
                <div class="mb-3">
                  <i class="fas fa-user-cog fa-2x text-primary"></i>
                </div>
                <h6>Ticket Assignment</h6>
                <p class="small text-muted">
                  Your ticket will be assigned to an ICT technician
                </p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="text-center p-3">
                <div class="mb-3">
                  <i class="fas fa-tools fa-2x text-primary"></i>
                </div>
                <h6>Resolution Process</h6>
                <p class="small text-muted">
                  ICT staff will work on resolving your issue
                </p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="text-center p-3">
                <div class="mb-3">
                  <i class="fas fa-check-circle fa-2x text-success"></i>
                </div>
                <h6>Ticket Closure</h6>
                <p class="small text-muted">
                  You'll be notified when your ticket is resolved
                </p>
              </div>
            </div>
          </div>
          <div class="alert alert-info mt-3">
            <i class="fas fa-phone-alt me-2"></i>
            <strong>Need urgent assistance?</strong> Contact the ICT Help Desk
            at <strong>(082) 123-4567</strong> or email
            <strong>ict.support@denrxi.gov.ph</strong>
          </div>
        </div>
      </div>
    </main>
    <footer class="denr-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <p>
              <i class="fas fa-code me-2"></i>Developed by: Planning and
              Management Division - Regional ICT Unit
            </p>
            <p>
              <i class="fas fa-shield-alt me-2"></i>DENR Region XI - Department
              of Environment and Natural Resources
            </p>
          </div>
          <div class="col-md-4 text-md-end">
            <p><i class="fas fa-code-branch me-2"></i>Version 2.0.1</p>
            <p><i class="far fa-copyright me-2"></i>2023 All Rights Reserved</p>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>