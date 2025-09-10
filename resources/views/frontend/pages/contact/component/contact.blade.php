<!-- CONTACT ADDRESS AREA START -->
<div class="ltn__contact-address-area  mb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h1 class="section-title">Contact & Address</h1>
                </div>
            </div>
            @php
                $phone = $settingTitles->where('title', 'phone_numbers')->first();
                $email = $settingTitles->where('title', 'emails')->first();
                $address = $settingTitles->where('title', 'address')->first();
            @endphp

            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                    <div class="ltn__contact-address-icon">
                        <img src="{{ asset('assets/frontend') }}/img/icons/10.png" alt="Icon Image">
                    </div>
                    <h3>Email Address</h3>
                    @if ($email && isset($email->values))
                        @foreach ($email->values as $e)
                            <p> E-mail: {{ $e->value }} <br></p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                    <div class="ltn__contact-address-icon">
                        <img src="{{ asset('assets/frontend') }}/img/icons/11.png" alt="Icon Image">
                    </div>
                    <h3>Phone Number</h3>
                    @if ($phone && isset($phone->values))
                        <p>
                            @foreach ($phone->values as $e)
                                {{ $e->value }} <br>
                            @endforeach
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                    <div class="ltn__contact-address-icon">
                        <img src="{{ asset('assets/frontend') }}/img/icons/12.png" alt="Icon Image">
                    </div>
                    <h3>Office Address</h3>
                    @if ($address && isset($address->values))
                        @foreach ($address->values as $e)
                            <p> {{ $e->value }} <br></p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTACT ADDRESS AREA END -->