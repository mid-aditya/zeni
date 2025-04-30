<?php

namespace App\Http\Controllers\Pelatih;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PelatihController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $activeClasses = $user->classesAsPelatih()
            ->where('is_active', true)
            ->where('end_time', '>', now())
            ->get();
            
        $pastClasses = $user->classesAsPelatih()
            ->where(function($query) {
                $query->where('is_active', false)
                    ->orWhere('end_time', '<=', now());
            })
            ->get();
            
        return view('pelatih.dashboard', compact('activeClasses', 'pastClasses'));
    }

    public function classes()
    {
        return $this->dashboard();
    }
    
    public function createClass()
    {
        return view('pelatih.classes.create');
    }
    
    public function storeClass(Request $request)
    {
        $request->validate([
            'subject' => 'required|in:' . implode(',', ClassModel::SUBJECTS),
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);
        
        $startTime = now();
        $endTime = $startTime->copy()->addDay();
        
        $class = ClassModel::create([
            'subject' => $request->subject,
            'title' => $request->title,
            'description' => $request->description,
            'pelatih_id' => Auth::id(),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'is_active' => true
        ]);
        
        return redirect()->route('pelatih.classes.index')->with('success', 'Kelas berhasil dibuat');
    }
    
    public function showClass(ClassModel $class)
    {
        return view('pelatih.classes.show', compact('class'));
    }
    
    public function editClass(ClassModel $class)
    {
        return view('pelatih.classes.edit', compact('class'));
    }
    
    public function updateClass(Request $request, ClassModel $class)
    {
        $request->validate([
            'subject' => 'required|in:' . implode(',', ClassModel::SUBJECTS),
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);
        
        $class->update($request->all());
        
        return redirect()->route('pelatih.classes.index')->with('success', 'Kelas berhasil diperbarui');
    }
    
    public function destroyClass(ClassModel $class)
    {
        $class->delete();
        return redirect()->route('pelatih.classes.index')->with('success', 'Kelas berhasil dihapus');
    }
    
    public function beriNilai(Request $request, ClassModel $class, User $siswa)
    {
        $request->validate([
            'score' => 'required|integer|min:0|max:100'
        ]);
        
        if ($class->pelatih_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk memberikan nilai pada kelas ini');
        }
        
        $class->participants()->updateExistingPivot($siswa->id, [
            'score' => $request->score
        ]);
        
        return redirect()->back()->with('success', 'Nilai berhasil diberikan');
    }
    
    public function addParticipant(Request $request, ClassModel $class)
    {
        $request->validate([
            'siswa_id' => 'required|exists:users,id'
        ]);
        
        $class->participants()->attach($request->siswa_id);
        
        return redirect()->back()->with('success', 'Peserta berhasil ditambahkan');
    }
    
    public function removeParticipant(ClassModel $class, User $participant)
    {
        $class->participants()->detach($participant->id);
        
        return redirect()->back()->with('success', 'Peserta berhasil dihapus');
    }
} 