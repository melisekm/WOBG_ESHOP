@extends("layout.app")
@section('title', 'WOBG - About us')
@section("content")
    <main class="container pt-5 pb-5">
        <p class="text-center fs-3"><strong> About Us </strong></p>
        <p> Born in Bratislava, Slovakia, in 2015, by board-game addicts, we're team who lives in the industry and
            passion
            is what
            makes us great at what we do! With growing amazing gaming community, we provide more than one thousand board
            games. We
            hope everyone feels welcome to join the fun. </p>
        <p> We started small, with boxes around our flats, and quickly started to grow. Our store opened in 2017, and
            you
            can find us in Bratislava, CUBICON. Thank you so much to all our amazing
            customers, because of your suppport we are able to do what we love to do. And huge thanks goes to our
            amazing
            and hardworking team!</p>
        <img src="{{asset("img/store/boardgame_store-900.jpg")}}"
             srcset="{{asset("img/store/boardgame_store-400.jpg")}} 400w,
                 {{asset("img/store/boardgame_store-600.jpg")}} 600w,
                 {{asset("img/store/boardgame_store-900.jpg")}} 900w"
             sizes="(max-width:576px) 400px, (max-width:991px) 600px, 900px"
             class="img-fluid" alt="picture of our store">
    </main>
@endsection
