<?php

namespace App\Http\Controllers;

use App\Models\Sub1category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class Sub1categoryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $sub1category = Sub1category::all();
        return response()->json([
            'data' => $sub1category
            ]);
        }
        
        //get Sub 1 category datatable friendly formated data
        public function getDataTableFilterData(Request $request){
            
            if($request->search['value'] != null){
                $sub1category = DB::table('sub1categories')
                ->where('maincategory', $request->maincategory)
                ->where('subcategory', 'LIKE', '%'.$request->search['value'].'%')            
                ->offset($request->start)
                ->limit($request->length)
                ->orderBy('id', 'desc')
                ->get();
            }else{            
                $sub1category = DB::table('sub1categories')
                ->where('maincategory', $request->maincategory)  
                ->offset($request->start)
                ->limit($request->length)
                ->orderBy('id', 'desc')
                ->get();
            }        
            return response()->json([      
                'data' => $sub1category
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
                    //validation rules initiate
                    $rules = [
                        'maincategory'=>'required',
                        'subcategory'=>'required|unique:sub1categories,subcategory',
                    ];
                    
                    //custom message for validation initiate.if not need custom message remove $mssage from validator method.
                    //if we not set custom message for any validation it message will pop as default from laravel
                    $messages = [
                        'maincategory.required' => 'Main category is required', 
                        'subcategory.unique' => 'This sub category already available.Please try again',  
                        'subcategory.required' => 'Sub category is required'
                    ];
                    
                    //custom validation
                    $validator = Validator::make($request->all(),$rules,$messages);
                    
                    $errorsMsgObject = $validator->errors();
                    $allErrorMsgArray = array();
                    $globalErrorMsg = "";
                    $msgType = 0;
                    
                    //create model object
                    $sub1category = new Sub1category;
                    
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
                        $sub1category->create($request->all());                
                        $msgType = 1;
                        $globalErrorMsg = "Successfully Saved.";                                             
                    }
                    
                    return response()->json([
                        'msgType' => $msgType,
                        'message' => $globalErrorMsg,
                        'category' => $sub1category
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
                    * @param  \App\Models\Sub1category  $sub1category
                    * @return \Illuminate\Http\Response
                    */
                    public function show(Sub1category $sub1category)
                    {
                        return $sub1category;
                    }
                    
                    /**
                    * Update the specified resource in storage.
                    *
                    * @param  \Illuminate\Http\Request  $request
                    * @param  \App\Models\Sub1category  $sub1category
                    * @return \Illuminate\Http\Response
                    */
                    public function update(Request $request, Sub1category $sub1category)
                    {
                        try {
                            //validation rules initiate
                            $rules = [
                                'maincategory'=>'required',
                                'subcategory'=>'required|unique:sub1categories,subcategory',
                            ];
                            
                            //custom message for validation initiate.if not need custom message remove $mssage from validator method.
                            //if we not set custom message for any validation it message will pop as default from laravel
                            $messages = [
                                'maincategory.required' => 'Main category is required', 
                                'subcategory.unique' => 'This sub category already available.Please try again',  
                                'subcategory.required' => 'Sub category is required'
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
                                $sub1category->update($request->all());
                                $msgType = 1;
                                $globalErrorMsg = "Successfully Updated.";                                             
                            }
                            
                            return response()->json([
                                'msgType' => $msgType,
                                'message' => $globalErrorMsg,
                                'category' => $sub1category
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
                            * @param  \App\Models\Sub1category  $sub1category
                            * @return \Illuminate\Http\Response
                            */
                            public function destroy(Sub1category $sub1category)
                            {
                                try {
                                    $sub1category->delete();
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
                                