<!-- TESTIMONIAL AREA START (testimonial-7) -->
<div class="ltn__testimonial-area section-bg-1--- bg-image-top pt-50 pb-70" data-bs-bg="img/bg/20.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Our Team</h6>
                    <h1 class="section-title">Intelligence Team</h1>
                </div>
            </div>
        </div>
        <div class="row  ">
            @foreach ($our_team as $item)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="ltn__team-item ltn__team-item-3---">
                    <div class="team-img">
                        <a href="{{ asset($item?->image ?? 'uploads/default.jpg')  }}" data-rel="lightcase:myCollection">
                        <img class="team_img_custom" src="{{ asset($item?->image ?? 'uploads/default.jpg') }}" alt="team_image">
                    </div>
        
                    <div class="team-info">
                        <h4><a href="#">{{$item?->name}}</a></h4>
                        <h5 class="ltn__primary-color-2">{{$item?->designation}}</h5>
                        <div class="ltn__social-media">
                            <ul>
                                @foreach ($item->social_link as $socil_item)
                                    <li><a href="{{$socil_item['title'] ?? ''}}"><i class="{{$socil_item['icon'] ?? ''}}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <div class="col-lg-3">
                <div class="ltn__team-item ltn__team-item-3">
                    <div class="team-img">
                        <img src="{{ asset('assets/frontend') }}/img/team/2.jpg" alt="Image">
                    </div>
                    <div class="team-info">
                        <h4><a href="#">Engr. Ahsan Kabir</a></h4>
                        <h6 class="ltn__secondary-color"></h6>
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-lg-3">
                <div class="ltn__team-item ltn__team-item-3---">
                    <div class="team-img">
                        <img src="{{ asset('assets/frontend') }}/img/team/3.jpg" alt="Image">
                    </div>
                    <div class="team-info">
                        <h4><a href="#">Engr. Atikur Rahman </a></h4>
                        <h6 class="ltn__secondary-color"></h6>
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-lg-3">
                <div class="ltn__team-item ltn__team-item-3---">
                    <div class="team-img">
                        <img src="{{ asset('assets/frontend') }}/img/team/1.jpg" alt="Image">
                    </div>
                    <div class="team-info">
                        <h4><a href="#">Engr. Syed Shamim Aziz</a></h4>
                        <h6 class="ltn__secondary-color"></h6>
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
            
            <!--  -->
        </div>
    </div>
</div>
<!-- TESTIMONIAL AREA END -->