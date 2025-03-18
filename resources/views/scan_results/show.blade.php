@extends('layouts.app')

@section('content')
    <div class="container">
        <p><strong>Hostname :</strong> {{ $scanResult->hostname }}</p>
        <p><strong>IP :</strong> {{ $scanResult->ip }}</p>
        <p><strong>Status :</strong> {{ $scanResult->status }}</p>
        <p><strong>Ports ouverts :</strong> {{ $scanResult->open_ports }}</p>

        <!-- Graphique de la disponibilité (up vs down) -->
        <h2>Disponibilité</h2>
        <canvas id="availabilityChart"></canvas>

        <h2>Historique des scans (IP : {{ $scanResult->ip }})</h2>

        @if($relatedResults->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hostname</th>
                        <th>Status</th>
                        <th>Ports</th>
                        <th>Créé le</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($relatedResults as $res)
                        <tr>
                            <td>{{ $res->id }}</td>
                            <td>{{ $res->hostname }}</td>
                            <td>{{ $res->status }}</td>
                            <td>{{ $res->open_ports }}</td>
                            <td>{{ $res->scan_time }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Aucun enregistrement trouvé pour cette IP.</p>
        @endif

        <!-- Bouton retour -->
        <a href="javascript:history.back()">Revenir</a>
    </div>

    @push('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('availabilityChart').getContext('2d');

            // On récupère les data depuis nos variables Blade (statusCounts)
            let statusCounts = @json($statusCounts); 

            let labels = Object.keys(statusCounts);    // ["up", "down"]
            let data   = Object.values(statusCounts);  // [5, 2]

            // schéma graphique en "tarte"
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Nombre de scans',
                        data: data,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.6)', // up
                            'rgba(255, 99, 132, 0.6)', // down
                            // plus de couleurs si plus de statuts
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
        </script>
    @endpush
@endsection


