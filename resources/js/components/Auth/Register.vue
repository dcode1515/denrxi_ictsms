<template>
  <div class="form-wrapper">
    <!-- Progress Indicator -->
    <div class="progress-container">
      <div class="progress-steps">
        <div
          v-for="(step, index) in steps"
          :key="index"
          class="step"
          :class="{
            active: currentStep === index,
            completed: currentStep > index,
          }"
          @click="goToStep(index)"
        >
          <div class="step-circle">
            <span v-if="currentStep > index" class="checkmark">✓</span>
            <span v-else>{{ index + 1 }}</span>
          </div>
          <div class="step-label">{{ step.label }}</div>
        </div>
      </div>
      <div class="progress-bar">
        <div
          class="progress-fill"
          :style="{ width: `${(currentStep / (steps.length - 1)) * 100}%` }"
        ></div>
      </div>
    </div>

    <!-- Header -->
    <div class="login-header">
      <h3>{{ steps[currentStep].title }}</h3>
      <p>{{ steps[currentStep].description }}</p>
    </div>

    <!-- Error Message -->
    <div v-if="error" class="alert alert-danger text-center">
      {{ error }}
    </div>

    <!-- Step 1: Personal Information -->
    <form v-if="currentStep === 0" @submit.prevent="nextStep" class="step-form">
      <div class="form-section">
        <!-- Name Row - Compact Layout -->

        <!-- First Name -->

        <div class="input-group">
          <input
            type="text"
            class="input-field"
            :class="{ 'is-invalid': fieldErrors.firstname }"
            placeholder=" "
            v-model="formData.firstname"
            autocomplete="given-name"
          />
          <i class="input-icon fas fa-user"></i>
          <label class="input-label">First Name *</label>
          <div v-if="fieldErrors.firstname" class="text-danger mt-1 small">
            {{ fieldErrors.firstname[0] }}
          </div>
        </div>

        <!-- Middle Initial -->

        <div class="input-group">
          <input
            type="text"
            class="input-field"
            :class="{ 'is-invalid': fieldErrors.middle_initial }"
            placeholder=" "
            v-model="formData.middle_initial"
            @input="formatMiddleInitial"
            maxlength="1"
            autocomplete="additional-name"
          />
          <i class="input-icon fas fa-user"></i>
          <label class="input-label">MI</label>
          <div v-if="fieldErrors.middle_initial" class="text-danger mt-1 small">
            {{ fieldErrors.middle_initial[0] }}
          </div>
        </div>

        <!-- Last Name -->

        <div class="input-group">
          <input
            type="text"
            class="input-field"
            :class="{ 'is-invalid': fieldErrors.lastname }"
            placeholder=" "
            v-model="formData.lastname"
            autocomplete="family-name"
          />
          <i class="input-icon fas fa-user"></i>
          <label class="input-label">Last Name *</label>
          <div v-if="fieldErrors.lastname" class="text-danger mt-1 small">
            {{ fieldErrors.lastname[0] }}
          </div>
        </div>

        <!-- Extension -->

        <div class="input-group">
          <select
            class="input-field compact-select"
            :class="{ 'is-invalid': fieldErrors.extension }"
            v-model="formData.extension"
          >
            <option value="">Ext.</option>
            <option value="N/A">N/A</option>
            <option value="Jr.">Jr.</option>
            <option value="Sr.">Sr.</option>
            <option value="II">II</option>
            <option value="III">III</option>
            <option value="IV">IV</option>
            <option value="V">V</option>
          </select>
          <i class="input-icon fas fa-user-plus"></i>
          <label class="input-label">Extension</label>
          <div v-if="fieldErrors.extension" class="text-danger mt-1 small">
            {{ fieldErrors.extension[0] }}
          </div>
        </div>

        <!-- Contact Number and Position Row -->

        <!-- Contact Number -->

        <div class="input-group">
          <input
            type="tel"
            class="input-field"
            :class="{ 'is-invalid': fieldErrors.contact_number }"
            placeholder=" "
            v-model="formData.contact_number"
            @input="formatPhoneNumber"
            @keydown="restrictToNumbers"
            ref="phoneInput"
            maxlength="13"
          />
          <i class="input-icon fas fa-phone"></i>
          <label class="input-label">Contact Number *</label>
          <div v-if="fieldErrors.contact_number" class="text-danger mt-1 small">
            {{ fieldErrors.contact_number[0] }}
          </div>
        </div>

        <!-- Position -->

        <div class="input-group">
          <input
            type="text"
            class="input-field"
            :class="{ 'is-invalid': fieldErrors.position }"
            placeholder=" "
            v-model="formData.position"
            list="positionList"
            autocomplete="organization-title"
          />
          <i class="input-icon fas fa-briefcase"></i>
          <label class="input-label">Position *</label>
          <div v-if="fieldErrors.position" class="text-danger mt-1 small">
            {{ fieldErrors.position[0] }}
          </div>
        </div>
      </div>

      <div class="form-buttons">
        <button type="submit" class="btn login-btn">
          Next <i class="fas fa-arrow-right"></i>
        </button>
      </div>
    </form>

    <!-- Step 2: Office Information -->
    <form v-if="currentStep === 1" @submit.prevent="nextStep" class="step-form">
      <div class="form-section">
        <!-- Head Office -->
        <div class="input-group">
          <select
            class="input-field"
            :class="{ 'is-invalid': fieldErrors.head_office }"
            v-model="formData.head_office"
            @change="fetchOffices"
          >
            <option value="">Select Head Office *</option>
            <option v-for="head in headOffices" :key="head.id" :value="head.id">
              {{ head.head_of_office }}
            </option>
          </select>
          <i class="input-icon fas fa-building"></i>
          <label class="input-label">Head Office</label>
          <div v-if="fieldErrors.head_office" class="text-danger mt-1 small">
            {{ fieldErrors.head_office[0] }}
          </div>
        </div>

        <!-- Office -->
        <div class="input-group">
          <select
            class="input-field"
            :class="{ 'is-invalid': fieldErrors.office }"
            v-model="formData.office"
            :disabled="!formData.head_office"
          >
            <option value="">Select Office *</option>
            <option
              v-for="office in offices"
              :key="office.id"
              :value="office.id"
            >
              {{ office.office }}
            </option>
          </select>
          <i class="input-icon fas fa-location-dot"></i>
          <label class="input-label">Office</label>
          <div v-if="fieldErrors.office" class="text-danger mt-1 small">
            {{ fieldErrors.office[0] }}
          </div>
        </div>
      </div>

      <div class="form-buttons">
        <button type="button" class="btn login-btn" @click="prevStep">
          <i class="fas fa-arrow-left"></i> Back
        </button>
        <button type="submit" class="btn login-btn">
          Next <i class="fas fa-arrow-right"></i>
        </button>
      </div>
    </form>

    <!-- Step 3: Account Setup -->
    <form
      v-if="currentStep === 2"
      @submit.prevent="handleRegistration"
      class="step-form"
    >
      <div class="form-section">
        <div class="input-group">
          <input
            type="email"
            class="input-field"
            :class="{ 'is-invalid': fieldErrors.email_address }"
            placeholder=" "
            v-model="formData.email_address"
            autocomplete="email"
          />
          <i class="input-icon fas fa-envelope"></i>
          <label class="input-label">Email Address *</label>
          <div v-if="fieldErrors.email_address" class="text-danger mt-1 small">
            {{ fieldErrors.email_address[0] }}
          </div>
        </div>

        <div class="input-group password-group">
          <input
            :type="showPassword ? 'text' : 'password'"
            class="input-field"
            :class="{ 'is-invalid': fieldErrors.password }"
            placeholder=" "
            v-model="formData.password"
            autocomplete="new-password"
            @input="checkPasswordStrength"
          />
          <i class="input-icon fas fa-lock"></i>
          <label class="input-label">Password *</label>
          <button
            type="button"
            class="password-toggle-btn"
            @click="showPassword = !showPassword"
            tabindex="-1"
          >
            <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
          </button>
          <div v-if="fieldErrors.password" class="text-danger mt-1 small">
            {{ fieldErrors.password[0] }}
          </div>
        </div>

        <div v-if="formData.password" class="password-strength">
          <div class="strength-text">
            <small>Strength: </small>
            <span :class="passwordStrengthClass">{{
              passwordStrengthText
            }}</span>
          </div>
          <div class="strength-bars">
            <div
              v-for="i in 5"
              :key="i"
              class="strength-bar"
              :class="{
                active: i <= passwordStrength,
                [passwordStrengthClass]: i <= passwordStrength,
              }"
            ></div>
          </div>
        </div>

        <div class="input-group password-group">
          <input
            :type="showConfirmPassword ? 'text' : 'password'"
            class="input-field"
            :class="{ 'is-invalid': fieldErrors.password_confirmation }"
            placeholder=" "
            v-model="formData.password_confirmation"
            autocomplete="new-password"
          />
          <i class="input-icon fas fa-lock"></i>
          <label class="input-label">Confirm Password *</label>
          <button
            type="button"
            class="password-toggle-btn"
            @click="showConfirmPassword = !showConfirmPassword"
            tabindex="-1"
          >
            <i
              :class="showConfirmPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"
            ></i>
          </button>
          <div
            v-if="fieldErrors.password_confirmation"
            class="text-danger mt-1 small"
          >
            {{ fieldErrors.password_confirmation[0] }}
          </div>
        </div>

        <div class="form-check">
          <input
            type="checkbox"
            class="form-check-input"
            :class="{ 'is-invalid': fieldErrors.terms }"
            id="terms"
            v-model="formData.terms"
          />
          <label class="form-check-label" for="terms">
            I agree to the
            <a href="#">Terms and Conditions</a>
            *
          </label>
          <div v-if="fieldErrors.terms" class="text-danger mt-1 small">
            {{ fieldErrors.terms[0] }}
          </div>
        </div>
      </div>

      <div class="form-buttons">
        <button type="button" class="btn login-btn" @click="prevStep">
          <i class="fas fa-arrow-left"></i> Back
        </button>
        <button type="submit" class="btn login-btn" :disabled="loading">
          <i v-if="!loading" class="fas fa-paper-plane"></i>
          <span v-if="!loading">Submit Registration</span>
          <span v-else>
            <span class="spinner-border spinner-border-sm" role="status"></span>
            Processing...
          </span>
        </button>
      </div>
    </form>

    <!-- Already have an account - Login link -->
    <div class="already-have-account">
      <p>
        Already have an account?
        <a href="/" class="login-link">
          <i class="fas fa-sign-in-alt"></i> Login here
        </a>
      </p>
    </div>

    <!-- Success Modal -->

    <!-- Terms Modal -->

    <!-- Footer -->
    <div class="login-footer">
      <p>
        &copy; {{ currentYear }} DENR Region 11 - ICT Service Management System.
        All rights reserved.
      </p>
    </div>
  </div>
