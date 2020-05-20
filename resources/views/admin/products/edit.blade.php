@extends('layouts.app')

@section('content')
    <h1>Atualizar produto Produto</h1>
    <form action="{{route('admin.products.update', ['product' => $product->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")


        <div class="form-group">
            <label>Produto</label>
            <input type="text" name="name" class="form-control" value="{{$product->name}}">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description"  class="form-control" value="{{$product->description}}">
        </div>

        <div class="form-group">
            <label>Conteúdo</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control" >{{$product->body}}</textarea>
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input type="text" name="price" id="price"   class="form-control" value="{{$product->price}}">
        </div>

        <div class="form-form-group">
            <label for="">Categorias</label>
            <select name="categories[]" id="" class="form-control" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}"
                            @if($product->categories->contains($category))
                            selected @endif>{{$category->name}}</option>
                    {{$categories}}
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
            <button type="submit" class="btn btn-lg btn-success">Atualizar Produto</button>
        </div>

        <button class="btn btn-lg btn-sucess"></button>
    </form>

    <hr>
    <div class="row">
        @foreach($product->photos as $photo)
            <div class="col-4 text-center">
                <img src="{{asset('storage/'. $photo->image)}}" alt="" class="img-fluid">
                <form action="{{route('admin.photo.remove', ['photoName' => $photo->image])}}" method="post">
                    @csrf
                    <input type="text" name="photoName" value="{{$photo->name}}" hidden>
                    <button type="submit" class="btn btn-xs btn-danger">Remover</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
@section('scripts')
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
<script>
    // $('#price').maskMoney({prefix: '', allowNegative: false, thousands: '.', decimal: ','});
</script>
@endsection
