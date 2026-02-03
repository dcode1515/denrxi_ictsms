<template>
  <div class="registration-page">
    <!-- BACKGROUND GRADIENT -->
    <div class="background-gradient"></div>
    
    <div class="registration-container">
      <!-- HEADER SECTION -->
      <header class="registration-header">
        <div class="header-content">
          <div class="logo-container">
            <div class="logo-icon">
              <i class="fas fa-shield-alt"></i>
            </div>
            <div class="logo-text">
              <h1>ICT Service Management System</h1>
              <p>Department of Environment and Natural Resources</p>
            </div>
          </div>
        </div>
      </header>

      <!-- MAIN FORM CONTENT -->
      <main class="registration-content">
        <div class="form-card">
          <!-- FORM PROGRESS -->
          <div class="form-progress">
            <div class="progress-bar">
              <div class="progress-fill" :style="{ width: progressPercentage }"></div>
            </div>
            <div class="steps">
              <div 
                v-for="stepItem in steps" 
                :key="stepItem.id"
                class="step"
                :class="{
                  'active': currentStep >= stepItem.id,
                  'completed': currentStep > stepItem.id
                }"
                @click="goToStep(stepItem.id)"
              >
                <div class="step-icon">
                  <i :class="stepItem.icon"></i>
                </div>
                <div class="step-info">
                  <span class="step-label">Step {{ stepItem.id }}</span>
                  <span class="step-title">{{ stepItem.title }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- SUCCESS MESSAGE -->
          <transition name="fade">
            <div v-if="registrationSuccess" class="success-container">
              <div class="success-icon">
                <i class="fas fa-check-circle"></i>
              </div>
              <h2>Registration Successful!</h2>
              <p>Your account has been created. Redirecting to login...</p>
              <div class="loading-dots">
                <span></span>
                <span></span>
                <span></span>
              </div>
            </div>
          </transition>

          <!-- ERROR MESSAGE -->
          <div v-if="apiError" class="error-alert">
            <i class="fas fa-exclamation-triangle"></i>
            <div class="error-content">
              <strong>Registration Failed</strong>
              <p>{{ apiError }}</p>
            </div>
            <button @click="apiError = null" class="close-error">
              <i class="fas fa-times"></i>
            </button>
          </div>

          <!-- FORM CONTENT -->
          <div v-if="!registrationSuccess" class="form-content">
            <!-- STEP 1: PERSONAL INFO -->
            <transition name="slide" mode="out-in">
              <div v-if="currentStep === 1" key="step1" class="form-step">
                <h2 class="step-header">
                  <i class="fas fa-user-circle"></i>
                  Personal Information
                </h2>
                <p class="step-description">Please provide your personal details.</p>

                <div class="form-grid">
                  <div class="form-group">
                    <label for="fullName" class="form-label">
                      Full Name *
                      <span class="label-helper">(as per official records)</span>
                    </label>
                    <div class="input-with-validation">
                      <input
                        id="fullName"
                        v-model="formData.name"
                        type="text"
                        :class="['form-input', { 'invalid': errors.name }]"
                        placeholder="Enter your full name"
                        @blur="validateField('name')"
                        @input="clearError('name')"
                      />
                      <div class="input-icons">
                        <i class="fas fa-user"></i>
                        <span v-if="formData.name && !errors.name" class="valid-icon">
                          <i class="fas fa-check"></i>
                        </span>
                      </div>
                    </div>
                    <div v-if="errors.name" class="validation-error">
                      <i class="fas fa-exclamation-circle"></i>
                      {{ errors.name }}
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="contactNumber" class="form-label">
                      Contact Number *
                      <span class="label-helper">(10 digits, starts with 09)</span>
                    </label>
                    <div class="input-with-validation">
                      <input
                        id="contactNumber"
                        v-model="formData.contact"
                        type="tel"
                        :class="['form-input', { 'invalid': errors.contact }]"
                        placeholder="09XXXXXXXXX"
                        @input="formatContactNumber"
                        @blur="validateField('contact')"
                      />
                      <div class="input-icons">
                        <i class="fas fa-phone"></i>
                      </div>
                    </div>
                    <div v-if="errors.contact" class="validation-error">
                      <i class="fas fa-exclamation-circle"></i>
                      {{ errors.contact }}
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="position" class="form-label">
                      Position *
                    </label>
                    <div class="input-with-validation">
                      <input
                        id="position"
                        v-model="formData.position"
                        type="text"
                        :class="['form-input', { 'invalid': errors.position }]"
                        placeholder="Enter your position"
                        @blur="validateField('position')"
                        @input="clearError('position')"
                      />
                      <div class="input-icons">
                        <i class="fas fa-briefcase"></i>
                        <span v-if="formData.position && !errors.position" class="valid-icon">
                          <i class="fas fa-check"></i>
                        </span>
                      </div>
                    </div>
                    <div v-if="errors.position" class="validation-error">
                      <i class="fas fa-exclamation-circle"></i>
                      {{ errors.position }}
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="role" class="form-label">
                      Role *
                    </label>
                    <div class="select-with-validation">
                      <select
                        id="role"
                        v-model="formData.role"
                        :class="['form-select', { 'invalid': errors.role }]"
                        @change="clearError('role')"
                        @blur="validateField('role')"
                      >
                        <option value="" disabled selected>Select your role</option>
                        <option value="staff">Staff</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="admin">Administrator</option>
                        <option value="manager">Manager</option>
                        <option value="director">Director</option>
                      </select>
                      <div class="select-icons">
                        <i class="fas fa-user-tag"></i>
                        <i class="fas fa-chevron-down select-arrow"></i>
                      </div>
                    </div>
                    <div v-if="errors.role" class="validation-error">
                      <i class="fas fa-exclamation-circle"></i>
                      {{ errors.role }}
                    </div>
                  </div>
                </div>
              </div>

              <!-- STEP 2: OFFICE INFO -->
              <div v-else-if="currentStep === 2" key="step2" class="form-step">
                <h2 class="step-header">
                  <i class="fas fa-building"></i>
                  Office Information
                </h2>
                <p class="step-description">Select your office location and department.</p>

                <div class="form-grid">
                  <div class="form-group">
                    <label for="headOffice" class="form-label">
                      Head Office *
                    </label>
                    <div class="select-with-validation">
                      <select
                        id="headOffice"
                        v-model="formData.headOffice"
                        :class="['form-select', { 'invalid': errors.headOffice }]"
                        @change="onHeadOfficeChange"
                        @blur="validateField('headOffice')"
                      >
                        <option value="" disabled selected>Select head office</option>
                        <option value="central">Central Office</option>
                        <option value="regional">Regional Office</option>
                        <option value="provincial">Provincial Office</option>
                        <option value="district">District Office</option>
                      </select>
                      <div class="select-icons">
                        <i class="fas fa-flag"></i>
                        <i class="fas fa-chevron-down select-arrow"></i>
                      </div>
                    </div>
                    <div v-if="errors.headOffice" class="validation-error">
                      <i class="fas fa-exclamation-circle"></i>
                      {{ errors.headOffice }}
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="office" class="form-label">
                      Office *
                    </label>
                    <div class="select-with-validation">
                      <select
                        id="office"
                        v-model="formData.office"
                        :class="['form-select', { 'invalid': errors.office, 'disabled': !offices.length }]"
                        :disabled="!offices.length"
                        @change="clearError('office')"
                        @blur="validateField('office')"
                      >
                        <option value="" disabled selected>
                          {{ offices.length ? 'Select office' : 'Select head office first' }}
                        </option>
                        <option 
                          v-for="office in offices" 
                          :key="office.id" 
                          :value="office.id"
                        >
                          {{ office.name }}
                        </option>
                      </select>
                      <div class="select-icons">
                        <i class="fas fa-building"></i>
                        <i class="fas fa-chevron-down select-arrow"></i>
                      </div>
                      <div v-if="loadingOffices" class="loading-indicator">
                        <i class="fas fa-spinner fa-spin"></i>
                      </div>
                    </div>
                    <div v-if="errors.office" class="validation-error">
                      <i class="fas fa-exclamation-circle"></i>
                      {{ errors.office }}
                    </div>
                  </div>

                  <div class="form-group full-width">
                    <label for="department" class="form-label">
                      Department / Section
                    </label>
                    <div class="input-with-validation">
                      <input
                        id="department"
                        v-model="formData.department"
                        type="text"
                        class="form-input"
                        placeholder="Enter department or section"
                      />
                      <div class="input-icons">
                        <i class="fas fa-sitemap"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- STEP 3: ACCOUNT INFO -->
              <div v-else-if="currentStep === 3" key="step3" class="form-step">
                <h2 class="step-header">
                  <i class="fas fa-lock"></i>
                  Account Security
                </h2>
                <p class="step-description">Set up your login credentials.</p>

                <div class="form-grid">
                  <div class="form-group">
                    <label for="email" class="form-label">
                      Email Address *
                      <span class="label-helper">(will be used for login)</span>
                    </label>
                    <div class="input-with-validation">
                      <input
                        id="email"
                        v-model="formData.email"
                        type="email"
                        :class="['form-input', { 'invalid': errors.email }]"
                        placeholder="name@denr.gov.ph"
                        @input="debounceEmailCheck"
                        @blur="validateField('email')"
                      />
                      <div class="input-icons">
                        <i class="fas fa-envelope"></i>
                        <span v-if="checkingEmail" class="loading-icon">
                          <i class="fas fa-spinner fa-spin"></i>
                        </span>
                        <span v-else-if="emailAvailable && formData.email" class="valid-icon">
                          <i class="fas fa-check"></i>
                        </span>
                      </div>
                    </div>
                    <div v-if="errors.email" class="validation-error">
                      <i class="fas fa-exclamation-circle"></i>
                      {{ errors.email }}
                    </div>
                    <div v-if="emailAvailable && formData.email && !errors.email" class="validation-success">
                      <i class="fas fa-check-circle"></i>
                      Email is available
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password" class="form-label">
                      Password *
                      <span class="label-helper">(8+ characters with mixed case, numbers & symbols)</span>
                    </label>
                    <div class="input-with-validation">
                      <input
                        id="password"
                        v-model="formData.password"
                        :type="showPassword ? 'text' : 'password'"
                        :class="['form-input', { 'invalid': errors.password }]"
                        placeholder="Create a strong password"
                        @input="checkPasswordStrength"
                        @blur="validateField('password')"
                      />
                      <div class="input-icons">
                        <i class="fas fa-key"></i>
                        <button
                          type="button"
                          class="toggle-password"
                          @click="showPassword = !showPassword"
                        >
                          <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                        </button>
                      </div>
                    </div>

                    <!-- Password Strength Meter -->
                    <div v-if="formData.password" class="password-strength">
                      <div class="strength-meter">
                        <div class="strength-bar" :class="passwordStrength.class"></div>
                      </div>
                      <div class="strength-label">
                        Strength: <span :class="passwordStrength.class">{{ passwordStrength.label }}</span>
                      </div>
                    </div>

                    <div v-if="errors.password" class="validation-error">
                      <i class="fas fa-exclamation-circle"></i>
                      {{ errors.password }}
                    </div>

                    <!-- Password Requirements -->
                    <div class="password-requirements">
                      <div 
                        v-for="req in passwordRequirements" 
                        :key="req.id"
                        :class="['requirement', { 'met': req.met }]"
                      >
                        <i :class="req.met ? 'fas fa-check-circle' : 'fas fa-circle'"></i>
                        <span>{{ req.text }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="confirmPassword" class="form-label">
                      Confirm Password *
                    </label>
                    <div class="input-with-validation">
                      <input
                        id="confirmPassword"
                        v-model="formData.confirmPassword"
                        :type="showConfirmPassword ? 'text' : 'password'"
                        :class="['form-input', { 'invalid': errors.confirmPassword }]"
                        placeholder="Re-enter your password"
                        @input="checkPasswordMatch"
                        @blur="validateField('confirmPassword')"
                      />
                      <div class="input-icons">
                        <i class="fas fa-key"></i>
                        <button
                          type="button"
                          class="toggle-password"
                          @click="showConfirmPassword = !showConfirmPassword"
                        >
                          <i :class="showConfirmPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                        </button>
                      </div>
                    </div>
                    <div v-if="errors.confirmPassword" class="validation-error">
                      <i class="fas fa-exclamation-circle"></i>
                      {{ errors.confirmPassword }}
                    </div>
                    <div v-if="passwordsMatch && formData.password" class="validation-success">
                      <i class="fas fa-check-circle"></i>
                      Passwords match
                    </div>
                  </div>
                </div>
              </div>

              <!-- STEP 4: VERIFICATION -->
              <div v-else-if="currentStep === 4" key="step4" class="form-step">
                <h2 class="step-header">
                  <i class="fas fa-shield-alt"></i>
                  Verification
                </h2>
                <p class="step-description">Complete verification to secure your account.</p>

                <div class="verification-content">
                  <!-- Terms & Conditions -->
                  <div class="terms-section">
                    <h3 class="terms-title">
                      <i class="fas fa-file-contract"></i>
                      Terms & Conditions
                    </h3>
                    <div class="terms-content">
                      <p>By creating an account, you agree to:</p>
                      <ul>
                        <li>Use the ICT Service Management System only for official purposes</li>
                        <li>Maintain the confidentiality of your login credentials</li>
                        <li>Comply with all applicable laws and regulations</li>
                        <li>Accept responsibility for all activities under your account</li>
                      </ul>
                    </div>
                    <label class="checkbox-container">
                      <input
                        type="checkbox"
                        v-model="acceptedTerms"
                        @change="validateField('terms')"
                      />
                      <span class="checkmark"></span>
                      <span class="checkbox-label">
                        I have read and agree to the 
                        <a href="#" class="terms-link" @click.prevent="showTermsModal = true">Terms of Service</a>
                        and 
                        <a href="#" class="terms-link" @click.prevent="showPrivacyModal = true">Privacy Policy</a>
                      </span>
                    </label>
                    <div v-if="errors.terms" class="validation-error">
                      <i class="fas fa-exclamation-circle"></i>
                      {{ errors.terms }}
                    </div>
                  </div>

                  <!-- CAPTCHA -->
                  <div class="captcha-section">
                    <h3 class="captcha-title">
                      <i class="fas fa-robot"></i>
                      Security Check
                    </h3>
                    <div class="captcha-container">
                      <div class="captcha-display">
                        <div class="captcha-text">{{ captchaText }}</div>
                        <button @click="refreshCaptcha" class="captcha-refresh" title="Refresh captcha">
                          <i class="fas fa-redo"></i>
                        </button>
                      </div>
                      <div class="captcha-input-group">
                        <input
                          v-model="captchaInput"
                          type="text"
                          :class="['captcha-input', { 'invalid': errors.captcha }]"
                          placeholder="Enter the code above"
                          @input="clearError('captcha')"
                        />
                        <button @click="refreshCaptcha" class="captcha-audio" title="Audio captcha">
                          <i class="fas fa-volume-up"></i>
                        </button>
                      </div>
                      <div v-if="errors.captcha" class="validation-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ errors.captcha }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- STEP 5: PREVIEW & CONFIRMATION -->
              <div v-else key="step5" class="form-step">
                <h2 class="step-header">
                  <i class="fas fa-clipboard-check"></i>
                  Review & Confirm
                </h2>
                <p class="step-description">Please review your information before submitting.</p>

                <div class="preview-container">
                  <div class="preview-grid">
                    <!-- Personal Info -->
                    <div class="preview-section">
                      <h3 class="preview-title">
                        <i class="fas fa-user"></i>
                        Personal Information
                      </h3>
                      <div class="preview-content">
                        <div class="preview-item">
                          <span class="preview-label">Full Name:</span>
                          <span class="preview-value">{{ formData.name }}</span>
                        </div>
                        <div class="preview-item">
                          <span class="preview-label">Contact Number:</span>
                          <span class="preview-value">{{ formatPhoneDisplay(formData.contact) }}</span>
                        </div>
                        <div class="preview-item">
                          <span class="preview-label">Position:</span>
                          <span class="preview-value">{{ formData.position }}</span>
                        </div>
                        <div class="preview-item">
                          <span class="preview-label">Role:</span>
                          <span class="preview-value">{{ formatRole(formData.role) }}</span>
                        </div>
                      </div>
                    </div>

                    <!-- Office Info -->
                    <div class="preview-section">
                      <h3 class="preview-title">
                        <i class="fas fa-building"></i>
                        Office Information
                      </h3>
                      <div class="preview-content">
                        <div class="preview-item">
                          <span class="preview-label">Head Office:</span>
                          <span class="preview-value">{{ formatHeadOffice(formData.headOffice) }}</span>
                        </div>
                        <div class="preview-item">
                          <span class="preview-label">Office:</span>
                          <span class="preview-value">{{ getOfficeName(formData.office) }}</span>
                        </div>
                        <div class="preview-item" v-if="formData.department">
                          <span class="preview-label">Department:</span>
                          <span class="preview-value">{{ formData.department }}</span>
                        </div>
                      </div>
                    </div>

                    <!-- Account Info -->
                    <div class="preview-section">
                      <h3 class="preview-title">
                        <i class="fas fa-lock"></i>
                        Account Information
                      </h3>
                      <div class="preview-content">
                        <div class="preview-item">
                          <span class="preview-label">Email:</span>
                          <span class="preview-value">{{ formData.email }}</span>
                        </div>
                        <div class="preview-item">
                          <span class="preview-label">Password:</span>
                          <span class="preview-value">
                            <span class="password-dots">••••••••</span>
                            <span class="password-strength-badge" :class="passwordStrength.class">
                              {{ passwordStrength.label }}
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Final Check -->
                  <div class="final-check">
                    <label class="checkbox-container final-confirmation">
                      <input
                        type="checkbox"
                        v-model="finalConfirmation"
                        @change="validateField('finalConfirmation')"
                      />
                      <span class="checkmark"></span>
                      <span class="checkbox-label">
                        I confirm that all information provided is accurate and complete
                      </span>
                    </label>
                    <div v-if="errors.finalConfirmation" class="validation-error">
                      <i class="fas fa-exclamation-circle"></i>
                      {{ errors.finalConfirmation }}
                    </div>
                  </div>
                </div>
              </div>
            </transition>

            <!-- NAVIGATION BUTTONS -->
            <div class="form-navigation">
              <button
                v-if="currentStep > 1"
                @click="previousStep"
                class="btn btn-secondary"
                :disabled="isSubmitting"
              >
                <i class="fas fa-arrow-left"></i>
                Back
              </button>
              
              <div class="nav-spacer"></div>
              
              <button
                v-if="currentStep < totalSteps"
                @click="nextStep"
                class="btn btn-primary"
                :disabled="!isStepValid || isSubmitting"
              >
                Continue
                <i class="fas fa-arrow-right"></i>
              </button>
              
              <button
                v-else
                @click="submitRegistration"
                class="btn btn-success"
                :disabled="!isStepValid || isSubmitting || !finalConfirmation"
              >
                <template v-if="!isSubmitting">
                  <i class="fas fa-paper-plane"></i>
                  Submit Registration
                </template>
                <template v-else>
                  <i class="fas fa-spinner fa-spin"></i>
                  Processing...
                </template>
              </button>
            </div>
          </div>
        </div>

        <!-- LOGIN LINK -->
        <div class="login-link-container">
          <p>Already have an account?</p>
          <a href="/" class="login-link">
            <i class="fas fa-sign-in-alt"></i>
            Sign in to your account
          </a>
        </div>
      </main>

      <!-- FOOTER -->
      <footer class="registration-footer">
        <p>© 2024 DENR ICT Service Management System. All rights reserved.</p>
        <p class="footer-links">
          <a href="#">Privacy Policy</a>
          <span class="separator">•</span>
          <a href="#">Terms of Service</a>
          <span class="separator">•</span>
          <a href="#">Help Center</a>
        </p>
      </footer>
    </div>
  </div>
</template>

<script>
export default {
  name: 'EnhancedRegistrationForm',
  data() {
    return {
      currentStep: 1,
      totalSteps: 5,
      isSubmitting: false,
      registrationSuccess: false,
      apiError: null,
      showPassword: false,
      showConfirmPassword: false,
      checkingEmail: false,
      emailAvailable: false,
      acceptedTerms: false,
      finalConfirmation: false,
      captchaText: '',
      captchaInput: '',
      loadingOffices: false,
      emailCheckTimeout: null,
      
      steps: [
        { id: 1, title: 'Personal Info', icon: 'fas fa-user' },
        { id: 2, title: 'Office Info', icon: 'fas fa-building' },
        { id: 3, title: 'Account Setup', icon: 'fas fa-lock' },
        { id: 4, title: 'Verification', icon: 'fas fa-shield-alt' },
        { id: 5, title: 'Confirmation', icon: 'fas fa-clipboard-check' }
      ],
      
      formData: {
        name: '',
        contact: '',
        position: '',
        role: '',
        headOffice: '',
        office: '',
        department: '',
        email: '',
        password: '',
        confirmPassword: ''
      },
      
      errors: {
        name: '',
        contact: '',
        position: '',
        role: '',
        headOffice: '',
        office: '',
        email: '',
        password: '',
        confirmPassword: '',
        terms: '',
        captcha: '',
        finalConfirmation: ''
      },
      
      offices: [],
      officeData: {
        central: [
          { id: 'co_admin', name: 'Administrative Division' },
          { id: 'co_finance', name: 'Finance Division' },
          { id: 'co_hr', name: 'Human Resources Division' },
          { id: 'co_ict', name: 'ICT Division' }
        ],
        regional: [
          { id: 'ro_ncr', name: 'NCR Regional Office' },
          { id: 'ro_region3', name: 'Region III Office' },
          { id: 'ro_region4', name: 'Region IV-A Office' },
          { id: 'ro_region7', name: 'Region VII Office' }
        ],
        provincial: [
          { id: 'po_pampanga', name: 'Pampanga Provincial Office' },
          { id: 'po_bulacan', name: 'Bulacan Provincial Office' },
          { id: 'po_cavite', name: 'Cavite Provincial Office' },
          { id: 'po_laguna', name: 'Laguna Provincial Office' }
        ],
        district: [
          { id: 'do_north', name: 'North District Office' },
          { id: 'do_south', name: 'South District Office' },
          { id: 'do_east', name: 'East District Office' },
          { id: 'do_west', name: 'West District Office' }
        ]
      }
    };
  },
  computed: {
    progressPercentage() {
      return `${((this.currentStep - 1) / (this.totalSteps - 1)) * 100}%`;
    },
    
    isStepValid() {
      const stepValidators = {
        1: () => !this.errors.name && !this.errors.contact && 
              !this.errors.position && !this.errors.role &&
              this.formData.name && this.formData.contact && 
              this.formData.position && this.formData.role,
        2: () => !this.errors.headOffice && !this.errors.office &&
              this.formData.headOffice && this.formData.office,
        3: () => !this.errors.email && !this.errors.password && 
              !this.errors.confirmPassword && this.emailAvailable &&
              this.formData.email && this.formData.password && 
              this.formData.confirmPassword && this.passwordsMatch,
        4: () => !this.errors.terms && !this.errors.captcha &&
              this.acceptedTerms && this.captchaInput === this.captchaText,
        5: () => !this.errors.finalConfirmation && this.finalConfirmation
      };
      
      return stepValidators[this.currentStep] ? stepValidators[this.currentStep]() : false;
    },
    
    passwordsMatch() {
      return this.formData.password === this.formData.confirmPassword;
    },
    
    passwordRequirements() {
      const password = this.formData.password;
      return [
        { id: 1, text: 'At least 8 characters', met: password.length >= 8 },
        { id: 2, text: 'Contains uppercase letter', met: /[A-Z]/.test(password) },
        { id: 3, text: 'Contains lowercase letter', met: /[a-z]/.test(password) },
        { id: 4, text: 'Contains number', met: /\d/.test(password) },
        { id: 5, text: 'Contains special character', met: /[!@#$%^&*]/.test(password) }
      ];
    },
    
    passwordStrength() {
      const password = this.formData.password;
      let strength = 0;
      
      if (password.length >= 8) strength++;
      if (/[A-Z]/.test(password)) strength++;
      if (/[a-z]/.test(password)) strength++;
      if (/\d/.test(password)) strength++;
      if (/[!@#$%^&*]/.test(password)) strength++;
      
      if (strength <= 1) return { class: 'very-weak', label: 'Very Weak' };
      if (strength <= 2) return { class: 'weak', label: 'Weak' };
      if (strength <= 3) return { class: 'medium', label: 'Medium' };
      if (strength <= 4) return { class: 'strong', label: 'Strong' };
      return { class: 'very-strong', label: 'Very Strong' };
    }
  },
  created() {
    this.generateCaptcha();
  },
  methods: {
    generateCaptcha() {
      const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';
      let captcha = '';
      for (let i = 0; i < 6; i++) {
        captcha += chars.charAt(Math.floor(Math.random() * chars.length));
      }
      this.captchaText = captcha;
    },
    
    refreshCaptcha() {
      this.generateCaptcha();
      this.captchaInput = '';
      this.clearError('captcha');
    },
    
    formatContactNumber() {
      let phone = this.formData.contact.replace(/\D/g, '');
      if (phone.length > 11) phone = phone.substring(0, 11);
      
      if (phone.length > 4 && phone.length <= 7) {
        phone = phone.replace(/(\d{4})(\d+)/, '$1 $2');
      } else if (phone.length > 7) {
        phone = phone.replace(/(\d{4})(\d{3})(\d+)/, '$1 $2 $3');
      }
      
      this.formData.contact = phone;
    },
    
    formatPhoneDisplay(phone) {
      const digits = phone.replace(/\D/g, '');
      if (digits.length === 11) {
        return digits.replace(/(\d{4})(\d{3})(\d{4})/, '$1 $2 $3');
      }
      return phone;
    },
    
    formatRole(role) {
      const roleMap = {
        staff: 'Staff',
        supervisor: 'Supervisor',
        admin: 'Administrator',
        manager: 'Manager',
        director: 'Director'
      };
      return roleMap[role] || role;
    },
    
    formatHeadOffice(office) {
      const officeMap = {
        central: 'Central Office',
        regional: 'Regional Office',
        provincial: 'Provincial Office',
        district: 'District Office'
      };
      return officeMap[office] || office;
    },
    
    getOfficeName(officeId) {
      const allOffices = Object.values(this.officeData).flat();
      const office = allOffices.find(o => o.id === officeId);
      return office ? office.name : officeId;
    },
    
    onHeadOfficeChange() {
      this.formData.office = '';
      this.offices = [];
      this.clearError('office');
      
      if (this.formData.headOffice) {
        this.loadingOffices = true;
        setTimeout(() => {
          this.offices = this.officeData[this.formData.headOffice] || [];
          this.loadingOffices = false;
        }, 500);
      }
    },
    
    debounceEmailCheck() {
      clearTimeout(this.emailCheckTimeout);
      this.clearError('email');
      
      if (!this.formData.email) {
        this.emailAvailable = false;
        return;
      }
      
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(this.formData.email)) {
        return;
      }
      
      this.checkingEmail = true;
      this.emailCheckTimeout = setTimeout(() => {
        this.checkEmailAvailability();
      }, 800);
    },
    
    async checkEmailAvailability() {
      try {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1000));
        
        // For demo purposes, email is available if it contains "test"
        this.emailAvailable = !this.formData.email.includes('taken');
        
        if (!this.emailAvailable) {
          this.errors.email = 'This email is already registered';
        }
      } catch (error) {
        console.error('Email check failed:', error);
      } finally {
        this.checkingEmail = false;
      }
    },
    
    checkPasswordStrength() {
      // Computed property handles this
    },
    
    checkPasswordMatch() {
      if (this.formData.confirmPassword && !this.passwordsMatch) {
        this.errors.confirmPassword = 'Passwords do not match';
      } else {
        this.clearError('confirmPassword');
      }
    },
    
    validateField(field) {
      const validators = {
        name: () => {
          if (!this.formData.name.trim()) return 'Full name is required';
          if (this.formData.name.trim().length < 3) return 'Name is too short';
          if (this.formData.name.trim().length > 100) return 'Name is too long';
          return '';
        },
        contact: () => {
          const digits = this.formData.contact.replace(/\D/g, '');
          if (!digits) return 'Contact number is required';
          if (digits.length < 11) return 'Please enter a valid 11-digit mobile number';
          if (!digits.startsWith('09')) return 'Mobile number must start with 09';
          return '';
        },
        position: () => {
          if (!this.formData.position.trim()) return 'Position is required';
          if (this.formData.position.trim().length < 2) return 'Position is too short';
          return '';
        },
        role: () => {
          if (!this.formData.role) return 'Please select a role';
          return '';
        },
        headOffice: () => {
          if (!this.formData.headOffice) return 'Please select head office';
          return '';
        },
        office: () => {
          if (!this.formData.office) return 'Please select office';
          return '';
        },
        email: () => {
          if (!this.formData.email) return 'Email is required';
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test(this.formData.email)) return 'Please enter a valid email';
          if (!this.emailAvailable && this.formData.email) return 'Email is not available';
          return '';
        },
        password: () => {
          if (!this.formData.password) return 'Password is required';
          if (this.formData.password.length < 8) return 'Password must be at least 8 characters';
          if (!/[A-Z]/.test(this.formData.password)) return 'Must contain uppercase letter';
          if (!/[a-z]/.test(this.formData.password)) return 'Must contain lowercase letter';
          if (!/\d/.test(this.formData.password)) return 'Must contain number';
          if (!/[!@#$%^&*]/.test(this.formData.password)) return 'Must contain special character';
          return '';
        },
        confirmPassword: () => {
          if (!this.formData.confirmPassword) return 'Please confirm your password';
          if (!this.passwordsMatch) return 'Passwords do not match';
          return '';
        },
        terms: () => {
          if (!this.acceptedTerms) return 'You must accept the terms and conditions';
          return '';
        },
        captcha: () => {
          if (!this.captchaInput) return 'Please enter the captcha code';
          if (this.captchaInput !== this.captchaText) return 'Captcha code is incorrect';
          return '';
        },
        finalConfirmation: () => {
          if (!this.finalConfirmation) return 'Please confirm all information is correct';
          return '';
        }
      };
      
      if (validators[field]) {
        this.errors[field] = validators[field]();
      }
    },
    
    clearError(field) {
      this.errors[field] = '';
    },
    
    goToStep(step) {
      if (step < this.currentStep) {
        this.currentStep = step;
      }
    },
    
    previousStep() {
      if (this.currentStep > 1) {
        this.currentStep--;
        this.apiError = null;
      }
    },
    
    async nextStep() {
      // Validate current step before proceeding
      const stepFields = {
        1: ['name', 'contact', 'position', 'role'],
        2: ['headOffice', 'office'],
        3: ['email', 'password', 'confirmPassword'],
        4: ['terms', 'captcha']
      };
      
      const fields = stepFields[this.currentStep];
      let isValid = true;
      
      if (fields) {
        fields.forEach(field => {
          this.validateField(field);
          if (this.errors[field]) {
            isValid = false;
          }
        });
      }
      
      if (isValid) {
        this.currentStep++;
        this.apiError = null;
        
        // Scroll to top of form
        window.scrollTo({ top: 0, behavior: 'smooth' });
      } else {
        this.apiError = 'Please fix the errors before proceeding';
      }
    },
    
    async submitRegistration() {
      this.isSubmitting = true;
      this.apiError = null;
      
      try {
        // Validate all steps
        for (let i = 1; i <= this.totalSteps; i++) {
          const stepFields = {
            1: ['name', 'contact', 'position', 'role'],
            2: ['headOffice', 'office'],
            3: ['email', 'password', 'confirmPassword'],
            4: ['terms', 'captcha'],
            5: ['finalConfirmation']
          }[i];
          
          if (stepFields) {
            stepFields.forEach(field => this.validateField(field));
            if (stepFields.some(field => this.errors[field])) {
              throw new Error('Please fix all validation errors');
            }
          }
        }
        
        // Prepare registration data
        const registrationData = {
          ...this.formData,
          contact: this.formData.contact.replace(/\D/g, '')
        };
        
        // Simulate API call
        console.log('Submitting registration:', registrationData);
        
        await new Promise(resolve => setTimeout(resolve, 2000));
        
        // Simulate successful registration
        this.registrationSuccess = true;
        
        // Redirect after 3 seconds
        setTimeout(() => {
          window.location.href = '/';
        }, 3000);
        
      } catch (error) {
        this.apiError = error.message || 'Registration failed. Please try again.';
        
        // Go to first step with error
        for (let i = 1; i <= this.totalSteps; i++) {
          const stepFields = {
            1: ['name', 'contact', 'position', 'role'],
            2: ['headOffice', 'office'],
            3: ['email', 'password', 'confirmPassword'],
            4: ['terms', 'captcha'],
            5: ['finalConfirmation']
          }[i];
          
          if (stepFields && stepFields.some(field => this.errors[field])) {
            this.currentStep = i;
            break;
          }
        }
      } finally {
        this.isSubmitting = false;
      }
    }
  }
};
</script>

<style scoped>
/* Base Styles */
.registration-page {
  min-height: 100vh;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  padding: 20px;
  font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
}

.background-gradient {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
  z-index: 0;
}

.registration-container {
  position: relative;
  z-index: 1;
  max-width: 1200px;
  margin: 0 auto;
}

/* Header */
.registration-header {
  margin-bottom: 30px;
}

.header-content {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 20px;
  padding: 30px;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.logo-container {
  display: flex;
  align-items: center;
  gap: 20px;
}

.logo-icon {
  width: 70px;
  height: 70px;
  background: linear-gradient(135deg, #667eea, #764ba2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 30px;
}

.logo-text h1 {
  margin: 0;
  color: #2d3748;
  font-size: 24px;
  font-weight: 700;
}

.logo-text p {
  margin: 5px 0 0;
  color: #718096;
  font-size: 16px;
}

/* Form Card */
.registration-content {
  margin-bottom: 40px;
}

.form-card {
  background: white;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

/* Progress Bar */
.form-progress {
  background: linear-gradient(to right, #667eea, #764ba2);
  padding: 30px 40px;
  color: white;
}

.progress-bar {
  height: 6px;
  background: rgba(255, 255, 255, 0.3);
  border-radius: 3px;
  margin-bottom: 40px;
  overflow: hidden;
}

.progress-fill {
  height: 100%;
  background: white;
  border-radius: 3px;
  transition: width 0.5s ease;
}

.steps {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 20px;
}

.step {
  display: flex;
  align-items: center;
  gap: 15px;
  cursor: pointer;
  padding: 15px;
  border-radius: 12px;
  transition: all 0.3s ease;
  opacity: 0.7;
}

.step.active {
  opacity: 1;
  background: rgba(255, 255, 255, 0.1);
}

.step.completed {
  opacity: 1;
}

.step-icon {
  width: 50px;
  height: 50px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
}

.step.active .step-icon {
  background: white;
  color: #667eea;
}

.step.completed .step-icon {
  background: #10b981;
  color: white;
}

.step-info {
  display: flex;
  flex-direction: column;
}

.step-label {
  font-size: 12px;
  opacity: 0.8;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.step-title {
  font-size: 16px;
  font-weight: 600;
}

/* Success Container */
.success-container {
  text-align: center;
  padding: 80px 40px;
}

.success-icon {
  font-size: 80px;
  color: #10b981;
  margin-bottom: 30px;
}

.success-container h2 {
  color: #2d3748;
  font-size: 32px;
  margin-bottom: 15px;
}

.success-container p {
  color: #718096;
  font-size: 18px;
  margin-bottom: 30px;
}

.loading-dots {
  display: flex;
  justify-content: center;
  gap: 8px;
}

.loading-dots span {
  width: 12px;
  height: 12px;
  background: #667eea;
  border-radius: 50%;
  animation: bounce 1.4s infinite ease-in-out;
}

.loading-dots span:nth-child(1) { animation-delay: -0.32s; }
.loading-dots span:nth-child(2) { animation-delay: -0.16s; }

@keyframes bounce {
  0%, 80%, 100% { transform: scale(0); }
  40% { transform: scale(1); }
}

/* Error Alert */
.error-alert {
  background: #fee2e2;
  border: 1px solid #fecaca;
  border-radius: 12px;
  padding: 20px;
  margin: 30px;
  display: flex;
  align-items: flex-start;
  gap: 15px;
  animation: slideDown 0.3s ease;
}

.error-alert i {
  color: #dc2626;
  font-size: 20px;
  margin-top: 2px;
}

.error-content {
  flex: 1;
}

.error-content strong {
  color: #7f1d1d;
  display: block;
  margin-bottom: 5px;
}

.error-content p {
  color: #991b1b;
  margin: 0;
  font-size: 14px;
}

.close-error {
  background: none;
  border: none;
  color: #dc2626;
  cursor: pointer;
  padding: 5px;
  font-size: 16px;
}

/* Form Content */
.form-content {
  padding: 40px;
}

.form-step {
  min-height: 400px;
}

.step-header {
  display: flex;
  align-items: center;
  gap: 15px;
  color: #2d3748;
  font-size: 28px;
  margin-bottom: 10px;
}

.step-header i {
  color: #667eea;
}

.step-description {
  color: #718096;
  font-size: 16px;
  margin-bottom: 40px;
}

/* Form Grid */
.form-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 30px;
}

.form-group.full-width {
  grid-column: 1 / -1;
}

.form-label {
  display: block;
  color: #4a5568;
  font-size: 14px;
  font-weight: 600;
  margin-bottom: 10px;
}

.label-helper {
  color: #a0aec0;
  font-weight: 400;
  font-size: 12px;
}

/* Input Styles */
.input-with-validation,
.select-with-validation {
  position: relative;
}

.form-input,
.form-select {
  width: 100%;
  padding: 16px 50px 16px 20px;
  border: 2px solid #e2e8f0;
  border-radius: 12px;
  font-size: 16px;
  color: #2d3748;
  background: white;
  transition: all 0.3s ease;
  font-family: inherit;
}

.form-input:focus,
.form-select:focus {
  outline: none;
  border-color: #667eea;
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-input.invalid,
.form-select.invalid {
  border-color: #f56565;
}

.form-input::placeholder {
  color: #a0aec0;
}

.input-icons,
.select-icons {
  position: absolute;
  right: 20px;
  top: 50%;
  transform: translateY(-50%);
  display: flex;
  align-items: center;
  gap: 10px;
  color: #a0aec0;
}

.valid-icon {
  color: #10b981;
}

.loading-icon {
  color: #667eea;
}

.select-arrow {
  pointer-events: none;
}

.toggle-password {
  background: none;
  border: none;
  color: #a0aec0;
  cursor: pointer;
  padding: 0;
  font-size: 16px;
  transition: color 0.2s;
}

.toggle-password:hover {
  color: #667eea;
}

/* Password Strength */
.password-strength {
  margin-top: 15px;
}

.strength-meter {
  height: 6px;
  background: #e2e8f0;
  border-radius: 3px;
  overflow: hidden;
  margin-bottom: 8px;
}

.strength-bar {
  height: 100%;
  border-radius: 3px;
  transition: width 0.3s ease, background-color 0.3s ease;
}

.strength-bar.very-weak {
  width: 20%;
  background: #f56565;
}

.strength-bar.weak {
  width: 40%;
  background: #ed8936;
}

.strength-bar.medium {
  width: 60%;
  background: #ecc94b;
}

.strength-bar.strong {
  width: 80%;
  background: #48bb78;
}

.strength-bar.very-strong {
  width: 100%;
  background: #10b981;
}

.strength-label {
  font-size: 12px;
  color: #718096;
  text-align: right;
}

.strength-label span {
  font-weight: 600;
}

.strength-label span.very-weak { color: #f56565; }
.strength-label span.weak { color: #ed8936; }
.strength-label span.medium { color: #ecc94b; }
.strength-label span.strong { color: #48bb78; }
.strength-label span.very-strong { color: #10b981; }

/* Password Requirements */
.password-requirements {
  margin-top: 15px;
  padding: 15px;
  background: #f7fafc;
  border-radius: 8px;
}

.requirement {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 13px;
  color: #a0aec0;
  margin-bottom: 8px;
}

.requirement:last-child {
  margin-bottom: 0;
}

.requirement.met {
  color: #10b981;
}

.requirement i {
  font-size: 12px;
}

/* Validation Messages */
.validation-error {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #f56565;
  font-size: 13px;
  margin-top: 8px;
}

.validation-success {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #10b981;
  font-size: 13px;
  margin-top: 8px;
}

/* Verification Content */
.verification-content {
  max-width: 800px;
  margin: 0 auto;
}

.terms-section,
.captcha-section {
  background: #f7fafc;
  border-radius: 16px;
  padding: 30px;
  margin-bottom: 30px;
}

.terms-title,
.captcha-title {
  display: flex;
  align-items: center;
  gap: 12px;
  color: #2d3748;
  font-size: 20px;
  margin-bottom: 20px;
}

.terms-title i {
  color: #667eea;
}

.captcha-title i {
  color: #ed8936;
}

.terms-content {
  color: #4a5568;
  line-height: 1.6;
  margin-bottom: 25px;
}

.terms-content ul {
  margin: 15px 0;
  padding-left: 20px;
}

.terms-content li {
  margin-bottom: 8px;
}

/* Checkbox */
.checkbox-container {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  cursor: pointer;
  position: relative;
}

.checkbox-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.checkmark {
  position: relative;
  top: 3px;
  width: 20px;
  height: 20px;
  border: 2px solid #cbd5e0;
  border-radius: 6px;
  flex-shrink: 0;
  transition: all 0.2s;
}

.checkbox-container input:checked ~ .checkmark {
  background: #667eea;
  border-color: #667eea;
}

.checkbox-container input:checked ~ .checkmark::after {
  content: '';
  position: absolute;
  left: 6px;
  top: 2px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}

.checkbox-label {
  color: #4a5568;
  font-size: 14px;
  line-height: 1.5;
  flex: 1;
}

.terms-link {
  color: #667eea;
  text-decoration: none;
  font-weight: 600;
}

.terms-link:hover {
  text-decoration: underline;
}

/* Captcha */
.captcha-container {
  background: white;
  border-radius: 12px;
  padding: 25px;
  border: 1px solid #e2e8f0;
}

.captcha-display {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 20px;
  padding: 20px;
  background: linear-gradient(45deg, #f7fafc, #edf2f7);
  border-radius: 8px;
  font-family: 'Courier New', monospace;
}

.captcha-text {
  font-size: 32px;
  font-weight: 700;
  letter-spacing: 10px;
  color: #2d3748;
  text-shadow: 2px 2px 0 #e2e8f0;
}

.captcha-refresh {
  background: #667eea;
  color: white;
  border: none;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  transition: transform 0.2s;
}

.captcha-refresh:hover {
  transform: rotate(90deg);
}

.captcha-input-group {
  display: flex;
  gap: 15px;
}

.captcha-input {
  flex: 1;
  padding: 16px 20px;
  border: 2px solid #e2e8f0;
  border-radius: 12px;
  font-size: 18px;
  text-align: center;
  letter-spacing: 5px;
  font-family: 'Courier New', monospace;
}

.captcha-input:focus {
  outline: none;
  border-color: #667eea;
}

.captcha-input.invalid {
  border-color: #f56565;
}

.captcha-audio {
  background: #ed8936;
  color: white;
  border: none;
  width: 60px;
  border-radius: 12px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  transition: background 0.2s;
}

.captcha-audio:hover {
  background: #dd6b20;
}

/* Preview Container */
.preview-container {
  background: #f7fafc;
  border-radius: 16px;
  padding: 40px;
}

.preview-grid {
  display: grid;
  gap: 30px;
  margin-bottom: 40px;
}

.preview-section {
  background: white;
  border-radius: 12px;
  padding: 25px;
  border: 1px solid #e2e8f0;
}

.preview-title {
  display: flex;
  align-items: center;
  gap: 12px;
  color: #2d3748;
  font-size: 18px;
  margin-bottom: 20px;
  padding-bottom: 15px;
  border-bottom: 2px solid #e2e8f0;
}

.preview-title i {
  color: #667eea;
}

.preview-content {
  display: grid;
  gap: 15px;
}

.preview-item {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 12px 0;
  border-bottom: 1px solid #f7fafc;
}

.preview-item:last-child {
  border-bottom: none;
}

.preview-label {
  color: #718096;
  font-size: 14px;
  font-weight: 600;
  min-width: 150px;
}

.preview-value {
  color: #2d3748;
  font-size: 16px;
  font-weight: 500;
  text-align: right;
  flex: 1;
}

.password-dots {
  font-size: 24px;
  letter-spacing: 3px;
  color: #4a5568;
}

.password-strength-badge {
  display: inline-block;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  margin-left: 15px;
}

.password-strength-badge.very-weak {
  background: #fed7d7;
  color: #c53030;
}

.password-strength-badge.weak {
  background: #feebc8;
  color: #c05621;
}

.password-strength-badge.medium {
  background: #fefcbf;
  color: #744210;
}

.password-strength-badge.strong {
  background: #c6f6d5;
  color: #22543d;
}

.password-strength-badge.very-strong {
  background: #b2f5ea;
  color: #234e52;
}

.final-check {
  background: white;
  border-radius: 12px;
  padding: 25px;
  border: 2px solid #e2e8f0;
}

.final-confirmation .checkbox-label {
  font-size: 16px;
  font-weight: 600;
  color: #2d3748;
}

/* Form Navigation */
.form-navigation {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 40px;
  padding-top: 40px;
  border-top: 1px solid #e2e8f0;
}

.nav-spacer {
  flex: 1;
}

.btn {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  padding: 16px 32px;
  border-radius: 12px;
  font-size: 16px;
  font-weight: 600;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
  font-family: inherit;
}

.btn-secondary {
  background: #f7fafc;
  color: #4a5568;
  border: 2px solid #e2e8f0;
}

.btn-secondary:hover:not(:disabled) {
  background: #edf2f7;
  border-color: #cbd5e0;
}

.btn-primary {
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: white;
}

.btn-primary:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
}

.btn-success {
  background: linear-gradient(135deg, #10b981, #059669);
  color: white;
}

.btn-success:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
}

.btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none !important;
  box-shadow: none !important;
}

/* Login Link */
.login-link-container {
  text-align: center;
  margin-top: 40px;
  padding: 25px;
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  border-radius: 16px;
}

.login-link-container p {
  color: #718096;
  margin-bottom: 10px;
  font-size: 16px;
}

.login-link {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  color: #667eea;
  font-size: 18px;
  font-weight: 600;
  text-decoration: none;
  transition: color 0.2s;
}

.login-link:hover {
  color: #764ba2;
}

.login-link i {
  font-size: 16px;
}

/* Footer */
.registration-footer {
  text-align: center;
  padding: 30px;
  color: rgba(255, 255, 255, 0.8);
}

.registration-footer p {
  margin: 10px 0;
}

.footer-links {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 20px;
  flex-wrap: wrap;
}

.footer-links a {
  color: rgba(255, 255, 255, 0.8);
  text-decoration: none;
  transition: color 0.2s;
}

.footer-links a:hover {
  color: white;
}

.separator {
  opacity: 0.5;
}

/* Animations */
.slide-enter-active,
.slide-leave-active {
  transition: all 0.4s ease;
}

.slide-enter-from {
  opacity: 0;
  transform: translateX(30px);
}

.slide-leave-to {
  opacity: 0;
  transform: translateX(-30px);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Responsive Design */
@media (max-width: 1024px) {
  .steps {
    grid-template-columns: 1fr;
    gap: 15px;
  }
  
  .form-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 768px) {
  .registration-page {
    padding: 10px;
  }
  
  .header-content {
    padding: 20px;
  }
  
  .logo-container {
    flex-direction: column;
    text-align: center;
    gap: 15px;
  }
  
  .form-progress {
    padding: 20px;
  }
  
  .form-content {
    padding: 20px;
  }
  
  .step-header {
    font-size: 24px;
  }
  
  .btn {
    padding: 14px 24px;
    font-size: 14px;
  }
  
  .captcha-text {
    font-size: 24px;
    letter-spacing: 8px;
  }
  
  .captcha-input-group {
    flex-direction: column;
  }
  
  .captcha-audio {
    width: 100%;
    height: 50px;
  }
  
  .preview-container {
    padding: 20px;
  }
  
  .preview-item {
    flex-direction: column;
    gap: 5px;
  }
  
  .preview-label {
    min-width: auto;
  }
  
  .preview-value {
    text-align: left;
  }
  
  .form-navigation {
    flex-direction: column;
    gap: 15px;
  }
  
  .nav-spacer {
    display: none;
  }
  
  .btn {
    width: 100%;
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .logo-text h1 {
    font-size: 20px;
  }
  
  .logo-text p {
    font-size: 14px;
  }
  
  .step-header {
    font-size: 20px;
    flex-direction: column;
    text-align: center;
    gap: 10px;
  }
  
  .step-description {
    text-align: center;
  }
  
  .captcha-text {
    font-size: 20px;
    letter-spacing: 6px;
  }
  
  .preview-grid {
    gap: 20px;
  }
  
  .preview-section {
    padding: 15px;
  }
}
</style>