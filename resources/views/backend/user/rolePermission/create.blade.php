@extends(config('authorization.master_template'))
@section(config('authorization.content_area'))
<div class="row">
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                @if(isset($routes))
                <div class="row">
                    <div class="col-md-2" style="padding-top: 5px;">
                        <div class="btn check hiddenbutton"> 
                            <input type="checkbox" id="checkAll" style="display: none;"/>
                            <label for="checkAll" style="color:#00bf00;">
                                <i style="font-size: 30px" class="fa fa-check-circle" aria-hidden="true"> Check All</i>
                            </label>
                        </div>
                        <div  class="btn uncheck hiddenbutton"style="display:none;"> 
                            <input type="checkbox" id="uncheckAll" style="display: none;"/>
                            <label for="uncheckAll" style="color:#9f191f;">
                                <i style="font-size: 30px" class="fa fa-times-circle" aria-hidden="true"> Uncheck all</i>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <form id="live-search" action="" class="styled" method="post">
                            <fieldset>
                                <input type="text" class="form-control text-input" placeholder="Please Enter Keyword" id="filter" value="" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            <form action="{{ route('role_permission.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 search">
                            @if(isset($routes))
                            @foreach($routes as $id=>$route)
                            <input type="hidden" name="role_id" value="{!! $role_id !!}">
                            <label for="{!! $route->id !!}">
                                <input class="flat-green" type="checkbox" id="{!! $route->id !!}" name="routes[{!! $route->id !!}]" class="checksearch">
                                @if(isset($route->title) && $route->title != null)
                                <b>{!! $route->title !!}</b>
                                @elseif(isset($route->route_name) && $route->route_name != null)
                                <b>({!! $route->route_name !!})</b>
                                @else
                                <b>{!! $route->route_uri !!}</b>
                                @endif
                            </label>
                        </div>
                        <div class="col-md-3 search">
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 offset-md-5">
                            <input type="submit" value="Submit" class="btn btn-success pull-right">
                            <a href="{!! route('role_permission.index',$role_id) !!}" class="btn btn-danger">Cancel</a>
                        </div>
                        @else
                        <b>Route Dose not exist.</b>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('customJs')
<script>
    $(function(){
        $("#checkAll").change(function () {
            $("input:checkbox:visible").prop('checked',true);
            $('.icheckbox_square-green').addClass("checked");
            $(".check").hide();
            $(".uncheck").show();
        });
        $("#uncheckAll").change(function () {
            $("input:checkbox:visible").prop('checked',false);
            $('.icheckbox_square-green').removeClass("checked");
            $(".uncheck").hide();
            $(".check").show();
        });
    });
        ///search
        $(document).ready(function(){
            $("#filter").keyup(function(){
                // Retrieve the input field text and reset the count to zero
                var filter = $(this).val(), count = 0;
                // Loop through the comment list
                $(".search").each(function(){
                    // If the list item does not contain the text phrase fade it out
                    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                        $(this).fadeOut();
                        // Show the list item if the phrase matches and increase the count by 1
                    }
                    else {
                        $(this).show();
                        count++;
                    }
                });
                var numberItems = count;
                $("#filter-count").text("Number of Comments = "+count);
            });
        });
    </script>
    @endpush

    @push('css')
    <style type="text/css">

        input[type=checkbox] + label:before {
            display: none!important;
            cursor: pointer;
            background:red ! important; 
            color:white; 
            content:" Absent ";
            padding:8px 10px;
            display: inline-block;
            width: 100px; 
            text-align:center;  
        }

        input[type=checkbox]:checked + label:before {
            display: none!important;
            cursor: pointer;
            background:green ! important;   
            color:white ! important;
            content:"Present";
            padding:8px 8px; 
            display: inline-block;
            width: 100px; 

            text-align:center;
        }
    </style>
    @endpush