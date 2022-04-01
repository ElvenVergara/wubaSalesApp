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
use Illuminate\Support\Facades\Hash;

class POController extends Controller
{
    







    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getPOs(Request $request)
    {   

        $status = $request->status;
        $transaction_code = $request->transaction_code;
        $company = $request->company;
        $supplier_name = $request->supplier_name;
        $user_name = $request->user_name;
        $item_name = $request->item_name;
        $unit = $request->unit;
        $quantity = $request->quantity;
        $suppliers_price = $request->suppliers_price;
        $total = $request->total;
        $payment_terms = $request->payment_terms;
        $date = $request->date;

        // pagenumberview
        $pagenumber = $request->tablenum;



        if ( $transaction_code == '' &&
                $status == '' &&
                $company == '' &&
                $supplier_name == '' &&
                $user_name == '' &&
                $item_name == '' &&
                $unit == '' &&
                $quantity == '' &&
                $suppliers_price == '' &&
                $total == '' &&
                $payment_terms == '' &&
                $date == ''
            ) {

                 $alldata_count = PO::orderBy('date')->get();
 
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


             $alldata = PO::limit($limit)
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

                $alldata_count = PO::where('transaction_code', 'LIKE', '%'.$transaction_code.'%')
                                      ->where('status', 'LIKE', '%'.$status.'%' )
                                      ->where('company', 'LIKE', '%'.$company.'%' )
                                      ->where('supplier_name', 'LIKE', '%'.$supplier_name.'%' )
                                      ->where('user_name', 'LIKE', '%'.$user_name.'%' )
                                      ->where('item_name', 'LIKE', '%'.$item_name.'%' )
                                      ->where('unit', 'LIKE', '%'.$unit.'%' )
                                      ->where('quantity', 'LIKE', '%'.$quantity.'%' )
                                      ->where('suppliers_price', 'LIKE', '%'.$suppliers_price.'%' )
                                      ->where('total', 'LIKE', '%'.$total.'%' )
                                      ->where('payment_terms', 'LIKE', '%'.$payment_terms.'%' )
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


                $alldata = PO::where('transaction_code', 'LIKE', '%'.$transaction_code.'%')
                                  ->where('status', 'LIKE', '%'.$status.'%' )
                                  ->where('company', 'LIKE', '%'.$company.'%' )
                                  ->where('supplier_name', 'LIKE', '%'.$supplier_name.'%' )
                                  ->where('user_name', 'LIKE', '%'.$user_name.'%' )
                                  ->where('item_name', 'LIKE', '%'.$item_name.'%' )
                                  ->where('unit', 'LIKE', '%'.$unit.'%' )
                                  ->where('quantity', 'LIKE', '%'.$quantity.'%' )
                                  ->where('suppliers_price', 'LIKE', '%'.$suppliers_price.'%' )
                                  ->where('total', 'LIKE', '%'.$total.'%' )
                                  ->where('payment_terms', 'LIKE', '%'.$payment_terms.'%' )
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



        $allcount = PO::all();

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
















    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPO(Request $request)
    {
            
            $this->validate($request,[
                'transaction_code' => 'required',
                'supplier_id' => 'required',
                'item_id' => 'required',
                'quantity' => 'required',
                'suppliers_price' => 'required',
                'payment_terms' => 'required',
            ]);  

            $getSupplier = User::where('id', $request->supplier_id)->first();
            $getItem = Item::where('id', $request->item_id)->first();

            if ($getItem['suppliers_price'] != $request->suppliers_price) {
              
                $update = Item::where('id', $request->item_id)->update([

                                      'suppliers_price' => $request->suppliers_price,

                                ]);

            }

            $updateItem = Item::where('id', $request->item_id)->update([

                              'storage' => ($getItem['storage'] + $request->quantity),
                              'po_code' => $request->transaction_code,

                          ]);

            $total = intval($request->quantity) * $getItem['suppliers_price'];

            $newdata = New PO;
            $newdata->transaction_code = $request->transaction_code;
            $newdata->supplier_id = $request->supplier_id;
            $newdata->user_id = auth()->user()->id;
            $newdata->user_name = auth()->user()->firstname.' '.auth()->user()->middlename.' '.auth()->user()->lastname;
            $newdata->supplier_id = $request->supplier_id;
            $newdata->company = $getSupplier['company'];
            $newdata->supplier_name = $getSupplier['firstname'].' '.$getSupplier['middlename'].' '.$getSupplier['lastname'];
            $newdata->item_id = $request->item_id;
            $newdata->item_name = $getItem['item_name'];
            $newdata->unit = $getItem['unit'];
            $newdata->quantity = $request->quantity;
            $newdata->remaining_count = $request->quantity;
            $newdata->suppliers_price = $request->suppliers_price;
            $newdata->total = $total;
            $newdata->payment_terms = $request->payment_terms;
            $newdata->date = date('Y-m-d');
            $newdata->save();

            userlogs('Added a Purchase Order', $getItem->item_name);

    }




























    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deletepo(Request $request)
    {
            
        $get = PO::where('id', $request->id)->first();
        $getItem = Item::where('id', $get['item_id'])->first();

        if ($get['status'] == 'used') {
            return 'bad';
        } else {

            $get = PO::where('id', $request->id)->first();

            userlogs('Deleted a Purchase Order', $get->item_name);
            $delete = PO::where('id', $request->id)->delete();

            $update = Item::where('id', $get['item_id'])->update([

                            'storage' => $getItem['storage'] - $get['quantity'],

                      ]);


            return 'good';
        }

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