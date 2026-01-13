<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pendingRevenue = Order::where('status', 'pending')->sum('total_amount');
        $completedRevenue = Order::where('status', 'completed')->sum('total_amount');

        return view('admin.dashboard', [
            'pendingRevenue'   => $pendingRevenue,
            'completedRevenue' => $completedRevenue,
            'orderCount'       => Order::count(),
            'productCount'     => Product::count(),
            'userCount'        => User::where('role', 'user')->count(),
            'adminCount'       => User::where('role', 'admin')->count(),
        ]);
    }
}
