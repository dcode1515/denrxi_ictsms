<template>
    <div class="container-fluid">
        <!-- Profile Header -->
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-xxl-3">
                <!-- Profile Card -->
                <div class="card mt-n5">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                <img :src="userProfileImage" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image">
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input" type="file" class="profile-img-file-input" @change="updateProfileImage">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <h5 class="fs-16 mb-1 font-display">{{ fullName }}</h5>
                            <p class="text-muted mb-0">{{ user.position || 'Technician' }}</p>
                            <div class="mt-2">
                                <span class="badge bg-primary">{{ user.role || 'Technician' }}</span>
                                <span :class="statusBadgeClass">{{ user.status || 'Active' }}</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="ri-mail-line me-2 icon-muted"></i>
                                <span class="font-body">{{ user.email }}</span>
                                <span v-if="user.email_verified_at" class="badge bg-success ms-2">Verified</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="ri-phone-line me-2 icon-muted"></i>
                                <span class="font-body">{{ user.contact_number || 'Not provided' }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="ri-building-line me-2 icon-muted"></i>
                                <span class="font-body">Office ID: {{ user.office_id || 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Completion -->
                <!-- Account Status -->
            </div>

            <!-- Main Content -->
            <div class="col-xxl-9">
                <div class="card mt-xxl-n5">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                    <i class="ri-user-line"></i> Personal Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                    <i class="ri-lock-line"></i> Security
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <!-- Personal Details Tab -->
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <form @submit.prevent="updatePersonalDetails">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">First Name *</label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text">
                                                        <i class="ri-user-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-enhanced" 
                                                           id="firstnameInput" v-model="formData.firstname" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label for="middleInitialInput" class="form-label">Middle Initial</label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text">
                                                        <i class="ri-text"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-enhanced" 
                                                           id="middleInitialInput" v-model="formData.middle_initial" maxlength="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="lastnameInput" class="form-label">Last Name *</label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text">
                                                        <i class="ri-user-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-enhanced" 
                                                           id="lastnameInput" v-model="formData.lastname" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label for="extensionInput" class="form-label">Extension</label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text">
                                                        <i class="ri-number-1"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-enhanced" 
                                                           id="extensionInput" v-model="formData.extension">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Email Address *</label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text">
                                                        <i class="ri-mail-line"></i>
                                                    </span>
                                                    <input type="email" class="form-control form-control-enhanced" 
                                                           id="emailInput" v-model="formData.email" required>
                                                </div>
                                                <div v-if="user.email_verified_at" class="form-text text-success">
                                                    <i class="ri-checkbox-circle-line"></i> Email verified
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="contactNumberInput" class="form-label">Contact Number</label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text">
                                                        <i class="ri-phone-line"></i>
                                                    </span>
                                                    <input type="tel" class="form-control form-control-enhanced" 
                                                           id="contactNumberInput" v-model="formData.contact_number">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-lg-12">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="agreeTerms" 
                                                       v-model="formData.agree_and_terms_condition" disabled>
                                                <label class="form-check-label font-body" for="agreeTerms">
                                                    I agree to the terms and conditions
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="confirmInfo" 
                                                       v-model="formData.information_confirmed" disabled>
                                                <label class="form-check-label font-body" for="confirmInfo">
                                                    Confirm information is accurate
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary" :disabled="updating">
                                                    <span v-if="updating" class="spinner-border spinner-border-sm me-1"></span>
                                                    {{ updating ? 'Updating...' : 'Update Details' }}
                                                </button>
                                                <button type="button" class="btn btn-light" @click="resetForm">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Security Tab -->
                            <div class="tab-pane" id="changePassword" role="tabpanel">
                                <form @submit.prevent="changePassword">
                                    <div class="row g-2">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="oldpasswordInput" class="form-label">Current Password</label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text">
                                                        <i class="ri-lock-line"></i>
                                                    </span>
                                                    <input type="password" class="form-control form-control-enhanced" 
                                                           id="oldpasswordInput" v-model="password.current" required>
                                                    <button class="btn btn-outline-secondary" type="button" 
                                                            @click="togglePassword('oldpasswordInput')">
                                                        <i class="ri-eye-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="newpasswordInput" class="form-label">New Password</label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text">
                                                        <i class="ri-lock-password-line"></i>
                                                    </span>
                                                    <input type="password" class="form-control form-control-enhanced" 
                                                           id="newpasswordInput" v-model="password.new" required>
                                                    <button class="btn btn-outline-secondary" type="button" 
                                                            @click="togglePassword('newpasswordInput')">
                                                        <i class="ri-eye-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="confirmpasswordInput" class="form-label">Confirm Password</label>
                                                <div class="input-group input-group-with-icon">
                                                    <span class="input-group-text">
                                                        <i class="ri-lock-password-line"></i>
                                                    </span>
                                                    <input type="password" class="form-control form-control-enhanced" 
                                                           id="confirmpasswordInput" v-model="password.confirm" required>
                                                    <button class="btn btn-outline-secondary" type="button" 
                                                            @click="togglePassword('confirmpasswordInput')">
                                                        <i class="ri-eye-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success" :disabled="changingPassword">
                                                    <span v-if="changingPassword" class="spinner-border spinner-border-sm me-1"></span>
                                                    {{ changingPassword ? 'Changing...' : 'Change Password' }}
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
        </div>

        <!-- Delete Account Modal -->
        <div v-if="showDeleteModal" class="modal fade show" style="display: block;" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-display">Delete Account</h5>
                        <button type="button" class="btn-close" @click="showDeleteModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger font-body">Warning: This action cannot be undone. All your data will be permanently deleted.</p>
                        <div class="mb-3">
                            <label for="deletePassword" class="form-label">Enter your password to confirm:</label>
                            <div class="input-group input-group-with-icon">
                                <span class="input-group-text">
                                    <i class="ri-lock-line"></i>
                                </span>
                                <input type="password" class="form-control form-control-enhanced" 
                                       id="deletePassword" v-model="deletePassword">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" @click="showDeleteModal = false">Cancel</button>
                        <button type="button" class="btn btn-danger" @click="deleteAccount" :disabled="!deletePassword">
                            Delete Account
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
                approval_status: '',
                module_assign: []
            },
            password: {
                current: '',
                new: '',
                confirm: ''
            },
            userProfileImage: 'assets/images/users/avatar-1.jpg',
            updating: false,
            changingPassword: false,
            showDeleteModal: false,
            deletePassword: ''
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
        }
    },

    mounted() {
        this.initializeForm();
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
                this.$toast.success('Personal details updated successfully!');
            }, 1000);
        },

        changePassword() {
            if (this.password.new !== this.password.confirm) {
                this.$toast.error('New passwords do not match!');
                return;
            }
            
            this.changingPassword = true;
            setTimeout(() => {
                console.log('Changing password');
                this.changingPassword = false;
                this.password = { current: '', new: '', confirm: '' };
                this.$toast.success('Password changed successfully!');
            }, 1000);
        },

        updateProfileImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.userProfileImage = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        deleteAccount() {
            if (!this.deletePassword) {
                this.$toast.error('Please enter your password');
                return;
            }
            
            console.log('Deleting account');
            this.showDeleteModal = false;
            this.deletePassword = '';
            this.$toast.warning('Account deletion requested. Please check your email for confirmation.');
        },

        resetForm() {
            this.initializeForm();
        },

        togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
        }
    }
}
</script>

