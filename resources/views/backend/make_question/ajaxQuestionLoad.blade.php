<table class="table table-bordered question-table">
	<tr class="text-center">
		<th width="85%">Question</th>
		<th>Mark</th>
		<th>Add</th>
	</tr>
	@foreach($questions as $question)
	<tr>
		<td>
			<div class="form-group">
				<input type="text" readonly name="question" id="question" class="form-control" value="{{ $question->question }}">
			</div>
		</td>
		<td>
			<div class="form-group">
				<label for="Mark" class="sr-only">Mark</label>
				<input type="text" onkeypress="return isNumberKey(event)"  name="mark" id="mark-{{ $question->id }}" class="form-control" value="">
			</div>
		</td>
		<td>
			<a href="javascript:void(0)" class="btn btn-primary" id="add_question_{{ $question->id }}">Add</a>
		</td>
	</tr>
	@endforeach
</table>