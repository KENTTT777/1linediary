@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="create_link">
            <a href="{{ url('/posts') }}"><span>一覧に戻る</span></a>
        </div>

        <div class="create_box">
            <h2 class="title mb-4">新規投稿</h2>

            <form action="{{ url('/posts') }}" method="post" enctype="multipart/form-data" name="createform" id="create" class="form-area">
                @csrf
                <dl>
                    <dt>
                        <span class="required">必須</span>
                        <span >日付</span>
                    </dt>
                    <dd class="postdate">
                        <label for="year">
                            <select name="year" id="year" required>
                                @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </label>

                        <label for="month">
                            <select name="month" id="month" required>
                                @for($j = 1; $j <= 12; $j++)
                                    @if(date('m') == $j) <option value="{{ $j }}" selected>{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}</option>
                                    @else <option value="{{ $j }}">{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endif
                                @endfor
                            </select>
                        </label>

                        <label for="day">
                            <select name="day" id="day" required>
                                @for($k = 1; $k <= 31; $k++)
                                    @if(date('d') == $k) <option value="{{ $k }}" selected>{{ str_pad($k, 2, '0', STR_PAD_LEFT) }}</option> 
                                    @else <option value="{{ $k }}">{{ str_pad($k, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endif
                                @endfor
                            </select>
                        </label>
                        @if ($errors->has('year'))
                            <p class="errormessage">{{ $errors->first('year') }}</p>
                        @endif
                        @if ($errors->has('month'))
                            <p class="errormessage">{{ $errors->first('month') }}</p>
                        @endif
                        @if ($errors->has('day'))
                            <p class="errormessage">{{ $errors->first('day') }}</p>
                        @endif
                    </dd>

                    <dt>
                        <span class="required">必須</span>
                        <span for="body">内容</span>
                    </dt>
                    <dd>
                        <textarea name="body" id="body" rows="3" maxlength="200"  placeholder="200文字まで入力可能です" required></textarea>
                        <div class="wordcount">
                            <p>文字数:<span class="length">0</span>/200</p>
                        </div>
                        @if ($errors->has('body'))
                            <p class="errormessage">{{ $errors->first('body') }}</p>
                        @endif
                    </dd>

                    <dt>
                        <span class="any">任意</span>
                        <span for="image">イメージ画像</span>
                    </dt>
                    <dd>
                        <input type="file" name="image" id="image" accept="image/jpeg">
                        @if ($errors->has('image'))
                            <p class="errormessage">{{ $errors->first('image') }}</p>
                        @endif
                    </dd>
                </dl>

                <p class="submit"><button type="submit">投稿</button></p>
            </form>
        </div>
    </div>
@endsection