<script type="text/template" id="image-manager-list">	

	<div class="col-md-8 pull-right" style="margin-top:10px;">
		<div class="input-group">
	      <input type="text" class="form-control" id="search" value="<%= query %>">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="button">Хайх!</button>
	      </span>
	    </div><!-- /input-group -->
	</div>	

	<div class="clearfix"></div>

	<div class="row" style="margin:0px; margin-top:20px;">

	 	<% _.each(images, function(image) { %>

		<div class="simbox" style="margin-bottom:10px;" path="<%= image.path %>">
			<div class="simbox-item img-thumbnail">
				<img src="/assets/images/thumb/<%= image.path %>" class="simbox-img" />
				<div class="img-name"><%= image.caption %></div>
			</div>
		</div>

		<% }); %>
	</div>

	<div>
		<div class="pull-left" style="margin-left:10px;">
			<ul class="pager">
			  <li><a style="cursor:pointer" class="btn-prev">Өмнөх</a></li>
			  <li><a style="cursor:pointer" class="btn-next">Дараах</a></li>
			</ul>
		</div>

		<div class="pull-right" style="margin-top:25px; margin-right:10px;">
			Хуудас (<span class="page-current"><%= page_current %></span>/<span class="page-total"><%= page_total %></span>), Нийт (<span class="total-count"><%= total %></span>)
		</div>
	</div>

	<div class="clearfix"></div>
</script>


<style type="text/css">	

	.simbox {
		display: inline-block;
		margin-left: 10px;
	}

	.simbox-img {
		/*max-width: 100%;*/
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

	.selected.simbox .img-thumbnail, .simbox:hover > .img-thumbnail {
		border-color:red;
	}
	.simbox .img-thumbnail {
		-webkit-border-radius: 0px;
		-moz-border-radius: 0px;
		border-radius: 0px;
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