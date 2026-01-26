<template>
    <div class="container-fluid">
        <!-- Profile Header -->
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-xxl-3">
                <!-- Profile Card -->
                <div class="card mt-n5 border-denr profile-card">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                <div class="position-relative">
                                    <img :src="userProfileImage" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image">
                                    <!-- Online Status Indicator -->
                                    <div class="position-absolute bottom-0 end-0">
                                        <span class="badge rounded-circle p-2 online-status-indicator" 
                                              :class="isOnline ? 'bg-success' : 'bg-secondary'">
                                            <i :class="isOnline ? 'ri-wifi-line' : 'ri-wifi-off-line'"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input" type="file" class="profile-img-file-input" @change="updateProfileImage">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-denr text-white material-shadow">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <h5 class="fs-16 mb-1 font-display text-denr-dark">{{ fullName }}</h5>
                            <p class="text-muted mb-0">
                                <i class="ri-briefcase-line me-1"></i>{{ user.position || 'Technician' }}
                            </p>
                            <div class="mt-2">
                                <span class="badge bg-denr">
                                    <i class="ri-shield-user-line me-1"></i>{{ user.role || 'Technician' }}
                                </span>
                                <span :class="statusBadgeClass">
                                    <i :class="statusIcon" class="me-1"></i>{{ user.status || 'Active' }}
                                </span>
                            </div>
                            <!-- Online Status -->
                            <div class="mt-2">
                                <span class="badge" :class="isOnline ? 'bg-success' : 'bg-secondary'">
                                    <i :class="isOnline ? 'ri-wifi-line' : 'ri-wifi-off-line'" class="me-1"></i>
                                    {{ isOnline ? 'Online Now' : 'Offline' }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- User Information -->
                        <div class="mt-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-denr p-2 rounded-circle me-3">
                                    <i class="ri-mail-line fs-5"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="font-body">{{ user.email }}</span>
                                    <span v-if="user.email_verified_at" class="badge bg-success ms-2">
                                        <i class="ri-checkbox-circle-line me-1"></i>Verified
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-denr p-2 rounded-circle me-3">
                                    <i class="ri-phone-line fs-5"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="font-body">{{ user.contact_number || 'Not provided' }}</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="icon-denr p-2 rounded-circle me-3">
                                    <i class="ri-building-line fs-5"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="font-body">Office ID: {{ user.office_id || 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Technical Skills & Specializations -->
                        <div class="mt-4 pt-3 border-top">
                            <h6 class="mb-3 font-display text-denr-dark">
                                <i class="ri-tools-line me-2"></i>Technical Skills
                            </h6>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge bg-denr-light text-denr">
                                    <i class="ri-computer-line me-1"></i>Hardware
                                </span>
                                <span class="badge bg-denr-light text-denr">
                                    <i class="ri-bug-line me-1"></i>Software
                                </span>
                                <span class="badge bg-denr-light text-denr">
                                    <i class="ri-server-line me-1"></i>Networking
                                </span>
                                <span class="badge bg-denr-light text-denr">
                                    <i class="ri-shield-line me-1"></i>Security
                                </span>
                            </div>
                            
                            <!-- Equipment Proficiency -->
                            <h6 class="mb-2 mt-3 font-display text-denr-dark">
                                <i class="ri-cpu-line me-2"></i>Equipment Proficiency
                            </h6>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center bg-denr-light p-2 rounded">
                                        <i class="ri-printer-line text-denr me-2"></i>
                                        <span class="small">Printers</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center bg-denr-light p-2 rounded">
                                        <i class="ri-router-line text-denr me-2"></i>
                                        <span class="small">Routers</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center bg-denr-light p-2 rounded">
                                        <i class="ri-database-line text-denr me-2"></i>
                                        <span class="small">Servers</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center bg-denr-light p-2 rounded">
                                        <i class="ri-survey-line text-denr me-2"></i>
                                        <span class="small">Scanners</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Availability Status -->
                        <div class="mt-3 pt-3 border-top">
                            <h6 class="mb-2 font-display text-denr-dark">
                                <i class="ri-time-line me-2"></i>Availability
                            </h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="availability-dot" :class="availabilityClass"></div>
                                    <span class="ms-2">{{ availabilityText }}</span>
                                </div>
                                <button class="btn btn-sm btn-outline-denr" @click="toggleAvailability">
                                    <i class="ri-toggle-line me-1"></i>{{ isAvailable ? 'Go Offline' : 'Go Online' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card mt-3 border-denr">
                    <div class="card-header bg-denr-light border-bottom-0">
                        <h6 class="mb-0 font-display text-denr-dark">
                            <i class="ri-bar-chart-line me-2"></i>Performance Stats
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="technical-icon mb-2">
                                    <i class="ri-task-line"></i>
                                </div>
                                <h5 class="mb-0 font-display">42</h5>
                                <p class="text-muted small mb-0">Active</p>
                                <p class="text-success small mb-0">+5%</p>
                            </div>
                            <div class="col-4">
                                <div class="technical-icon mb-2">
                                    <i class="ri-check-double-line"></i>
                                </div>
                                <h5 class="mb-0 font-display">128</h5>
                                <p class="text-muted small mb-0">Completed</p>
                                <p class="text-success small mb-0">+12%</p>
                            </div>
                            <div class="col-4">
                                <div class="technical-icon mb-2">
                                    <i class="ri-star-line"></i>
                                </div>
                                <h5 class="mb-0 font-display">4.8</h5>
                                <p class="text-muted small mb-0">Rating</p>
                                <p class="text-success small mb-0">+0.2</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="card mt-3 border-denr">
                    <div class="card-header bg-denr-light border-bottom-0">
                        <h6 class="mb-0 font-display text-denr-dark">
                            <i class="ri-history-line me-2"></i>Recent Activities
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="activity-feed">
                            <div class="activity-item">
                                <div class="activity-icon bg-success">
                                    <i class="ri-check-line"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="mb-0 small">Completed ticket #TEC-234</p>
                                    <span class="text-muted small">2 hours ago</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon bg-primary">
                                    <i class="ri-tools-line"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="mb-0 small">Started repair on Server Rack</p>
                                    <span class="text-muted small">4 hours ago</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon bg-warning">
                                    <i class="ri-alarm-warning-line"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="mb-0 small">Responded to urgent ticket</p>
                                    <span class="text-muted small">6 hours ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-xxl-9">
                <div class="card mt-xxl-n5 border-denr">
                    <div class="card-header bg-denr-gradient border-bottom-0">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                    <i class="ri-user-line me-2"></i>
                                    <span class="d-none d-md-inline">Personal Details</span>
                                    <span class="badge bg-white text-denr ms-2">Basic Info</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                    <i class="ri-shield-keyhole-line me-2"></i>
                                    <span class="d-none d-md-inline">Security</span>
                                    <span class="badge bg-white text-denr ms-2">Protected</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#technicalProfile" role="tab">
                                    <i class="ri-tools-line me-2"></i>
                                    <span class="d-none d-md-inline">Technical Profile</span>
                                    <span class="badge bg-white text-denr ms-2">Expertise</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <!-- Personal Details Tab -->
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="icon-denr p-3 rounded-circle me-3">
                                        <i class="ri-user-line fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 font-display text-denr-dark">Personal Information</h5>
                                        <p class="text-muted mb-0">Update your personal details and contact information</p>
                                    </div>
                                </div>
                                <form @submit.prevent="updatePersonalDetails">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">
                                                    <i class="ri-user-3-line me-1"></i>First Name *
                                                </label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text bg-denr-light text-denr">
                                                        <i class="ri-user-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-enhanced" 
                                                           id="firstnameInput" v-model="formData.firstname" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label for="middleInitialInput" class="form-label">
                                                    <i class="ri-text me-1"></i>M.I.
                                                </label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text bg-denr-light text-denr">
                                                        <i class="ri-text"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-enhanced text-center" 
                                                           id="middleInitialInput" v-model="formData.middle_initial" maxlength="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="lastnameInput" class="form-label">
                                                    <i class="ri-user-3-line me-1"></i>Last Name *
                                                </label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text bg-denr-light text-denr">
                                                        <i class="ri-user-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-enhanced" 
                                                           id="lastnameInput" v-model="formData.lastname" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label for="extensionInput" class="form-label">
                                                    <i class="ri-hashtag me-1"></i>Ext.
                                                </label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text bg-denr-light text-denr">
                                                        <i class="ri-number-1"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-enhanced" 
                                                           id="extensionInput" v-model="formData.extension">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Contact Information Section -->
                                        <div class="col-12 mt-3">
                                            <h6 class="text-denr-dark mb-3 font-display">
                                                <i class="ri-contacts-line me-2"></i>Contact Information
                                            </h6>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">
                                                    <i class="ri-mail-line me-1"></i>Email Address *
                                                </label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text bg-denr-light text-denr">
                                                        <i class="ri-mail-line"></i>
                                                    </span>
                                                    <input type="email" class="form-control form-control-enhanced" 
                                                           id="emailInput" v-model="formData.email" required>
                                                </div>
                                                <div v-if="user.email_verified_at" class="form-text text-success mt-2">
                                                    <i class="ri-checkbox-circle-line me-1"></i> Email verified and secured
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="contactNumberInput" class="form-label">
                                                    <i class="ri-smartphone-line me-1"></i>Contact Number
                                                </label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text bg-denr-light text-denr">
                                                        <i class="ri-phone-line"></i>
                                                    </span>
                                                    <input type="tel" class="form-control form-control-enhanced" 
                                                           id="contactNumberInput" v-model="formData.contact_number">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Professional Information -->
                                        <div class="col-12 mt-3">
                                            <h6 class="text-denr-dark mb-3 font-display">
                                                <i class="ri-briefcase-line me-2"></i>Professional Information
                                            </h6>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="positionInput" class="form-label">
                                                    <i class="ri-briefcase-2-line me-1"></i>Position
                                                </label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text bg-denr-light text-denr">
                                                        <i class="ri-briefcase-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-enhanced" 
                                                           id="positionInput" v-model="formData.position">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="officeInput" class="form-label">
                                                    <i class="ri-government-line me-1"></i>Office
                                                </label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text bg-denr-light text-denr">
                                                        <i class="ri-building-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-enhanced" 
                                                           id="officeInput" v-model="formData.office_id">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Terms & Conditions -->
                                        <div class="col-12 mt-4">
                                            <div class="card border-denr-light">
                                                <div class="card-body">
                                                    <h6 class="mb-3 text-denr-dark font-display">
                                                        <i class="ri-file-text-line me-2"></i>Terms & Agreements
                                                    </h6>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="checkbox" id="agreeTerms" 
                                                               v-model="formData.agree_and_terms_condition" disabled>
                                                        <label class="form-check-label font-body" for="agreeTerms">
                                                            <i class="ri-checkbox-circle-line text-success me-2"></i>
                                                            I agree to the DENR terms and conditions
                                                        </label>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="checkbox" id="confirmInfo" 
                                                               v-model="formData.information_confirmed" disabled>
                                                        <label class="form-check-label font-body" for="confirmInfo">
                                                            <i class="ri-check-double-line text-primary me-2"></i>
                                                            Confirm information is accurate and verified
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="dataPrivacy" 
                                                               v-model="formData.data_privacy" disabled checked>
                                                        <label class="form-check-label font-body" for="dataPrivacy">
                                                            <i class="ri-shield-check-line text-info me-2"></i>
                                                            I comply with Data Privacy Act of 2012
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Action Buttons -->
                                        <div class="col-12">
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-success" :disabled="updating">
                                                    <span v-if="updating" class="spinner-border spinner-border-sm me-2"></span>
                                                    <i v-else class="ri-save-line me-2"></i>
                                                    {{ updating ? 'Updating...' : 'Update Personal Info' }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Security Tab -->
                            <div class="tab-pane" id="changePassword" role="tabpanel">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="icon-denr p-3 rounded-circle me-3">
                                        <i class="ri-shield-keyhole-line fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 font-display text-denr-dark">Security Settings</h5>
                                        <p class="text-muted mb-0">Manage your password and account security</p>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card border-denr-light mb-4">
                                            <div class="card-body">
                                                <h6 class="mb-3 text-denr-dark font-display">
                                                    <i class="ri-lock-password-line me-2"></i>Change Password
                                                </h6>
                                                <form @submit.prevent="changePassword">
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="oldpasswordInput" class="form-label">
                                                                    <i class="ri-lock-line me-1"></i>Current Password
                                                                </label>
                                                                <div class="input-group input-group-with-icon">
                                                                    <span class="input-group-text bg-denr-light text-denr">
                                                                        <i class="ri-lock-line"></i>
                                                                    </span>
                                                                    <input type="password" class="form-control form-control-enhanced" 
                                                                           id="oldpasswordInput" v-model="password.current" required>
                                                                    <button class="btn btn-outline-denr" type="button" 
                                                                            @click="togglePassword('oldpasswordInput')">
                                                                        <i class="ri-eye-line"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="newpasswordInput" class="form-label">
                                                                    <i class="ri-key-2-line me-1"></i>New Password
                                                                </label>
                                                                <div class="input-group input-group-with-icon">
                                                                    <span class="input-group-text bg-denr-light text-denr">
                                                                        <i class="ri-lock-password-line"></i>
                                                                    </span>
                                                                    <input type="password" class="form-control form-control-enhanced" 
                                                                           id="newpasswordInput" v-model="password.new" required>
                                                                    <button class="btn btn-outline-denr" type="button" 
                                                                            @click="togglePassword('newpasswordInput')">
                                                                        <i class="ri-eye-line"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-text">
                                                                    <i class="ri-information-line me-1"></i>
                                                                    Must be at least 8 characters with uppercase, lowercase, and numbers
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="confirmpasswordInput" class="form-label">
                                                                    <i class="ri-key-2-fill me-1"></i>Confirm Password
                                                                </label>
                                                                <div class="input-group input-group-with-icon">
                                                                    <span class="input-group-text bg-denr-light text-denr">
                                                                        <i class="ri-lock-password-line"></i>
                                                                    </span>
                                                                    <input type="password" class="form-control form-control-enhanced" 
                                                                           id="confirmpasswordInput" v-model="password.confirm" required>
                                                                    <button class="btn btn-outline-denr" type="button" 
                                                                            @click="togglePassword('confirmpasswordInput')">
                                                                        <i class="ri-eye-line"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="d-flex justify-content-end">
                                                                <button type="submit" class="btn btn-success" :disabled="changingPassword">
                                                                    <span v-if="changingPassword" class="spinner-border spinner-border-sm me-2"></span>
                                                                    <i v-else class="ri-key-2-line me-2"></i>
                                                                    {{ changingPassword ? 'Updating...' : 'Update Password' }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Technical Profile Tab -->
                            <div class="tab-pane" id="technicalProfile" role="tabpanel">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="icon-denr p-3 rounded-circle me-3">
                                        <i class="ri-tools-line fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 font-display text-denr-dark">Technical Profile</h5>
                                        <p class="text-muted mb-0">Manage your technical skills and expertise</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Technical Skills -->
                                    <div class="col-lg-8">
                                        <div class="card border-denr-light mb-4">
                                            <div class="card-body">
                                                <h6 class="mb-3 text-denr-dark font-display">
                                                    <i class="ri-tools-line me-2"></i>Technical Skills
                                                </h6>
                                                <div class="mb-4">
                                                    <label class="form-label">
                                                        <i class="ri-computer-line me-1"></i>Primary Specialization
                                                    </label>
                                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                                        <span v-for="skill in technicalSkills" :key="skill" 
                                                              class="badge bg-denr-light text-denr p-2">
                                                            <i :class="skill.icon" class="me-1"></i>{{ skill.name }}
                                                            <button class="btn-close btn-close-sm ms-1" 
                                                                    @click="removeSkill(skill)"></button>
                                                        </span>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" v-model="newSkill" 
                                                               placeholder="Add new skill (e.g., Networking, Cybersecurity)">
                                                        <button class="btn btn-denr" @click="addSkill">
                                                            <i class="ri-add-line"></i> Add
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Certifications -->
                                                <div class="mb-4">
                                                    <h6 class="mb-3 text-denr-dark font-display">
                                                        <i class="ri-award-line me-2"></i>Certifications
                                                    </h6>
                                                    <div class="row g-2">
                                                        <div class="col-md-6" v-for="cert in certifications" :key="cert.id">
                                                            <div class="card border-denr-light">
                                                                <div class="card-body">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="cert-icon me-3">
                                                                            <i class="ri-award-fill text-warning"></i>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="mb-0">{{ cert.name }}</h6>
                                                                            <p class="text-muted small mb-0">{{ cert.issuer }}</p>
                                                                            <p class="text-muted small mb-0">{{ cert.year }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Technical Preferences -->
                                                <div>
                                                    <h6 class="mb-3 text-denr-dark font-display">
                                                        <i class="ri-settings-3-line me-2"></i>Technical Preferences
                                                    </h6>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="autoUpdates" v-model="preferences.autoUpdates">
                                                                <label class="form-check-label font-body" for="autoUpdates">
                                                                    <i class="ri-refresh-line me-2"></i>Auto System Updates
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="maintenanceAlerts" v-model="preferences.maintenanceAlerts">
                                                                <label class="form-check-label font-body" for="maintenanceAlerts">
                                                                    <i class="ri-alarm-warning-line me-2"></i>Maintenance Alerts
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="ticketNotifications" v-model="preferences.ticketNotifications">
                                                                <label class="form-check-label font-body" for="ticketNotifications">
                                                                    <i class="ri-notification-3-line me-2"></i>Ticket Notifications
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="equipmentTracking" v-model="preferences.equipmentTracking">
                                                                <label class="form-check-label font-body" for="equipmentTracking">
                                                                    <i class="ri-radar-line me-2"></i>Equipment Tracking
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Technical Stats -->
                                    <div class="col-lg-4">
                                        <div class="card border-denr-light mb-4">
                                            <div class="card-body">
                                                <h6 class="mb-3 text-denr-dark font-display">
                                                    <i class="ri-bar-chart-line me-2"></i>Technical Stats
                                                </h6>
                                                <div class="text-center mb-4">
                                                    <div class="position-relative d-inline-block">
                                                        <div class="circular-progress" :style="progressStyle">
                                                            <span class="progress-value">{{ completionRate }}%</span>
                                                        </div>
                                                        <div class="mt-2">
                                                            <p class="text-muted small mb-0">Profile Completion</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="list-group list-group-flush">
                                                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                                                        <span><i class="ri-task-line me-2"></i>Assigned Tickets</span>
                                                        <span class="badge bg-denr">15</span>
                                                    </div>
                                                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                                                        <span><i class="ri-check-double-line me-2"></i>Completed</span>
                                                        <span class="badge bg-success">128</span>
                                                    </div>
                                                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                                                        <span><i class="ri-time-line me-2"></i>Avg. Response Time</span>
                                                        <span class="badge bg-info">2.4h</span>
                                                    </div>
                                                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                                                        <span><i class="ri-star-line me-2"></i>Customer Rating</span>
                                                        <span class="badge bg-warning">4.8/5</span>
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <h6 class="mb-2 text-denr-dark font-display">
                                                        <i class="ri-calendar-line me-2"></i>Availability Schedule
                                                    </h6>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="ri-calendar-event-line text-denr me-2"></i>
                                                        <span>Monday - Friday</span>
                                                        <span class="badge bg-denr-light text-denr ms-auto">8:00 AM - 5:00 PM</span>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ri-calendar-event-line text-denr me-2"></i>
                                                        <span>Emergency Response</span>
                                                        <span class="badge bg-danger-light text-danger ms-auto">24/7</span>
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
        </div>

        <!-- Delete Account Modal -->
        <div v-if="showDeleteModal" class="modal fade show" style="display: block;" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-denr">
                    <div class="modal-header bg-denr-gradient">
                        <h5 class="modal-title font-display text-white">
                            <i class="ri-delete-bin-line me-2"></i>Delete Account
                        </h5>
                        <button type="button" class="btn-close btn-close-white" @click="showDeleteModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <div class="avatar-lg mx-auto mb-3">
                                <div class="avatar-title bg-denr-light rounded-circle">
                                    <i class="ri-error-warning-line text-denr fs-1"></i>
                                </div>
                            </div>
                            <h5 class="font-display text-denr-dark">Are you absolutely sure?</h5>
                            <p class="text-muted">This action cannot be undone. All your data will be permanently deleted from DENR systems.</p>
                        </div>
                        <div class="alert alert-warning">
                            <i class="ri-alarm-line me-2"></i>
                            <strong>Warning:</strong> This will remove all your access to DENR applications and services.
                        </div>
                        <div class="mb-4">
                            <label for="deletePassword" class="form-label">
                                <i class="ri-lock-line me-1"></i>Enter your password to confirm:
                            </label>
                            <div class="input-group input-group-with-icon">
                                <span class="input-group-text bg-denr-light text-denr">
                                    <i class="ri-lock-line"></i>
                                </span>
                                <input type="password" class="form-control form-control-enhanced" 
                                       id="deletePassword" v-model="deletePassword" placeholder="Your current password">
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="confirmDelete" v-model="confirmDelete">
                            <label class="form-check-label font-body" for="confirmDelete">
                                I understand that this action is irreversible and I want to proceed
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" @click="showDeleteModal = false">
                            <i class="ri-close-line me-2"></i>Cancel
                        </button>
                        <button type="button" class="btn btn-danger" @click="deleteAccount" 
                                :disabled="!deletePassword || !confirmDelete">
                            <i class="ri-delete-bin-line me-2"></i>Permanently Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showDeleteModal" class="modal-backdrop fade show"></div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            formData: {
                firstname: '',
                middle_initial: '',
                lastname: '',
                extension: '',
                email: '',
                contact_number: '',
                position: '',
                role: '',
                status: '',
                head_office_id: '',
                office_id: '',
                agree_and_terms_condition: false,
                information_confirmed: false,
                data_privacy: true,
                approval_status: '',
                module_assign: []
            },
            password: {
                current: '',
                new: '',
                confirm: ''
            },
            userProfileImage: 'assets/images/users/technician-avatar.png', // Changed to technician avatar
            updating: false,
            changingPassword: false,
            showDeleteModal: false,
            deletePassword: '',
            confirmDelete: false,
            isOnline: true,
            isAvailable: true,
            newSkill: '',
            technicalSkills: [
                { name: 'Hardware Repair', icon: 'ri-computer-line' },
                { name: 'Software Troubleshooting', icon: 'ri-bug-line' },
                { name: 'Network Configuration', icon: 'ri-router-line' },
                { name: 'System Security', icon: 'ri-shield-line' }
            ],
            certifications: [
                { id: 1, name: 'CompTIA A+', issuer: 'CompTIA', year: '2023' },
                { id: 2, name: 'Cisco CCNA', issuer: 'Cisco', year: '2022' },
                { id: 3, name: 'Microsoft Certified', issuer: 'Microsoft', year: '2021' },
                { id: 4, name: 'Network Security', issuer: 'DENR', year: '2024' }
            ],
            preferences: {
                autoUpdates: true,
                maintenanceAlerts: true,
                ticketNotifications: true,
                equipmentTracking: false
            }
        }
    },

    computed: {
        fullName() {
            const parts = [this.formData.firstname];
            if (this.formData.middle_initial) {
                parts.push(this.formData.middle_initial + '.');
            }
            if (this.formData.lastname) {
                parts.push(this.formData.lastname);
            }
            return parts.join(' ');
        },

        statusBadgeClass() {
            const status = this.formData.status?.toLowerCase();
            switch(status) {
                case 'active': return 'badge bg-success ms-1';
                case 'inactive': return 'badge bg-secondary ms-1';
                case 'pending': return 'badge bg-warning ms-1';
                case 'suspended': return 'badge bg-danger ms-1';
                default: return 'badge bg-info ms-1';
            }
        },

        statusIcon() {
            const status = this.formData.status?.toLowerCase();
            switch(status) {
                case 'active': return 'ri-checkbox-circle-line';
                case 'inactive': return 'ri-indeterminate-circle-line';
                case 'pending': return 'ri-time-line';
                case 'suspended': return 'ri-error-warning-line';
                default: return 'ri-information-line';
            }
        },

        availabilityClass() {
            return this.isAvailable ? 'available' : 'unavailable';
        },

        availabilityText() {
            return this.isAvailable ? 'Available for assignments' : 'Currently unavailable';
        },

        completionRate() {
            let completed = 0;
            if (this.formData.firstname) completed++;
            if (this.formData.lastname) completed++;
            if (this.formData.email) completed++;
            if (this.formData.position) completed++;
            if (this.technicalSkills.length > 0) completed++;
            return Math.round((completed / 5) * 100);
        },

        progressStyle() {
            const deg = (this.completionRate / 100) * 360;
            return {
                background: `conic-gradient(var(--denr-primary) ${deg}deg, var(--denr-light) ${deg}deg)`
            };
        }
    },

    mounted() {
        this.initializeForm();
        this.simulateOnlineStatus();
    },

    methods: {
        initializeForm() {
            Object.keys(this.formData).forEach(key => {
                if (this.user[key] !== undefined) {
                    this.formData[key] = this.user[key];
                }
            });
            
            if (this.formData.module_assign && typeof this.formData.module_assign === 'string') {
                this.formData.module_assign = this.formData.module_assign.split(',').map(m => m.trim());
            }
        },

        updatePersonalDetails() {
            this.updating = true;
            setTimeout(() => {
                console.log('Updating personal details:', this.formData);
                this.updating = false;
                this.$toast.success('Personal details updated successfully!', {
                    icon: 'ri-checkbox-circle-line'
                });
            }, 1500);
        },

        changePassword() {
            if (this.password.new !== this.password.confirm) {
                this.$toast.error('New passwords do not match!', {
                    icon: 'ri-error-warning-line'
                });
                return;
            }
            
            if (this.password.new.length < 8) {
                this.$toast.error('Password must be at least 8 characters long!', {
                    icon: 'ri-shield-cross-line'
                });
                return;
            }
            
            this.changingPassword = true;
            setTimeout(() => {
                console.log('Changing password');
                this.changingPassword = false;
                this.password = { current: '', new: '', confirm: '' };
                this.$toast.success('Password changed successfully!', {
                    icon: 'ri-shield-check-line'
                });
            }, 1500);
        },

        updateProfileImage(event) {
            const file = event.target.files[0];
            if (file) {
                if (!file.type.match('image.*')) {
                    this.$toast.error('Please select an image file', {
                        icon: 'ri-image-line'
                    });
                    return;
                }
                
                if (file.size > 5 * 1024 * 1024) {
                    this.$toast.error('Image size should be less than 5MB', {
                        icon: 'ri-alarm-warning-line'
                    });
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.userProfileImage = e.target.result;
                    this.$toast.success('Profile picture updated!', {
                        icon: 'ri-camera-fill'
                    });
                };
                reader.readAsDataURL(file);
            }
        },

        deleteAccount() {
            if (!this.deletePassword) {
                this.$toast.error('Please enter your password', {
                    icon: 'ri-lock-line'
                });
                return;
            }
            
            console.log('Deleting account');
            this.showDeleteModal = false;
            this.deletePassword = '';
            this.confirmDelete = false;
            this.$toast.warning('Account deletion requested. Please check your email for confirmation.', {
                icon: 'ri-mail-send-line'
            });
        },

        resetForm() {
            this.initializeForm();
            this.$toast.info('Form reset to original values', {
                icon: 'ri-refresh-line'
            });
        },

        togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
        },

        toggleAvailability() {
            this.isAvailable = !this.isAvailable;
            this.$toast.success(`You are now ${this.isAvailable ? 'available' : 'unavailable'} for assignments`, {
                icon: this.isAvailable ? 'ri-toggle-line' : 'ri-toggle-fill'
            });
        },

        simulateOnlineStatus() {
            // Simulate online status changes
            setInterval(() => {
                this.isOnline = Math.random() > 0.1; // 90% chance of being online
            }, 30000);
        },

        addSkill() {
            if (this.newSkill.trim()) {
                const skillIcons = {
                    'networking': 'ri-router-line',
                    'hardware': 'ri-computer-line',
                    'software': 'ri-bug-line',
                    'security': 'ri-shield-line',
                    'server': 'ri-server-line',
                    'database': 'ri-database-line',
                    'cloud': 'ri-cloud-line',
                    'mobile': 'ri-smartphone-line'
                };

                const icon = Object.keys(skillIcons).find(key => 
                    this.newSkill.toLowerCase().includes(key)
                ) ? skillIcons[Object.keys(skillIcons).find(key => 
                    this.newSkill.toLowerCase().includes(key)
                )] : 'ri-tools-line';

                this.technicalSkills.push({
                    name: this.newSkill.trim(),
                    icon: icon
                });
                this.newSkill = '';
                this.$toast.success('Skill added successfully!', {
                    icon: 'ri-add-line'
                });
            }
        },

        removeSkill(skill) {
            const index = this.technicalSkills.indexOf(skill);
            if (index > -1) {
                this.technicalSkills.splice(index, 1);
                this.$toast.info('Skill removed', {
                    icon: 'ri-delete-bin-line'
                });
            }
        }
    }
}
</script>

<style scoped>
/* DENR Color Palette */
:root {
    --denr-primary: #006747;
    --denr-secondary: #008542;
    --denr-accent: #7AB800;
    --denr-dark: #004d33;
    --denr-light: #e8f5e9;
    --denr-gradient: linear-gradient(135deg, var(--denr-primary) 0%, var(--denr-secondary) 100%);
    --danger-light: #f8d7da;
}

/* Profile Card Enhancements */
.profile-card {
    position: relative;
    overflow: hidden;
}

.profile-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--denr-gradient);
}

/* Online Status Indicator */
.online-status-indicator {
    border: 2px solid white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
    }
}

