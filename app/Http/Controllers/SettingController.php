<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Setting;

class SettingController extends Controller
{
    private function GetIsAdmin()
    {
        return Auth::id() && Auth::user()->usertype == "1" ? true : false;
    }

    public function edit()
    {
        $user = Auth::id() ? Auth::user() : null;
        $isAdmin = $this->GetIsAdmin();
        $siteName = Setting::where('key', 'site_name')->value('value');
        $siteLogo = Setting::where('key', 'site_logo')->value('value');
        return view('admin.pages.settings.edit', compact('user', 'isAdmin', 'siteName', 'siteLogo'));
    }

    public function update(Request $request)
    {
        $isAdmin = $this->GetIsAdmin();
        if ($isAdmin) {
            Setting::updateOrCreate(
                ['key' => 'site_name'],
                ['value' => $request->sitename]
            );

            if ($request->hasFile('sitelogo')) {
                $image = $request->file('sitelogo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'assets/images/logo';
                $image->move($imagePath, $imageName);

                Setting::updateOrCreate(
                    ['key' => 'site_logo'],
                    ['value' => $imagePath . '/' . $imageName]
                );
            }

            return redirect()->route('settings.edit')->with('msg', 'Site settings updated');
        }
        return redirect()->route('settings.edit')->with('msg', "Can't update site settings");
    }
}
