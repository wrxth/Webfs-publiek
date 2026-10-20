<?php

namespace App\Http\Controllers\Tablet;

use App\Http\Controllers\Controller;
use App\Models\HelpRequest;
use App\Models\TableSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HelpRequestController extends Controller
{
    public function store(Request $request, TableSession $tableSession): RedirectResponse
    {
        $tableSession->helpRequests()->create($request->validate(['message' => ['nullable', 'string', 'max:500']]));
        return back()->with('success', 'Er komt zo iemand naar je tafel.');
    }

    public function update(HelpRequest $helpRequest): RedirectResponse
    {
        $helpRequest->update(['status' => 'handled', 'handled_at' => now()]);
        return back()->with('success', 'Hulpvraag afgehandeld.');
    }
}
