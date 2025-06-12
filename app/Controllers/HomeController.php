<?php
namespace App\Controllers;

use App\Core\Controller\Controller;
use App\Core\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the welcome page
     * 
     * @param \App\Core\Http\Request $request
     * @return \App\Core\Http\Response
     */
    public function index(Request $request)
    {
        return $this->view('welcome', [
            'title' => 'Welcome to Your PHP Framework',
            'message' => 'This is a Laravel-like framework built with core PHP.',
        ]);
    }
    
    /**
     * Show the about page
     * 
     * @param \App\Core\Http\Request $request
     * @return \App\Core\Http\Response
     */
    public function about(Request $request)
    {
        return $this->view('about', [
            'title' => 'About Us',
            'content' => 'This is a custom PHP framework built with core PHP.',
            'features' => [
                'MVC Architecture',
                'Routing System',
                'Dependency Injection',
                'View Rendering'
            ]
        ]);
    }

        public function team(Request $request)
    {
        return $this->view('team', [
            'title' => 'Our Team',
            'team' => [
                ['name' => 'John Doe', 'position' => 'CEO'],
                ['name' => 'Jane Smith', 'position' => 'CTO'],
                ['name' => 'Mike Johnson', 'position' => 'Developer']
            ]
        ]);
    }
}
