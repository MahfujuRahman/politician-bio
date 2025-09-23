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
                
                <!-- Offline Payment Gateways -->
                <div v-if="formData.payment_method === 'offline'" class="offline-gateways mt-3">
                    <h6 class="title">Payment Instructions:</h6>
                    <p class="instruction-text">Please send your donation to any of the following accounts and enter the transaction ID below:</p>
                    
                    <div class="payment-methods-list">
                        <div v-for="gateway in offlineGateways" :key="gateway.name" class="payment-method-item">
                            <div class="method-header">
                                <strong>{{ gateway.label }}</strong>
                            </div>
                            <div class="method-details">
                                {{ gateway.value }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="instruction-note">
                        <i class="icon-info"></i>
                        <small>After sending money, please enter the transaction ID in the form above and submit.</small>
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
            offlineGateways: [], // Will store the offline payment gateways
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
                payment_method: 'sslcommerze',
                trx_id: ''
            }
        }
    },
    mounted() {
        console.log('Mounted - amount:', this.amount);
        console.log('Type of amount:', typeof this.amount);
        this.fetchOfflineGateways();
    },
    
    methods: {
        async fetchOfflineGateways() {
            try {
                // Fetch website settings to get offline payment gateways
                const response = await axios.get('/website-settings?get_all=1&limit=100');
                console.log('Website settings response:', response.data);
                
                if (response.data && response.data.data) {
                    console.log('Website settings data:', response.data.data);
                    
                    // Convert object to array since data comes as {0: {}, 1: {}, ...}
                    const settingsArray = Object.values(response.data.data);
                    console.log('Settings array:', settingsArray);
                    
                    // Filter for payment gateway titles (bkash, nagad, rocket, bank, etc.)
                    const paymentGateways = settingsArray.filter(setting => {
                        const title = setting.title ? setting.title.toLowerCase() : '';
                        return ['bkash', 'nagad', 'rocket', 'bank'].includes(title);
                    });
                    
                    console.log('Found payment gateways:', paymentGateways);
                    
                    if (paymentGateways.length > 0) {
                        this.offlineGateways = paymentGateways.map(gateway => {
                            const name = gateway.title.toLowerCase();
                            
                            // Get the account details from setting_values if available
                            let accountDetails = 'Please contact admin for account details';
                            
                            if (gateway.setting_values && gateway.setting_values.length > 0) {
                                // Look for account number or value in setting_values
                                const accountValue = gateway.setting_values.find(sv => 
                                    sv.name === 'account_number' || 
                                    sv.name === 'number' || 
                                    sv.name === 'value' ||
                                    sv.value && sv.value.trim() !== '' && sv.value !== gateway.title
                                );
                                
                                if (accountValue && accountValue.value && accountValue.value.trim() !== '') {
                                    accountDetails = accountValue.value;
                                }
                            }
                            
                            return {
                                name: name,
                                label: this.capitalizeFirst(name),
                                value: accountDetails
                            };
                        });
                        
                        console.log('Processed offline gateways:', this.offlineGateways);
                    } else {
                        console.log('No payment gateways found, using fallback');
                        // If no payment gateways found, use fallback
                        this.offlineGateways = [
                            { name: 'bkash', label: 'Bkash', value: 'Please contact admin for Bkash account details' },
                            { name: 'nagad', label: 'Nagad', value: 'Please contact admin for Nagad account details' },
                            { name: 'rocket', label: 'Rocket', value: 'Please contact admin for Rocket account details' },
                            { name: 'bank', label: 'Bank Transfer', value: 'Please contact admin for Bank account details' }
                        ];
                    }
                }
            } catch (error) {
                console.error('Error fetching offline gateways:', error);
                // Fallback to default gateways if API fails
                this.offlineGateways = [
                    { name: 'bkash', label: 'Bkash', value: 'Please contact admin for Bkash account details' },
                    { name: 'nagad', label: 'Nagad', value: 'Please contact admin for Nagad account details' },
                    { name: 'rocket', label: 'Rocket', value: 'Please contact admin for Rocket account details' },
                    { name: 'bank', label: 'Bank Transfer', value: 'Please contact admin for Bank account details' }
                ];
            }
        },
        
        capitalizeFirst(str) {
            if (!str || typeof str !== 'string') {
                return 'Unknown';
            }
            return str.charAt(0).toUpperCase() + str.slice(1);
        },
        
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

            // Additional validation for offline payments
            if (this.formData.payment_method === 'offline') {
                if (!this.formData.trx_id || this.formData.trx_id.trim() === '') {
                    window.s_alert('Please enter a transaction ID for offline payment', 'error');
                    return;
                }
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
                payment_method: 'sslcommerze',
                trx_id: ''
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

.offline-gateways {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.offline-gateways .title {
    color: #495057;
    margin-bottom: 10px;
    font-size: 16px;
    font-weight: 600;
}

.instruction-text {
    color: #6c757d;
    margin-bottom: 15px;
    font-size: 14px;
}

.payment-methods-list {
    margin-bottom: 15px;
}

.payment-method-item {
    background-color: white;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 12px;
    margin-bottom: 10px;
}

.method-header {
    color: #495057;
    font-size: 14px;
    margin-bottom: 4px;
}

.method-details {
    color: #007bff;
    font-size: 13px;
    font-family: monospace;
}

.instruction-note {
    background-color: #d1ecf1;
    border: 1px solid #bee5eb;
    border-radius: 4px;
    padding: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.instruction-note i {
    color: #0c5460;
}

.instruction-note small {
    color: #0c5460;
    margin: 0;
}

.offline-gateways .check-box {
    margin-bottom: 8px;
}

.offline-gateways .container-box {
    font-size: 13px;
    color: #6c757d;
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
