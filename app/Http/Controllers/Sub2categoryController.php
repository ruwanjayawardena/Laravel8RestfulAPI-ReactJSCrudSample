<?php

namespace App\Http\Controllers;

use App\Models\Sub2category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;

class Sub2categoryController extends Controller
{
     /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $sub2category = Sub2category::all();
        return response()->json([
            'data' => $sub2category
        ]);
    }

    //Load Sub 2 category combo box
    public function cmbSub2Category(Request $request){
        $sub2categories = DB::table('sub2categories')
        ->where('sub1category', $request->id)
        ->get();
        return response()->json($sub2categories);
    }
        
    //get Sub 1 category datatable friendly formated data
    public function getDataTableFilterData(Request $request){
        
        if($request->search['value'] != null){
            $sub2category = DB::table('sub2categories')
            ->where('sub1category', $request->sub1category)
            ->where('sub2category', 'LIKE', '%'.$request->search['value'].'%')            
            ->offset($request->start)
            ->limit($request->length)
            ->orderBy('id', 'desc')
            ->get();
        }else{            
            $sub2category = DB::table('sub2categories')
            ->where('sub1category', $request->sub1category)  
            ->offset($request->start)
            ->limit($request->length)
            ->orderBy('id', 'desc')
            ->get();
        }        
        return response()->json([      
            'data' => $sub2category
        ]);
    }
            
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        try { 
            $rules = [
                'sub1category' => 'required',
                'sub2category' =>  [
                             'required', 
                             Rule::unique('sub2categories')
                                    ->where('sub2category', $request->sub2category)
                                    ->where('sub1category', $request->sub1category)
                            ]
            ];            
            
            //custom message for validation initiate.if not need custom message remove $mssage from validator method.
            //if we not set custom message for any validation it message will pop as default from laravel
            $messages = [
                'sub1category.required' => 'Sub Category 1 is required', 
                'sub2category.unique' => 'This sub category 2 already available.Please try again',  
                'sub2category.required' => 'Sub category 2 is required',
            ];
            
            //custom validation
            $validator = Validator::make($request->all(),$rules,$messages);
            
            $errorsMsgObject = $validator->errors();
            $allErrorMsgArray = array();
            $globalErrorMsg = "";
            $msgType = 0;
            
            //create model object
            $sub2category = new sub2category;
            
            if ($validator->fails()) { 
                //validation failed warning message block  
                $jsonMsgtype = 2;            
                foreach ($errorsMsgObject->all() as $message) {
                    $allErrorMsgArray[] = $message;
                } 
                if(isset($allErrorMsgArray) && !empty($allErrorMsgArray)){
                    $globalErrorMsg = implode(' | ',$allErrorMsgArray);
                } else{
                    $globalErrorMsg = "A problem has been occurred while saving data. Please Try again later.";
                } 
            }else{
                //validation ok success message                 
                $sub2category->create($request->all());                
                $msgType = 1;
                $globalErrorMsg = "Successfully Saved.";                                             
            }
            
            return response()->json([
                'msgType' => $msgType,
                'message' => $globalErrorMsg,
                'category' => $sub2category
                ]); 
                
            } catch (\Throwable $th) {
                return response()->json([
                    'msgType' => 0,
                    'message' => $th->getMessage()               
                ]);
            } 
        }
                    
        /**
        * Display the specified resource.
        *
        * @param  \App\Models\sub2category  $sub2category
        * @return \Illuminate\Http\Response
        */
        public function show(sub2category $sub2category)
        {
            $query = DB::table('sub2categories')
            ->join('sub1categories', 'sub2categories.sub1category', '=', 'sub1categories.id')           
            ->select('sub2categories.*', 'sub1categories.subcategory as sub1catname')
            ->where('sub2categories.id', $sub2category->id) 
            ->get();
            return response()->json($query);
        }
                    
        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \App\Models\sub2category  $sub2category
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, sub2category $sub2category)
        {
            try {
                $rules = [
                    'sub1category' => 'required',
                    'sub2category' =>  [
                                 'required', 
                                 Rule::unique('sub2categories')
                                        ->where('sub2category', $request->sub2category)
                                        ->where('sub1category', $request->sub1category)
                                ]
                ]; 
                
                //custom message for validation initiate.if not need custom message remove $mssage from validator method.
                //if we not set custom message for any validation it message will pop as default from laravel
                $messages = [
                    'sub1category.required' => 'Sub Category 1 is required', 
                    'sub2category.unique' => 'This sub category 2 already available.Please try again',  
                    'sub2category.required' => 'Sub category 2 is required'
                ];
                
                //custom validation
                $validator = Validator::make($request->all(),$rules,$messages);
                
                $errorsMsgObject = $validator->errors();
                $allErrorMsgArray = array();
                $globalErrorMsg = "";
                $msgType = 0;
                
                if ($validator->fails()) { 
                    //validation failed warning message block  
                    $jsonMsgtype = 2;            
                    foreach ($errorsMsgObject->all() as $message) {
                        $allErrorMsgArray[] = $message;
                    } 
                    if(isset($allErrorMsgArray) && !empty($allErrorMsgArray)){
                        $globalErrorMsg = implode(' | ',$allErrorMsgArray);
                    } else{
                        $globalErrorMsg = "A problem has been occurred while updating data. Please Try again later.";
                    } 
                }else{
                    //validation ok success message
                    $sub2category->update($request->all());
                    $msgType = 1;
                    $globalErrorMsg = "Successfully Updated.";                                             
                }
                
                return response()->json([
                    'msgType' => $msgType,
                    'message' => $globalErrorMsg,
                    'category' => $sub2category
                ]); 
                    
            } catch (\Throwable $th) {
                return response()->json([
                    'msgType' => 0,
                    'message' => $th->getMessage()               
                ]);
            }            
        }
        
                
        /**
        * Remove the specified resource from storage.
        *
        * @param  \App\Models\sub2category  $sub2category
        * @return \Illuminate\Http\Response
        */
        public function destroy(sub2category $sub2category)
        {
            try {
                $sub2category->delete();
                return response()->json([
                    'msgType' => 1,
                    'message' => 'Successfully Deleted.'
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'msgType' => 0,
                    'message' => $th->getMessage()               
                ]);
            }
        }
}
