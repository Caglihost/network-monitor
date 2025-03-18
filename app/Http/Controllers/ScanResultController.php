<?php

namespace App\Http\Controllers;

use App\Models\ScanResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScanResultController extends Controller
{
    //Affiche la liste des hosts (hostname).
    //Ici, on liste toutes les entrées de la table.
    public function index()
{
    // Récupère la liste des hostnames distincts
    // On peut utiliser select + distinct :
    $distinctHostnames = ScanResult::select('hostname')->distinct()->get();

    // Passez-les ensuite à la vue
    return view('scan_results.index', compact('distinctHostnames'));
}
    
public function showByHostname($hostname)
{
    // Récupère tous les scans pour ce hostname, du plus récent au plus ancien
    $all = ScanResult::where('hostname', $hostname)
        ->orderBy('scan_time', 'desc')  // ou orderBy('id','desc')
        ->get();
    
    // Ne garder qu’une seule occurrence par IP.
    // "unique('ip')" va parcourir la collection et ne garder que la première occurrence de chaque IP.
    // Comme on a trié en 'desc', la "première occurrence" sera la plus récente pour chaque IP.
    $uniqueByIp = $all->unique('ip');

    $uniqueByIp = $uniqueByIp->values();

    return view('scan_results.show_by_hostname', [
        'scanResults' => $uniqueByIp,
        'hostname'    => $hostname,
    ]);
}

    /**
     * Affiche le détail d'un host donné (via son ID).
     */
    public function show($id)
{
    $scanResult = ScanResult::findOrFail($id);

    // Récupérer tous les scans de la même IP
    $relatedResults = ScanResult::where('ip', $scanResult->ip)
        ->orderBy('scan_time', 'desc')
        ->get();

    // Calculer combien de fois c’est up/down (ou tout autre statut)
    $statusCounts = ScanResult::select('status', DB::raw('count(*) as total'))
        ->where('ip', $scanResult->ip)
        ->groupBy('status')
        ->pluck('total','status');
    // $statusCounts est un tableau associatif, ex: ['up' => 5, 'down' => 2, ...]

    return view('scan_results.show', compact('scanResult', 'relatedResults', 'statusCounts'));
}

}
