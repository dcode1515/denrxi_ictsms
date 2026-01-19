<template>
  <div class="form-wrapper">
    <div class="login-header">
      <h3>Welcome Back</h3>
      <p>Access the ICT Service Management Portal</p>
    </div>

    <form id="loginForm" onsubmit="handleLogin(event)">
      <!-- Username -->
      <div class="input-group">
        <input
          type="text"
          id="username"
          class="input-field"
          placeholder=" "
          required
          autocomplete="off"
        />
        <i class="input-icon fas fa-user"></i>
        <label for="username" class="input-label">ICT Account / Email</label>
      </div>

      <!-- Password -->
      <div class="input-group">
        <input
          type="password"
          id="password"
          class="input-field"
          placeholder=" "
          required
        />
        <i class="input-icon fas fa-lock"></i>
        <label for="password" class="input-label">Password</label>
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

      <button type="submit" class="btn login-btn" id="loginBtn">
        <span>Secure Login</span>
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