<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingUsers = User::where('status', 'pending')->get();
        $approvedUsers = User::where('status', 'approved')->get();
        return view('admin.dashboard', compact('pendingUsers', 'approvedUsers'));
    }
} 