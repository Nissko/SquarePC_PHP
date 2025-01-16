<?php

namespace App\Http\Controllers;

use App\Models\ComputerModel;
use App\Models\Cooling;
use App\Models\Corp;
use App\Models\Cpu;
use App\Models\Disk;
use App\Models\Gpu;
use App\Models\Motherboard;
use App\Models\Order;
use App\Models\Package;
use App\Models\Position;
use App\Models\Psu;
use App\Models\Ram;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        return view('admin.index')->with(['data'=>$data]);
    }

    public function ModerateOrder(){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        $orders = Order::all()->sortDesc();
        $count = $orders -> count();

        return view('admin.order.orders')
            ->with('count', $count)
            ->with(['orders'=>$orders])
            ->with(['data'=>$data]);
    }

    public function ModerateComponent(){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        $models = ComputerModel::all();
        $cpu = Cpu::all();
        $ram = Ram::all();
        $gpu = Gpu::all();
        $motherboard = Motherboard::all();
        $psu = Psu::all();
        $disk = Disk::all();
        $cooling = Cooling::all();
        $case = Corp::all();

        return view('admin.component.components')
            ->with(['models' => $models])
            ->with(['cases' => $case])
            ->with(['cpus' => $cpu])
            ->with(['rams' => $ram])
            ->with(['gpus' => $gpu])
            ->with(['motherboards' => $motherboard])
            ->with(['psus' => $psu])
            ->with(['disks' => $disk])
            ->with(['coolings' => $cooling])
            ->with(['data'=>$data]);
    }

    public function ModeratePackage(){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        /*Получение данных*/
        $configuration_model = ComputerModel::all();
        $configuration_package = Package::all();
        $configuration_position = Position::all();
        $configuration_case = Corp::all();
        $configuration_cpu = Cpu::all();
        $configuration_ram = Ram::all();
        $configuration_gpu = Gpu::all();
        $configuration_motherboard = Motherboard::all();
        $configuration_psu = Psu::all();
        $configuration_disk = Disk::all();
        $configuration_cooling = Cooling::all();

        return view('admin.package.packages')
            ->with(['configuration_models' => $configuration_model])
            ->with(['configuration_packages' => $configuration_package])
            ->with(['configuration_positions' => $configuration_position])
            ->with(['configuration_cases' => $configuration_case])
            ->with(['configuration_cpus' => $configuration_cpu])
            ->with(['configuration_rams' => $configuration_ram])
            ->with(['configuration_gpus' => $configuration_gpu])
            ->with(['configuration_motherboards' => $configuration_motherboard])
            ->with(['configuration_psus' => $configuration_psu])
            ->with(['configuration_disks' => $configuration_disk])
            ->with(['configuration_coolings' => $configuration_cooling])
            ->with(['data'=>$data]);
    }

    public function ModerateUser(){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        $user = User::all();

        return view('admin.user.users')
            ->with(['users' => $user])
            ->with(['data'=>$data]);
    }
}
