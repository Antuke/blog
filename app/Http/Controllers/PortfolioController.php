<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;


class PortfolioController extends Controller
{
    public function index()
    {
        $commenter_id = session('commenter_id');
        $projects = Project::with(['authors', 'comments.commenter'])->get();
        return view('project_showcase', ['projects' => $projects, 'commenter_id' => $commenter_id ?? null]);
    }


}
