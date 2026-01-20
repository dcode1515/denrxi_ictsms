<template>
  <div class="form-wrapper">
    <div class="login-header">
      <h3>Welcome Back</h3>
      <p>Access the ICT Service Management Portal</p>
    </div>

    <form id="loginForm" @submit.prevent="handleLogin">
      <!-- Username -->
      <div v-if="error" class="alert alert-danger text-center">
        {{ error }}
      </div>

      <div class="input-group">
        <input
          type="text"
          class="input-field"
          :class="{ 'is-invalid': fieldErrors.email_address }"
          placeholder=" "
          v-model="email_address"
          autocomplete="off"
        />
        <i class="input-icon fas fa-user"></i>
        <label for="username" class="input-label">ICT Account / Email</label>
        <div v-if="fieldErrors.email_address" class="text-danger mt-1 small">
          {{ fieldErrors.email_address[0] }}
        </div>
      </div>

      <!-- Password -->
      <div class="input-group" :class="{ shake: fieldErrors.password }">
        <input
          type="password"
          id="password"
          class="input-field"
          :class="{ 'is-invalid': fieldErrors.password }"
          placeholder=" "
          v-model="password"
        />
        <i class="input-icon fas fa-lock"></i>
        <label class="input-label">Password</label>
        <div v-if="fieldErrors.password" class="text-danger">
          {{ fieldErrors.password[0] }}
        </div>
      </div>

      <div class="form-actions">
        <label class="checkbox-container">
          <input type="checkbox" id="remember" />
          <span>Remember me</span>
        </label>
        <a
          href="#"
          class="forgot-link"
          onclick="showToast('Password reset link sent to email.', 'success')"
          >Forgot password?</a
        >
      </div>

      <button
        type="submit"
        :disabled="loading"
        class="btn login-btn"
        id="loginBtn"
      >
        <i v-if="!loading" class="fas fa-sign-in-alt"></i>
        <span v-if="!loading">Secure Login </span>
        <span v-else>
          <span
            class="spinner-border spinner-border-sm"
            role="status"
            aria-hidden="true"
          ></span>
          Logging in....
        </span>
      </button>
    </form>

    <div class="register-text">
      Don't have an account?
      <a class="register-link" onclick="openModal()">Request Access</a>
    </div>

    <div
      class="login-footer"
      style="
        margin-top: 2rem;
        text-align: center;
        font-size: 0.8rem;
        color: var(--text-muted);
      "
    >
      <p>
        &copy; 2025 DENR Region 11 - ICT Service Management System. All rights
        reserved.
      </p>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      email_address: "",
      password: "",
      loading: false,
      error: null,
      fieldErrors: {},
    };
  },
  methods: {
    async handleLogin() {
      this.loading = true;
      this.error = null;
      this.fieldErrors = {};

      try {
        const response = await axios.post("/denrxi_ictsms/api/post/login", {
          email_address: this.email_address,
          password: this.password,
        });

        // Redirect immediately after successful login
        window.location.href = response.request.responseURL;
      } catch (error) {
        if (error.response?.status === 422 && error.response.data.errors) {
          this.fieldErrors = error.response.data.errors;
          console.log("Validation Errors:", this.fieldErrors);
        } else if (error.response?.data?.error) {
          this.error = error.response.data.error;
          console.log("General Error:", this.error);
        } else {
          this.error = "An unexpected error occurred. Please try again.";
          console.error("Unexpected Error:", error);
        }
      } finally {
        this.loading = false;
      }
    },

    created() {
      console.log("Component Created");
    },
    mounted() {
      console.log("Login Mounted");
    },
  },
};
</script>

<style>
:root {
  --danger: #dc3545;
  --danger-dark: #b02a37;
  --success: #28a745;
  --input-bg: #ffffff;
  --border-default: #d1d5db;
  --text-muted: #6c757d;
}

/* ===========================
   FORM WRAPPER
=========================== */

/* ===========================
   INPUT GROUP
=========================== */
.input-group {
  position: relative;
  margin-bottom: 1.5rem;
}


.input-field:focus {
  outline: none;
  border-color: #0d6efd;
  box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

/* ===========================
   ICON & LABEL
=========================== */
.input-icon {
  position: absolute;
  top: 50%;
  left: 0.85rem;
  transform: translateY(-50%);
  color: var(--text-muted);
  transition: color 0.3s;
}

.input-label {
  position: absolute;
  top: 50%;
  left: 2.75rem;
  transform: translateY(-50%);
  font-size: 0.8rem;
  color: var(--text-muted);
  pointer-events: none;
  transition: all 0.3s ease;
}

/* ===========================
   VALIDATION LEVEL 1:
   FIELD ERROR
=========================== */
.input-field.is-invalid {
  border-color: var(--danger);
  background: #fff5f5;
  box-shadow: 0 0 0 0.15rem rgba(220, 53, 69, 0.25);
}

.input-field.is-invalid ~ .input-icon {
  color: var(--danger);
}

.text-danger {
  color: var(--danger);
  font-size: 0.75rem;
  margin-top: 0.25rem;
  animation: fadeIn 0.3s ease-in-out;
}

/* ===========================
   VALIDATION LEVEL 2:
   FORM ERROR ALERT
=========================== */
.alert-danger {
  background: linear-gradient(135deg, var(--danger), var(--danger-dark));
  color: #fff;
  border-radius: 6px;
  padding: 0.75rem 1rem;
  font-size: 0.85rem;
  text-align: center;
  margin-bottom: 1rem;
  animation: shake 0.35s ease-in-out;
}

/* ===========================
   VALIDATION LEVEL 3:
   INTERACTION FEEDBACK
=========================== */
.input-group.shake {
  animation: shake 0.35s ease-in-out;
}

@keyframes shake {
  0% {
    transform: translateX(0);
  }
  20% {
    transform: translateX(-5px);
  }
  40% {
    transform: translateX(5px);
  }
  60% {
    transform: translateX(-5px);
  }
  80% {
    transform: translateX(5px);
  }
  100% {
    transform: translateX(0);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-4px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>