<style scoped>
/* Enhanced Typography */
:root {
    --font-display: 'Segoe UI', -apple-system, BlinkMacSystemFont, 'Roboto', sans-serif;
    --font-body: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    --font-mono: 'SF Mono', Monaco, 'Courier New', monospace;
}

.font-display {
    font-family: var(--font-display);
    font-weight: 600;
    letter-spacing: -0.01em;
}

.font-body {
    font-family: var(--font-body);
    font-weight: 400;
    line-height: 1.6;
}

.font-mono {
    font-family: var(--font-mono);
}

/* Enhanced Form Controls */
.form-control-enhanced {
    font-family: var(--font-body);
    font-size: 0.9375rem;
    font-weight: 400;
    line-height: 1.5;
    padding: 0.5rem 0.75rem;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.form-control-enhanced:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    transform: translateY(-1px);
}

.form-label {
    font-family: var(--font-body);
    font-weight: 500;
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
    color: #495057;
}

/* Input Group with Icons */
.input-group-with-icon {
    position: relative;
}

.input-group-with-icon .input-group-text {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-right: none;
    padding: 0.5rem 0.75rem;
    transition: all 0.2s ease;
}

.input-group-with-icon .input-group-text i {
    font-size: 1.1rem;
    color: #6c757d;
}

.input-group-with-icon .form-control-enhanced {
    border-left: none;
}

.input-group-with-icon:focus-within .input-group-text {
    border-color: #0d6efd;
    background-color: #e7f1ff;
}

.input-group-with-icon:focus-within .input-group-text i {
    color: #0d6efd;
}

/* Password Toggle Button */
.input-group-with-icon .btn-outline-secondary {
    border: 1px solid #dee2e6;
    border-left: none;
    background-color: #f8f9fa;
    color: #6c757d;
    transition: all 0.2s ease;
}

.input-group-with-icon .btn-outline-secondary:hover {
    background-color: #e9ecef;
    color: #495057;
}

.input-group-with-icon:focus-within .btn-outline-secondary {
    border-color: #0d6efd;
}

/* Icon Styles */
.icon-muted {
    color: #6c757d;
    font-size: 1rem;
}

/* Enhanced Badges */
.badge {
    font-family: var(--font-body);
    font-weight: 500;
    letter-spacing: 0.01em;
}

/* Enhanced Buttons */
.btn {
    font-family: var(--font-body);
    font-weight: 500;
    letter-spacing: 0.01em;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn:active {
    transform: translateY(0);
}

/* Enhanced Modal */
.modal-content {
    font-family: var(--font-body);
    border-radius: 0.5rem;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.modal-title {
    font-family: var(--font-display);
    font-weight: 600;
}

/* Profile Image */
.user-profile-image {
    border: 4px solid #fff;
    margin-top: -60px;
    transition: transform 0.3s ease;
}

.user-profile-image:hover {
    transform: scale(1.05);
}

/* Material Shadow */
.material-shadow {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.material-shadow:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: box-shadow 0.3s ease;
}

/* Custom Checkboxes */
.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .input-group-with-icon {
        flex-wrap: nowrap;
    }
    
    .font-display {
        font-size: 1.1rem;
    }
    
    .font-body {
        font-size: 0.9rem;
    }
}

/* Smooth Animations */
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

.tab-pane {
    animation: fadeIn 0.3s ease-out;
}

/* Focus States */
.form-control-enhanced:focus,
.select-enhanced:focus,
.btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
}

/* Loading States */
.spinner-border {
    vertical-align: middle;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}
</style>