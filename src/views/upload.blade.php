<div class="template" id="image-manager-upload">

	<form id="upload-form" action="/images" method="post" enctype="multipart/form-data">
		<input type="text" placeholder="Зургын нэр" name="caption" />

		<div class="row" style="width:40%; margin-top:12px;">
			<div class="col-md-8">
				<input type="file" name="file-image" />
			</div> 
			<div class="col-md-4">
				<button class="btn btn-primary" type="button" id="btn-upload" data-loading-text="Хуулж байна...">Хуулах</button>	
			</div>
		</div>

		<img src="" class="img-thumbnail" alt="SIM" id="uploaded-img" />

		<div class="image-manager-uploaded-image">http://localhost/</div>
	</form>

	<div class="clearfix"></div>

	<span id="uploading-status"></span>
</div>
</div>
