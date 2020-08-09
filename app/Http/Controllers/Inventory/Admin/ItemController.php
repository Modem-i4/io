<?php

namespace App\Http\Controllers\Inventory\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

/* LiveTable
    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $data = InventoryDepartment::all();
            echo json_encode($data);
        }
    }

    function add_data(Request $request)
    {
        if($request->ajax())
        {
            $data = array(
                'title'    =>  $request->title,
                'parent_id'     =>  $request->parent_id
            );
            $id = InventoryDepartment::insert($data);
            if($id > 0)
            {
                echo '<div class="alert alert-success">Data Inserted</div>';
            }
        } 
    }

    function update_data(Request $request)
    {
        if($request->ajax())
        {
            $data = array(
                $request->column_name       =>  $request->column_value
            );
            InventoryDepartment::where('id', $request->id)
                ->update($data);
            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }

    function delete_data(Request $request)
    {
        if($request->ajax())
        {
            InventoryDepartment::where('id', $request->id)
                ->delete();
            echo '<div class="alert alert-success">Data Deleted</div>';
        }
    }

    //Tabledit
    function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->action == 'edit')
    		{
          
                $data = $request->all();
                $rules=['title' => 'required|min:5|max:200',
                    'parent_id' => 'required|integer|exists:inventory_departments,id',
                ];
                $validator = \Validator::make($data, $rules);
                    if ($validator->passes()) {

                        $item = $this->inventoryDepartmentRepository->getEdit($request->id); 
 
                    }
                    return response()->json(['error'=>$validator->errors()->all()]);



    		}

    		return response()->json($request);
    	}
    }


    //// xeditable validate
        public function index()
            {
                $data = Contact::all();
                return view('admin.contacts.index',compact('data'));
            }
            

            public function moreAddData()
            {
                return view("inventory.admin.deptest2");
            }
            public function moreAddDataPost(Request $request)
            {
               // 
               $rules = [];
                foreach($request->input('name') as $key => $value) {
                    $rules["title"] = 'required';
                }
                
                $validator = \Validator::make($request->all(), $rules);
                if ($validator->passes()) {
        
                    foreach($request->input('name') as $key => $value) {
                        InventoryDepartment::create(['name'=>$value]);
                    }
        
                    return response()->json(['success'=>'done']);
                }
                return response()->json(['error'=>$validator->errors()->all()]);
            }
*/

}
