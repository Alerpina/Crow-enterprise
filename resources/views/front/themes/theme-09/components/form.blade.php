<div class="container-fluid fundoForm">
    <div class="container">
        <form action="{{route('front.subscribe')}}" id="subscribeform2" method="POST">
        {{csrf_field()}}
            <div class="row fundoForm"> 
                <div class="mb-6 fundotitleMargin">
                    <h3>Pioneer! News</h3>
                    <h6>Receba ofertas exclusivas no seu email</h6>
                </div>
                <div class="mb-6 fundoFormMargin">
                    <input type="name" name="name" class="form-control" id="exampleInputName1" placeholder="Qual seu nome?">
                </div>
                <div class="mb-6 fundoFormMargin">
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Seu email?">
                </div>
                <button type="submit" class="btn btn-dark buttonForm">CADASTRAR</button>
        </form>
    </div>
</div> 
</div>
