<?php

namespace App\Http\Controllers;

use App\Models\Computer_cases;
use App\Models\ComputerModel;
use App\Models\Computers_assemblies;
use App\Models\Configurations;
use App\Models\Cooling;
use App\Models\Coolings;
use App\Models\Corp;
use App\Models\Cpu;
use App\Models\Cpuses;
use App\Models\Disk;
use App\Models\Disks;
use App\Models\Gpu;
use App\Models\gpuses;
use App\Models\Motherboard;
use App\Models\Motherboardses;
use App\Models\Package;
use App\Models\Position;
use App\Models\Positions;
use App\Models\Psu;
use App\Models\Psuses;
use App\Models\Ram;
use App\Models\rams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ConfigurationsController extends Controller
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
        $configuration = ComputerModel::all();
        if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid('', true), strtotime("+7 days"));
        return view('configurations.configuration')->withConfiguration($configuration)->with(['data'=>$data]);
    }

    public function computers_assemblies($id)
    {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];
        $Assemblies = Package::where('model_id', $id)->get();
        $CartList = \Cart::session($_COOKIE['cart_id'])->getContent();
        if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid('', true), strtotime("+7 days"));
        return view('configurations.computers_assemblies', compact('Assemblies'))
            ->with(['data'=>$data]);
    }

    public function configurator_page($model_name, $name_conf, $complectation_name){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];
        /*Получение комплектующих*/
        $cpuses = Cpu::all()->where('model_id', $model_name);
        $rams = Ram::all()->where('model_id', $model_name);
        $gpuses = Gpu::all()->where('model_id', $model_name);
        $motherboardses = Motherboard::all()->where('model_id', $model_name);
        $psuses = Psu::all()->where('model_id', $model_name);
        $disks = Disk::all();
        $cases = Corp::all();
        $coolings = Cooling::all();
        $qty_ram_conf = Package::all()->where('model_id', $model_name)->where('package_name', $complectation_name);
        if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid('', true), strtotime("+7 days"));
        return view('configurations.configurator_page', ['complectation_name' => $complectation_name]
        )
            ->withModel($model_name)
            ->withConf($name_conf)
            ->withCpuses($cpuses)
            ->withRams($rams)
            ->withGpuses($gpuses)
            ->withMotherboardses($motherboardses)
            ->withPsuses($psuses)
            ->withDisks($disks)
            ->withCases($cases)
            ->withCoolings($coolings)
            ->withQtyconf($qty_ram_conf)
            ->with(['data'=>$data]);
    }

    public function selectMotherboard(Request $request){
        if($request->ajax()){
            $motherboards_select = Motherboard::all()->where('socket', $request->id_socket)
                ->where('model_id', $request -> model_name);
            $data = view('configurations.selectMotherboard',['motherboards_select' => $motherboards_select])->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function selectCpu(Request $request){
        if($request->ajax()){
            $cpus_select = Cpu::all()->where('socket', $request->id_socket)
                ->where('model_id', $request -> model_name);
            $data = view('configurations.selectCpu',['cpus_select' => $cpus_select])->render();
            return response()->json(['options'=>$data]);
        }
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_lastname,
        ];
        $validator = Validator::make($request->all(), [
            'cpu_id' => 'required',
            'motherboard_id' => 'required'
        ]);
        if($validator->fails()) {
            return redirect()->back()->with('error', 'Ошибка заполнения формы, выберите все комлектующие');
        }
        else{
            $configruations = Position::create($request->all());
            $positions = Position::all()->where('model_name', $request -> model_name)
                ->where('package_name', $request -> package_name) // start
                ->first();
            $cart_id = $_COOKIE['cart_id'];

            \Cart::session($cart_id)->add([
                'id' => $configruations -> id, // inique row ID
                'name' => $positions -> model_name, //
                'price' => $positions -> price,
                'quantity' => 1,
                'attributes' => [
                    'package_name' => $positions -> package_name,
                    'qty_ram' => $positions -> count_ram,
                    'cpu_id' => $positions -> cpu_id,
                    'motherboard_id' => $positions->motherboard_id,
                    'ram_id' => $positions -> ram_id,
                    'gpu_id' => $positions -> gpu_id,
                    'psu_id' => $positions -> psu_id,
                    'corp_id' => $positions -> corp_id,
                    'disk_id' => $positions -> disk_id,
                    'ssd_id' => $positions -> ssd_id,
                    'info_model' => (object)[
                        "count" => 50
                    ],
                ]
            ]);
            return redirect()->route('cart')->with(['data'=>$data]);
        }

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
    }

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
