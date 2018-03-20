<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Storage;

/**
 * Class GroupAvatarController.
 * 
 * @package App\Http\Controllers
 */
class GroupAvatarController extends Controller
{
    /**
     * Show group avatar.
     *
     * @param Group $group
     * @return mixed
     */
    public function show(Group $group)
    {
        if ($group->avatar) {
            return response()->file(Storage::disk('local')->path($group->avatar));
        }
        dd('adsdsa');
        redirect('img/groupPlaceholder.jpg');
    }

    /**
     * Store.
     *
     * @param Request $request
     * @return false|string
     */
    public function store(Request $request, Group $group)
    {
        Storage::delete($group->avatar);
        $group->avatar = $request->avatar->storeAs('avatars', $this->avatarFileName($group, $request->avatar));
        $group->update();
        return $group;
    }

    /**
     * Get avatar file name.
     *
     * @param $group
     * @param $file
     * @return string
     */
    protected function avatarFileName($group, $file)
    {
        return $group->id . '_' . snake_case($group->name) . '.' . pathinfo($file->name, PATHINFO_EXTENSION);
    }
}
