<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Item;
use App\Models\Unit;
use App\Models\ItemCategory;
use App\Models\PO;
use App\Models\Userlog;
use App\Models\StockOut;
use Illuminate\Support\Facades\Hash;

class StockOutController extends Controller
{
    




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_stockout(Request $request)
    {
            
            $this->validate($request,[
                'item_id' => 'required',
                'type' => 'required',
                'quantity' => 'required',
            ]);   

            $getItem = Item::where('id', $request->item_id)->first();


            $stock = $getItem['stock'];
            $storage = $getItem['storage'];
            $quantity = $request->quantity;
            $type = $request->type;

            $status = 'good';

            

            if ($type == '1') {
            
                if ($quantity > 0 && $stock >= $quantity) {
                   
                    $update = Item::where('id', $request->item_id)->update([

                                      'stock' => $stock - $quantity,
                                      'storage' => $storage + $quantity,

                                ]);

                    $getPO_code = Item::where('id', $request->item_id)->first();
                    $getPO_count = PO::where('transaction_code', $getPO_code['po_code'])->first();

                    $update = PO::where('transaction_code', $getPO_code['po_code'])->update([

                                      'remaining_count' => $getPO_count['remaining_count'] + $quantity,

                                ]);


                } else {
                    $status = 'bad';
                }

            } else if ($type == '2') {
                
                if ($quantity > 0 && $stock >= $quantity) {
                   
                    $update = Item::where('id', $request->item_id)->update([

                                      'stock' => $stock - $quantity,

                                ]);
                } else {
                    $status = 'bad';
                }

            } else if ($type == '3') {
                
                if ($quantity > 0 && $storage >= $quantity) {
                   
                    $update = Item::where('id', $request->item_id)->update([

                                      'storage' => $storage - $quantity,

                                ]);
                } else {
                    $status = 'bad';
                }

            }
                
                    


                if ($status == 'good') {

                    $newItem = Item::where('id', $request->item_id)->first();

                    if ($newItem['stock'] == 0) {
                      
                        $newItem = Item::where('id', $request->item_id)->update([

                                                'status' => 'Out of Stock', 

                                          ]);


                    } else {

                        $newItem = Item::where('id', $request->item_id)->update([

                                                'status' => 'Available', 

                                          ]);

                    }


                    
                    $newdata = New StockOut;
                    $newdata->type = $request->type;
                    $newdata->company = $getItem['company'];
                    $newdata->supplier_name = $getItem['supplier_name'];
                    $newdata->item_id = $getItem['id'];
                    $newdata->item_name = $getItem['item_name'];
                    $newdata->unit = $getItem['unit'];
                    $newdata->quantity = $request->quantity;
                    $newdata->user_id = auth()->user()->id;
                    $newdata->issued_by = auth()->user()->firstname.' '.auth()->user()->middlename.' '.auth()->user()->lastname;
                    $newdata->date = date('Y-m-d');
                    $newdata->save();

                    userlogs('Added Stock Out', $getItem->item_name);

                }
                               
                


            return $status;
            

                
    }



        













    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getStockOut(Request $request)
    {   

        $item_name = $request->item_name;
        $type = $request->type;
        $quantity = $request->quantity;
        $unit = $request->unit;
        $supplier_name = $request->supplier_name;
        $issued_by = $request->issued_by;
        $date = $request->date;

        // pagenumberview
        $pagenumber = $request->tablenum;



        if ( $item_name == '' &&
              $type == '' &&
              $quantity == '' &&
              $unit == '' &&
              $supplier_name == '' &&
              $issued_by == '' &&
              $date == ''
            ) {

                 $alldata_count = StockOut::orderBy('date')->get();
 
                 //total row Count
                 $rows = count($alldata_count);

                 //number of rows per page
                 $page_rows = intval($pagenumber);

                 //divide total rows
                 $last = ceil($rows/$page_rows);

                 // This makes sure $last cannot be less than 1
                 if($last < 1){
                     $last = 1;
                 }


                if(isset($request['pn'])){

                    $pn = intval($request['pn']);

                    $pagenum = session(['pn' => $pn]);
                    $pagenum = $pn;

                  } else if ($request->session()->exists('pn') == 1) {

                    $pagenum = $request->session()->get('pn');
                     
                  } else {

                    $pagenum = session(['pn' => 1]);

                  }



                  //check if its on the last page
                  if ($pagenum < 1) {

                      $pagenum = 1; 

                  } else if ($pagenum > $last) { 

                      $pagenum = $last; 

                  }



                 $offset = ($pagenum - 1) * $page_rows;
                 $limit = $page_rows;


             $alldata = StockOut::limit($limit)
                          ->offset($offset)
                          ->orderBy('date')
                          ->get();


             $textline1 = $rows;
             $currentpagenumber = number_format($pagenum);
             $currentpage = number_format($pagenum);
             $totalpagenumber = number_format($last);


             $previews = '';
             $next = '';
             $leftsidenumbers = '';
             $rightsidenumbers = '';

             if($last != 1){

                      if ($pagenum > 1) {

                       $previews = $pagenum - 1;

                       //previews
                       $previews = $previews;

                               for($i = $pagenum-4; $i < $pagenum; $i++){


                                         if($i > 0){
                                              //left side numbers
                                               $leftsidenumbers .= $i.',';
                                         }

                                 }

                       }


                      //current page
                       $currentpage = $pagenum;

                       for($i = $pagenum+1; $i <= $last; $i++){

                              //right side number
                              $rightsidenumbers .= $i.',';

                         if($i >= $pagenum+4){

                           break;

                         }

                       }

                       if ($pagenum != $last) {

                           $next = $pagenum + 1;
                           //next
                           $next = $next;

                       }


                }



               $textline1 = $rows;
               $currentpagenumber = number_format($pagenum);
               $currentpage = number_format($pagenum);
               $totalpagenumber = number_format($last);


               $numberofresults = number_format($textline1);



        } else {

                $alldata_count = StockOut::where('item_name', 'LIKE', '%'.$item_name.'%')
                                      ->where('type', 'LIKE', '%'.$type.'%' )
                                      ->where('quantity', 'LIKE', '%'.$quantity.'%' )
                                      ->where('unit', 'LIKE', '%'.$unit.'%' )
                                      ->where('supplier_name', 'LIKE', '%'.$supplier_name.'%' )
                                      ->where('issued_by', 'LIKE', '%'.$issued_by.'%' )
                                      ->where('date', 'LIKE', '%'.$date.'%' )
                                      ->get();


                 //total row Count
                 $rows = count($alldata_count);

                 //number of rows per page
                 $page_rows = intval($pagenumber);

                 //divide total rows
                 $last = ceil($rows/$page_rows);

                 // This makes sure $last cannot be less than 1
                 if($last < 1){
                     $last = 1;
                 }


                if(isset($request['pn'])){

                    $pn = intval($request['pn']);

                    $pagenum = session(['pn' => $pn]);
                    $pagenum = $pn;

                  } else if ($request->session()->exists('pn') == 1) {

                    $pagenum = $request->session()->get('pn');
                     
                  } else {

                    $pagenum = session(['pn' => 1]);

                  }



                  //check if its on the last page
                  if ($pagenum < 1) {

                      $pagenum = 1; 

                  } else if ($pagenum > $last) { 

                      $pagenum = $last; 

                  }



                 $offset = ($pagenum - 1) * $page_rows;
                 $limit = $page_rows;


                $alldata = StockOut::where('item_name', 'LIKE', '%'.$item_name.'%')
                                      ->where('type', 'LIKE', '%'.$type.'%' )
                                      ->where('quantity', 'LIKE', '%'.$quantity.'%' )
                                      ->where('unit', 'LIKE', '%'.$unit.'%' )
                                      ->where('supplier_name', 'LIKE', '%'.$supplier_name.'%' )
                                      ->where('issued_by', 'LIKE', '%'.$issued_by.'%' )
                                      ->where('date', 'LIKE', '%'.$date.'%' )
                                      ->limit($limit)->offset($offset)->get();


                 $previews = '';
                 $next = '';
                 $leftsidenumbers = '';
                 $rightsidenumbers = '';

                 $paginationCtrls = '';



                      if($last != 1){

                           if ($pagenum > 1) {

                           $previews = $pagenum - 1;

                           //previews
                           $previews = $previews;

                                   for($i = $pagenum-4; $i < $pagenum; $i++){


                                             if($i > 0){

                                                  //left side numbers
                                                   $leftsidenumbers .= $i.',';

                                             }

                                     }

                           }



                          //current page
                          $currentpage = $pagenum;

                           for($i = $pagenum+1; $i <= $last; $i++){

                                        //right side number
                                     $rightsidenumbers .= $i.',';

                             if($i >= $pagenum+4){

                               break;

                             }
                           }

                             if ($pagenum != $last) {

                                 $next = $pagenum + 1;
                                 //next
                                 $next = $next;

                             }
                      }




                 $textline1 = $rows;
                 $currentpagenumber = number_format($pagenum);
                 $currentpage = number_format($pagenum);
                 $totalpagenumber = number_format($last);

                 $numberofresults = number_format($textline1);


        }



        $allcount = StockOut::all();

        return $data = [

                'alldata' => $alldata,
                'heading' => [
                        'currentpagenumber' => $currentpagenumber,
                        'totalpagenumber' => $totalpagenumber,
                        'numberofresults' => $numberofresults,

                    ],
                'footer' => [

                        'previews' => $previews,
                        'leftsidenumbers' => explode(',', $leftsidenumbers),
                        'currentpage' => $currentpage,
                        'rightsidenumbers' => explode(',', $rightsidenumbers),
                        'next' => $next,
                        'numberofresults' => $numberofresults,
                        'allcount' => count($allcount),
                ],

        ];



    }







}





function userlogs($activity,$content){

        date_default_timezone_set('Asia/Manila');
        setlocale(LC_MONETARY, 'en_PH');

            if (isset(auth()->user()->id)) {
                    $user_id = auth()->user()->id;
                    $usertype = auth()->user()->usertype;
                    $user = auth()->user()->firstname.' '.auth()->user()->middlename.' '.auth()->user()->lastname; 

            } else {

                  $user_id = '';
                  $usertype = '';   
                  $content = ''; 

            }

            $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

            $userlog = new Userlog();
            $userlog->ip = $ip;
            $userlog->user_id = $user_id;
            $userlog->usertype = $usertype;
            $userlog->user = $user;
            $userlog->activity = $activity;
            $userlog->content = $content;
            $userlog->date = date("Y-m-d");
            $userlog->save(); 


   }