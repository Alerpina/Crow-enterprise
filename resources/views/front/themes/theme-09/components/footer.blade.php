<!-- Footer Area Start -->
<footer class="footer" id="footer">
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-lg-2">
                <div class="footer-widget info-link-widget">
                    <h4 class="title m-0">
                        {{ __('departaments') }}
                    </h4>
                    <div class="">

                        @foreach ($categories->where('is_featured', '=', 1) as $cat)
                            <ul class="ftt link-list">
                                <li><a href="{{ route('front.category', $cat->slug) }}"
                                        class="text-left d-block ft ftt">{{ $cat->name }}</a></li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="footer-widget info-link-widget">
                    <h4 class="title m-0">
                        {{ __('NEWS') }}
                    </h4>
                    <ul class="link-list">
                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'compra-segura-16') }}"
                                    class="ft">{{ __('safe buy') }}</a></li>
                        @endif

                        @if ($gs->is_contact == 1)
                            <li><a href="{{ route('front.page', 'pioneer-channel-8') }}"
                                    class="ft">{{ __('pioneer channel') }}</a></li>
                        @endif
                    </ul>
                    <div class="fotter-social-links">
                        <ul style="width:200px;">

                            @if ($socials->f_status == 1)
                                <li>
                                    <a href="{{ $socials->youtube }}" class="youtube" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socials->f_status == 1)
                                <li>
                                    <a href="{{ $socials->facebook }}" class="facebook" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socials->i_status == 1)
                                <li>
                                    <a href="{{ $socials->instagram }}" class="instagram" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socials->t_status == 1)
                                <li>
                                    <a href="{{ $socials->twitter }}" class="twitter" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socials->l_status == 1)
                                <li>
                                    <a style="margin-top:6px;" href="{{ $socials->linkedin }}" class="linkedin"
                                        target="_blank">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socials->d_status == 1)
                                <li>
                                    <a href="{{ $socials->dribble }}" class="dribbble" target="_blank">
                                        <i class="fab fa-dribbble"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socials->y_status == 1)
                                <li>
                                    <a href="{{ $socials->youtube }}" class="youtube" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="footer-widget info-link-widget">
                    <h3 class="title m-0">
                        {{ __('institutional') }}
                    </h3>
                    <ul class="link-list">
                        @if ($gs->is_home == 1)
                            <li><a href="{{ route('front.page', 'sobre-a-pioneer-international-shop-6') }}"
                                    class="ft">{{ __('About Pioneer International Shop') }}</a></li>
                        @endif

                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'trabalhe-conosco-21') }}"
                                    class="ft">{{ __('Work with us') }}</a></li>
                        @endif

                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'politicas-de-devolucao-e-troca-25') }}"
                                    class="ft">{{ __('Return and exchange policy') }}</a></li>
                        @endif

                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'regime-de-tributacao-unificada-rtu-2') }}"
                                    class="ft">{{ __('Unified Taxation RTU') }}</a></li>
                        @endif

                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <div class="footer-widget info-link-widget">
                    <h3 class="title m-0">
                        {{ __('attendance') }}
                    </h3>
                    <ul class="link-list">
                        @if ($gs->is_home == 1)
                            <li class="ft">{{ __('Opening hours: 08:00 to 20:00') }}
                            </li>
                        @endif

                        @if ($gs->is_home == 1)
                            <li class="ft">{{ __('Monday to Saturday, Brasilia time (Except Sunday and holidays, in Limeira - SP)') }}
                            </li>
                        @endif

                        @if ($gs->is_home == 1)
                            <li class="ft">{{ __('Address: Rua Carlos Gomes, 1321 - Ninth floor - Centro Limeira / SP - Zip code: 13480-010') }}
                            </li>
                        @endif
                        
                        <li class="ft">{{ __('+595 61 504 590') }}
                        </li>

                        <h4 style="text-align:left;" class="title m-0">
                            {{ __('email:') }}
                        </h4>

                        @if ($gs->is_home == 1)
                            <li class="ft">{{ __('faleconosco@pioneer.com.br') }}</li>
                        @endif
                    </ul>
                </div>



            </div>
            <div class="col-md-2">
                <div>
                    {!! $gs->copyright !!}
                </div>
            </div>
        </div>
    </div>

    <div class="copy-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <div class="content">
                            <p>{{ $gs->title }} © {{ date('Y') }}.
                                {{ $gs->company_document ? '| ' . $gs->document_name . ' - ' . $gs->company_document . ' |' : '' }}
                                {{ __('All Rights Reserved') }}.</p>
                            <p>{{ __('Developed By') }} <a id="agcrow"
                                    href="https://crowtech.digital/">CrowTech</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- Footer Area End -->
