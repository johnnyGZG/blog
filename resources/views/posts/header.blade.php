{{-- <header class="container-flex space-between">
    <div class="date">
    
    <span class="c-gris">{{ optional($post->published_at)->format('M d') }}</span>
    </div>
    @if($post->category)
    <div class="post-category">
        <span class="category">{{ optional($post->category)->name }}</span>
    </div>
    @endif
</header> --}}



<header class="container-flex space-between">
    <div class="date">
        <!-- Otra Opcion de Formato diffForHumans() -->
        <span class="c-gray-1">
            {{-- el helper optional permite que los valores se muestren nulos asi se este haciendo una operacion para que no de error --}}
            {{ optional($post->published_at)->Format('M d') }}
            /
            {{ $post->owner->name }}
        </span>
    </div>
    <div class="post-category">
        <span class="category text-capitalize">
            <a href="{{ route('categories.show', $post->category) }}">
                {{ optional($post->category)->name }}
            </a>
        </span>
    </div>
</header>