<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    // public function recordView(string $id, Request $request)
    // {
    //     $apartment = Apartment::with('user', 'services')->find($id);
    //     if (!$apartment) return response(null, 404);

    //     $code_ip = $request->getClientIp();
    //     $apartment_views_hour = $apartment->views->where('code_ip', $code_ip)->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 hour')))->count();

    //     if ($apartment_views_hour === 0) {
    //         // Insert View
    //         $view = new View();
    //         $view->code_ip = $request->getClientIp();
    //         $view->apartment_id = $id;
    //         $view->save();
    //     }

    //     return response()->json($apartment);
    // }
}
