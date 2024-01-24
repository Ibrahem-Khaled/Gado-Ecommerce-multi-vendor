@extends('layouts.app')

@section('style')

<style type="text/css">
	#avatar{
		width: 100%;
		height: 300px;
	}
	#avatar:hover{
		width: 100%;
		height: 300px;
		cursor: pointer;
	}
	.marbo{
		margin-bottom: 10px
	}

	.img img{
		width:150px;
		height:150px;
		margin-right:20px;
		margin-top:20px;
	}

	#gallery-photo-add {
    display: inline-block;
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 50px;
    top: 0;
    left: 0;
    opacity: 0;
    cursor: pointer;
}
</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12">
          <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0" style="display: inline;">تعديل البانر <i class="fas fa-exclamation-circle" style="cursor: pointer;color:#FFC107" data-toggle="modal" data-target="#modal-secondary"></i></h5>
              </div>

              <div class="card-body">
                <form action="{{route('UpdatePannar')}}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="{{ $data->id }}">
				{{csrf_field()}}
                    <div class="row">
                      <div class="col-sm-4 marbo">
                          
                          <label class="text-primary">إختيار صورة <span class="text-danger"> * </span></label>
                            <input type="file" name="image" accept="image/*" onchange="loadAvatar(event)" style="display: none;" >
                            <img src="{{asset('uploads/panners/'.$data->image)}}" style="width: 100%;height:200px" onclick="ChooseAvatar()" id="avatar">
                        </div>
                        <div class="col-sm-8">
                          <div class="row">
                            <div class="col-sm-6">
                              <label class="text-primary">إسم البانر</label> <span class="text-danger">*</span>
                              <input type="text" name="name_ar" class="form-control" value="{{ $data->name_ar }}" placeholder="إسم البانر " required="" style="margin-bottom: 10px">
                            </div>
                            <div class="col-sm-6">
                              <label class="text-primary">إسم البانر بالانجليزي</label> <span class="text-danger">*</span>
                              <input type="text" name="name_en" class="form-control" value="{{ $data->name_en }}" placeholder=" إسم البانر بالانجليزي" required="" style="margin-bottom: 10px">
                            </div>
                            <div class="col-sm-3">
                              <label class="text-primary"> السعر من</label> <span class="text-danger">*</span>
                              <input type="number" name="price_from" class="form-control" value="{{ $data->price_from }}" step="0.01" required="">
                            </div>
                            <div class="col-sm-3">
                              <label class="text-primary">  السعر الي</label> <span class="text-danger">*</span>
                              <input type="number" name="price_to" class="form-control" value="{{ $data->price_to }}" step="0.01" required="">
                            </div>
                            {{-- categories --}}
                            <div class="col-sm-6" >
                              <div class="from-group">
                                <label class="text-primary">الأقسام : <span class="text-danger">*</span></label>
                                <select required class="form-control" id="select-gear" name="sections[]" multiple>
                                    @foreach($sections as $cat)

                                  @if(in_array($cat->id, $secs))
                                    <option class="major" selected value="{{ $cat->id }}"><span style="margin-right: 3px">{{ $cat->name_ar }}</span>
                                  @else
                                    <option class="major" value="{{ $cat->id }}"><span style="margin-right: 3px">{{ $cat->name_ar }}</span>
                                  @endif

                                                      
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            {{-- type --}}
                            <div class="col-sm-6">
                              <div class="from-group">
                                <label class="text-primary">ألنوع : <span class="text-danger">*</span></label>
                                <select required class="form-control" id="select-gear" name="type" >
                                <option value="" disabled selected>إختيار </option>
                                        <option value="1" @if($data->type == '1') selected @endif>عادي</option>
                                        <option value="2" @if($data->type == '2') selected @endif>سلايدر</option>
                                 
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="from-group">
                                <label class="text-primary">ألنوع : <span class="text-danger">*</span></label>
                                <select required class="form-control" id="select-gear" name="kind" >
                                <option value="1" @if($data->kind == '1') selected @endif>متجر التكييفات</option>
                                <option value="2" @if($data->kind == '2') selected @endif>العدد والأدوات اليدوية</option>
                                 
                                </select>
                              </div>
                            </div>
                          </div>
                         </div>
                         {{--  discription  --}}
                          <div class="col-sm-12">
                              <hr>
                              <div class="row">
                                  <div class="col-sm-6">
                                      <label class="text-primary">وصف البانر بالعربية  : <span class="text-primary">*</span></label>
                                      <textarea class="form-control"  name="desc_ar" id="editor1" rows="6" cols="80" required>{{ $data->desc_ar }}</textarea>
                                  </div>
                                  <div class="col-sm-6">
                                      <label class="text-primary">وصف البانر بالإنجليزية  : <span class="text-primary">*</span></label>
                                      <textarea class="form-control"  name="desc_en" id="editor1" rows="6" cols="80" required>{{ $data->desc_en }}</textarea>
                                  </div>
                              </div>
                          </div>
                       


                      <button style="width: 50%; margin-left: auto; margin-top:30px; margin-right: auto; " type="submit" class="btn btn-outline-primary btn-block">إضافة</button>
                    </div>
                </form>
              </div>
          </div>
        </div>
       
    </div>
@endsection

@section('script')
<script type="text/javascript">
        var option = {
        language: 'ar',
        uiColor: '#9AB8F3'
        }
    CKEDITOR.replace( 'desc_ar',option );
    CKEDITOR.replace( 'desc_en',option );
//edit image
function ChooseAvatar(){$("input[name='image']").click()}
var loadAvatar = function(event) {
var output = document.getElementById('avatar');
output.src = URL.createObjectURL(event.target.files[0]);
};

	


</script>
@endsection


