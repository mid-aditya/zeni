<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        
        $availableClasses = ClassModel::where('is_active', true)
            ->where('end_time', '>', now())
            ->whereDoesntHave('participants', function($query) use ($user) {
                $query->where('siswa_id', $user->id);
            })
            ->get();
            
        $joinedClasses = $user->classesAsSiswa()
            ->where('is_active', true)
            ->where('end_time', '>', now())
            ->get();
            
        $pastClasses = $user->classesAsSiswa()
            ->where(function($query) {
                $query->where('is_active', false)
                    ->orWhere('end_time', '<=', now());
            })
            ->orderBy('end_time', 'desc')
            ->paginate(5);
            
        return view('siswa.dashboard', compact('availableClasses', 'joinedClasses', 'pastClasses'));
    }
    
    public function joinClass($classId)
    {
        $class = ClassModel::findOrFail($classId);
        
        if (!$class->isActive()) {
            return redirect()->back()->with('error', 'Kelas ini sudah tidak aktif');
        }
        
        if ($class->participants()->where('siswa_id', Auth::id())->exists()) {
            return redirect()->back()->with('error', 'Anda sudah bergabung dengan kelas ini');
        }
        
        $class->participants()->attach(Auth::id());
        
        return redirect()->back()->with('success', 'Berhasil bergabung dengan kelas');
    }
    
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id()
        ]);
        
        $user = Auth::user();
        $user->email = $request->email;
        $user->save();
        
        return redirect()->back()->with('success', 'Email berhasil diperbarui');
    }
} 