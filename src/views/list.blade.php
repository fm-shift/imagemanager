<script type="text/template" id="image-manager-list">	

	<div class="col-md-8 pull-right" style="margin-top:10px;">
		<div class="input-group">
	      <input type="text" class="form-control" id="search" value="<%= query %>">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="button"><%= Window.lang.search_btn %></button>
	      </span>
	    </div>
	</div>	

	<div class="clearfix"></div>

	<div class="row" style="margin:0px; margin-top:20px;">

	 	<% _.each(images, function(image) { %>

		<div class="simbox" style="margin-bottom:10px;" path="<%= image.path %>">
			<div class="simbox-item img-thumbnail">
				<img src="{{ Config::get("imagemanager::config.basePath") }}thumb/<%= image.path %>" class="simbox-img" />
				<div class="img-name"><%= image.caption %></div>
			</div>
		</div>

		<% }); %>
	</div>

	<div>
		<div class="pull-left" style="margin-left:10px;">
			<ul class="pager">
			  <li><a style="cursor:pointer" class="btn-prev"><%= Window.lang.prev_btn %></a></li>
			  <li><a style="cursor:pointer" class="btn-next"><%= Window.lang.next_btn %></a></li>
			</ul>
		</div>

		<div class="pull-right" style="margin-top:25px; margin-right:10px;">
			<%= Window.lang.page %> (<span class="page-current"><%= page_current %></span>/<span class="page-total"><%= page_total %></span>), <%= Window.lang.total %> (<span class="total-count"><%= total %></span>)
		</div>
	</div>

	<div class="clearfix"></div>
</script>