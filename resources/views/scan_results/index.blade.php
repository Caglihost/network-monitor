@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des hostnames scannés</h1>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Hostname</th>
                    <th>Voir détail</th>
                </tr>
            </thead>
            <tbody>
            @forelse($distinctHostnames as $item)
                <tr>
                    <td>{{ $item->hostname }}</td>
                    <td>
                        <!-- Lien pour voir toutes les IP relatives à ce hostname avec showByHostname() -->
                        <a href="{{ route('scan_results.showByHostname', $item->hostname) }}">
                            Voir détail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Aucun hostname trouvé.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

