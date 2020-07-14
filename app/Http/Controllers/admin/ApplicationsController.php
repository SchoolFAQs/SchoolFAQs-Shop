<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use App\Models\Apply;
use Carbon\Carbon;
use App\User;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $applications = Apply::orderBy('created_at', 'desc')->orderBy('is_approve', 'asc')->paginate(10);
        return view('admin.application.application_index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $application = Apply::find($id);                                         
        return view('admin.application.application_show', compact('application'));
    }

    public function view_id($id)
    {
            $application = Apply::find($id);
        // Fetch ID CARD
            $myIDCARD = storage_path("app/public/applications/{$application->user_name}/{$application->id_card}");
         // PDF Header
            $headers = ['Content-Type: application/pdf'];
         return response()->file($myIDCARD, $headers);
    }
     public function view_license($id)
    {
            $application = Apply::find($id);
        //Fetch License
            $myLicense = storage_path("app/public/applications/{$application->user_name}/{$application->license}");
         // PDF Header
            $headers = ['Content-Type: application/pdf'];
         return response()->file($myLicense, $headers);
    }
    /* public function view_kyc($id)
    {
            $application = Apply::find($id);
         //Fetch KYC Form
            $mykyc = storage_path("app\public\applications\\{$application->user_name}\\{$application->kyc_form}");
         // PDF Header
            $headers = ['Content-Type: application/pdf'];
         return response()->file($mykyc, $headers);     
    }*/
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function approve(Request $request, $id)
    {
        //
            $application = Apply::find($id);
            $application->is_approve = '1';
            $application->admin_name = Auth()->User()->name;
            $application->solve_date = Carbon::now();
            $application->save();
            // Register User For Super Admin Approval
            $user = new User;
            $user->name = $application->user_name;
            $user->email = $application->user_email;
            $user->password = bcrypt($application->user_tel);
            $user->save();
            return redirect(route('applications.index'))->with('success', 'Application Approved');
    }

    public function reject(Request $request, $id)
    {
            $application = Apply::find($id);
            $application->is_reject = '1';
            $application->admin_name = Auth()->User()->name;
            $application->solve_date = Carbon::now();
            $application->save();
            return redirect(route('applications.index'))->with('error', 'Application Rejected');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
