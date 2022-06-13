(function ($) {
    function loadContent ( element, options) {
        this.element = element;
        this.options = options;

        var self = this;
        
        $.ajax({
            url: this.options.url,
            success: function (response) {
                self.handleAjaxResponse(response);
            }
        });
    }

    loadContent.prototype.handleAjaxResponse = function (response) {
        var self = this;

        if(this.options.delay) {
            setTimeout(function () {
                self.element.html(response);
            }, this.options.delay);
        }
        else{
            this.element.html(response);
        }
    }

    $.fn.loadContent = function (options) {
        // OPTIONS will be -> {url: "file.php", delay:2000} 
        new loadContent(this, options);
        return this;
    }
})(jQuery)