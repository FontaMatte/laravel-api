<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Project;

class ProjectController extends Controller
{
    public function index() 
    {
        $projectPerPage = 12;
        
        // gestisco dinamicamente tramite input qiuanti risulati voglio vedere per pagina
        // N.B. meglio aggiungere un controllo sull'input

        if (request()->input('per_page')) {
            $projectPerPage = request()->input('per_page');
        }

        $projects = Project::with('type','technologies')->paginate($projectPerPage);

        foreach ($projects as $project) {
            if ($project->img) {
                $project->img = asset('storage/' .$project->img);
            }
        }
        
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Ok',
            'projects' => $projects
        ]);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Ok',
            'project' => $project
        ]);
    }
}
