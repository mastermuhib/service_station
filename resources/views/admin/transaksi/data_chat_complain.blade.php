@foreach($chat as $cm)
    @if($cm->type == '1')
    <div class="new-member-list">
        <div class="d-flex align-items-center">
            <img src="{{$cm->profile}}" alt="" class="avatar">
            <div>
                <h6>{{$cm->user_name}}<span class="text-muted ml-15" style="font-size: 12px;font-weight: 300;">{{ $cm->text_time }}</span></h6>
            </div>
        </div>
    </div>
    <div class="div_left p-3">
        <div class="text-dark font-sm p-3" style="background: white;width: 70%;border-radius: 1px 15px 15px 30px;border: 1px solid #eeeeee;">
            {!! $cm->chat !!}
        </div>
        @if($cm->file != null)
        <div class="row mt-2">
            <div class="col-md-4 col-10">
                <div class="card card-user mb-0">
                    @if($cm->is_video == 1)
                    <video width="320" height="240" controls>
                      <source src="{{$cm->file}}" type="video/mp4">
                      <source src="{{$cm->file}}" type="video/ogg">
                      Your browser does not support the video tag.
                    </video>
                    @else
                    <img src="{{$cm->file}}" style="width: 100%">
                    @endif
                </div>
            </div>
            <div class="col-md-8 col-2">
                
            </div>
        </div>
        @endif
        <span class="text-muted p-pointer d-none" style="font-size: 12px;font-weight: 500;">1 Balasan</span>
    </div>
    @elseif($cm->type == '2')
    <div class="new-member-list" style="float: right;"> 
        <div class="d-flex align-items-center">
            <div>
                <h6><span class="text-muted mr-15" style="font-size: 12px;font-weight: 300;">{{ $cm->text_time }}</span>{{$cm->shop_name}}</h6>
            </div>
            <img src="{{$cm->shop_icon}}" alt="" class="avatar">
        </div>
    </div>
    <br>
    <div class="col-md-12 mt-30">
        <div class="row"> 
            <div class="col-3">   
            </div> 
            <div class="col-9">
                
                <div class="text-dark font-sm p-3" style="background: #c0ffcf;border-radius: 15px 1px 30px 15px;text-align: right;">
                    {!! $cm->chat !!}
                </div>
                @if($cm->file != null)
                <div class="row mt-2">
                    <div class="col-md-8 col-2">
                        
                    </div>
                    <div class="col-md-4 col-10">
                        <div class="card card-user mb-0">
                            @if($cm->is_video == 1)
                            <video width="320" height="240" controls>
                              <source src="{{$cm->file}}" type="video/mp4">
                              <source src="{{$cm->file}}" type="video/ogg">
                              Your browser does not support the video tag.
                            </video>
                            @else
                            <img src="{{$cm->file}}" style="width: 100%">
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                <p class="text-muted p-pointer d-none" style="font-size: 12px;font-weight: 500;text-align: right;">1 Balasan</p>
            </div>
        </div>  
    </div>
    @else
    <div class="new-member-list" style="float: right;"> 
        <div class="d-flex align-items-center">
            <div>
                <h6><span class="text-muted mr-15" style="font-size: 12px;font-weight: 300;">{{ $cm->text_time }}</span>{{$cm->admin_name}}</h6>
            </div>
            <img src="{{$cm->foto_admin}}" alt="" class="avatar">
        </div>
    </div>
    <br>
    <div class="col-md-12 mt-30">
        <div class="row"> 
            <div class="col-3">   
            </div> 
            <div class="col-9">
                
                <div class="text-dark font-sm p-3" style="background: #c0e6ff;border-radius: 15px 1px 30px 15px;text-align: right;">
                    {!! $cm->chat !!}
                </div>
                @if($cm->file != null)
                <div class="row mt-2">
                    <div class="col-md-8 col-2">
                        
                    </div>
                    <div class="col-md-4 col-10">
                        <div class="card card-user mb-0">
                            @if($cm->is_video == 1)
                            <video width="320" height="240" controls>
                              <source src="{{$cm->file}}" type="video/mp4">
                              <source src="{{$cm->file}}" type="video/ogg">
                              Your browser does not support the video tag.
                            </video>
                            @else
                            <img src="{{$cm->file}}" style="width: 100%">
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                <p class="text-muted p-pointer d-none" style="font-size: 12px;font-weight: 500;text-align: right;">1 Balasan</p>
            </div>
        </div>  
    </div>
    @endif
@endforeach