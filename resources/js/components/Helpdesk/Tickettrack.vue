<template>
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Search Ticket Card -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="section-title mb-0">Search Ticket</h3>
                        </div>
                        <div class="card-body">
                            <form id="ticketSearchForm">
                                <div class="row">
                                    <!-- Email Field -->
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Address <span class="required-field"></span></label>
                                        <div class="form-group-icon">
                                            <i class="fas fa-envelope input-icon"></i>
                                            <input type="email" class="form-control form-control-icon" id="email" placeholder="Enter your email address" required>
                                        </div>
                                        <small class="form-text text-muted">The email you used when submitting the ticket</small>
                                    </div>
                                    
                                    <!-- Ticket Number Field -->
                                    <div class="col-md-6 mb-3">
                                        <label for="ticketNumber" class="form-label">Ticket Number <span class="required-field"></span></label>
                                        <div class="form-group-icon">
                                            <i class="fas fa-ticket-alt input-icon"></i>
                                            <input type="text" class="form-control form-control-icon" id="ticketNumber" placeholder="e.g., DENR-XI-2023-00123" required>
                                        </div>
                                        <small class="form-text text-muted">Your unique ticket reference number</small>
                                    </div>
                                </div>
                                
                                <!-- Error Message -->
                                <div id="errorMessage" class="alert alert-danger d-none" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span id="errorText"></span>
                                </div>
                                
                                <!-- Search Button -->
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                                    <button type="submit" class="btn btn-denr btn-responsive">
                                        <i class="fas fa-search me-2"></i> Search Ticket Status
                                    </button>
                                    <button type="button" id="clearBtn" class="btn btn-outline-denr btn-responsive">
                                        <i class="fas fa-eraser me-2"></i> Clear Form
                                    </button>
                                </div>
                            </form>
                            
                            <!-- Loading Spinner -->
                            <div id="loadingSpinner" class="loading-spinner">
                                <div class="spinner-border text-denr" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-3">Searching for ticket information...</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Results Container -->
                    <div id="resultsContainer" class="results-container">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="section-title mb-0">Ticket Status Details</h3>
                            </div>
                            <div class="card-body">
                                <!-- Results will be displayed here -->
                                <div id="ticketResults"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {

}
</script>

<style></style>