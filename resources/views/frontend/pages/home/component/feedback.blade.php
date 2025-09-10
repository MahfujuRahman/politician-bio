<!-- TESTIMONIAL AREA START (testimonial-7) -->
<div class="ltn__testimonial-area section-bg-1--- bg-image-top pt-50 pb-70" data-bs-bg="img/bg/20.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Our Testimonial</h6>
                    <h1 class="section-title">Clients Feedback</h1>
                </div>
            </div>
        </div>
        <div class="row ">
            @foreach ($testimonials as $item)
                <div class="col-lg-4">
                    <div class="ltn__testimonial-item ltn__testimonial-item-7">
                        <div class="ltn__testimoni-info">
                            <div class="ltn__testimoni-info-inner">
                                <div class="ltn__testimoni-img">
                                    <a href="{{ asset($item?->image ?? 'uploads/default_man.jpeg') }}" data-rel="lightcase:myCollection">
                                        <img class="h-100 w-100" src="{{ asset($item?->image ?? 'uploads/default_man.jpeg') }}" alt="#">
                                    </a>
                                </div>
                                <div class="ltn__testimoni-name-designation">
                                    <h5>{{$item?->name}}</h5>
                                    <label>{{$item?->company_location}}, {{ $item?->company}}</label>
                                    <label>{{$item?->designation}}</label>
                                </div>
                            </div>
                            <p >
                                <i class="flaticon-left-quote-1"></i> 
                                {!! strip_tags($item?->feedback, '<span><strong><em><b><i><u>') !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- <div class="col-lg-4">
                <div class="ltn__testimonial-item ltn__testimonial-item-7">
                    <div class="ltn__testimoni-info">
                        <div class="ltn__testimoni-info-inner">
                            <div class="ltn__testimoni-img">
                                <img src="{{ asset('assets/frontend') }}/img/testimonial/Kawser-Ali.png" alt="#">
                            </div>
                            <div class="ltn__testimoni-name-designation">
                                <h5>Engr. Md. Kawser Ali</h5>
                                <label>Flat owner, Starlit Shamsia</label>
                                <label>Chief Operating Officer, Youth Group</label>
                            </div>
                        </div>
                        <p><i class="flaticon-left-quote-1"></i> 
                            Starlit Homes Ltd is a very structured real estate firm. 
                            I came to know their expertises. Their dealing is fair & transparent.
                             They make affordable flats and apartments in terms of price, location and quality.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ltn__testimonial-item ltn__testimonial-item-7">
                    <div class="ltn__testimoni-info">
                        <div class="ltn__testimoni-info-inner">
                            <div class="ltn__testimoni-img">
                                <img src="{{ asset('assets/frontend') }}/img/testimonial/Khondker-Abul-Qasem3.png" alt="#">
                            </div>
                            <div class="ltn__testimoni-name-designation">
                                <h5>Khondker Abul Qasem</h5>
                                <label>Landowner, Stralit Bonolata</label>
                                <label>Director, Nikki Thai Industries Ltd.</label>
                            </div>
                        </div>
                        <p><i class="flaticon-left-quote-1"></i> 
                            Starlit Homes Ltd is technically very sound.
                             They have expert engineers. Its their expertises in c
                             onstruction field that allures me to make a solid contract with them.</p>
                    </div>
                </div>
            </div> --}}
            <!--  -->
        </div>
    </div>
</div>
<!-- TESTIMONIAL AREA END -->