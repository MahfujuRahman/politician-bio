<template>

    <div class="col-lg-12">
        <div class="volunteer-form style-01">
            <div class="donate-programm">
                <div class="content">
                    <h6 class="subtitle">Thanks for Donating on this program</h6>
                    <p class="description style-01">Every pleasures is to welcomed pain avoided owing to the duty the
                        obligations of business it will frequently.</p>
                    <div class="notice">
                        <div class="icon">
                            <i class="icon-danger"></i>
                        </div>
                        <p><span>Notice:</span> Test mode is enable. While in test mode no live donations are processed
                        </p>
                    </div>
                    <div class="amount">
                        <div class="btn-wrapper">
                            <span v-for="amt in amountOptions" :key="amt" class="price-btn"
                                :class="{ 'active': formData.amount == amt }" @click="setAmount(amt)"
                                v-text="getAmountText(amt)"></span>
                        </div>
                        <div class="form-group mt-2">
                            <input type="number" v-model="formData.amount" placeholder="Custom amount"
                                class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-form style-01">
                <form @submit.prevent="submitDonation" class="contact-page-form">
                    <h6 class="title">Fill the following information for Donation.</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" v-model="formData.first_name" placeholder="First Name"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" v-model="formData.last_name" placeholder="Last Name"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" v-model="formData.email" class="form-control" placeholder="Email"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" v-model="formData.number" placeholder="Phone Number"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" v-model="formData.address_1" placeholder="Address line 1"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" v-model="formData.address_2" placeholder="Address line 2"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" v-model="formData.city" placeholder="City" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" v-model="formData.state" placeholder="State*" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" v-model="formData.trx_id" placeholder="Transaction ID*" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="form-question">
                <h6 class="title">How would you like to help? </h6>
                <div class="check-box-wrapper">
                    <div class="check-box">
                        <label class="container-box">
                            SSL Commerz
                            <input type="radio" v-model="formData.payment_method" value="sslcommerze">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="check-box">
                        <label class="container-box">
                            Offline payment
                            <input type="radio" v-model="formData.payment_method" value="offline">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="btn-wrapper">
                <button type="submit" @click="submitDonation" class="boxed-btn btn-sanatory" :disabled="isSubmitting">
                    {{ isSubmitting ? 'Processing...' : 'Donation Now' }}
                    <span class="icon-paper-plan"></span>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    props: {
        amount: {
            type: [Array, String],
            default: () => [25, 50, 100, 200]
        }
    },
    computed: {
        amountOptions() {
            if (typeof this.amount === 'string') {
                try {
                    console.log('Parsing string amount:', this.amount);
                    const parsed = JSON.parse(this.amount);
                    return Array.isArray(parsed) ? parsed : [25, 50, 100, 200];
                } catch (error) {
                    console.error('Error parsing amount string:', error);
                    return [25, 50, 100, 200];
                }
            }
            return Array.isArray(this.amount) ? this.amount : [25, 50, 100, 200];
        }
    },
    created() {
        console.log('Amount prop received:', this.amount);
    },
    data() {
        return {
            isSubmitting: false,
            formData: {
                amount: null,
                first_name: '',
                last_name: '',
                email: '',
                number: '',
                address_1: '',
                address_2: '',
                city: '',
                state: '',
                payment_method: 'sslcommerze'
            }
        }
    },
    mounted() {
        console.log('Mounted - amount:', this.amount);
        console.log('Type of amount:', typeof this.amount);
    },
    
    methods: {
        getAmountText(amt) {
            return `${amt}`;
        },
        setAmount(amount) {
            this.formData.amount = amount;
        },

        async submitDonation() {
            if (this.isSubmitting) return;

            // Basic validation
            if (!this.formData.amount || this.formData.amount <= 0) {
                window.s_alert('Please enter a valid donation amount', 'error');
                return;
            }

            if (!this.formData.first_name || !this.formData.last_name || !this.formData.email) {
                window.s_alert('Please fill in all required fields', 'error');
                return;
            }

            this.isSubmitting = true;

            console.log('Payment method:', this.formData.payment_method);

            // For payment gateway integrations, we need to handle redirects differently
            if (this.formData.payment_method === 'sslcommerze') {
                console.log('Using SSLCommerz - creating form submission');
                
                // Create a form and submit it to allow proper redirect
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/api/v1/donations/store';
                
                // Add all form data as hidden inputs
                Object.entries(this.formData).forEach(([key, value]) => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = value;
                    form.appendChild(input);
                });
                
                // Add CSRF token if available
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = '_token';
                    input.value = csrfToken.getAttribute('content');
                    form.appendChild(input);
                }

                // Get slug from URL parameters
                const urlParams = new URLSearchParams(window.location.search);
                const slug = urlParams.get('slug');
                console.log('Donation slug from URL:', slug);
                if (slug) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'donation_details_slug';
                    input.value = slug;
                    form.appendChild(input);
                }

                document.body.appendChild(form);
                console.log('Submitting form for SSLCommerz redirect');
                form.submit();
                return; // Important: Don't continue with AJAX
            }

            // For offline payments, use AJAX
            try {
                console.log('Using offline payment - AJAX submission');
                const response = await axios.post('/donations/store', this.formData);

                if (response.status === 200 || response.status === 201) {
                    window.s_alert('Thank you for your donation! Your submission has been received.');
                    this.resetForm();
                } else {
                    throw new Error('Submission failed');
                }
            } catch (error) {
                console.error('Donation submission error:', error);

                if (error.response && error.response.status === 422) {
                    // Validation errors
                    const errors = error.response.data.errors || {};
                    const errorMessages = Object.values(errors).flat().join('\n');
                    window.s_alert('Please correct the following errors:\n' + errorMessages, 'error');
                } else {
                    window.s_alert('There was an error processing your donation. Please try again.', 'error');
                }
            } finally {
                this.isSubmitting = false;
            }
        },

        resetForm() {
            this.formData = {
                amount: null,
                first_name: '',
                last_name: '',
                email: '',
                number: '',
                address_1: '',
                address_2: '',
                city: '',
                state: '',
                trx_id: '',
                payment_method: 'sslcommerze'
            };
        }
    },

}
</script>

<style scoped>
.price-btn {
    cursor: pointer;
    transition: all 0.3s ease;
}

.price-btn.active {
    background-color: #007bff;
    color: white;
}

.price-btn:hover {
    opacity: 0.8;
}

button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}
</style>

<style>
.swal2-container {
    z-index: 9999999 !important;
}

.swal2-container.swal2-top-end {
    z-index: 9999999 !important;
}

.swal2-popup {
    z-index: 9999999 !important;
}
</style>
