<?php

namespace App\Http\Controllers;

use App\Models\ComputerModel;
use App\Models\Cooling;
use App\Models\Corp;
use App\Models\Cpu;
use App\Models\Disk;
use App\Models\Gpu;
use App\Models\Motherboard;
use App\Models\Package;
use App\Models\Position;
use App\Models\Psu;
use App\Models\Ram;
use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PackageAdminController extends Controller
{
    public function ComponentPackageStore(Request $request){
        if($request->ajax()){
            $UserController = new UserController();
            $UserController -> authUser();
            $data = (object)[
                'id' => $UserController -> user_id,
                'role' => $UserController -> user_role,
                'name' => $UserController -> user_name,
                'surname' => $UserController -> user_lastname,
            ];

            $model = ComputerModel::find($request->model);
            $cpu = Cpu::all()->where('model_id', $model->id)->where('complectation_name', null);
            $ram = Ram::all()->where('model_id', $model->id)->where('complectation_name', null);
            $gpu = Gpu::all()->where('model_id', $model->id)->where('complectation_name', null);
            $motherboard = Motherboard::all()->where('model_id', $model->id)->where('complectation_name', null);
            $psu = Psu::all()->where('model_id', $model->id)->where('complectation_name', null);
            $disk = Disk::all();
            $cooling = Cooling::all();
            $case = Corp::all()->where('model_id', $model->id)->where('complectation_name', null);

            $datas = view('admin.package.component_package_store')
                ->with(['cases' => $case])
                ->with(['cpus' => $cpu])
                ->with(['rams' => $ram])
                ->with(['gpus' => $gpu])
                ->with(['motherboards' => $motherboard])
                ->with(['psus' => $psu])
                ->with(['disks' => $disk])
                ->with(['coolings' => $cooling])
                ->with(['data' => $data])
                ->render();
            return response()->json(['options'=>$datas]);
        }
    }

    public function PackagePositionStore(Request $request){
        if(Auth::user()->role === 'admin'){
            /*Получение комплектующих*/
            $modelDb = ComputerModel::find($request->model_id);
            $cpu = Cpu::find($request->cpu_id);
            $cpu -> update(['complectation_name' => $request -> package_name]);
            $ram = Ram::find($request->ram_id);
            $gpu = Gpu::find($request->gpu_id);
            $gpu -> update(['complectation_name' => $request -> package_name]);
            $motherboard = Motherboard::find($request->motherboard_id);
            $motherboard -> update(['complectation_name' => $request -> package_name]);
            $psu = Psu::find($request->psu_id);
            $disk_hdd = Disk::find($request->disk_id);
            $disk_ssd = Disk::find($request->ssd_id);
            $cooling = Cooling::find($request->cooling_id);
            $case = Corp::find($request->case_id);
            /*Расчет цены*/
            $price = $cpu->price + $motherboard->price + ($ram->price * $request->qty_ram) + $gpu->price + $psu->price + $disk_hdd->price + $disk_ssd -> price + $cooling->price + $case->price;

            /*Добавление комплектации*/
            $package = Package::create([
                'package_name' => $request -> package_name,
                'description' => $request -> description,
                'recommendation' => $request -> recommendation,
                'qty_ram' => $request -> qty_ram,
                'count' => $request -> count,
                'price' => $price,
                'model_id' => $request -> model_id
            ]);

            $stat1 = Stat::create([
                'stat_name' => '1080P',
                'stat_value' => $request->stat1,
                'package_id' => $package->id,
            ]);

            $stat2 = Stat::create([
                'stat_name' => '1440P',
                'stat_value' => $request->stat2,
                'package_id' => $package->id,
            ]);

            $stat3 = Stat::create([
                'stat_name' => '2160P',
                'stat_value' => $request->stat3,
                'package_id' => $package->id,
            ]);

            /*Добавление позиции*/
            $position = Position::create([
                'cpu_id' => $request -> cpu_id,
                'motherboard_id' => $request -> motherboard_id,
                'ram_id' => $request -> ram_id,
                'count_ram' => $request -> qty_ram,
                'gpu_id' => $request -> gpu_id,
                'psu_id' => $request -> psu_id,
                'cooling_id' => $request -> cooling_id,
                'corp_id' => $request -> case_id,
                'disk_id' => $request -> disk_id,
                'ssd_id' => $request -> ssd_id,
                'price' => $price,
                'model_name' => $modelDb -> name,
                'package_name' => $request -> package_name,
            ]);

            return redirect()->back();
        }
    }

    public function CreateModel(Request $request)
    {
        if(Auth::user()->role === 'admin'){
            if (isset($request->model_img)) {
                $file = $request->file('model_img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/package_photo', $filename);

                $model = ComputerModel::create([
                    'name' => $request->model_name,
                    'description' => $request->model_description,
                    'img' => $filename
                ]);

                return redirect()->route('admin.package.index');
            }
            else{
                $model = ComputerModel::create([
                    'name' => $request->model_name,
                    'description' => $request->model_description,
                ]);

                return redirect()->route('admin.package.index');
            }
        }
    }

    public function UpdateModel(Request $request, $id){
        if(Auth::user()->role === 'admin'){
            if (isset($request->model_img)) {
                $file = $request->file('model_img');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/img/package_photo', $filename);

                $model = ComputerModel::find($id);
                $model -> update([
                    'name' => $request->model_name,
                    'description' => $request->model_description,
                    'img' => isset($file) ? $filename : NULL,
                ]);

                return redirect()->route('admin.package.index');
            }
            else{
                $model = ComputerModel::find($id);
                $model -> update([
                    'name' => $request->model_name,
                    'description' => $request->model_description,
                ]);

                return redirect()->route('admin.package.index');
            }
        }
    }

}
