<?php

namespace App\Http\Controllers;

use App\Models\ComputerModel;
use App\Models\Cooling;
use App\Models\Corp;
use App\Models\Cpu;
use App\Models\Disk;
use App\Models\Gpu;
use App\Models\Motherboard;
use App\Models\Psu;
use App\Models\Ram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ComponentAdminController extends Controller
{

    public function show($id)
    {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        $models = ComputerModel::findOrFail($id);
        $cpu = Cpu::all();
        $ram = Ram::all();
        $gpu = Gpu::all();
        $motherboard = Motherboard::all();
        $psu = Psu::all();
        $disk = Disk::all();
        $cooling = Cooling::all();
        $case = Corp::all();

        return view('admin.component.components_show')
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

    public function ShowCpu($id) {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        $models = ComputerModel::findOrFail($id);
        $cpu = Cpu::all();

        return view('admin.component.cpu.index')
            ->with(['models' => $models])
            ->with(['cpus' => $cpu])
            ->with(['data'=>$data]);
    }

    public function ShowMotherboard($id) {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        $models = ComputerModel::findOrFail($id);
        $motherboard = Motherboard::all();

        return view('admin.component.motherboard.index')
            ->with(['models' => $models])
            ->with(['motherboards' => $motherboard])
            ->with(['data'=>$data]);
    }

    public function ShowRam($id) {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        $models = ComputerModel::findOrFail($id);
        $ram = Ram::all();

        return view('admin.component.ram.index')
            ->with(['models' => $models])
            ->with(['rams' => $ram])
            ->with(['data'=>$data]);
    }

    public function ShowGpu($id) {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        $models = ComputerModel::findOrFail($id);
        $gpu = Gpu::all();

        return view('admin.component.gpu.index')
            ->with(['models' => $models])
            ->with(['gpus' => $gpu])
            ->with(['data'=>$data]);
    }

    public function ShowPsu($id) {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        $models = ComputerModel::findOrFail($id);
        $psu = Psu::all();

        return view('admin.component.psu.index')
            ->with(['models' => $models])
            ->with(['psus' => $psu])
            ->with(['data'=>$data]);
    }

    public function ShowHdd($id) {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        $models = ComputerModel::findOrFail($id);
        $disk = Disk::all();

        return view('admin.component.hdd.index')
            ->with(['models' => $models])
            ->with(['disks' => $disk])
            ->with(['data'=>$data]);
    }

    public function ShowSsd($id) {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        $models = ComputerModel::findOrFail($id);
        $disk = Disk::all();

        return view('admin.component.ssd.index')
            ->with(['models' => $models])
            ->with(['disks' => $disk])
            ->with(['data'=>$data]);
    }

    public function ShowCooling($id) {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        $models = ComputerModel::findOrFail($id);
        $cooling = Cooling::all();

        return view('admin.component.cooling.index')
            ->with(['models' => $models])
            ->with(['coolings' => $cooling])
            ->with(['data'=>$data]);
    }

    public function ShowCase($id) {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];

        $models = ComputerModel::findOrFail($id);
        $case = Corp::all();

        return view('admin.component.case.index')
            ->with(['models' => $models])
            ->with(['cases' => $case])
            ->with(['data'=>$data]);
    }


    public function UpdateCpu(Request $request, $id)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/cpu', $filename);

                $cpu = Cpu::find($id);
                $cpu -> update([
                    'img' => isset($file) ? $filename : NULL,
                ] + $request -> all());

                return redirect()->back();
            }
            else{
                $cpu = Cpu::find($id);
                $cpu -> update($request -> all());

                return redirect()->back();
            }
        }
    }

    public function UpdateMotherboard(Request $request, $id)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/motherboard', $filename);

                $motherboard = Motherboard::find($id);
                $motherboard -> update([
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
            else{
                $motherboard = Motherboard::find($id);
                $motherboard -> update($request -> all());

                return redirect()->back();
            }
        }
    }

    public function UpdateRam(Request $request, $id)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/ram', $filename);

                $ram = Ram::find($id);
                $ram -> update([
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
            else{
                $ram = Ram::find($id);
                $ram -> update($request -> all());

                return redirect()->back();
            }
        }
    }

    public function UpdateGpu(Request $request, $id)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/gpu', $filename);

                $gpu = Gpu::find($id);
                $gpu -> update([
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
            else{
                $gpu = Gpu::find($id);
                $gpu -> update($request -> all());

                return redirect()->back();
            }
        }
    }

    public function UpdatePsu(Request $request, $id)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/psu', $filename);

                $psu = Psu::find($id);
                $psu -> update([
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
            else{
                $psu = Psu::find($id);
                $psu -> update($request -> all());

                return redirect()->back();
            }
        }
    }

    public function UpdateHDD(Request $request, $id)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/disk', $filename);

                $disk = Disk::find($id);
                $disk -> update([
                        'type' => 'HDD',
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
            else{
                $disk = Disk::find($id);
                $disk -> update([
                    'type' => 'HDD'
                    ] + $request -> all());

                return redirect()->back();
            }
        }
    }

    public function UpdateSSD(Request $request, $id)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/disk', $filename);

                $disk = Disk::find($id);
                $disk -> update([
                        'type' => 'SSD',
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
            else{
                $disk = Disk::find($id);
                $disk -> update([
                        'type' => 'SSD'
                    ] + $request -> all());

                return redirect()->back();
            }
        }
    }

    public function UpdateCooling(Request $request, $id)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/cooling', $filename);

                $cooling = Cooling::find($id);
                $cooling -> update([
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
            else{
                $cooling = Cooling::find($id);
                $cooling -> update($request -> all());

                return redirect()->back();
            }
        }
    }

    public function UpdateCase(Request $request, $id)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/case', $filename);

                $case = Corp::find($id);
                $case -> update([
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
            else{
                $case = Corp::find($id);
                $case -> update($request -> all());

                return redirect()->back();
            }
        }
    }

    public function StoreCpu(Request $request)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/cpu', $filename);

                $cpu = Cpu::create([
                        'model_id' => $request -> model_id,
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
        }
    }

    public function StoreMotherboard(Request $request)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/motherboard', $filename);

                $component = Motherboard::create([
                        'model_id' => $request -> model_id,
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
        }
    }

    public function StoreRam(Request $request)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/ram', $filename);

                $component = Ram::create([
                        'model_id' => $request -> model_id,
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
        }
    }

    public function StoreGpu(Request $request)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/gpu', $filename);

                $component = Gpu::create([
                        'model_id' => $request -> model_id,
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
        }
    }

    public function StorePsu(Request $request)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/psu', $filename);

                $component = Psu::create([
                        'model_id' => $request -> model_id,
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
        }
    }

    public function StoreHdd(Request $request)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/disk', $filename);

                $component = Disk::create([
                        'type' => 'HDD',
                        'model_id' => $request -> model_id,
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
        }
    }

    public function StoreSsd(Request $request)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/disk', $filename);

                $component = Disk::create([
                        'type' => 'SSD',
                        'model_id' => $request -> model_id,
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
        }
    }

    public function StoreCooling(Request $request)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/cooling', $filename);

                $component = Cooling::create([
                        'model_id' => $request -> model_id,
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
        }
    }

    public function StoreCase(Request $request)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->img)) {
                $file = $request->file('img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/component_photo/case', $filename);

                $component = Corp::create([
                        'model_id' => $request -> model_id,
                        'img' => isset($file) ? $filename : NULL,
                    ] + $request -> all());

                return redirect()->back();
            }
        }
    }
}
