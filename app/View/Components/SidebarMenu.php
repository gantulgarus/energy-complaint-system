<?php

namespace App\View\Components;

use App\Models\Complaint;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class SidebarMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $org_id = Auth::user()->org_id;
        $user_id = Auth::user()->id;

        $new_complaints = Complaint::where('status_id', 0)->where('organization_id', $org_id)->count();
        $received_complaints = Complaint::where('status_id', 2)->where('organization_id', $org_id)->where('controlled_user_id', $user_id)->count();
        $under_control_complaints = Complaint::where('status_id', 3)->where('organization_id', $org_id)->where('controlled_user_id', $user_id)->count();
        $solved_complaints = Complaint::where('status_id', 6)->where('organization_id', $org_id)->where('controlled_user_id', $user_id)->count();
        $canceled_complaints = Complaint::where('status_id', 4)->where('organization_id', $org_id)->where('controlled_user_id', $user_id)->count();
        $all_complaints = Complaint::all()->count();

        return view('components.sidebar-menu', ['new_complaints' => $new_complaints, 'received_complaints' => $received_complaints, 'under_control_complaints' => $under_control_complaints, 'solved_complaints' => $solved_complaints, 'canceled_complaints' => $canceled_complaints, 'all_complaints' => $all_complaints]);
    }
}