/* Availability Dot */
.availability-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
}

.availability-dot.available {
    background-color: #28a745;
    animation: blink 1.5s infinite;
}

.availability-dot.unavailable {
    background-color: #6c757d;
}

@keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

/* Technical Icons */
.technical-icon {
    width: 40px;
    height: 40px;
    background: var(--denr-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: var(--denr-primary);
    font-size: 1.2rem;
}

.cert-icon {
    width: 40px;
    height: 40px;
    background: rgba(255, 193, 7, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffc107;
    font-size: 1.2rem;
}

/* Activity Feed */
.activity-feed {
    position: relative;
    padding-left: 20px;
}

.activity-feed::before {
    content: '';
    position: absolute;
    left: 9px;
    top: 0;
    bottom: 0;
    width: 2px;
    background-color: var(--denr-light);
}

.activity-item {
    position: relative;
    margin-bottom: 1.5rem;
}

.activity-icon {
    position: absolute;
    left: -20px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.7rem;
}

.activity-content {
    margin-left: 10px;
}

/* Circular Progress */
.circular-progress {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.circular-progress::before {
    content: '';
    position: absolute;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background-color: white;
}

.progress-value {
    position: relative;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--denr-primary);
    z-index: 1;
}

/* Equipment Proficiency */
.equipment-item {
    transition: all 0.3s ease;
}

.equipment-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Skill Badges */
.badge {
    transition: all 0.3s ease;
}

.badge:hover {
    transform: scale(1.05);
}

/* Responsive Design */
@media (max-width: 768px) {
    .online-status-indicator {
        width: 20px;
        height: 20px;
        font-size: 0.6rem;
    }
    
    .technical-icon {
        width: 30px;
        height: 30px;
        font-size: 1rem;
    }
    
    .circular-progress {
        width: 80px;
        height: 80px;
    }
    
    .circular-progress::before {
        width: 60px;
        height: 60px;
    }
    
    .progress-value {
        font-size: 1.2rem;
    }
}

/* Hover Effects */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* Animation for new tab */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.tab-pane {
    animation: slideIn 0.3s ease-out;
}

/* Enhanced Form Controls */
.form-control:focus {
    border-color: var(--denr-primary);
    box-shadow: 0 0 0 0.2rem rgba(0, 103, 71, 0.25);
}

/* Custom Scrollbar for Activity Feed */
.activity-feed {
    max-height: 200px;
    overflow-y: auto;
}

.activity-feed::-webkit-scrollbar {
    width: 4px;
}

.activity-feed::-webkit-scrollbar-track {
    background: var(--denr-light);
    border-radius: 2px;
}

.activity-feed::-webkit-scrollbar-thumb {
    background: var(--denr-primary);
    border-radius: 2px;
}

/* Badge Colors */
.bg-danger-light {
    background-color: var(--danger-light) !important;
}

.text-danger {
    color: #dc3545 !important;
}

/* Button Enhancements */
.btn-outline-denr {
    border-width: 2px;
}

.btn-outline-denr:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 103, 71, 0.2);
}

/* Card Header Enhancement */
.card-header {
    padding: 1rem 1.5rem;
}

/* Form Switch Customization */
.form-switch .form-check-input:checked {
    background-color: var(--denr-primary);
    border-color: var(--denr-primary);
}

.form-switch .form-check-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 103, 71, 0.25);
}

/* List Group Item Hover */
.list-group-item:hover {
    background-color: var(--denr-light);
}

/* Skill Input Group */
.input-group .btn {
    padding-left: 1rem;
    padding-right: 1rem;
}

/* Smooth Transitions */
* {
    transition: background-color 0.3s ease, border-color 0.3s ease;
}
</style>