@extends('layouts.app')

@section('content')
<table class="table table-striped">
    <a href="{{route('admin.stores.create')}}" class="btn btn-lg btn-success">Criar loja</a>
    <thead>
        <tr>
            <th>#</th>
            <th>Loja</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stores as $store)
            <tr>
                <td>{{$store->id}}</td>
                <td>{{$store->name}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('admin.stores.edit', [$store->id])}}" class="btn btn-sm btn-primary">EDITAR</a>
                        <form action="{{route('admin.stores.destroy', [$store->id])}}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-sm btn-danger">REMOVER</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{$stores->links()}}
@endsection