</template>

<script>
import "toastr/build/toastr.min.css"; // Ensure Toastr CSS is imported

import Swal from "sweetalert2";
export default {
  data() {
    return {
      currentStep: 0,
      steps: [
        {
          label: "Personal",
          title: "Personal Information",
          description: "Enter your personal details",
        },
        {
          label: "Office",
          title: "Office Information",
          description: "Provide your office details",
        },
        {
          label: "Account",
          title: "Account Setup",
          description: "Create your login credentials",
        },
      ],
      formData: {
        firstname: "",
        middle_initial: "",
        lastname: "",
        extension: "",
        email_address: "",
        contact_number: "",
        head_office: "",
        office: "",
        position: "",
        password: "",
        password_confirmation: "",
        terms: false,
      },
      loading: false,
      error: null,
      successMessage: null,
      fieldErrors: {},
      showPassword: false,
      showConfirmPassword: false,

      headOffices: [],
      offices: [],
      passwordStrength: 0,
    };
  },
  computed: {
    passwordStrengthClass() {
      if (this.passwordStrength <= 2) return "strength-weak";
      if (this.passwordStrength <= 4) return "strength-medium";
      return "strength-strong";
    },
    passwordStrengthText() {
      if (this.passwordStrength <= 2) return "Weak";
      if (this.passwordStrength <= 4) return "Medium";
      return "Strong";
    },
    currentYear() {
      return new Date().getFullYear();
    },
  },
  mounted() {
    this.fetchHeadOffices();
  },
  methods: {
    fetchHeadOffices() {
      axios
        .get("/api/head-offices")
        .then((response) => {
          this.headOffices = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    fetchOffices() {
      this.formData.office = "";
      this.offices = [];

      if (!this.formData.head_office) return;

      axios
        .get(`/api/offices/${this.formData.head_office}`)
        .then((response) => {
          this.offices = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    restrictToNumbers(event) {
      if (
        [46, 8, 9, 27, 13].includes(event.keyCode) ||
        (event.keyCode === 65 && event.ctrlKey === true) ||
        (event.keyCode === 67 && event.ctrlKey === true) ||
        (event.keyCode === 86 && event.ctrlKey === true) ||
        (event.keyCode === 88 && event.ctrlKey === true) ||
        (event.keyCode >= 35 && event.keyCode <= 39)
      ) {
        return;
      }

      if (
        (event.keyCode < 48 || event.keyCode > 57) &&
        (event.keyCode < 96 || event.keyCode > 105)
      ) {
        event.preventDefault();
      }
    },
    formatMiddleInitial() {
      if (this.formData.middle_initial) {
        this.formData.middle_initial = this.formData.middle_initial
          .charAt(0)
          .toUpperCase();
      }
    },
    nextStep() {
      if (this.validateCurrentStep()) {
        this.currentStep = Math.min(
          this.currentStep + 1,
          this.steps.length - 1
        );
      }
    },
    prevStep() {
      this.currentStep = Math.max(this.currentStep - 1, 0);
    },
    goToStep(step) {
      if (step < this.currentStep) {
        this.currentStep = step;
      }
    },
    validateCurrentStep() {
      this.fieldErrors = {};
      let isValid = true;

      switch (this.currentStep) {
        case 0:
          if (!this.formData.firstname.trim()) {
            this.fieldErrors.firstname = ["First name is required"];
            isValid = false;
          }
          if (!this.formData.lastname.trim()) {
            this.fieldErrors.lastname = ["Last name is required"];
            isValid = false;
          }
          if (!this.formData.contact_number.trim()) {
            this.fieldErrors.contact_number = ["Contact number is required"];
            isValid = false;
          } else {
            const phone = this.formData.contact_number.replace(/\D/g, "");
            if (phone.length !== 11) {
              this.fieldErrors.contact_number = [
                "Mobile number must be 11 digits",
              ];
              isValid = false;
            } else if (!phone.startsWith("09")) {
              this.fieldErrors.contact_number = [
                "Mobile number must start with 09",
              ];
              isValid = false;
            }
          }
          if (!this.formData.position.trim()) {
            this.fieldErrors.position = ["Position is required"];
            isValid = false;
          }
          break;

        case 1:
          if (!this.formData.head_office) {
            this.fieldErrors.head_office = ["Head office is required"];
            isValid = false;
          }
          if (!this.formData.office) {
            this.fieldErrors.office = ["Office is required"];
            isValid = false;
          }
          break;
      }

      if (!isValid) {
        this.$nextTick(() => {
          const firstError = document.querySelector(".is-invalid");
          if (firstError) {
            firstError.scrollIntoView({ behavior: "smooth", block: "center" });
          }
        });
      }

      return isValid;
    },
    validateStep3() {
      this.fieldErrors = {};
      let isValid = true;

      if (!this.formData.email_address.trim()) {
        this.fieldErrors.email_address = ["Email is required"];
        isValid = false;
      } else if (!this.validateEmail(this.formData.email_address)) {
        this.fieldErrors.email_address = ["Please enter a valid email address"];
        isValid = false;
      }

      if (!this.formData.password) {
        this.fieldErrors.password = ["Password is required"];
        isValid = false;
      } else if (this.passwordStrength < 3) {
        this.fieldErrors.password = [
          "Password is too weak. Please use a stronger password.",
        ];
        isValid = false;
      }

      if (!this.formData.password_confirmation) {
        this.fieldErrors.password_confirmation = [
          "Please confirm your password",
        ];
        isValid = false;
      } else if (
        this.formData.password !== this.formData.password_confirmation
      ) {
        this.fieldErrors.password_confirmation = ["Passwords do not match"];
        isValid = false;
      }

      if (!this.formData.terms) {
        this.fieldErrors.terms = ["You must agree to the terms and conditions"];
        isValid = false;
      }

      if (!isValid) {
        this.$nextTick(() => {
          const firstError = document.querySelector(".is-invalid");
          if (firstError) {
            firstError.scrollIntoView({ behavior: "smooth", block: "center" });
          }
        });
      }

      return isValid;
    },
    checkPasswordStrength() {
      const password = this.formData.password;
      if (!password) {
        this.passwordStrength = 0;
        return;
      }

      let strength = 0;

      if (password.length >= 8) strength++;
      if (password.length >= 12) strength++;
      if (/[A-Z]/.test(password)) strength++;
      if (/[a-z]/.test(password)) strength++;
      if (/[0-9]/.test(password)) strength++;
      if (/[^A-Za-z0-9]/.test(password)) strength++;

      this.passwordStrength = Math.min(strength, 5);
    },
    validateEmail(email) {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email);
    },
    async handleRegistration() {
      if (!this.validateStep3()) {
        return;
      }

      this.loading = true;
      this.error = null;

      try {
        // Prepare data for submission
        const registrationData = {
          firstname: this.formData.firstname,
          middle_initial: this.formData.middle_initial,
          lastname: this.formData.lastname,
          extension: this.formData.extension,
          email_address: this.formData.email_address,
          contact_number: this.formData.contact_number.replace(/\s+/g, ""),
          position: this.formData.position,
          head_office: this.formData.head_office,
          office: this.formData.office,
          password: this.formData.password,
          password_confirmation: this.formData.password_confirmation,
          terms: this.formData.terms,
        };

        const response = await axios.post(
          "/api/post/register",
          registrationData,
          {
            headers: {
              "Content-Type": "application/json",
              Accept: "application/json",
            },
          }
        );

        if (response.data.success) {
          // Show SweetAlert success message
          Swal.fire({
            icon: "success",
            title: "Registration Successful!",
            text: "Registration submitted successfully! Please wait for admin approval.",
            confirmButtonColor: "#2ecc71",
            confirmButtonText: "Go to Login",
          }).then((result) => {
            if (result.isConfirmed) {
              this.redirectToLogin();
            }
          });

          this.resetForm();
        } else {
          this.error =
            response.data.message || "Registration failed. Please try again.";
        }
      } catch (error) {
        this.handleRegistrationError(error);
      } finally {
        this.loading = false;
      }
    },
    handleRegistrationError(error) {
      if (error.response?.status === 422 && error.response.data.errors) {
        this.fieldErrors = error.response.data.errors;
        if (this.fieldErrors.email_address || this.fieldErrors.password) {
          this.currentStep = 2;
        } else if (this.fieldErrors.head_office || this.fieldErrors.office) {
          this.currentStep = 1;
        } else {
          this.currentStep = 0;
        }
      } else if (error.response?.data?.error) {
        this.error = error.response.data.error;
      } else if (error.response?.data?.message) {
        this.error = error.response.data.message;
      } else {
        this.error = "An unexpected error occurred. Please try again.";
      }
    },
    formatPhoneNumber() {
      let phone = this.formData.contact_number;
      const cursorPosition = this.$refs.phoneInput
        ? this.$refs.phoneInput.selectionStart
        : null;

      phone = phone.replace(/\D/g, "");
      phone = phone.substring(0, 11);

      let formatted = phone;
      if (phone.length > 4) {
        formatted = phone.substring(0, 4) + " " + phone.substring(4);
      }
      if (phone.length > 7) {
        formatted =
          phone.substring(0, 4) +
          " " +
          phone.substring(4, 7) +
          " " +
          phone.substring(7);
      }

      this.formData.contact_number = formatted;

      if (cursorPosition !== null && this.$refs.phoneInput) {
        this.$nextTick(() => {
          let newPosition = cursorPosition;
          if (phone.length >= 4 && cursorPosition > 4) {
            newPosition++;
          }
          if (phone.length >= 7 && cursorPosition > 7) {
            newPosition++;
          }
          this.$refs.phoneInput.setSelectionRange(newPosition, newPosition);
        });
      }
    },

    redirectToLogin() {
      window.location.href = "/";
    },
    resetForm() {
      this.formData = {
        firstname: "",
        middle_initial: "",
        lastname: "",
        extension: "",
        email_address: "",
        contact_number: "",
        head_office: "",
        office: "",
        position: "",
        password: "",
        password_confirmation: "",
        terms: false,
      };
      this.currentStep = 0;
      this.passwordStrength = 0;
    },
  },
};
</script>

<style scoped>
/* Base Styles */
.form-wrapper {
  max-width: 800px;
  width: 100%;
  margin: 2rem auto;
  padding: 2rem;
  background: white;
  border-radius: 12px;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
}

/* Progress Indicator */
.progress-container {
  margin-bottom: 2rem;
}

.progress-steps {
  display: flex;
  justify-content: space-between;
  margin-bottom: 1rem;
  position: relative;
}

.step {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
  z-index: 1;
  cursor: pointer;
  flex: 1;
}

.step-circle {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #ecf0f1;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  color: #95a5a6;
  border: 3px solid #ecf0f1;
  transition: all 0.3s;
  margin-bottom: 0.5rem;
}

.step.active .step-circle {
  background: #3498db;
  border-color: #3498db;
  color: white;
  transform: scale(1.1);
}

.step.completed .step-circle {
  background: #2ecc71;
  border-color: #2ecc71;
  color: white;
}

.step-label {
  font-size: 0.8rem;
  color: #95a5a6;
  font-weight: 600;
  text-align: center;
}

.step.active .step-label {
  color: #3498db;
}

.step.completed .step-label {
  color: #2ecc71;
}

.progress-bar {
  height: 4px;
  background: #ecf0f1;
  border-radius: 2px;
  position: relative;
  margin: 0 20px;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, #2ecc71, #3498db);
  border-radius: 2px;
  transition: width 0.5s ease;
}

/* Header */
.login-header {
  text-align: center;
  margin-bottom: 2rem;
}

.login-header h3 {
  color: #2c3e50;
  margin-bottom: 0.5rem;
}

.login-header p {
  color: #7f8c8d;
  font-size: 0.95rem;
}

/* Already Have Account Section */
.already-have-account {
  text-align: center;
  margin: 2rem 0 1.5rem;
  padding-top: 1.5rem;
  border-top: 1px solid #ecf0f1;
}

.already-have-account p {
  color: #6c757d;
  font-size: 0.95rem;
  margin-bottom: 0;
}

.login-link {
  color: #3498db;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s;
  display: inline-flex;
  align-items: center;
  gap: 0.3rem;
}

.login-link:hover {
  color: #2980b9;
  text-decoration: underline;
}

.login-link i {
  font-size: 0.9rem;
}

/* Form Styles */
.step-form {
  width: 100%;
  max-width: 500px;
  margin: 0 auto;
}

.form-section {
  margin-bottom: 1.5rem;
}

.input-group {
  position: relative;
  margin-bottom: 1.5rem;
}

.input-field {
  width: 100%;
  padding: 0.75rem 1rem 0.75rem 2.5rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 0.95rem;
  transition: all 0.3s;
  background: #f8f9fa;
}

.input-field:focus {
  outline: none;
  border-color: #3498db;
  background: white;
  box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.input-field.is-invalid {
  border-color: #e74c3c;
  background: #fff5f5;
}

.input-icon {
  position: absolute;
  left: 0.85rem;
  top: 50%;
  transform: translateY(-50%);
  color: #95a5a6;
  z-index: 1;
  pointer-events: none;
}

/* Password group specific styles */
.password-group {
  position: relative;
}

.password-group .input-field {
  padding: 0.75rem 3.5rem 0.75rem 2.5rem;
}

.password-group .input-icon {
  position: absolute;
  left: 0.85rem;
  top: 50%;
  transform: translateY(-50%);
  color: #95a5a6;
  z-index: 1;
  pointer-events: none;
}

.password-group .password-toggle-btn {
  position: absolute;
  right: 0.85rem;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #95a5a6;
  cursor: pointer;
  padding: 0.25rem;
  z-index: 2;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 24px;
  height: 24px;
}

.password-group .password-toggle-btn:hover {
  color: #3498db;
  background: rgba(52, 152, 219, 0.1);
  border-radius: 4px;
}

.password-group ~ .password-group {
  margin-top: 0.5rem;
}

.password-strength {
  margin-top: 0.5rem;
  padding-left: 2.5rem;
}

.password-group .text-danger {
  padding-left: 2.5rem;
}

.password-group .input-field.is-invalid {
  padding-right: 3.5rem;
}

/* Buttons */
.form-buttons {
  display: flex;
  gap: 1rem;
  margin-top: 2rem;
}

.btn {
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  font-size: 0.95rem;
  flex: 1;
}

.btn-prev {
  background: #ecf0f1;
  color: #7f8c8d;
}

.btn-prev:hover {
  background: #bdc3c7;
}

.btn-next,
.btn-confirm {
  background: linear-gradient(135deg, #3498db, #2980b9);
  color: white;
}

.btn-next:hover,
.btn-confirm:hover {
  background: linear-gradient(135deg, #2980b9, #1f639b);
  box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
}

.btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

/* Modal Styles */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 1rem;
}

.modal-content {
  background: white;
  border-radius: 12px;
  padding: 2rem;
  max-width: 500px;
  width: 100%;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.success-icon {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, #2ecc71, #27ae60);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1.5rem;
  color: white;
  font-size: 2.5rem;
}

.success-message {
  color: #27ae60;
  font-weight: 500;
  margin-bottom: 1.5rem;
}

.success-details {
  background: #f8fafc;
  border-radius: 8px;
  padding: 1.25rem;
  margin: 1.5rem 0;
}

.success-details .detail-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  color: #495057;
  font-size: 0.9rem;
  justify-content: center;
}

.success-actions {
  display: flex;
  gap: 1rem;
  margin-top: 1.5rem;
}

.btn-success {
  background: linear-gradient(135deg, #2ecc71, #27ae60);
  color: white;
  border: none;
  flex: 1;
}

.btn-success:hover {
  background: linear-gradient(135deg, #27ae60, #219653);
  box-shadow: 0 4px 12px rgba(46, 204, 113, 0.25);
}

/* Footer */
.login-footer {
  margin-top: 1rem;
  text-align: center;
  font-size: 0.75rem;
  color: #95a5a6;
  padding-top: 1.5rem;
  border-top: 1px solid #ecf0f1;
}

/* Animations */
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

/* Password Strength */
.strength-text {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 0.5rem;
}

.strength-bars {
  display: flex;
  gap: 2px;
  height: 6px;
}

.strength-bar {
  flex: 1;
  background: #ecf0f1;
  border-radius: 1px;
  transition: all 0.3s;
}

.strength-bar.active.strength-weak {
  background: #e74c3c;
}

.strength-bar.active.strength-medium {
  background: #f39c12;
}

.strength-bar.active.strength-strong {
  background: #2ecc71;
}

/* Alert */
.alert {
  padding: 0.75rem 1rem;
  border-radius: 8px;
  margin-bottom: 1.5rem;
  animation: fadeIn 0.3s;
}

.alert-danger {
  background: linear-gradient(135deg, #e74c3c, #c0392b);
  color: white;
  border: none;
}

/* Responsive Design */
@media (max-width: 768px) {
  .form-wrapper {
    padding: 1.5rem;
    margin: 1rem auto;
  }

  .progress-steps {
    flex-wrap: wrap;
  }

  .step {
    min-width: 70px;
    margin-bottom: 1rem;
  }

  .step-circle {
    width: 36px;
    height: 36px;
  }

  .action-buttons {
    flex-direction: column;
  }

  .btn {
    width: 100%;
  }

  .already-have-account {
    margin: 1.5rem 0 1rem;
  }

  /* Password group responsive */
  .password-group .input-field {
    padding: 0.7rem 3.2rem 0.7rem 2.2rem;
  }

  .password-group .input-icon {
    left: 0.75rem;
  }

  .password-group .password-toggle-btn {
    right: 0.75rem;
  }

  .password-strength {
    padding-left: 2.2rem;
  }

  .password-group .text-danger {
    padding-left: 2.2rem;
  }

  /* Regular input fields */
  .input-field {
    padding: 0.7rem 1rem 0.7rem 2.2rem;
  }

  .input-icon {
    left: 0.75rem;
  }
}

@media (max-width: 576px) {
  .form-wrapper {
    padding: 1rem;
    margin: 0.5rem;
  }

  .login-header h3 {
    font-size: 1.25rem;
  }

  .input-field {
    padding: 0.7rem 1rem 0.7rem 2.2rem;
    font-size: 0.9rem;
  }

  .password-group .input-field {
    padding: 0.7rem 3.2rem 0.7rem 2.2rem;
  }

  .modal-content {
    padding: 1.5rem;
  }

  .already-have-account p {
    font-size: 0.9rem;
  }

  .login-link {
    font-size: 0.9rem;
  }
}

@media (max-width: 400px) {
  .step-label {
    font-size: 0.7rem;
  }

  .btn {
    padding: 0.6rem 1rem;
    font-size: 0.85rem;
  }

  .already-have-account {
    margin: 1rem 0 0.5rem;
  }
}
</style>