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
	},

	render: function()
	{
		this.$el.html("hello");
	},

	run: function()
	{
		this.render();
	},
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
		this.bodyElement = this.$(".modal-body");

		// Render tab items
		for(key in this.tools) 
		{
			var tool = this.tools[key];

			var e = '<a href="#'+ key +'" data-toggle="tab">' + tool.title + '</a>';


			this.$(".nav").append("<li>" + e + "</li>");
			this.$(".tab-content").append('<div class="tab-pane" id="' + key + '">' + tool.title + '</div>');

			tool.setElement(this.$("#" + key));
		}
	},

	select: function( options )
	{
		this.setSelectedPath(null);

		this.callbackSelected = options.selected;

		this.showTab("upload");

		this.$el.modal("show"); // Use bootstrap modal
	},

	showTab: function( tabId ) 
	{
		this.$('.nav a[href="#' + tabId + '"]').tab("show");

		this.tools[tabId].run();
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