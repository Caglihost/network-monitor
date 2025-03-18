@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails pour le hostname : {{ $hostname }}</h1>

    @if($scanResults->isEmpty())
        <p>Aucun enregistrement trouvé pour ce hostname.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>IP</th>
                    <th>Status</th>
                    <th>Ports ouverts</th>
                    <th>Détail</th>
                </tr>
            </thead>
            <tbody>
            @foreach($scanResults as $result)
                <tr>
                    <td>{{ $result->ip }}</td>
                    <td>{{ $result->status }}</td>
                    <td>{{ $result->open_ports }}</td>
                    <td>
                        <a href="{{ route('scan_results.show', $result->id) }}">Voir détail</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('scan_results.index') }}">Revenir à la liste des hostnames</a>
</div>
@endsection

