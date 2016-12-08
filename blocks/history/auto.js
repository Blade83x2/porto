/*
 * auto.js
 * wird bei edit/add geladen
 */

function HistoryBlock()
{
    this.initialisize        = false;
    this.mode                = null;

    this.setMode = function(mode)
    {
        if (!this.initialisize)
        {
            return;
        }
        if (this.mode == mode) return;
        switch (mode)
        {
            case 'single':
                $("input[name=createFromSubPages]").attr("disabled",true);
                $( "#descriptionDiv" ).fadeOut( "fast", function() {
                    $( "#pageWithSubpagesDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 140, "linear", function() {
                        $( "#redirectToPageDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 180, "linear", function() {
                            $( "#pictureDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 220, "linear", function() {
                                $( "#yearDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 260, "linear", function() {
                                    $( "#textDiv" ).fadeIn( "slow", function() {
                                        $("input[name=createFromSubPages]").attr("disabled",false);
                                    });
                                });
                            });
                        });
                    });
                });
                break;
            case 'page':
                $("input[name=createFromSubPages]").attr("disabled",true);
                $( "#textDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 100, "linear", function() {
                    $( "#yearDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 140, "linear", function() {
                        $( "#pictureDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 180, "linear", function() {
                            $( "#redirectToPageDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 220, "linear", function() {
                                $( "#pageWithSubpagesDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 260, "linear", function() {
                                    $( "#descriptionDiv" ).fadeIn( "slow", function() {
                                        $("input[name=createFromSubPages]").attr("disabled",false);
                                    });
                                });
                            });
                        });
                    });
                });
                break;
        }
        this.mode = mode;
    };

    this.setStartValueMode = function(mode)
    {
        this.mode = mode;
    }

    this.init = function()
    {
        if (!this.initialisize)
        {
            this.initialisize = true;
        }
    };

    if (!this.initialisize)
    {
        this.init();
    }
}