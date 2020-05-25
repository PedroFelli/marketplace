@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid">
            <br>
            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-table mr-1"></i>Tabela produtos</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Ações</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($products as $p)
                                <tr>
                                    <td>{{$p->id}}</td>
                                    <td>{{$p->name}}</td>
                                    <td>R${{number_format($p->price, 2, ',','.')}}</td>

                                    <td style="text-align-last: center;">
                                        <div class="btn-group">
                                            <a href="{{route('admin.products.edit', ['product' => $p->id])}}"
                                               class="" style="margin-right: 5px;">
                                                <button class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </a>

                                            <form action="{{route('admin.products.destroy', ['product' => $p->id])}}" method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
