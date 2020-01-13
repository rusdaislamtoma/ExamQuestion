
<script>
    var export_data = [];

    $(document).ready(function(){

        $("#sectionId").change(function(){
            //alert('hello');
            $('#difficultyId').html('<option value="" disabled selected>Select Difficulty</option>');
            var sectionId = $(this).val();
            var url = "{{url('ajaxChapterLoadBySectionIdforwritten')}}" +"/"+ sectionId;
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    $('#chapterId').html(data);

                }
            });
        });

        $("#chapterId").change(function(){
            var chapter_id = $(this).val();
            var sectionId = $('#sectionId').val();
            var url = "{{url('ajaxDifficultyLoadByChapterIDforwritten')}}" +"/"+ sectionId+"/"+ chapter_id;
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    $('#difficultyId').html(data);
                }
            });
        });



    });


</script>



