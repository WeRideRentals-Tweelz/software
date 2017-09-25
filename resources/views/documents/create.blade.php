@extends('layouts.main')

@section('styles')
	<style type="text/css">
		.buttonSeparator
		{
			display: inline-block;
			width: 50px;
		}
	</style>
@stop

@section('content')
<form action="{{ isset($document) ? '/documents/'.$document->id : '/documents' }}" method="POST">
	{{ csrf_field() }}
	
	@if(isset($document))
		<input type="hidden" name="_method" value="PATCH">
	@endif
	
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">
					<input type="text" name="name" value="{{ $document->name or old('name') }}" placeholder="Document's name" style="width:100%">
				</h1>
			</div>
			<div class="panel-body">
				<!-- Text Edition Buttons -->
				<a type="button" id="bold" class="btn btn-default styleButton" title="bold"><span class="glyphicon glyphicon-bold"></span></a>
				<a type="button" id="italic" class="btn btn-default styleButton" title="italic"><span class="glyphicon glyphicon-italic"></span></a>
				<a type="button" id="underline" class="btn btn-default styleButton" title="undeline"><span class="glyphicon glyphicon-text-width"></span></a>

				<span class="buttonSeparator"></span>

				<a type="button" id="insertOrderedList" class="btn btn-default styleButton" title="ordered list"><span class="glyphicon glyphicon-list-alt"></span></a>
				<a type="button" id="insertOrderedList" class="btn btn-default styleButton" title="unordered list"><span class="glyphicon glyphicon-list-alt"></span></a>

				<span class="buttonSeparator"></span>

				<a type="button" id="indent" class="btn btn-default styleButton" title="indent"><span class="glyphicon glyphicon-indent-left"></span></a>
				<a type="button" id="outdent" class="btn btn-default styleButton" title="indent"><span class="glyphicon glyphicon-indent-right"></span></a>

				<span class="buttonSeparator"></span>
				
				<a type="button" id="justifyLeft" class="btn btn-default styleButton alignButton active"><span class="glyphicon glyphicon-align-left"></span></a>
				<a type="button" id="justifyCenter" class="btn btn-default styleButton alignButton"><span class="glyphicon glyphicon-align-center"></span></a>
				<a type="button" id="justifyRight" class="btn btn-default styleButton alignButton"><span class="glyphicon glyphicon-align-right"></span></a>
				<a type="button" id="justifyFull" class="btn btn-default styleButton alignButton"><span class="glyphicon glyphicon-align-justify"></span></a>


				<br>
				<br>
				<div class="row">
					<div class="well well-lg">
						<iframe frameborder="0" id="textEditor" style="border:1px silver solid;width: 100%; height: 430px;">
							
						</iframe>
					</div>
				
					<textarea class="hidden" name="content" id="textContent">
					</textarea>

					<div id="oldDocument" class="hidden">
						@if(isset($document->content))
							<?php print($document->content) ?>
						@endif
					</div>
					
				</div>
				
			</div>
			<div class="panel-footer">
				<button id="saveButton" type="submit" class="btn btn-primary">
					@if(isset($document))
						Update
					@else
						Create
					@endif
				</button>
			</div>
		</div>
	</div>
</form>
@stop

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			
			document.getElementById('textEditor').contentWindow.document.designMode="on";
			document.getElementById('textEditor').contentWindow.document.close();
			var edit = document.getElementById("textEditor").contentWindow;
			edit.focus();
			if($('#oldDocument').html() !== null){
				$("#textEditor").contents().find("body").append($('#oldDocument').html());
			}

			var styleButtons = $('.styleButton');
			styleButtons.each(function(styleButton){
				var effect = $(this).attr('id');
				$(this).click(function(){
					var alignButtons = $('.alignButton');

					if($(this).hasClass('active')){
						if(!$(this).hasClass('alignButton')){
							$(this).removeClass('active');
						}
					} else {
						if($(this).hasClass('alignButton')){
							alignButtons.each(function(){
								$(this).removeClass('active');
							});
						}
						$(this).addClass('active');
					}
					actionOnText(effect);
				});
			});

			function actionOnText(effect){
				var edit = document.getElementById('textEditor').contentWindow;
				edit.focus();
				edit.document.execCommand(effect, false, "");
				edit.focus();
			}
			setInterval(function(){
				var gyt=$("#textEditor").contents().find("body").html().match(/@/g);
				if(!$("#textEditor").contents().find("body").html().match(/@/g)>=0){
				  $("#textContent").val($("#textEditor").contents().find("body").html());
				}
				$("#textContent").val($("#textEditor").contents().find("body").html());
			},1000);
		});
	</script>
@stop