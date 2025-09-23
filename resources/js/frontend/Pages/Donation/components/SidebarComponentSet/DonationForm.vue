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
                            <span 
                                class="price-btn" 
                                :class="{ 'active': formData.amount === 25 }"
                                @click="setAmount(25)"
                            >25</span>
                            <span 
                                class="price-btn" 
                                :class="{ 'active': formData.amount === 50 }"
                                @click="setAmount(50)"
                            >50</span>
                            <span 
                                class="price-btn" 
                                :class="{ 'active': formData.amount === 100 }"
                                @click="setAmount(100)"
                            >100</span>
                            <span 
                                class="price-btn" 
                                :class="{ 'active': formData.amount === 200 }"
                                @click="setAmount(200)"
                            >200</span>
                        </div>
                        <div class="form-group">
                            <input 
                                type="number" 
                                v-model="formData.amount" 
                                placeholder="Custom amount" 
                                class="form-control"
                                required
                            >
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
                                <input 
                                    type="text" 
                                    v-model="formData.first_name" 
                                    placeholder="First Name" 
                                    class="form-control"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input 
                                    type="text" 
                                    v-model="formData.last_name" 
                                    placeholder="Last Name" 
                                    class="form-control" 
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input 
                                    type="email" 
                                    v-model="formData.email" 
                                    class="form-control" 
                                    placeholder="Email" 
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input 
                                    type="text" 
                                    v-model="formData.number" 
                                    placeholder="Phone Number" 
                                    class="form-control"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input 
                                    type="text" 
                                    v-model="formData.address_1" 
                                    placeholder="Address line 1" 
                                    class="form-control"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input 
                                    type="text" 
                                    v-model="formData.address_2" 
                                    placeholder="Address line 2" 
                                    class="form-control"
                                >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input 
                                    type="text" 
                                    v-model="formData.city" 
                                    placeholder="City" 
                                    class="form-control" 
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input 
                                    type="text" 
                                    v-model="formData.state" 
                                    placeholder="State*" 
                                    class="form-control" 
                                    required
                                >
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
                            <input 
                                type="radio" 
                                v-model="formData.payment_method" 
                                value="sslcommerze"
                            >
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="check-box">
                        <label class="container-box">
                            Offline payment
                            <input 
                                type="radio" 
                                v-model="formData.payment_method" 
                                value="offline"
                            >
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="btn-wrapper">
                <button 
                    type="submit" 
                    @click="submitDonation"
                    class="boxed-btn btn-sanatory"
                    :disabled="isSubmitting"
                >
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
    methods: {
        setAmount(amount) {
            this.formData.amount = amount;
        },
        
        async submitDonation() {
            if (this.isSubmitting) return;
            
            // Basic validation
            if (!this.formData.amount || this.formData.amount <= 0) {
                alert('Please enter a valid donation amount');
                return;
            }
            
            if (!this.formData.first_name || !this.formData.last_name || !this.formData.email) {
                alert('Please fill in all required fields');
                return;
            }
            
            this.isSubmitting = true;
            
            try {
                const response = await axios.post('/donations/store', this.formData);
                
                if (response.status === 200 || response.status === 201) {
                    alert('Thank you for your donation! Your submission has been received.');
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
                    alert('Please correct the following errors:\n' + errorMessages);
                } else {
                    alert('There was an error processing your donation. Please try again.');
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
                payment_method: 'sslcommerze'
            };
        }
    }
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
