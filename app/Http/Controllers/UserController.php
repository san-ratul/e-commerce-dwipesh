<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Reason;
class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminIndex()
    {
        return view('admin.index');
    }
    public function sellerIndex()
    {
        return view('seller.index');
    }
    public function sellerInactive()
    {
        return view('seller.inactive');
    }
    public function sellerRegister()
    {
        return view('auth.sellerRegistration');
    }
    public function allSeller()
    {
        $users = User::where('is_seller',true)->get();
        return view('admin.seller.activeSeller',compact('users'));
    }
    public function allInactiveSeller()
    {
        $users = User::where('is_seller',false)->get();
        return view('admin.seller.inactiveSeller',compact('users'));
    }
    protected function activeSeller(User $user){
        $user->is_seller = true;
        $user->save();
        return redirect()->route('activeseller.list')->with('status','Seller Activated Successfully');
    }
    protected function deactiveSeller(Request $request, User $user){
        $this->validate($request,[
            'reason' => 'required',
        ]);
        Reason::create([
            'reason' => $request->reason,
            'user_id' => $user->id
        ]);
        $user->is_seller = false;
        $user->save();
        return redirect()->route('activeseller.list')->with('status','Seller Deactive Successfully');
    }
    public function adminProfile(User $user)
    {

       return view('admin.profile.profile',compact('user'));
    }
    public function editAdmin(User $user){
        return view('admin.profile.updateProfile',compact('user'));
    }
    protected function updateAdmin(Request $request, User $user)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'password' => [ 'string', 'max:255','nullable'],
            'phone' => ['required', 'max:255'],
        ]);
       $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
        ]);
        if($request->password != null){
            $user->password = Hash::make($request['password']);
            $user->save();
        }

        return redirect()->route('admin.profile',$user->id)->with('status','admin Updated successfully!');
    }
    public function allSellerLIst()
    {
        $users = User::where('is_seller',true)->get();
        return view('admin.seller.sellerList',compact('users'));
    }
    public function sellerProfile(User $user)
    {

       return view('seller.profile.sellerProfile',compact('user'));
    }
    public function editSeller(User $user){
        return view('seller.profile.updateProfile',compact('user'));
    }
    protected function updateSeller(Request $request, User $user)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'password' => [ 'string', 'max:255','nullable'],
            'phone' => ['required', 'max:255'],
        ]);
       $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
        ]);
        if($request->password != null){
            $user->password = Hash::make($request['password']);
            $user->save();
        }

        return redirect()->route('seller.profile',$user->id)->with('status','Seller Updated successfully!');
    }
    
}
