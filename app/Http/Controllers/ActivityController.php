<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->paginate(6);

        return view('Front-end.actualite.list_actualite', compact('activities'));
    }

    public function show(Activity $activity)
    {
        return view('Front-end.actualite.actualite', compact('activity'));
    }
}
