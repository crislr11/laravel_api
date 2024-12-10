@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="dashboard">
            <div class="dashboard__card">
                <div class="dashboard__body">
                    <h1 class="dashboard__title">Usuarios Desactivados</h1>

                    @if (session('status'))
                        <div class="dashboard__status">{{ session('status') }}</div>
                    @endif

                    <table class="dashboard__table">
                        <thead class="dashboard__table-header">
                            <tr>
                                <th class="dashboard__table-heading dashboard__table-heading--name">Nombre</th>
                                <th class="dashboard__table-heading dashboard__table-heading--email">Email</th>
                                <th class="dashboard__table-heading dashboard__table-heading--acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="dashboard__table-body">
                            @foreach($users as $user)
                                <tr class="dashboard__table-row">
                                    <td class="dashboard__table-cell">
                                        <span>{{ $user->name }}</span>
                                        <br>
                                        <small>Estado: {{ $user->actived ? 'Activado' : 'Desactivado' }}</small>
                                    </td>
                                    <td class="dashboard__table-cell">
                                        <span>{{ $user->email }}</span>
                                    </td>
                                    <td class="dashboard__table-cell">
                                        @if($user->actived)
                                            <form action="{{ route('users.deactivate', $user->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="button button--warning">Desactivar</button>
                                            </form>
                                        @else
                                            <form action="{{route('users.activate', $user->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="button button--success">Activar</button>
                                            </form>
                                        @endif

                                        <a href="{{ route('profile.edit', $user->id) }}"
                                            class="button button--primary">Editar</a>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button button--danger">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection