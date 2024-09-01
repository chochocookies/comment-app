@extends('layouts.app')

@push('css')
    @livewireStyles
@endpush
@push('scss')
    @livewireStyles
@endpush
@push('js')
    @livewireScripts
    <script>
        Livewire.on('comment_store', commentId => {
            var helloScroll = document.getElementById('comment-'+ commentId);
            helloScroll.scrollIntoView({behavior: 'smooth'}, true);
        })
    </script>
@endpush

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-8">
            <h1>{{ $article->title }}</h1>
            <div class="mb-3">
                <div>
                    <span>{{ $article->user->name }}</span>
                    <span>{{ $article->created_at }}</span>
                </div>
                <p class="text-secondary">{{ $article->description }}</p>
                <p class="text-secondary">{{ $article->body }}</p>
            </div>
            <div>
                @livewire('articles.comment', ['id' => $article->id]);
            </div>

        </div>
    </div>
</div>
@endsection
