<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewLeaveApplicationRequest;
use App\Mail\DepartmentMail;
use App\Models\Attachment;
use App\Models\LeaveApplication;
use App\Models\LeaveApproval;
use App\Models\User;
use App\Notifications\ApplicationApprovedNotification;
use App\Notifications\ApplicationRejectedNotification;
use App\Notifications\NewApplicationNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class LeaveApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = LeaveApplication::with('applier', 'leave_type')->paginate(10);
        // return $data;
        $data->transform(function ($item) {
            $days = Carbon::parse($item->start_date)->diffInDaysFiltered(function (Carbon $date) {
                return !$date->isWeekend();
            }, Carbon::parse($item->end_date));
            $item->duration = $days+1;
            return $item;
        });
        return view('pages.leave', $data);
    }

    // public function store(Request $request)
    public function store(NewLeaveApplicationRequest $request)
    {

        // Mail::queue(new DepartmentMail(Auth::user(), $application));



        // $fileName = auth()->id() . '_' . time() . '.' . $request->file->extension();

        // $type = $request->file->getClientMimeType();
        // $size = $request->file->getSize();


        // $file_path = $request->file->move(public_path('file'), $fileName);

        // return $file_path;
        // dd($request->all());
        $application = new LeaveApplication();

        $application->take_charge   = $request['take_charge'];
        $application->information   = $request['information'];
        $application->department   = $request['department'];
        $application->applier_user_id = Auth::id();
        $application->start_date    = $request['start_date'];
        $application->end_date      = $request['end_date'];
        $application->leave_type_id = $request['leave_type'];

        $application->save();

        if ($request['department'] == 1) {
            $email = 'business@mftfulfillmentcentre.com';
        } elseif ($request['department'] == 2) {
            $email = 'operationske@mftfulfillmentcentre.com';
        } elseif ($request['department'] == 3) {
            $email = 'vincent.aluoch@speedballcourier.com';
        } elseif ($request['department'] == 4) {
            $email = 'vincent.aluoch@speedballcourier.com';
            // $email = 'warehouseke@mftfulfillmentcentre.com';
        } elseif ($request['department'] == 5) {
            $email = 'finance@mftfulfillmentcentre.com';
        } elseif ($request['department'] == 6) {
            $email = 'support@mftfulfillmentcentre.com';
        } elseif ($request['department'] == 7) {
            $email = 'support@mftfulfillmentcentre.com';
        } elseif ($request['department'] == 8) {
            $email = 'csm@komfy-shop.com';
        }
        if ($request->has('file')) {
            $file = new Attachment();
            $file_path = Storage::disk('public')->put('files', $request->file);
            $file->path = '/storage/' . $file_path;
            $file->user_id = Auth::id();
            $file->leave_id = $application->id;
            $file->save();
        }


        $user = User::where('email', $email)->first();
        // $application = LeaveApplication::with('applier', 'leave_type')->first();

        $url = env('APP_URL') . '/department/' . $application->id;
        $user_info = Auth::user();
        Mail::to($user)->send(new DepartmentMail($user_info, $application, $url));
        // $users = User::where('email', $email)->get();

        // Mail::send(new DepartmentMail($users, Auth::user(), $application));
        // $users = User::role(['admin'])->orWhere('email', $email)->get();

        // Notification::send($users, new NewApplicationNotification($application));

        Session::Flash('success', 'Application Submitted Successfully.');
        return redirect()->route('homeView');
    }

    public function update(Request $request, LeaveApplication $application)
    {
        $application->remarks = $request['remarks'];
        $application->authorizer_user_id = Auth::id();

        if ($request->has('approved')) {
            $application->approval_level = 3;
            $application->status = 'approved';
        } else {
            $application->status = 'rejected';
        }
        $application->save();

        $applier = User::findOrFail($application->applier_user_id);
        if ($request->has('approved')) {
            // if ($request->has('approved') && Auth::user()->hasRole('admin')) {
            $users = User::role(['Hr'])->get();
            Notification::send($users, new ApplicationApprovedNotification($application));
            Notification::send($applier, new ApplicationApprovedNotification($application));
        } else {
            Notification::send($applier, new ApplicationRejectedNotification($application));
        }

        return redirect()->back();
    }

    public function department($id, $status)
    {
        $application = LeaveApplication::find($id);
        if ((Auth::user()->hasRole('department head') || Auth::user()->hasRole('admin') )&& $application->approval_level < 1) {
            if ($status == 'rejected') {
                return redirect('action');
                // $this->update(new Request($status), $application);
                // return 'Leave rejected';
            }

            $application->status = 'Waiting HR Approval';
            $application->approval_level = 1;
            $application->save();
            $user_info = User::find($application->applier_user_id);
            $user = User::where('email', 'hrm@mftfulfillmentcentre.com')->first();
            $url = env('APP_URL') . '/hrm/' . $application->id;
            Mail::to($user)->send(new DepartmentMail($user_info, $application, $url));

            $approvals = new LeaveApproval();
            $approvals->user_id = Auth::id();
            $approvals->leave_application_id = $id;
            $approvals->status = $status;
            $approvals->save();
            return 'Leave approved';
        } else {
            abort(403);
        }
    }

    public function hrm($id, $status)
    {
        // dd(1);
        $application = LeaveApplication::find($id);
        // dd(Auth::user()->email != 'hrm@mftfulfillmentcentre.com', $application->approval_level > 1);
        if (Auth::user()->email != 'hrm@mftfulfillmentcentre.com'  || $application->approval_level > 1) {
            abort(403);
        }

        if ($status == 'rejected') {
                return redirect('action');
            // $this->update(new Request($status), $application);
            // return 'Leave rejected';
        }

        $application->status = 'Waiting final Approval';
        $application->approval_level = 2;
        $application->save();
        $users = User::role(['admin'])->get();
        Notification::send($users, new NewApplicationNotification($application));
        return 'Leave approved';
    }

    public function admin()
    {

    }
}
