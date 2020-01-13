
<script>
    i=0;
$(document).ready(function(){
    $("#add_new_question").click(function(){
        i++;
        $('#question').append('\n' +
            '    <div class="col-md-3" style="clear:left;float: left">\n' +
            '           <div class="form-group" >\n' +
            '                    <label>Question:<span style="color:red">*</span></label>\n' +
            '                    <textarea  name="question[]" rows="2" cols="50" class="form-control border border-info" placeholder="Enter Question"\n' +
            '                                required></textarea>\n' +
            '          </div>\n' +
            '    </div>\n' +
            '\n' +
            '  <div class="col-md-3" style="float: left; height: 20px;">\n' +
            '            <div class="form-group" >\n' +
            '                <label>Image:</label>\n' +
            '                <input id="fileId" type="file" name="image'+i+'" class="form-control border border-info"/>\n' +
            '            </div>\n' +
            '    </div>\n'+
            '  <div class="col-md-3" style="float: left">\n' +
            '            <div class="form-group" >\n' +
            '                <label>Option 1:</label>\n' +
            '                <input type="text" value="" name="option'+i+'[]" class="form-control border border-info" placeholder="Enter Option" >\n' +
            '            </div>\n' +
            '    </div>\n'+
            '  <div class="col-md-3" style="float: left">\n' +
            '            <div class="form-group" >\n' +
            '                <label>Option 2:</label>\n' +
            '                <input type="text" value="" name="option'+i+'[]" class="form-control border border-info" placeholder="Enter Option" >\n' +
            '            </div>\n' +
            '    </div>\n'+
            '  <div class="col-md-3" style="float: left">\n' +
            '            <div class="form-group" >\n' +
            '                <label>Option 3:</label>\n' +
            '                <input type="text" value="" name="option'+i+'[]" class="form-control border border-info" placeholder="Enter Option" >\n' +
            '            </div>\n' +
            '    </div>\n'+

            '  <div class="col-md-3" style="float: left">\n' +
            '            <div class="form-group" >\n' +
            '                <label>Option 4:</label>\n' +
            '                <input type="text" value="" name="option'+i+'[]" class="form-control border border-info" placeholder="Enter Option" >\n' +
            '            </div>\n' +
            '    </div>\n'+
            '    <div class="col-md-3" style="float: left">\n' +
            '        <div class="form-group" >\n' +
            '            <label>Marks: <span style="color:red">*</span></label>\n' +
            '            <input type="number" value="" name="mark[]" step="0.01" class="form-control border border-info" placeholder="Enter Marks" required >\n' +
            '        </div>\n' +
            '    </div>\n');
    });

});
</script>



