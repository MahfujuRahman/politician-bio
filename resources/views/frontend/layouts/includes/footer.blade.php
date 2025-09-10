<footer class="ltn__footer-area footer_background_color">
    @php
        // Helper function to get the first value or null
        // function get_setting_value($setting) {
        //     return $setting?->values?->first()?->value ?? '';
        // }

        // basic info
        $phone_value = get_setting_value($settingTitles->where('title', 'phone_numbers')->first());
        $email_value = get_setting_value($settingTitles->where('title', 'emails')->first());
        $address_value = get_setting_value($settingTitles->where('title', 'address')->first());
        // social links
        $facebook_value = get_setting_value($settingTitles->where('title', 'facebook')->first());
        $instagram_value = get_setting_value($settingTitles->where('title', 'instagram')->first());
        $twitter_value = get_setting_value($settingTitles->where('title', 'twitter')->first());
        $linkedin_value = get_setting_value($settingTitles->where('title', 'linkedin')->first());
        $youtube_value = get_setting_value($settingTitles->where('title', 'youtube')->first());
        // logos
        $header_logo_value = get_setting_value($settingTitles->where('title', 'header_logo')->first());
        //copy_right
        $copy_right_value = get_setting_value($settingTitles->where('title', 'copy_right')->first());

        // @dd($phone_value, $email_value, $address_value, $facebook_value, $instagram_value, $twitter_value)
    @endphp
   <div class="container">
    <div class="footer-top-area  section-bg-2 plr--5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-about-widget">
                        <div class="footer-logo">
                            <div class="site-logo">
                                <img class="invert h-100" src=" {{ asset($header_logo_value ?? 'uploads/default.jpg') }}" alt="Logo">
                            </div>
                        </div>
                        <p>Leave us a note and we will get back to you for a free consultation</p>
                        <div class="footer-address">
                            <ul>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-placeholder"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p>{{$address_value}}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-call"></i>
                                    </div>
                                    <div class="footer-address">
                                        <p><a class="text-white" href="tel:{{$phone_value}}">{{$phone_value}}</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-mail"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p><a class="text-white " href="mailto:{{$email_value}}">{{$email_value}}</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="ltn__social-media mt-20">
                            <ul>
                                <li><a href="{{$facebook_value}}" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{$twitter_value}}" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="{{$youtube_value}}" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                                {{-- <li><a href="{{$instagram_value}}" title="Instagram"><i class="fab fa-instagram"></i></a></li> --}}
                                <li><a href="{{$linkedin_value}}" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Company</h4>
                        <div class="footer-menu text-wh">
                            <ul>
                                <li><a href="{{ route('about') }}">About</a></li>
                                <li><a href="{{ route('news') }}">Blog</a></li>
                                <li><a href="{{ route('properties') }}">Properties</a></li>
                                {{-- <li><a href="{{ route('about') }}">Locations Map</a></li> --}}
                                {{-- <li><a href="{{ route('about') }}">FAQ</a></li> --}}
                                <li><a href="{{ route('contact') }}">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Services</h4>
                        <div class="footer-menu text-wh">
                            <ul>
                                <li><a href="javascript:void(0)">Order tracking</a></li>
                                <li><a href="javascript:void(0)">Wish List</a></li>
                                <li><a href="javascript:void(0)">Login</a></li>
                                <li><a href="javascript:void(0)">My account</a></li>
                                <li><a href="javascript:void(0)">Terms & Conditions</a></li>
                                <li><a href="javascript:void(0)">Promotional Offers</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Customer Care</h4>
                        <div class="footer-menu text-wh">
                            <ul>
                                <li><a href="/login">Login</a></li>
                                <li><a href="javascript:void(0)">My account</a></li>
                                <li><a href="javascript:void(0)">Wish List</a></li>
                                <li><a href="javascript:void(0)">Order tracking</a></li>
                                <li><a href="javascript:void(0)">FAQ</a></li>
                                <li><a href="javascript:void(0)">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                    <div class="footer-widget footer-newsletter-widget">
                        <h4 class="footer-title">Newsletter</h4>
                        <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                        <div class="footer-newsletter">
                            <form id="newsletter-form">
                                <input id="newsletter-email" type="email" name="email" placeholder="Email*">
                                <small id="newsletter-error" style="color: red;"></small> <!-- Display validation error -->
                                <div class="btn-wrapper">
                                    <button class="theme-btn-1" type="submit"><i class="fa-solid fa-location-arrow"></i></button>
                                </div>
                            </form>
                        </div>
                        <h5 class="mt-30">We Accept</h5>
                        <img src="{{ asset('assets/frontend') }}/img/icons/payment-4.png" alt="Payment Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ltn__copyright-area ltn__copyright-2 section-bg-7  plr--5">
        <div class="container-fluid ltn__border-top-2">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="ltn__copyright-design clearfix">
                        <p>All Rights Reserved @ {{$copy_right_value ?? "Tech Park IT"}} <span class="current-year"></span></p>
                    </div>
                </div>
                <div class="col-md-6 col-12 align-self-center">
                    <div class="ltn__copyright-menu text-end text-wh">
                        <ul>
                            <li><a href="/pages/terms-and-conditions">Terms & Conditions</a></li>
                            <li><a href="/pages/claim">Claim</a></li>
                            <li><a href="/pages/privacy-and-policy">Privacy & Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>
</footer>

@push('js_start')
<script>
    async function onSubmitNewsletter(e) {
        e.preventDefault();
        const email = document.getElementById('newsletter-email').value;
        const form = document.getElementById('newsletter-form');
        const errorDiv = document.getElementById('newsletter-error');
        errorDiv.innerText = ""; // Clear previous errors

        try {
            const response = await fetch('/api/v1/newsletters/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email })
            });

            const data = await response.json();

            if (response.ok) {
                alert("Subscribed  successfully!");
                form.reset();
            } else if (response.status === 422) {
                // Laravel validation errors
                if (data.errors && data.errors.email) {
                    errorDiv.innerText = data.errors.email[0];
                } else {
                    errorDiv.innerText = data.message || "Validation error.";
                }
            } else {
                alert(data.message || "Something went wrong.");
            }
        } catch (err) {
            console.error(err);
            alert("Network or server error.");
        }
    }

    document.getElementById('newsletter-form').addEventListener('submit', onSubmitNewsletter);
</script>
@endpush