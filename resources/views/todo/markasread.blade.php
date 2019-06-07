I ran into this problem and solved it like this:

//url in blade:
<a href="{{url('notifications/'.$notification->id)}}">mark as read</a>

// in the routes:
Route::get('/notifications/{id}','NotificationController@delete');

and I made a controller named NotificationController which has a delete function:

class NotificationController extends Controller
{

    /**
     * delete a specific notification
     *
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $user = \Auth::user();
        $notification = $user->notifications()->where('id',$id)->first();
        if ($notification)
        {
            $notification->delete();
            return back();
        }
        else
            return back()->withErrors('we could not found the specified notification');
    }
}

Instead of

        $user = \Auth::user();
        $notification = $user->notifications()->where('id',$id)->first();
        if ($notification)
        {
            $notification->delete();
            return back();
        }
        else
            return back()->withErrors('we could not found the specified notification');

you can use this (5.3)

$notification = Auth::user()->notifications()->findOrFail($id);
$notification->delete();
return back();