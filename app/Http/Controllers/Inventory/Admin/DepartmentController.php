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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function categoriesApi(Request $request)
    {
        $term = $request->input('term', '');
        $categoryList = $this->inventoryDepartmentRepository->getForJson($term);
       // $items = InventoryDepartment::where('title', 'LIKE', '%'.$request->input('term', '').'%')
         //   ->get(['id', 'title as text']);
          
        return response()->json(['results' => $categoryList]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->inventoryDepartmentRepository->getAllWithPaginate(500);
        $categoryList = $this->inventoryDepartmentRepository->getForComboBox();
        return view('inventory.admin.departments', compact('paginator', 'categoryList'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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

    }
    
    public function updateAjax (Request $request)
    {
        if($request->ajax()){
            
            $item = $this->inventoryDepartmentRepository->getEdit($request->pk);
            

            if (empty($item)) { //якщо ід не знайдено
                return json_encode(array('statusCode'=>404));
            } else {
                $result = $item->update([$request->name => $request->value]);
                $parentTitle = $item->parentTitle;
                //$pk = $item->id;
                if ($result) {
                    return response()->json(['success' => true, 'title' => $parentTitle]);
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
            $ids = explode(",", $id);
            foreach ($ids as $id) {
                $item = $this->inventoryDepartmentRepository->getEdit($id);
                $hasChild = $this->inventoryDepartmentRepository->getChild($id);
                if (empty($item)) { 
                    return response()->json(['statusCode' => 404,'msg' => 'Помилка видалення']);
                } elseif ($hasChild) {
                    return response()->json(['statusCode' => 600,'msg' => 'Помилка видалення. Має дочірні відділи', 'id' => $item->id]);
                }
            }
                $result = $item->destroy($ids);
    
                    if ($result) {
                            return response()->json(['statusCode' => 200,'msg' => 'Записи видалено']);
                    } else {
                            return response()->json(['statusCode' => 500,'msg' => 'Помилка 500']);
                    }
    }

}
