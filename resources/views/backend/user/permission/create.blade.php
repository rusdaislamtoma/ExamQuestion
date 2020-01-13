@extends(config('authorization.master_template'))
@section(config('authorization.content_area'))
<div class="row">
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
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
                    <div class="col-md-6" style="padding-top: 5px;">
                        <form id="live-search" action="" class="styled" method="post">
                            <fieldset>
                                <input type="text" class="form-control text-input" placeholder="Please enter keyword" id="filter" value="" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <form action="{{ route('permission.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 search">
                            @forelse($routes as $id=>$route)
                            <label for="{!! $id !!}">
                                <input class="flat-green" type="checkbox" id="{!! $id !!}" name="routes[{!! $route->uri() !!}]">
                                @if(isset($route->action['title']))
                                <b>{!! $route->action['title'] !!}</b>
                                <input type="hidden" name="route_titles[{!! $route->uri() !!}]" value="{!! $route->action['title'] !!}">
                                @elseif(isset($route->action['as']))
                                <b>{!! $route->action['as'] !!}</b>
                                <input type="hidden" name="route_names[{!! $route->uri() !!}]" value="{!! $route->action['as'] !!}">
                                @else
                                <b>{!! $route->uri() !!}</b>
                                @endif

                            </label>

                        </div><div class="col-md-3 search">
                            @empty

                            @endforelse
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 offset-md-5">
                            <input type="submit" value="Save" class="btn btn-success">
                            <a href="{!! route('permission.index') !!}" class="btn btn-danger" onclick="return confirm('Are you sure to cancel?')">Cancel</a>
                        </div>
                    </div>
                </div>

            </form>
            <div class="box-footer">
            </div>

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
            $("input:checkbox:visible").prop('checked', false);
            $('.icheckbox_square-green').removeClass("checked");
            $(".uncheck").hide();
            $(".check").show();
        });

    });

        ///search
        $(document).ready(function(){
            $("#filter").keyup(function(){
//                $('.hiddenbutton').hide();
                // Retrieve the input field text and reset the count to zero
                var filter = $(this).val(), count = 0;
                // Loop through the comment list
                $(".search").each(function(){

                    // If the list item does not contain the text phrase fade it out
                    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                        $(this).fadeOut();
//                        $('.permissions').removeClass('hiddenPermission');

                        // Show the list item if the phrase matches and increase the count by 1
                    } else {
                        $(this).addClass('hiddenPermission');
                        $(this).show();
                        count++;
                    }
                });

                // Update the count
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