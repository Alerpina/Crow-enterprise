<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
    parent::__construct();
  }

  public function count()
  {
    $count = Notification::notRead()->count();
    return response()->json($count);
  }

  public function show()
  {
    $notifications = Notification::orderBy('created_at', 'DESC')->get();

    return view('admin.notification.popup', compact('notifications'));
  }

  public function markAllAsRead()
  {
    Notification::notRead()->update(['is_read' => 1]);
  }

  public function clear($notification_id)
  {
    Notification::find($notification_id)->delete();
  }
}
