<!-- CONTACT MESSAGE AREA START -->
<div class="ltn__contact-message-area pb-120 mb--100">
    <div class="container">
        <div class="row">
            @if(session('success'))
                <div class="col-12">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if (session('success'))
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif
            <div class="col-lg-12">
                <div class="ltn__form-box contact-form-box box-shadow white-bg">
                    <h4 class="title-2">Get A Quote</h4>
                    <form id="contact-form" action="{{ route('contact.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-item input-item-name ltn__custom-icon mb-3">
                                    <input type="text" name="name" placeholder="Enter your name"
                                        style="margin-bottom: 0px">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-item input-item-email ltn__custom-icon mb-3">
                                    <input type="email" name="email" placeholder="Enter email address"
                                        style="margin-bottom: 0px">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <style>
                                .nice-select {
                                    margin-bottom: 0px!important;
                                }
                            </style>
                            <div class="col-md-6">
                                <div class="input-item">
                                    <select class="nice-select" name="service_type">
                                        <option value="">Select Service Type</option>
                                        <option value="Property Management" {{ old('service_type') == 'Property Management' ? 'selected' : '' }}>Property Management</option>
                                        <option value="Consulting Service" {{ old('service_type') == 'Consulting Service' ? 'selected' : '' }}>Consulting Service</option>
                                        <option value="Home Buying" {{ old('service_type') == 'Home Buying' ? 'selected' : '' }}>Home Buying</option>
                                        <option value="Home Selling" {{ old('service_type') == 'Home Selling' ? 'selected' : '' }}>Home Selling</option>
                                    </select>
                                    @error('service_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-item input-item-phone ltn__custom-icon mb-3">
                                    <input type="text" name="phone" placeholder="Enter phone number"
                                        style="margin-bottom: 0px">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="input-item input-item-textarea ltn__custom-icon">
                            <textarea name="message" placeholder="Enter message"></textarea>
                            @error('message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="btn-wrapper mt-2">
                            <button class="btn btn-outline-primary text-uppercase" type="submit">get a free
                                service</button>
                        </div>
                        <p class="form-messege mb-0 mt-20"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTACT MESSAGE AREA END -->