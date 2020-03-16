<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequestRequest;
use App\Http\Requests\UpdateReservationRequestRequest;
use App\Repositories\ReservationRequestRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\ReservationRequest;
use function Helper\Common\imageUrl;

class ReservationRequestController extends AppBaseController
{
    /** @var  ReservationRequestRepository */
    private $reservationRequestRepository;

    public function __construct(ReservationRequestRepository $reservationRequestRepo)
    {
        parent::__construct();
        $this->reservationRequestRepository = $reservationRequestRepo;
    }







    /**
     * Display a listing of the ReservationRequest.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->reservationRequestRepository->pushCriteria(new RequestCriteria($request));
        $reservationRequests = $this->reservationRequestRepository->all();
        */

        return view('reservation_requests.index');
        /*return view('reservation_requests.index')
             ->with('reservationRequests', $reservationRequests);*/
    }



    /**
     * Show the form for creating a new ReservationRequest.
     *
     * @return Response
     */
    public function create()
    {
        return view('reservation_requests.create');
    }

    /**
     * Store a newly created ReservationRequest in storage.
     *
     * @param CreateReservationRequestRequest $request
     *
     * @return Response
     */
    public function store(CreateReservationRequestRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $reservationRequest = $this->reservationRequestRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('reservationRequests.index'));
    }

    /**
     * Display the specified ReservationRequest.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reservationRequest = $this->reservationRequestRepository->findWithoutFail($id);

        if (empty($reservationRequest)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('reservationRequests.index'));
        }

        return view('reservation_requests.show')->with('reservationRequest', $reservationRequest);
    }

    /**
     * Show the form for editing the specified ReservationRequest.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reservationRequest = $this->reservationRequestRepository->findWithoutFail($id);

        if (empty($reservationRequest)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('reservationRequests.index'));
        }

        return view('reservation_requests.edit')->with('reservationRequest', $reservationRequest);
    }

    /**
     * Update the specified ReservationRequest in storage.
     *
     * @param  int              $id
     * @param UpdateReservationRequestRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReservationRequestRequest $request)
    {


        $reservationRequest = $this->reservationRequestRepository->findWithoutFail($id);

        if (empty($reservationRequest)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('reservationRequests.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $reservationRequest = $this->reservationRequestRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('reservationRequests.index'));
    }

    /**
     * Remove the specified ReservationRequest from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        /*
         if($request->ids != null AND count($request->ids) > 0)
         {
             foreach ($request->ids as $id)
             {
                 $this->reservationRequestRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('reservationRequests.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('reservationRequests.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->reservationRequestRepository->delete($id);
            }
        }
        else
        {
            $data['message'] = 'برجاء تحديد بيانات المراد حذفها';
            $data['success'] = false;
            return $data;
        }
        $data['message'] = 'تم الحذف بنجاح';
        $data['success'] = true;
        return $data;

    }

    public function data() {
            $items = ReservationRequest::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (ReservationRequest $item) {
                $back = ' <div class="btn-group">';
                 $back .= '
               
                <a type="button" href="'. route('reservationRequests.show' ,[$item->id]).'" class="btn btn-outline-primary btn-icon m-1">
                                                                                 <span class="ul-btn__icon"><i class="i-Eyeglasses-Smiley"></i></span>
                                  </a>
                   </div>';
                  return $back;


                })
                /*
                 ->addColumn("active",function(ReservationRequest $item){
                    if($item->active == 1)
                    {
                        $back = '<a class="btn btn-warning" onclick="changeActive(this)" data-id="'.$item->id.'">';
                        $back.= "اقفال التفعيل"."</a>";
                    }
                    else
                    {
                        $back = '<a class="btn btn-success" onclick="changeActive(this)" data-id="'.$item->id.'">';
                        $back.= "تفعيل"."</a>";
                    }
                    return $back;
                 })
                 ->editColumn('image', function (ReservationRequest $item) {
                    $back = ' <img src= "'.imageUrl($item->image).'" class="img-circle" style="width:75px;height:75px;" >';
                    return $back;
                 })
                 */
                ->editColumn("id",function($item){
                 $back = '<div class="btn-group">';
                                    $back.='
                                    <label class="checkbox checkbox-primary" for="'.$item->id.'">
                                                <input id="'.$item->id.'" type="checkbox" name="ids[]" value="'.$item->id.'">
                                                <span class="checkmark"></span>
                                            </label>';
                                    $back .= '
                                    </div>';


                    return $back;
                })
                ->rawColumns(['options', 'active'])
                ->escapeColumns([])
                ->make(true);
        }


}
