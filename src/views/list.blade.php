<script type="text/template" id="image-manager-list">	

	<div class="col-md-8 pull-right" style="margin-top:10px;">
		<div class="input-group">
	      <input type="text" class="form-control">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="button">Хайх!</button>
	      </span>
	    </div><!-- /input-group -->
	</div>	

	<div class="clearfix"></div>

	<div class="row" style="margin:0px; margin-top:20px;">

	 	<% _.each(images, function(image) { %>

		<div class="col-sm-3" style="margin-bottom:10px;">
			<div class="simbox-item img-thumbnail">
				<img src="/assets/images/thumb/<%= image %>" class="simbox-img" />
				<div class="img-name">
					Hello world
				</div>
			</div>
		</div>

		<% }); %>
	</div>

</script>

<style type="text/css">	

	.simbox-img {
		max-width: 100%;
		max-height: 110px;
		cursor: pointer;
	}

	.simbox-item {
		position: relative;
		cursor: pointer;
		overflow: hidden;
	}

	.simbox-item:hover > .img-name {
		-webkit-animation:myfirst 0.3s; /* Chrome, Safari, Opera */
		animation:myfirst 0.3s;
		background: rgba(0,0,0,1);
	}

	.simbox-item .img-name {
		position: absolute;
		bottom:4px;
		left:4px;
		width: 96%;
		color: white;
		text-align: center;
		background: rgba(0,0,0,0.6);
	}

	/* Chrome, Safari, Opera */
	@-webkit-keyframes myfirst
	{
		from { background-color: rgba(0,0,0,0.6) }
		to { background-color: rgba(0,0,0,1) }
	}

	/* Standard syntax */
	@keyframes myfirst
	{
		from { background-color: rgba(0,0,0,0.6) }
		to { background-color: rgba(0,0,0,1) }
	}
</style>