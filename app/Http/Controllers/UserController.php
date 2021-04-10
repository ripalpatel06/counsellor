<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonalInformationRequest;
use App\PersonalInformation;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('hasPersonalInformation', [
            'only' => [
                'index',
            ]
        ]);

        $this->middleware('hasNoPersonalInformation', [
            'only' => [
                'create'
            ]
        ]);
    }

    public function index()
    {
        return view('user.index', [
            'model' => Auth::user()
        ]);
    }

    public function create()
    {
        return view('user.create', [
            'model' => Auth::user()
        ]);
    }

    public function update()
    {
        return view('user.update', [
            'model' => Auth::user()
        ]);
    }

    public function store(CreatePersonalInformationRequest $request)
    {
        $model = Auth::user();
        $model->update($request->all());

        return redirect()
            ->action('UserController@index');
    }
}
