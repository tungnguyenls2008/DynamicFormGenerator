<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormDetail;
use App\Models\FieldValue;
use App\Models\FormData;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Request;
use jazmy\FormBuilder\Traits\HasFormBuilderTraits;
use Verot\Upload\Upload;

class FormDetailController extends Controller
{
    use HasFormBuilderTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id;
        $formData = FormData::where('form_id', $id)->get();

        return view('formDetails.index',compact('formData'));

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
        $data = $request->all();
        $id = $data['form_id'];
        unset($data['_token'],$data['form_id']);
        if (!isset($data['files'])){
            $data = serialize($data);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $dt=date("Y-m-d H:i:s");
            $formData = new FormData;
            $formData->form_id = $id;
            $formData->name = $dt;
            $formData->data = $data;
            $formData->save();
        }

        else {

            $handle = new Upload($data['files'][0]);
            $handle->process('uploads/test');

            rename($handle->file_dst_pathname,'uploads/test/'.$handle->file_dst_name_body.'.mp4');
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $dt=date("Y-m-d H:i:s");
            $data = serialize(['file'=>'uploads/test/'.$handle->file_dst_name_body.'.mp4']);
            $formData = new FormData;
            $formData->form_id = $id;
            $formData->name = $dt;
            $formData->data = $data;
            $formData->save();
        }

        return redirect('form');
    }


    public function show($id)
    {

        $form = Form::where('id', $id)->first();
        $formDetail = FormDetail::where('form_id', $id)->get();
        $html = '<form enctype="multipart/form-data" action="'.route('showform.store').'" method="POST"> '. csrf_field() ;
        $html .= '<input type="hidden" name="form_id" value="'.$id.'">';
        foreach($formDetail as $item){
            if($item->field_type == "textarea"){
                $html .= '<div class="form-group"><label for="'.$item->field_name.'">'.$item->field_label.'</label>';
                $html .= '<textarea class="form-control" name="'.$item->field_name.'" id="'.$item->field_name.'"></textarea></div>';
            }
            else if($item->field_type == "select"){
                $html .= '<div class="form-group"><label for="'.$item->field_name.'">'.$item->field_label.'</label>';
                $html .= '<select name="'.$item->field_name.'" id="'.$item->field_name.'" class="form-control">';
                $FieldValue = FieldValue::where('form_details_id', $item->id)->get();

                foreach($FieldValue as $value){
                    $html .= '<option value="'.$value->field_value.'">'.$value->field_label.'</option>';
                }
                $html .= '</select></div>';
            }
            else if($item->field_type == "radio"){
                $html .= '<div class="form-group"><label for="'.$item->field_name.'">'.$item->field_label.'</label>';
                $FieldValue = FieldValue::where('form_details_id', $item->id)->get();

                foreach ($FieldValue as $value) {
                    $html .= '<div class="form-check">';
                    $html .= '<input class="form-check-input" type="radio" name="'.$item->field_name.'" id="'.$item->field_name.'" value="'.$value->field_value.'">';
                    $html .= '<label class="form-check-label" for="'.$value->field_value.'"> '.$value->field_label.' </label></div>';
                }

            }
            else if($item->field_type == "checkbox"){
                $html .= '<div class="form-group">';
                $html .= '<input type="'.$item->field_type.'" id="'.$item->field_name.'" name="'.$item->field_name.'" class="form-check-input ml-1">';
                $html .= '<label class="form-check-label ml-4" for="'.$item->field_name.'">'.$item->field_label.'</label></div>';
            }
            else if ($item->field_type == "file"){
                $html .= '<div class="form-group">';
                $html .= '<input type="'.$item->field_type.'" id="'.$item->field_name.'" name="files[]" class="form-check-input ml-1">';
                $html .= '<label class="form-check-label ml-4" for="'.$item->field_name.'">'.$item->field_label.'</label></div>';

            }
            else {
                $html .= '<div class="form-group"><label for="'.$item->field_name.'">'.$item->field_label.'</label>';
                $html .= '<input type="'.$item->field_type.'" name="'.$item->field_name.'" id="'.$item->field_name.'" class="form-control"></div>';
            }
        }
        $html .= '<div class="row"><button class="btn btn-primary offset-1 col-3">Xác nhận & Lưu dữ liệu</button></div>';
        $html .= '</form>';

        return view('formDetails.show',compact('form', 'html'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormDetail  $formDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(FormDetail $formDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormDetail  $formDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormDetail $formDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormDetail  $formDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormDetail $formDetail)
    {
        //
    }
    public function saveJsonFromFormBuilder(Request $request){
        return $request->json_form;

    }
}
