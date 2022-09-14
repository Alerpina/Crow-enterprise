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
                        @if ($gs->is_home == 1)
                            <li><a href="{{ route('front.page', 'seja-prime-11') }}"
                                    class="ft">{{ __('Be Prime') }}</a></li>
                        @endif

                        @if ($gs->is_home == 1)
                            <li><a href="{{ route('front.page', 'black-friday-12') }}"
                                    class="ft">{{ __('black friday') }}</a></li>
                        @endif

                        @if ($gs->is_home == 1)
                            <li><a href="{{ route('front.page', 'mega-maio-13') }}"
                                    class="ft">{{ __('Mega May') }}</a></li>
                        @endif

                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'julho-gamer-14') }}"
                                    class="ft">{{ __('july gamer') }}</a></li>
                        @endif

                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'pix-15') }}" class="ft">{{ __('pix') }}</a>
                            </li>
                        @endif

                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'compra-segura-16') }}"
                                    class="ft">{{ __('safe buy') }}</a></li>
                        @endif

                        @if ($gs->is_contact == 1)
                            <li><a href="{{ route('front.page', 'garantia-estendida-e-roubo-quebra-adicional-17') }}"
                                    class="ft">{{ __('Extended Warranty and Theft + Additional Breakage') }}</a>
                            </li>
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
                            <li><a href="{{ route('front.page', 'sobre-a-pioneer-international-shop-1') }}"
                                    class="ft">{{ __('About Pioneer International Shop') }}</a></li>
                        @endif

                        @if ($gs->is_home == 1)
                            <li><a href="{{ route('front.page', 'politicas-de-sites-e-mercados-2') }}"
                                    class="ft">{{ __('Site and Marketplace Policies') }}</a></li>
                        @endif

                        @if ($gs->is_home == 1)
                            <li><a href="{{ route('front.page', 'politicas-de-privacidade-3') }}"
                                    class="ft">{{ __('Privacy Policies') }}</a>
                            </li>
                        @endif

                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'premios-4') }}"
                                    class="ft">{{ __('awards') }}</a></li>
                        @endif

                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'trabalhe-conosco-5') }}"
                                    class="ft">{{ __('Work with us') }}</a></li>
                        @endif

                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'codigo-de-defesa-do-consumidor-6') }}"
                                    class="ft">{{ __('Consumer Protection Code') }}</a></li>
                        @endif

                        @if ($gs->is_contact == 1)
                            <li><a href="{{ route('front.page', 'codigo-de-conduta-e-etica-7') }}"
                                    class="ft">{{ __('Code of Conduct and Ethics') }}</a>
                            </li>
                        @endif

                        @if ($gs->is_contact == 1)
                            <li><a href="{{ route('front.page', 'pioneer-channel-8') }}"
                                    class="ft">{{ __('pioneer channel') }}</a></li>
                        @endif

                        @if ($gs->is_home == 1)
                            <li><a href="{{ route('front.page', 'faq-9') }}" class="ft">{{ __('faq') }}</a>
                            </li>
                        @endif

                        @if ($gs->is_home == 1)
                            <li><a href="{{ route('front.page', 'perguntas-frequentes-diretrizes-10') }}"
                                    class="ft">{{ __('FAQ - Guidelines') }}</a></li>
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
                            <li><a href="" class="ft">{{ __('Opening hours: 08:00 to 20:00') }}</a>
                            </li>
                        @endif

                        @if ($gs->is_home == 1)
                            <li><a href=""
                                    class="ft">{{ __('Monday to Saturday, Brasilia time (Except Sunday and holidays, in Limeira - SP)') }}</a>
                            </li>
                        @endif

                        @if ($gs->is_home == 1)
                            <li><a href=""
                                    class="ft">{{ __('Address: Rua Carlos Gomes, 1321 - Ninth floor - Centro Limeira / SP - Zip code: 13480-010') }}</a>
                            </li>
                        @endif
                        <h4 style="text-align:left;" class="title m-0">
                            {{ __('email:') }}
                        </h4>

                        @if ($gs->is_home == 1)
                            <li><a href="" class="ft">{{ __('faleconosco@pioneer.com.br') }}</a></li>
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
