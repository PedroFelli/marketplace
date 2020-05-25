@extends('layouts.app')

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Notificações</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-hacker-news mr-1"></i> <a href="{{route('admin.notifications.read.all')}}" class="btn btn-xs btn-success float-lg-right">Marcar todas como lidas</a>
            </div>
            <table class="table table-striped">

                <thead>
                <tr>
                    <th>Notificação</th>
                    <th>Criado em</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse($unreadNotifications as $n)
                    <tr>
                        <td>{{$n->data['message']}}</td>
                        <td>{{$n->created_at->locale('pt')->diffForHumans()}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('admin.notifications.read', ['notification' => $n->id])}}" class="btn btn-sm btn-primary">Marcar como lida</a>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            <div class="alert alert-warning">Nenhuma notificação encontrada!</div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
</main>

@endsection
