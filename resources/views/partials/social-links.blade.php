{{-- Url para ver parametros de las redes sociales -- https://github.com/bradvin/social-share-urls --}}

<div class="buttons-social-media-share">
    <ul class="share-buttons">
        <li>
            {{-- request()->fullurl() == Devuaelve la url completa de la pagina en la que se esta actualmente --}}
            <a href="https://www.facebook.com/sharer.php?u={{ request()->fullurl() }}&title={{ $description }}" title="Share on Facebook" target="_blank">
                <img alt="Compartir en Facebook" src="{{ asset('img/flat_web_icon_set/Facebook.png') }}">
            </a>
        </li>
        <li>
            <a href="https://twitter.com/intent/tweet?url={{ request()->fullurl() }}&text={{ $description }}&via={{ config('app.name') }}&hashtags=Blog" target="_blank" title="Tweet">
                <img alt="Tweet" src="{{ asset('img/flat_web_icon_set/Twitter.png')}}">
            </a>
        </li>
        <li>
            <a href="https://plus.google.com/share?url={{ request()->fullurl() }}&text={{ $description }}&hl=es" target="_blank" title="Share on Google+">
            <img alt="Compartir en Google+" src="{{ asset('img/flat_web_icon_set/Google-plus.png') }}">
            </a>
        </li>
        <li>
            <a href="http://pinterest.com/pin/create/button/?url={{ request()->fullurl() }}&description={{ $description }}" target="_blank" title="Pin it">
                <img alt="Pin it" src="{{ asset('img/flat_web_icon_set/Pinterest.png')}} ">
            </a>
        </li>
    </ul>
</div>