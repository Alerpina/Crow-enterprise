<!-- Footer Area Start -->
<footer class="footer" id="footer">
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-lg-2">
                <div class="footer-widget info-link-widget">
                    <h4 class="title m-0">
                        {{ __("DEPARTAMENTOS") }}
                    </h4>
                    <div class="">

                        @foreach($categories->where('is_featured','=',1) as $cat)
                        <ul class="ftt link-list">
                            <li><a href="{{ route('front.category',$cat->slug) }}"
                            class="text-left d-block ft ftt">{{ $cat->name }}</a></li>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="footer-widget info-link-widget">
                    <h4 class="title m-0">
                        {{ __("NOVIDADES") }}
                    </h4>
                    <ul class="link-list">
                        @if($gs->is_home == 1)
                        <li><a href="" class="ft">{{ __("Seja Prime") }}</a></li>
                        @endif

                        @if($gs->is_home == 1)
                        <li><a href="" class="ft">{{ __("Black Friday") }}</a></li>
                        @endif

                        @if($gs->is_home == 1)
                        <li><a href="" class="ft">{{ __("Mega Maio") }}</a></li>
                        @endif

                        @if($gs->is_blog == 1)
                        <li><a href="" class="ft">{{ __("Julho Gamer") }}</a></li>
                        @endif

                        @if($gs->is_blog == 1)
                        <li><a href="" class="ft">{{ __("Pix") }}</a></li>
                        @endif

                        @if($gs->is_blog == 1)
                        <li><a href="" class="ft">{{ __("Compra Segura") }}</a></li>
                        @endif

                        @if($gs->is_contact == 1)
                        <li><a href="" class="ft">{{ __("Garantia Estendida e Roubo + Quebra adicional") }}</a></li>
                        @endif
                    </ul>
                    <div class="fotter-social-links">
                        <ul style="width:200px;">

                            @if($socials->f_status == 1)
                            <li>
                                <a href="{{ $socials->youtube }}" class="youtube" target="_blank">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                            @endif

                            @if($socials->f_status == 1)
                            <li>
                                <a href="{{ $socials->facebook }}" class="facebook" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            @endif

                            @if($socials->i_status == 1)
                            <li>
                                <a href="{{ $socials->instagram }}" class="instagram" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            @endif

                            @if($socials->t_status == 1)
                            <li>
                                <a href="{{ $socials->twitter }}" class="twitter" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            @endif

                            @if($socials->l_status == 1)
                            <li>
                                <a style="margin-top:6px;" href="{{ $socials->linkedin }}" class="linkedin"
                                    target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                            @endif

                            @if($socials->d_status == 1)
                            <li>
                                <a href="{{ $socials->dribble }}" class="dribbble" target="_blank">
                                    <i class="fab fa-dribbble"></i>
                                </a>
                            </li>
                            @endif

                            @if($socials->y_status == 1)
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
                        {{ __("INSTITUCIONAL") }}
                    </h3>
                    <ul class="link-list">
                        @if($gs->is_home == 1)
                        <li><a href="" class="ft">{{ __("Sobre a Pioneer Internacional Shop") }}</a></li>
                        @endif

                        @if($gs->is_home == 1)
                        <li><a href="" class="ft">{{ __("Políticas do Site e Marketplace") }}</a></li>
                        @endif

                        @if($gs->is_home == 1)
                        <li><a href="" class="ft">{{ __("Políticas de Privacidade") }}</a>
                        </li>
                        @endif

                        @if($gs->is_blog == 1)
                        <li><a href="" class="ft">{{ __("Prêmios") }}</a></li>
                        @endif

                        @if($gs->is_blog == 1)
                        <li><a href="" class="ft">{{ __("Trabalhe Conosco") }}</a></li>
                        @endif

                        @if($gs->is_blog == 1)
                        <li><a href="" class="ft">{{ __("Código de Defesa do Consumidor") }}</a></li>
                        @endif

                        @if($gs->is_contact == 1)
                        <li><a href="" class="ft">{{ __("Código de Conduta e Etica") }}</a>
                        </li>
                        @endif

                        @if($gs->is_contact == 1)
                        <li><a href="" class="ft">{{ __("Canal Ninja") }}</a></li>
                        @endif

                        @if($gs->is_home == 1)
                        <li><a href="" class="ft">{{ __("FAQ") }}</a></li>
                        @endif

                        @if($gs->is_home == 1)
                        <li><a href="" class="ft">{{ __("FAQ - Orientações") }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <div class="footer-widget info-link-widget">
                    <h3 class="title m-0">
                        {{ __("ATENDIMENTO") }}
                    </h3>
                    <ul class="link-list">
                    @if($gs->is_home == 1)
                        <li><a href="" class="ft">{{ __("Horário de atendimento: 08:00 as 20:00") }}</a></li>
                        @endif

                        @if($gs->is_home == 1)
                        <li><a href="" class="ft">{{ __("Segunda a Sábado, horário de Brasilia(Exceto domingo e feriados, em Limeira - SP)") }}</a></li>
                        @endif

                        @if($gs->is_home == 1)
                        <li><a href="" class="ft">{{ __("Endereço: Rua Carlos Gomes, 1321 - Nono andar - Centro Limeira / SP - Cep:13480-010") }}</a></li>
                        @endif
                        <h4 style="text-align:left;" class="title m-0">
                            {{ __("Central SAC") }}
                        </h4>
                        @if($gs->is_home == 1)
                        <li><a href="" class="ft">{{ __("(19) 2114-444") }}</a></li>
                        @endif
                        <h4 style="text-align:left;" class="title m-0">
                            {{ __("Email:") }}
                        </h4>

                        @if($gs->is_home == 1)
                        <li><a href="" class="ft">{{ __("faleconosco@pioneer.com.br") }}</a></li>
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
                                <p>{{ $gs->title }} © {{ date('Y') }}. {{ $gs->company_document ? ('| ' . $gs->document_name . ' - ' . $gs->company_document . ' |') : '' }} {{ __('All Rights Reserved') }}.</p>
                                <p>{{ __('Developed By') }} <a id="agcrow" href="https://www.agenciacrow.com.br/">Agência Crow</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</footer>
<!-- Footer Area End -->