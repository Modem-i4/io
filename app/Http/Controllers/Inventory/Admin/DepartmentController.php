<?php

namespace App\Http\Controllers\Inventory\Admin;

use App\Models\InventoryDepartment;
use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryDepartmentUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Repositories\InventoryDepartmentRepository;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Response;


class DepartmentController extends BaseController
{
    /**
     * @var InventoryDepartmentRepository
     */
    private $inventoryDepartmentRepository; // властивість через яку будемо звертатись в репозиторій

    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct(); //конструктор від парента на перпективу, можливо колись знадобиться
        $this->inventoryDepartmentRepository = app(InventoryDepartmentRepository::class); //app вертає об'єкт класа
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->inventoryDepartmentRepository->getAllWithPaginate(50);
        $categoryList = $this->inventoryDepartmentRepository->getForComboBox();
        return view('inventory.admin.departments', compact('paginator', 'categoryList'));

        
       /* $data['students'] = InventoryDepartment::orderBy('id','desc')->paginate(5);   
        return view('inventory.admin.deptest',$data);*/

       // return view('inventory.admin.deptest2');

       // $data = InventoryDepartment::all();
    	//return view('inventory.admin.deptest3', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$item = InventoryDepartment::make(); //використовуємо метод make
        $categoryList = $this->inventoryDepartmentRepository->getForComboBox(); //::all();
        

        return view('admin.departments.edit', compact('item', 'categoryList'));*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ['title' => $request->post('addTitle'),
        'parent_id'=> $request->post('addPlace'),];

        $result = InventoryDepartment::create($data);  
        return response()->json($result);
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
       /* $where = array('id' => $id);
        $student  = InventoryDepartment::where($where)->first();
 
        return Response::json($student);*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*$student = InventoryDepartment::updateOrCreate(
            ['id' => $request->post('hdnStudentId')],
            ['title' => $request->post('txtFirstName'),
            'parent_id'=> $request->post('txtAddress'),
            ]
        );

        return response()->json($student);*/
    }
    
    public function updateAjax (Request $request)
    {
        if($request->ajax()){
            
            $item = $this->inventoryDepartmentRepository->getEdit($request->pk);

            if (empty($item)) { //якщо ід не знайдено
                return json_encode(array('statusCode'=>404));
            } else {
                $result = $item->update([$request->name => $request->value]);
                if ($result) {
                    return response()->json(['success' => true]);
                } else {
                    return response()->json(['statusCode' => 500,'msg' => 'Помилка 500']);
                }
            }        
            
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = $this->inventoryDepartmentRepository->getEdit($id); 
        $hasChild = $this->inventoryDepartmentRepository->getChild($id);

            if (empty($item)) { //якщо ід не знайдено
                return response()->json(['statusCode' => 404,'msg' => 'Помилка видалення']);
            } elseif ($hasChild) {
                return response()->json(['statusCode' => 600,'msg' => 'Помилка видалення. Має дочірні відділи']);
            } else {
                $result = $item->forceDelete();

                if ($result) {
                        return response()->json(['statusCode' => 200,'msg' => 'Запис видалено']);
                        //json_encode(array('statusCode'=>200));
                } else {
                        return response()->json(['statusCode' => 500,'msg' => 'Помилка 500']);
                }
            }  
    }
    
}
