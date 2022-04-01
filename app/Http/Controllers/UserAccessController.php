<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserAccess;
 

class UserAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkUserAccess(Request $request)
    {
        
        $getAccess = UserAccess::where('usertype', auth()->user()->usertype)
                               ->where('access', $request->access)
                               ->get();

        if (count($getAccess) >= 1) {
            return 'good';
        } else {
            return 'bad';
        }

    }

    







     /**
         * Show the form for creating a new resource.
         * 
         * @return \Illuminate\Http\Response
         */
        public function getUserAccess(Request $request)
        {   

            $usertype = $request->usertype;
            $access = $request->access;

            // pagenumberview
            $pagenumber = $request->tablenum;



            if ( $usertype == '' &&
                   $access == ''
                ) {


                     $alldata_count = UserAccess::orderBy('usertype')->get();
        
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


                 $alldata = UserAccess::limit($limit)
                              ->offset($offset)
                              ->orderBy('usertype')
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

                    $alldata_count = UserAccess::where('usertype', 'LIKE', '%'.$usertype.'%')
                                          ->where('access', 'LIKE', '%'.$access.'%' )
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


                    $alldata = UserAccess::where('usertype', 'LIKE', '%'.$usertype.'%')
                                          ->where('access', 'LIKE', '%'.$access.'%' )
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



            $allcount = UserAccess::all();

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
        public function addaccess(Request $request)
        {
                
                $this->validate($request,[
                    'usertype' => 'required',
                    //'access' => 'required|unique:user_accesses,access',
                ]);  

                $newdata = New UserAccess;
                $newdata->usertype = $request->usertype;
                $newdata->access = $request->access;
                $newdata->save();

        }














        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function editaccess(Request $request)
        {

                $this->validate($request,[
                    'usertype' => 'required',
                    'access' => 'required|unique:user_accesses,access,'.$request->id,
                ]);   

                  $update = UserAccess::where('id', $request->id)->update([

                                  'usertype' => $request->usertype,
                                  'access' => $request->access,

                            ]);

        }






        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function deleteaccess(Request $request)
        {
              
            $delete = UserAccess::where('id', $request->id)->delete();

        }







        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function getAccessforEdit(Request $request)
        {
              
            return $get = UserAccess::where('id', $request->id)->first();

        }




}
