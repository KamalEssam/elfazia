<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Repositories\ChatRepository;
use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\Chat;
use function Helper\Common\imageUrl;

class ChatController extends AppBaseController
{
    /** @var  ChatRepository */
    private $chatRepository;

    public function __construct(ChatRepository $chatRepo)
    {
        parent::__construct();
        $this->chatRepository = $chatRepo;
    }







    /**
     * Display a listing of the Chat.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    /*
        $this->chatRepository->pushCriteria(new RequestCriteria($request));
        $chats = $this->chatRepository->all();
        */

        return view('chats.index');
        /*return view('chats.index')
             ->with('chats', $chats);*/
    }



    /**
     * Show the form for creating a new Chat.
     *
     * @return Response
     */
    public function create()
    {
        return view('chats.create');
    }

    /**
     * Store a newly created Chat in storage.
     *
     * @param CreateChatRequest $request
     *
     * @return Response
     */
    public function store(CreateChatRequest $request)
    {

        $input = $request->request->all();

        $input['image'] = $this->uploadFile($request,"image",true);

        $chat = $this->chatRepository->create($input);

        Flash::success('تم حفظ البيانات بنجاح');

        return redirect(route('chats.index'));
    }

    /**
     * Display the specified Chat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $chat = $this->chatRepository->findWithoutFail($id);

        if (empty($chat)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('chats.index'));
        }

        return view('chats.show')->with('chat', $chat);
    }

    /**
     * Show the form for editing the specified Chat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $chat = $this->chatRepository->findWithoutFail($id);

        if (empty($chat)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('chats.index'));
        }

        return view('chats.edit')->with('chat', $chat);
    }

    /**
     * Update the specified Chat in storage.
     *
     * @param  int              $id
     * @param UpdateChatRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChatRequest $request)
    {


        $chat = $this->chatRepository->findWithoutFail($id);

        if (empty($chat)) {
            Flash::error('عفوا خطأ في البيانات برجاء محاولة مره اخري');

            return redirect(route('chats.index'));
        }


        $input = $request->request->all();

        if($request->hasFile("image"))
            $input['image'] = $this->uploadFile($request,"image",true);

        $chat = $this->chatRepository->update($input, $id);

        Flash::success('تم تعديل البيانات بنجاح');

        return redirect(route('chats.index'));
    }

    /**
     * Remove the specified Chat from storage.
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
                 $this->chatRepository->delete($id);
             }
         }
         else
         {
             Flash::error('برجاء تحديد بيانات المراد حذفها');
             return redirect(route('chats.index'));
         }
        Flash::success('تم الحذف بنجاح');

        return redirect(route('chats.index'));
         */

        if($request->ids != null AND count($request->ids) > 0)
        {

            foreach ($request->ids as $id)
            {
                $this->chatRepository->delete($id);
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
            $items = Chat::select();

            return DataTables::eloquent($items)
                ->addColumn('options', function (Chat $item) {
                    $back = ' <div class="btn-group">';
                    $back .= '
                        <a href="'. route('chats.show' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
                        <a href="'. route('chats.edit' ,[$item->id]).'" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                    </div>';
                    return $back;
                })
                /*
                 ->addColumn("active",function(Chat $item){
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
                 ->editColumn('image', function (Chat $item) {
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
