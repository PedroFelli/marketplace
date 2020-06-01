@extends('layouts.app')


@section('content')
    <h1 class="mt-4">Criar Produto</h1>
    <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nome Produto</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">

            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}">

            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Conteúdo</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{old('body')}}</textarea>

            @error('body')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>


        <div class="form-group">
            <label>Preço</label>
            <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">

            @error('price')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-form-group">
            <label for="">Tamanho</label>
            <select name="sizes[]" id="" class="form-control" multiple>
                @foreach($sizes as $size)
                    <option value="{{$size->id}}">{{$size->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-form-group">
            <label for="">Cor</label>
            <select name="colors[]" id="" class="form-control" multiple>
                @foreach($colors as $color)
                    <option value="{{$color->id}}">{{$color->name}}</option>
                @endforeach
            </select>
            @error('colors')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-form-group">
            <label for="">Categorias</label>
            <select name="categories[]" id="" class="form-control" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Fotos do Produto</label>
            <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>
            @error('photos.*')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>



        <div>
            <button type="submit" class="btn btn-lg btn-success">Criar Produto</button>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
    <script>
        $('#price').maskMoney({prefix: '', allowNegative: false, thousands: '.', decimal: ','});
    </script>
@endsection
