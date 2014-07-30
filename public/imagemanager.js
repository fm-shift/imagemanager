var ImageManagerUpload = Backbone.View.extend({

	title: "Зураг хуулах",

	events: {

		"click #btn-upload": "upload"
	},

	render: function()
	{
		var html = $("#image-manager-upload").html();

		this.$el.html( html );

		this.btnUpload = this.$("#btn-upload");

		return this;
	},

	run: function()
	{
		this.render();

		this.$("#uploading-status").html("");
	},

	upload: function( e )
	{
		var that = this;

		this.$("#upload-form").ajaxSubmit({

			beforeSend: function() {

				that.btnUpload.button("loading");
			},

			success: function( response ) {

				that.btnUpload.button("reset");

				that.$(".image-manager-uploaded-image").html( response.path );

				that.$("#uploaded-img").attr( "src", response.thumb );


				this.selectedPath = response.path;

				Window.imageManager.setSelectedPath( response.path );
			},

			uploadProgress: function( event, position, total, percentComplete ) {
				
				that.$("#uploading-status").html(percentComplete + "%");
			}

		});
	},

});

var ImageManagerList = Backbone.View.extend({

	title: "Зургын сангаас",

	events: {

		"click .btn-next": "nextPage",
		"click .btn-prev": "prevPage",
		"keyup #search"  : "onSearchPressed",
		"click .simbox"  : "simboxClicked",
		"dblclick .simbox" : "simboxDblClicked"
	},

	selectedEl: null,

	render: function()
	{

		var html = _.template( $("#image-manager-list").html(), { 
			images: this.images.data,
			page_total: this.images.last_page,
			page_current: this.images.current_page,
			total: this.images.total,
			query: this.query
		});

		this.$el.html( html );


		if(this.images.current_page == 1)
			this.$(".btn-prev").parent("li").addClass("disabled");

		if(this.images.current_page == this.images.last_page)
			this.$(".btn-next").parent("li").addClass("disabled");
	},

	run: function()
	{		
		this.reload(0); // эхний хуудас
	},

	nextPage: function( e )
	{	
		var page = this.images.current_page + 1;

		if(page > this.images.last_page) return;


		this.reload( page );
	},

	prevPage: function()
	{
		var page = this.images.current_page - 1;

		if(page < 1) return;

		this.reload( page );
	},

	reload: function( page )
	{
		var that = this;

		$.get("/images", { page: page, query: this.query }, function(response)
		{
			that.images = response;

			that.render();
		});
	},

	onSearchPressed: function( e )
	{
		if(e.keyCode == 13)
		{
			this.query = this.$("#search").val();

        	this.reload(0);
    	}
	},

	simboxClicked: function( e )
	{
		if(this.selectedEl != null)
			this.selectedEl.removeClass("selected");


		this.selectedEl = $( e.target ).parents(".simbox");
		this.selectedEl.addClass("selected");

		this.selectedPath = this.selectedEl.attr("path");

		Window.imageManager.setSelectedPath( this.selectedPath );
	},

	simboxDblClicked: function( e ) 
	{
		this.simboxClicked(e);

		Window.imageManager.selectAndExit();
	}
});

var ImageManager = Backbone.View.extend({

	tools: {},

	initialize: function()
	{
		this.tools.upload = new ImageManagerUpload();
		this.tools.list = new ImageManagerList();

		this.render();
	},

	events: {

		"click .btn-select" : "selectAndExit",
	},

	render: function()
	{
		var that = this;

		this.bodyElement = this.$(".modal-body");

		// Render tab items
		for(key in this.tools) 
		{
			var tool = this.tools[key];

			var e = '<a href="#'+ key +'" data-toggle="tab">' + tool.title + '</a>';


			this.$(".nav").append("<li>" + e + "</li>");
			this.$(".tab-content").append('<div class="tab-pane fade in" id="' + key + '">' + tool.title + '</div>');

			tool.setElement(this.$("#" + key));
		}


		this.$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

		  	var tabId = $(e.target).attr("href").replace("#", "");

		  	if( ! that.tools[tabId].hasOwnProperty("firsttime"))
		  	{
		  		that.tools[tabId].run();
		  		
		  		that.tools[tabId].firsttime = false;		  		
		  	}
		})

	},

	select: function( options )
	{
		this.setSelectedPath(null);

		this.callbackSelected = options.selected;

		// default aar upload tab ajillana.
		this.$('.nav a[href="#upload"]').tab("show");

		this.$el.modal("show"); // Use bootstrap modal
	},

	setSelectedPath: function( path )
	{
		this.selectedPath = path;

		if(this.selectedPath == null)
			this.$(".btn-select").button("loading");
		else
			this.$(".btn-select").button("reset");
	},

	selectAndExit: function()
	{
		this.callbackSelected( this.selectedPath );

		this.$el.modal("hide");
	}

});

Window.imageManager = new ImageManager({ el: $("#myModal") });