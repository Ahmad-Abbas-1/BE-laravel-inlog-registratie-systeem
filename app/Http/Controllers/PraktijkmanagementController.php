<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PraktijkmanagementController extends Controller
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Praktijkmanagement.index', [
            'title' => 'Praktijkmanagement Home'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userId)
    {

        $result = $this->userModel->sp_DeleteUser($userId);

        if ($result > 0) {
            return redirect()->route('praktijkmanagement.userroles')
                             ->with('success', 'User is succesvol verwijdert');
        }

        return redirect()->route('praktijkmanagement.userroles')
                             ->with('error', 'User is niet verwijdert');
    }

        public function manageUserroles()
    {
        // Het Id dat we meegeven wordt niet meegenomen in de select. Alle andere gebruikers wel.
        $users = $this->userModel->sp_GetAllUsers(Auth::id());

        // var_dump($users);

        // De return waarde voor de view
        return view('Praktijkmanagement.userroles', [
            'title' => 'Gebruikersrollen',
            'users' => $users
        ]);
    }
}