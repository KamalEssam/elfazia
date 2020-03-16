<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChatRoomRequest;
use App\Http\Requests\UpdateChatRoomRequest;
use App\Models\Chat;
use App\Repositories\ChatRoomRepository;
use function Helper\Common\__lang;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\ChatRoom;
use function Helper\Common\imageUrl;

class ChatRoomController extends AppBaseController
{
    /** @var  ChatRoomRepository */
    private $chatRoomRepository;

    public function __construct(ChatRoomRepository $chatRoomRepo)
    {
        parent::__construct();
        $this->chatRoomRepository = $chatRoomRepo;
    }







    /**
     * Display a listing of the ChatRoom.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->chatRoomRepository->pushCriteria(new RequestCriteria($request));
        $chatRooms = $this->chatRoomRepository->all();
        */

        return view('chat_rooms.index');
        /*return view('chat_rooms.index')
             ->with('chatRooms', $chatRooms);*/
    }



    /**
     * Show the form for creating a new ChatRoom.
     *
     * @return Response
     */
    public function create()
    {
        return view('chat_rooms.create');
    }


    /**
     * @param $id
     * @return array
     */
    public function roomDetails($order_id)
    {
        $chatRoom = ChatRoom::where("order_id",$order_id)->first();

        if (empty($chatRoom)) {
            $data['success'] = false;
            $data['message'] = __lang("error_no_data");
            return $data;
        }
        $messages = $chatRoom->messages()->orderBy("id")->get();

        $result = array();
        /** @var Chat $message */
        foreach ($messages as $message)
        {
            $result[] = $message->transformAdmin();
        }


        return $result;

    }

    /**
     * Store a newly created ChatRoom in storage.
     *
     * @param CreateChatRoomRequest $request
     *
     * @return Response
     */
    public function store(CreateChatRoomRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $chatRoom = $this->chatRoomRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('chatRooms.index'));
    }

    /**
     * Display the specified ChatRoom.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $chatRoom = $this->chatRoomRepository->findWithoutFail($id);

        if (empty($chatRoom)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('chatRooms.index'));
        }

        return view('chat_rooms.show')->with('chatRoom', $chatRoom);
    }

    /**
     * Show the form for editing the specified ChatRoom.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $chatRoom = $this->chatRoomRepository->findWithoutFail($id);

        if (empty($chatRoom)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('chatRooms.index'));
        }

        return view('chat_rooms.edit')->with('chatRoom', $chatRoom);
    }

    /**
     * Update the specified ChatRoom in storage.
     *
     * @param  int              $id
     * @param UpdateChatRoomRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChatRoomRequest $request)
    {


        $chatRoom = $this->chatRoomRepository->findWithoutFail($id);

        if (empty($chatRoom)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('chatRooms.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $chatRoom = $this->chatRoomRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('chatRooms.index'));
    }

    /**
     * Remove the specified ChatRoom from storage.
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
                 $this->chatRoomRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('chatRooms.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('chatRooms.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->chatRoomRepository->delete($id);
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
            $items = ChatRoom::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (ChatRoom $item) {
                    $back = ' <div class="btn-group">';
                    $back .= '
                        <a href="'. route('chatRooms.show' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
                        <a href="'. route('chatRooms.edit' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                    </div>';
                    return $back;
                })
                /*
                 ->addColumn("active",function(ChatRoom $item){
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
                 ->editColumn('image', function (ChatRoom $item) {
                    $back = ' <img src= "'.imageUrl($item->image).'" class="img-circle" style="width:75px;height:75px;" >';
                    return $back;
                 })
                 */
                ->editColumn("id",function($item){
                    $back = '<div class="checkbox checkbox-danger">';
                    $back.='
                        <input id="'.$item->id.'" type="checkbox" name="ids[]" value="'.$item->id.'">';
                    $back .= '
                        <label for="'.$item->id.'">  </label>
                    </div>';

                    return $back;
                })
                ->rawColumns(['options', 'active'])
                ->escapeColumns([])
                ->make(true);
        }


}
