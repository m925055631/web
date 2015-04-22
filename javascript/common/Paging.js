


$(document).ready(function(){

	var Paging = function() {
		this.prevButton = null;

		this.nextButton = null;

		this.pageButtons = null;

		this.numOfPages = 0;

		this.currentPage = 1;

		this.getContent = function(self, paramObj, callback) {
			
			$.getJSON("../php/takeAction.php", paramObj, function(res) {
				callback(res);
			});
		};

		this.prevPage = function(self, paramObj, callback) {
			if( self.currentPage > 1 ) {
				self.currentPage = self.currentPage - 1;
			}

			paramObj.pageId = self.currentPage;
			self.getContent(self, paramObj, callback);
		};

		this.nextPage = function(self, paramObj, callback) {
			if( self.currentPage < self.numOfPages ) {
				self.currentPage = self.currentPage + 1;
			}

			paramObj.pageId = self.currentPage;
			self.getContent(self, paramObj, callback);
		};

		this.getPage = function(self, paramObj, callback) {
			self.currentPage = parseInt( $(this).html() );

			paramObj.pageId = self.currentPage;
			self.getContent(self, paramObj, callback);
		};

		this.addEventHandler = function(paramObj, callback) {
			this.prevButton.unbind("click");
			this.nextButton.unbind("click");
			this.pageButtons.unbind("click");

			this.prevButton.bind("click", (function(self) {
				return function() {
					self.prevPage.call($(this), self, paramObj, callback);
				};
			}(this)));
			this.nextButton.bind("click", (function(self) {
				return function() {
					self.nextPage.call($(this), self, paramObj, callback);
				};
			}(this)));
			this.pageButtons.bind("click", (function(self) {
				return function() {
					self.getPage.call($(this), self, paramObj, callback);
				};
			}(this)));
		};

		this.init = function(num, selector) {
			if( selector === undefined ) {
				var selector = "";
			}
			this.prevButton = $(selector + " .prev");
			this.nextButton = $(selector + " .next");
			this.numOfPages = num;

			$(selector + " .pageId").remove();

			for( var i = 1; i <= num; i ++ ) {
				var a = $("<a href='javascript:void(0)' class='pageId'>" + i + "</a>");

				a.insertBefore(this.nextButton);
			}

			this.pageButtons = $(selector + " .pageId");
		};
	};

	window.Paging = Paging;
});

