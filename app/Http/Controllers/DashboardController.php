<?php

namespace App\Http\Controllers;

use App\Http\Resources\SiteResource;
use App\Models\Site;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke(Request $request, Site $site)
    {
        $site->update([
            'default' => 1
        ]);

        if (!$site->exists) {
            $site = auth()
                ->user()
                ->sites()
                ->whereDefault(1)
                ->first() ?? $request->user()->sites()->first();
        }

        return Inertia::render('Dashboard', [
            'site' => SiteResource::make($site),
            'sites' => SiteResource::collection(Site::get())
        ]);
    }
}
