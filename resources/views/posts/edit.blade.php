@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <div class="create_link">
            <a href="{{ url('/posts') }}"><span>一覧に戻る</span></a>
        </div>
    
        <div class="edit_box">
            <h2 class="title mb-4">投稿編集</h2>
                <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data" name="editform" id="edit" class="form-area">
                @csrf
                @method('PUT')

                <dl>
                    <dt>
                        <span class="required">必須</span>
                        <span >日付</span>
                    </dt>
                    <dd class="postdate">
                        <label for="year">
                            <select name="year" id="year" required>
                                @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                                    @if(old('year',$post->year) == $i) <option value="{{ $i }}" selected>{{ $i }}</option>
                                    @else <option value="{{ $i }}">{{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
                        </label>

                        <label for="month">
                            <select name="month" id="month" required>
                                @for($j = 1; $j <= 12; $j++)
                                    @if(old('month',$post->month) == $j) <option value="{{ $j }}" selected>{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}</option>
                                    @else <option value="{{ $j }}">{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endif
                                @endfor
                            </select>
                        </label>

                        <label for="day">
                            <select name="day" id="day" required>
                                @for($k = 1; $k <= 31; $k++)
                                    @if(old('day',$post->day) == $k) <option value="{{ $k }}" selected>{{ str_pad($k, 2, '0', STR_PAD_LEFT) }}</option> 
                                    @else <option value="{{ $k }}">{{ str_pad($k, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endif
                                @endfor
                            </select>
                        </label>
                        @if ($errors->has('year')) <p class="errormessage">{{ $errors->first('year') }}</p>
                        @endif
                        @if ($errors->has('month')) <p class="errormessage">{{ $errors->first('month') }}</p>
                        @endif
                        @if ($errors->has('day')) <p class="errormessage">{{ $errors->first('day') }}</p>
                        @endif
                    </dd>

                    <dt>
                    <span class="required">必須</span>
                    <label for="body">内容</label>
                    </dt>
                    <dd>
                        <textarea name="body" id="body" rows="3" maxlength="200" placeholder="200文字まで入力可能です" required>{{ old('body', $post->body) }}</textarea>
                        <div class="wordcount">
                            <p>文字数:<span class="length">0</span>/200</p>
                        </div>
                        @if ($errors->has('body')) <p class="errormessage">{{ $errors->first('body') }}</p>
                        @endif
                    </dd>

                    <dt>
                        <span class="any">任意</span>
                        <label for="image">イメージ画像</label>
                    </dt>
                    <dd>
                        @if ($post->image) <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->name }}_{{ $post->id }}" class="diaryimage">
                        @endif
                        <input type="file" name="image" id="image" value="{{ old('image', $post->image) }}" accept="image/jpeg">
                        @if ($errors->has('image')) <p class="errormessage">{{ $errors->first('image') }}</p>
                        @endif
                    </dd>
                </dl>

                <p class="submit"><button type="submit">編集</button></p>
            </form>
        </div>
    </div>
@endsection