<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $this->authorize("admin", User::class);
        $users = User::whereNot('id', auth()->id())->get();
        return view("admin.index", compact('users'));
    }


    public function create(){
        $this->authorize("admin", User::class);

        return view("admin.users.create");
    }


    public function store(Request $request){

        $this->authorize("admin", User::class);
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image' =>  'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = "";
        if($request->hasFile('image')){
            $image = $request->file("image");
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
            "image" => $imageName,
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy(User $user)
    {
        $this->authorize("admin", User::class);

        $user->delete();
        return redirect()->route('dashboard')->with('success', 'User deleted successfully');
    }

    public function blockUser(User $user){
        $this->authorize("admin", User::class);

        $user->update(['is_block' => true]);

        return redirect()->route('dashboard')->with('success', 'User blocked successfully');
    }

    public function unblockUser(User $user){
        $this->authorize("admin", User::class);

        $user->update(['is_block' => false]);
        return redirect()->route('dashboard')->with('success', 'User unblocked successfully');
    }
}

?>
