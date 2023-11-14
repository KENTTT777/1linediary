@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="create_link">
            <a href="{{ url('/posts/create') }}"><span>新規投稿</span></a>
        </div>

        <div class="post_box">
            <div class="post-data">
                <ul>
                @foreach ($posts as $post)
                    <li>
                        <div class="post-data-time">
                            <p>
                                {{ $post->postdate }}
                            </p>
                        </div>

                        <div class="post-data-content">
                            <dl>
                            @if ($post->image)
                                <dt>
                                    <div class="post-data-image">
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->name }}_{{ $post->id }}">
                                    </div>
                                </dt>
                            @endif

                                <dd>
                                    <p>
                                        {!! nl2br(e(Str::limit($post->body, 200))) !!}
                                    </p>
                                </dd>
                            </dl>
                            <div class="btn_box">
                                <a href="{{ route('posts.edit', $post) }}" class="edit"><span>編集</span></a>
                                <form action="{{ route('posts.destroy', $post) }}" method="post" name="delform{{$post->id}}" class="deleteform">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-button">削除</button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>
            {{ $posts->links() }}
        </div>
    </div>
@endsection


