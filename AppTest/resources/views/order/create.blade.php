@extends('layouts.app')

@section('content')


    <form method="POST" enctype="multipart/form-data" action="{{route('order.store')}}">
    @csrf
        @if($error??false)
            <span><strong>{{ $error }}</strong></span>
        @endif
        <input name="full-name" placeholder="ФИО" required value="{{old('full-name')}}">
        @error('full-name')<span><strong>{{ $message }}</strong></span>@enderror
        <input name="article" placeholder="Артикул" value="{{old('article')}}">
        @error('article')<span><strong>{{ $message }}</strong></span>@enderror
        <input name="brand" placeholder="Бренд" value="{{old('brand')}}">
        @error('brand')<span><strong>{{ $message }}</strong></span>@enderror
        <textarea name="comment" placeholder="Комментарий" >
            {{old('comment')}}
        </textarea>
        @error('comment')<span><strong>{{ $message }}</strong></span>@enderror

        <button type="submit">Создать заказ</button>
    </form>

@endsection
