<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{CvTemplate, Resume};

class TemplateController extends Controller
{
    public function index()
    {
        $templates = CvTemplate::where('is_active', true)->latest()->get();

        return view('pages.templates', compact('templates'));
    }

    public function detail($slug)
    {
        $template = CvTemplate::where('slug', $slug)->first();

        if (!$template || !$template->is_active) {
            abort(404);
        }

        return view('pages.resume.template-detail', compact('template'));
    }

    public function resume()
    {
        $templates = CvTemplate::where('is_active', true)->first();
        $resumes = Resume::where('cv_template_id', $templates->id)->get();

        return view('pages.resume.templates', compact('resumes'));
    }

    public function resumePost()
    {
        //
    }

    public function editor()
    {
        $template = CvTemplate::where('is_active', true)->latest()->first();

        return view('pages.resume.editor', compact('template'));
    }



}
