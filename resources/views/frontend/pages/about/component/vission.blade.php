<!-- TESTIMONIAL AREA START (testimonial-7) -->
<div class="ltn__testimonial-area section-bg-1--- bg-image-top pt-50 pb-70" data-bs-bg="img/bg/20.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    {{-- <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Our Testimonial</h6> --}}
                    <h1 class="section-title">Our Vission</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class=" about-img-left">
                    <a href="{{ asset($our_vission?->primary_image	?? 'uploads/default.jpg') }}" data-rel="lightcase:myCollection">
                        <img class="equal-box fixed_h_w mx-auto" src="{{ asset($our_vission?->primary_image ?? 'uploads/default.jpg') }}" alt="Our Vission Image">
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ltn__testimonial-item ltn__testimonial-item-7">
                    <div class="ltn__testimoni-info">
                        <p class="equal-box"><i class="flaticon-left-quote-1"></i> 
                            <span>{!! $our_vission?->description !!}</span></p>
                        </p>
                    </div>
                </div>
            </div>
            <!--  -->
        </div>
    </div>
</div>
<!-- TESTIMONIAL AREA END -->