@extends('layouts.backend.master')
@section('content')
    <style>
        .item:nth-child(odd) {
            border-right: 1px solid black;
        }
        @media print {
            #print_btn {
                display :  none;
            }
            #cancel_btn {
                display :  none;
            }
        }

    </style>
    <div class="card card-info card-outline" id="printarea">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <h3 class="text-center">{{ $school->name }}</h3>
                <h4 class="text-center">{{ $grade->name }}</h4>
                <p class="text-center">Subject: {{ $subject->name }}</p>
                <p class="text-center">Subject Code: {{ $subject->code_no }}</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <p>Time: {{ $subject->mcq_time }} Hour</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <p class="text-right">Total Marks: {{ $marks }}</p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @php
                        $array = ['A','B','C','D'];
                    @endphp
                    @foreach($questions as $key=>$question)

                        <div class="col-md-6 item">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ $key+1 }}. &nbsp;{{ $question->question  }} &nbsp;{{ '('.$question->mark.')'  }}
                                </div>
                                    <img style="width:40%;" src="{{ asset($question->image) }}" alt="">
                                <div class="form-group">
                                    @php
                                        $options = json_decode($question->option);
                                    @endphp
                                    @foreach($options as $key=>$option)
                                       <div>
                                           &nbsp;&nbsp;&nbsp;&nbsp;
                                           {{ $array[$key] }}.&nbsp;{{ $option }}
                                       </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-6 offset-md-5">
                        <input type='button' id='print_btn' value='Print Question' class="btn btn-primary">
                        <a  id='cancel_btn' href="{{ route('admin.make.question.index',$subject->slug) }}" class="btn btn-danger ml-2" onclick="return confirm('Are you sure?')">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('customJs')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#print_btn").click(function () {
                window.print();
            });
        });

    </script>
@endpush
