<!DOCTYPE html>

<html lang="{{$current_locale}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="minimal-ui, width=device-width,initial-scale=1">

    <meta name="language" content="{{$current_locale}}" />
    @if($current_locale == 'pt-br')
    <meta name="country" content="BRA" />
    <meta name="currency" content="R$" />
    @endif

    <title>{{$gs->title}}</title>


    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('storage/images/'.$gs->favicon)}}" />

    <!-- stylesheet crow -->
    <link rel="stylesheet" href="{{asset('assets/front/themes/shared/assets/css/crow.css')}}">
    <!-- stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/front/themes/shared/assets/css/all.css')}}">
    <!--Updated CSS-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    @yield('styles')
</head>

<body>
    <section class="maintenance-lp"
        style="background-image:url('{{ $gs->is_dark_mode ? asset('assets/front/themes/shared/assets/images/dark-bg-maintenance.jpeg') : asset('assets/front/themes/shared/assets/images/white-bg-maintenance.jpg') }}');">
        <div class="boxmaintenance-infos {{ $gs->is_dark_mode ? " dark" : "" }}">
            <h2 class="animate__animated">Em manutenção</h2>
            <img class="animate__animated maintenance-image" style="animation-delay:.3s;" src="{{ $gs->is_dark_mode ? asset('storage/images/').'/'.$gs->footer_logo :
            asset('storage/images/').'/'.$gs->logo }}" alt="Logo">
            <h5 class="animate__animated" style="animation-delay:.5s;">Estamos aperfeiçoando nossa plataforma para você
                ter uma melhor expêriencia com nosso site. Enquanto isso, confira nossos outros canais de comunicação:
            </h5>

            @php
            $social = App\Models\Socialsetting::find(1);
            @endphp
            <ul class="list-socials {{ $gs->is_dark_mode ? " dark" : "" }}">
                <li>
                    <a target="_blank" href="{{ $social->facebook }}"><i style="animation-delay:.7s;"
                            class="fab fa-facebook-f animate__animated"></i></a>
                </li>
                <li>
                    <a target="_blank" href="{{ $social->instagram }}"><i style="animation-delay:.7s;"
                            class="fab fa-instagram animate__animated"></i></a>
                </li>
                <li>
                    <a target="_blank"
                        href="https://api.whatsapp.com/send?phone={{ $gs->whatsapp_number }}&text=Ol%C3%A1!"><i
                            style="animation-delay:.7s;" class="fab fa-whatsapp animate__animated"></i></a>
                </li>
                <li>
                    <a target="_blank" href="{{ $social->linkedin }}"><i style="animation-delay:.7s;"
                            class="fab fa-linkedin-in animate__animated"></i></a>
                </li>
            </ul>
        </div>

        <p class="copyright-maintenance animate__animated {{ $gs->is_dark_mode ? " dark" : "" }}"
            style="animation-delay:.9s;">© 2021 {{$gs->title}}. Desenvolvido por <a class="link_agencia" href="">Agência
                Crow</a></p>

    </section>

    <script src="{{asset('assets/front/themes/shared/assets/js/jquery.js')}}"></script>

    <script>
        $(document).ready(function() {
      $('.animate__animated').each(function(){
        $(this).addClass('animate__fadeInUp');
      })
    });
    </script>

</body>

</html>
