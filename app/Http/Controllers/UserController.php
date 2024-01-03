<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use stdClass;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    //register
    public function registration(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:250',
            'email' => 'required|email|max:250',
            'password' => 'required|min:4|confirmed'
            // 'password' => 'required|min:4'
        ]);
        $data = $request->all();
        // return response()->json(['data' => [
        //     'name' => $data['username'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     'roleId' => 4,
        // ]], 200);

        $user = new User([
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roleId' => 4,
        ]);

        $log = new Log();
        $log->task="Creating new user " . $user->name. ' with email: '.$user->email;
        $status = false;
        $user->api=json_encode([
            'name'=>$data['username'],
            'roleId'=>4,
            'email'=>$data['email'],
            'password'=>$user->password,
            'bare password'=>$data['password'],
        ]);

        try {
            // $user->save();
            $status = true;
            $log->status = $status ? 'Success!' : 'Failed!';
            $log->detail = json_encode($user->api);
            // $log->save();
        } catch (\Throwable $th) {
            $log->status = $status ? 'Success!' : 'Failed!';
            // $log->save();
            return response()->json(['message' => 'Registration Failed!'], 404);
        }

        // $credentials = $request->only('email', 'password');
        // Auth::attempt($credentials);
        $request->session()->regenerate();
        return response()->json([
            'id1'=>$user->roleId,'id2'=>$user->id, 'isApproved'=>true,
            'user'=> ['name'=>$user->name, ],
            'role'=>['role'=>$user->roleId,'userId'=>$user->id],
            'accessToken' => 'this is new token'],200);
    }

    public function roleConfirmation(Request $req){
        $roleId=$req->all('id1');
        $userId=$req->all('id2');
        $user=User::withoutTrashed()->where('id',$userId)->first();
        $user->roleId=$roleId;
        $user->api=json_encode([
            'roleId'=>$roleId,
        ]);
        $user->save();
        $log = new Log();
        $log->task='User '.$user->name.' now is '.Role::withoutTrashed()->where('id',$roleId)->first()->name;
        $log->status='Success!';
        $log->detail=json_encode($user->api);
        $log->save();
    }

    public function profile(Request $req){
        $name=$req->all('name');
        $t=User::withoutTrashed()->where('name',$name)->first();
        $role=Role::withoutTrashed()->where('id',$t->roleId)->first();
        if ($t) {
            return response()->json(['user'=>['name' => $t->name, 'email' => $t->email, 'role'=>$role->name]],200);
        }
        return response()->json("Something wrong with database!",404);
    }


    //login
    
    public function login(Request $request)
    {
        $data = $request->all();
        // return response()->json(['1'=>gettype($request), '2'=>1], 200);
        $user = User::withoutTrashed()->where('email', $data['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'Abnormal Data Occurred!', 'isApproved' => false], 404);
        }

        if (Hash::check($data['password'], $user->password)) {
            $role=Role::withoutTrashed()->where('id', $user->roleId)->first()->name;
            return response()->json(['message' => 'Successful!', 
                'isApproved' => true, 'user'=>[
                'name'=>$user->name, 'role'=>$role ],
                'accessToken' => 'this is new token'
            ], 200);
        }

        return response()->json(['message' => 'Invalid Login!', 'isApproved' => false], 404);
    }


    public function authenticate(Request $req) {
        $credentials=$req->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();
            if ($req->wantsJson()) {
                return response()->json(['isApproved'=>true,200]);
            }
            return redirect()->intended('/dashboard');
        }
        if ($req->wantsJson()) {
            return response()->json(['isApproved'=>false,404]);
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
    public function destroy(string $id)
    {
        //
    }
}
