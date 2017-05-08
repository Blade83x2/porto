// Theme
window.theme = {};

// Animate
(function(theme, $) {

	theme = theme || {};

	var instanceName = '__animate';

	var PluginAnimate = function($el, opts) {
		return this.initialize($el, opts);
	};

	PluginAnimate.defaults = {
		accX: 0,
		accY: -150,
		delay: 1
	};

	PluginAnimate.prototype = {
		initialize: function($el, opts) {
			if ($el.data(instanceName)) {
				return this;
			}

			this.$el = $el;

			this
				.setData()
				.setOptions(opts)
				.build();

			return this;
		},

		setData: function() {
			this.$el.data(instanceName, this);

			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginAnimate.defaults, opts, {
				wrapper: this.$el
			});

			return this;
		},

		build: function() {
			var self = this,
				$el = this.options.wrapper,
				delay = 0;

			$el.addClass('appear-animation');

			if (!$('html').hasClass('no-csstransitions') && $(window).width() > 767) {

				$el.appear(function() {

					delay = ($el.attr('data-appear-animation-delay') ? $el.attr('data-appear-animation-delay') : self.options.delay);

					if (delay > 1) {
						$el.css('animation-delay', delay + 'ms');
					}

					$el.addClass($el.attr('data-appear-animation'));

					setTimeout(function() {
						$el.addClass('appear-animation-visible');
					}, delay);

				}, {
					accX: self.options.accX,
					accY: self.options.accY
				});

			} else {

				$el.addClass('appear-animation-visible');

			}

			return this;
		}
	};

	// expose to scope
	$.extend(theme, {
		PluginAnimate: PluginAnimate
	});

	// jquery plugin
	$.fn.themePluginAnimate = function(opts) {
		return this.map(function() {
			var $this = $(this);

			if ($this.data(instanceName)) {
				return $this.data(instanceName);
			} else {
				return new PluginAnimate($this, opts);
			}

		});
	};

}).apply(this, [window.theme, jQuery]);

// Carousel
(function(theme, $) {

	theme = theme || {};

	var instanceName = '__carousel';

	var PluginCarousel = function($el, opts) {
		return this.initialize($el, opts);
	};

	PluginCarousel.defaults = {
		itemsDesktop: [1199, 4],
		itemsDesktopSmall: [979, 3],
		itemsTablet: [768, 2],
		itemsTabletSmall: false,
		itemsMobile: [479, 1]
	};

	PluginCarousel.prototype = {
		initialize: function($el, opts) {
			if ($el.data(instanceName)) {
				return this;
			}

			this.$el = $el;

			this
				.setData()
				.setOptions(opts)
				.build();

			return this;
		},

		setData: function() {
			this.$el.data(instanceName, this);

			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginCarousel.defaults, opts, {
				wrapper: this.$el
			});

			return this;
		},

		build: function() {
			if (!($.isFunction($.fn.owlCarousel))) {
				return this;
			}

			// Force to Show 1 item if Items Settings is set to 1
			if (this.options.items === 1) {
				this.options = $.extend(true, {}, this.options, {
					itemsDesktop: false,
					itemsDesktopSmall: false,
					itemsTablet: false,
					itemsTabletSmall: false,
					itemsMobile: false
				});
			}

			this.options.wrapper.owlCarousel(this.options).addClass("owl-carousel-init");

			return this;
		}
	};

	// expose to scope
	$.extend(theme, {
		PluginCarousel: PluginCarousel
	});

	// jquery plugin
	$.fn.themePluginCarousel = function(opts) {
		return this.map(function() {
			var $this = $(this);

			if ($this.data(instanceName)) {
				return $this.data(instanceName);
			} else {
				return new PluginCarousel($this, opts);
			}

		});
	}

}).apply(this, [window.theme, jQuery]);

// Chart Circular
(function(theme, $) {

	theme = theme || {};

	var instanceName = '__chartCircular';

	var PluginChartCircular = function($el, opts) {
		return this.initialize($el, opts);
	};

	PluginChartCircular.defaults = {
		accX: 0,
		accY: -150,
		delay: 1,
		barColor: '#0088CC',
		trackColor: '#f2f2f2',
		scaleColor: false,
		scaleLength: 5,
		lineCap: 'round',
		lineWidth: 13,
		size: 175,
		rotate: 0,
		animate: ({
			duration: 2500,
			enabled: true
		})
	};

	PluginChartCircular.prototype = {
		initialize: function($el, opts) {
			if ($el.data(instanceName)) {
				return this;
			}

			this.$el = $el;

			this
				.setData()
				.setOptions(opts)
				.build();

			return this;
		},

		setData: function() {
			this.$el.data(instanceName, this);

			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginChartCircular.defaults, opts, {
				wrapper: this.$el
			});

			return this;
		},

		build: function() {
			if (!($.isFunction($.fn.appear)) || !($.isFunction($.fn.easyPieChart))) {
				return this;
			}

			var self = this,
				$el = this.options.wrapper,
				value = ($el.attr('data-percent') ? $el.attr('data-percent') : 0),
				percentEl = $el.find('.percent');

			$.extend(true, self.options, {
				onStep: function(from, to, currentValue) {
					percentEl.html(parseInt(currentValue));
				}
			});

			$el.attr('data-percent', 0);

			$el.appear(function() {

				$el.easyPieChart(self.options);

				setTimeout(function() {

					$el.data('easyPieChart').update(value);
					$el.attr('data-percent', value);

				}, self.options.delay);

			}, {
				accX: self.options.accX,
				accY: self.options.accY
			});

			return this;
		}
	};

	// expose to scope
	$.extend(theme, {
		PluginChartCircular: PluginChartCircular
	});

	// jquery plugin
	$.fn.themePluginChartCircular = function(opts) {
		return this.map(function() {
			var $this = $(this);

			if ($this.data(instanceName)) {
				return $this.data(instanceName);
			} else {
				return new PluginChartCircular($this, opts);
			}

		});
	}

}).apply(this, [window.theme, jQuery]);

// Counter
(function(theme, $) {

	theme = theme || {};

	var instanceName = '__counter';

	var PluginCounter = function($el, opts) {
		return this.initialize($el, opts);
	};

	PluginCounter.defaults = {
		accX: 0,
		accY: 0,
		speed: 3000,
		refreshInterval: 100,
		decimals: 0,
		onUpdate: null,
		onComplete: null
	};

	PluginCounter.prototype = {
		initialize: function($el, opts) {
			if ($el.data(instanceName)) {
				return this;
			}

			this.$el = $el;

			this
				.setData()
				.setOptions(opts)
				.build();

			return this;
		},

		setData: function() {
			this.$el.data(instanceName, this);

			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginCounter.defaults, opts, {
				wrapper: this.$el
			});

			return this;
		},

		build: function() {
			if (!($.isFunction($.fn.countTo))) {
				return this;
			}

			var self = this,
				$el = this.options.wrapper;

			$.extend(self.options, {
				onComplete: function() {
					if ($el.data('append')) {
						$el.html($el.html() + $el.data('append'));
					}
				}
			});

			$el.appear(function() {

				$el.countTo(self.options);

			}, {
				accX: self.options.accX,
				accY: self.options.accY
			});

			return this;
		}
	};

	// expose to scope
	$.extend(theme, {
		PluginCounter: PluginCounter
	});

	// jquery plugin
	$.fn.themePluginCounter = function(opts) {
		return this.map(function() {
			var $this = $(this);

			if ($this.data(instanceName)) {
				return $this.data(instanceName);
			} else {
				return new PluginCounter($this, opts);
			}

		});
	}

}).apply(this, [window.theme, jQuery]);

// Lightbox
(function(theme, $) {
	theme = theme || {};
	var instanceName = '__lightbox';
	var PluginLightbox = function($el, opts) {
		return this.initialize($el, opts);
	};
	PluginLightbox.defaults = {
		tClose: 'Close (Esc)', // Alt text on close button
		tLoading: 'Loading...', // Text that is displayed during loading. Can contain %curr% and %total% keys
		gallery: {
			tPrev: 'Previous (Left arrow key)', // Alt text on left arrow
			tNext: 'Next (Right arrow key)', // Alt text on right arrow
			tCounter: '%curr% of %total%' // Markup for "1 of 7" counter
		},
		image: {
			tError: '<a href="%url%">The image</a> could not be loaded.' // Error message when image could not be loaded
		},
		ajax: {
			tError: '<a href="%url%">The content</a> could not be loaded.' // Error message when ajax request failed
		}
	};

	PluginLightbox.prototype = {
		initialize: function($el, opts) {
			if ($el.data(instanceName)) {
				return this;
			}

			this.$el = $el;

			this
				.setData()
				.setOptions(opts)
				.build();

			return this;
		},

		setData: function() {
			this.$el.data(instanceName, this);

			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginLightbox.defaults, opts, {
				wrapper: this.$el
			});

			return this;
		},

		build: function() {
			if (!($.isFunction($.fn.magnificPopup))) {
				return this;
			}

			this.options.wrapper.magnificPopup(this.options);

			return this;
		}
	};

	// expose to scope
	$.extend(theme, {
		PluginLightbox: PluginLightbox
	});

	// jquery plugin
	$.fn.themePluginLightbox = function(opts) {
		return this.map(function() {
			var $this = $(this);

			if ($this.data(instanceName)) {
				return $this.data(instanceName);
			} else {
				return new PluginLightbox($this, opts);
			}

		});
	}

}).apply(this, [window.theme, jQuery]);

// Masonry
(function(theme, $) {

	theme = theme || {};

	var instanceName = '__masonry';

	var PluginMasonry = function($el, opts) {
		return this.initialize($el, opts);
	};

	PluginMasonry.defaults = {
		itemSelector: 'li',
		layoutMode: 'fitRows'
	};

	PluginMasonry.prototype = {
		initialize: function($el, opts) {
			if ($el.data(instanceName)) {
				return this;
			}

			this.$el = $el;

			this
				.setData()
				.setOptions(opts)
				.build();

			return this;
		},

		setData: function() {
			this.$el.data(instanceName, this);

			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginMasonry.defaults, opts, {
				wrapper: this.$el
			});

			return this;
		},

		build: function() {
			if (!($.isFunction($.fn.isotope))) {
				return this;
			}

			this.options.wrapper.isotope(this.options);

			return this;
		}
	};

	// expose to scope
	$.extend(theme, {
		PluginMasonry: PluginMasonry
	});

	// jquery plugin
	$.fn.themePluginMasonry = function(opts) {
		return this.map(function() {
			var $this = $(this);

			$this.waitForImages(function() {
				if ($this.data(instanceName)) {
					return $this.data(instanceName);
				} else {
					return new PluginMasonry($this, opts);
				}
			});

		});
	}

}).apply(this, [window.theme, jQuery]);

// Parallax
(function(theme, $) {

	theme = theme || {};

	$.extend(theme, {

		PluginParallax: {

			defaults: {
				itemsSelector: '.parallax',
				horizontalScrolling: false
			},

			initialize: function(opts) {

				this
					.setOptions(opts)
					.build();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);

				return this;
			},

			build: function() {
				if (!($.isFunction($.fn.stellar)) || typeof(Modernizr.touch) == 'undefined') {
					return this;
				}

				var self = this;

				$(window).load(function() {

					if (!Modernizr.touch) {
						$.stellar(self.options).addClass('parallax-ready');
					} else {
						$(self.options.itemsSelector).addClass('parallax-disabled');
					}

				});

				return this;
			}

		}

	});

}).apply(this, [window.theme, jQuery]);

// Progress Bar
(function(theme, $) {
	theme = theme || {};
	var instanceName = '__progressBar';
	var PluginProgressBar = function($el, opts) { return this.initialize($el, opts); };
	PluginProgressBar.defaults = { accX: 0, accY: -50, delay: 1 };
	PluginProgressBar.prototype = {
		initialize: function($el, opts) {
			if ($el.data(instanceName)) { return this; }
			this.$el = $el;
			this.setData().setOptions(opts).build();
			return this;
		},
		setData: function() { this.$el.data(instanceName, this); return this; },
		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginProgressBar.defaults, opts, { wrapper: this.$el });
			return this;
		},
		build: function() {
			if (!($.isFunction($.fn.appear))) { return this; }
			var self = this, $el = this.options.wrapper, delay = 1;
			$el.appear(function() {
				delay = ($el.attr('data-appear-animation-delay') ? $el.attr('data-appear-animation-delay') : self.options.delay);
				$el.addClass($el.attr('data-appear-animation'));
				setTimeout(function() { $el.animate({ width: $el.attr('data-appear-progress-animation') }, 1500, 'easeOutQuad', function() { $el.find('.progress-bar-tooltip').animate({ opacity: 1 }, 500, 'easeOutQuad'); }); }, delay);
			}, { accX: self.options.accX, accY: self.options.accY });
			return this;
		}
	};
	$.extend(theme, { PluginProgressBar: PluginProgressBar });
	$.fn.themePluginProgressBar = function(opts) {
		return this.map(function() {
			var $this = $(this);
			if ($this.data(instanceName)) { return $this.data(instanceName); } else { return new PluginProgressBar($this, opts); }
		});
	}
}).apply(this, [window.theme, jQuery]);

// Sort
(function(theme, $) {
	theme = theme || {};
	var instanceName = '__sort';
	var PluginSort = function($el, opts) { return this.initialize($el, opts); };
	PluginSort.defaults = {
		useHash: true,
		itemSelector: 'li',
		layoutMode: 'masonry',
		filter: '*'
	};
	PluginSort.prototype = {
		initialize: function($el, opts) {
			if ($el.data(instanceName)) { return this; }
			this.$el = $el;
			this.setData().setOptions(opts).build();
			return this;
		},
		setData: function() {
			this.$el.data(instanceName, this);
			return this;
		},
		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginSort.defaults, opts, { wrapper: this.$el });
			return this;
		},
		build: function() {
			if (!($.isFunction($.fn.isotope))) { return this; }
			var self = this, $source = this.options.wrapper, $destination = $('.sort-destination[data-sort-id="' + $source.attr('data-sort-id') + '"]');
			if ($destination.get(0)) {
				self.$source = $source;
				self.$destination = $destination;
				self.setParagraphHeight($destination);
				$(window).load(function() {
					$destination.isotope(self.options).isotope('layout');
					self.$destination.isotope('on', 'layoutComplete', function(isoInstance, laidOutItems) {
						if (self.options.useHash || typeof(isoInstance.options.filter != 'undefined')) {
							if (window.location.hash != '' || isoInstance.options.filter.replace('.', '') != '*') {
								window.location.hash = isoInstance.options.filter.replace('.', '');
							}
						}
					});
					self.events();
				});
			}
			return this;
		},
		events: function() {
			var self = this,
				filter = null;
			self.$source.find('a').click(function(e) {
				e.preventDefault();
				filter = $(this).parent().attr('data-option-value');
				self.setFilter(filter);
				return this;
			});
			if (self.options.useHash) { self.hashEvents(); }
			return this;
		},
		setFilter: function(filter) {
			var self = this;
			if (self.filter == filter) { return this; }
			self.$source.find('li.active').removeClass('active');
			self.$source.find('li[data-option-value="' + filter + '"]').addClass('active');
			self.$destination.isotope({ filter: filter });
			self.filter = filter;
			return this;
		},
		hashEvents: function() {
			var self = this, hash = null, hashFilter = null, initHashFilter = '.' + location.hash.replace('#', '');
			if (initHashFilter != '.' && initHashFilter != '.*') { self.setFilter(initHashFilter); }
			$(window).bind('hashchange', function(e) {
				hashFilter = '.' + location.hash.replace('#', '');
				hash = (hashFilter == '.' || hashFilter == '.*' ? '*' : hashFilter);
				self.setFilter(hash);
			});
			return this;
		},
		setParagraphHeight: function() {
			var self = this, minParagraphHeight = 0, paragraphs = $('span.thumb-info-caption p', self.$destination);
			paragraphs.each(function() {
				if ($(this).height() > minParagraphHeight) { minParagraphHeight = ($(this).height() + 10); }
			});
			paragraphs.height(minParagraphHeight);
			return this;
		}
	};
	$.extend(theme, { PluginSort: PluginSort });
	$.fn.themePluginSort = function(opts) {
		return this.map(function() {
			var $this = $(this);
			if ($this.data(instanceName)) { return $this.data(instanceName); } else { return new PluginSort($this, opts); }
		});
	}
}).apply(this, [window.theme, jQuery]);

// Toggle
(function(theme, $) {
	theme = theme || {};
	var instanceName = '__toggle';
	var PluginToggle = function($el, opts) {
		return this.initialize($el, opts);
	};
	PluginToggle.defaults = { duration: 350, isAccordion: false, addIcons: true };
	PluginToggle.prototype = {
		initialize: function($el, opts) {
			if ($el.data(instanceName)) { return this; }
			this.$el = $el;
			this.setData().setOptions(opts).build();
			return this;
		},
		setData: function() {
			this.$el.data(instanceName, this);
			return this;
		},
		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginToggle.defaults, opts, {
				wrapper: this.$el
			});
			return this;
		},
		build: function() {
			var self = this,
				$wrapper = this.options.wrapper,
				$items = $wrapper.find('.toggle'),
				$el = null;
			$items.each(function() {
				$el = $(this);
				if (self.options.addIcons) {
					$el.find('> label').prepend(
						$('<i />').addClass('fa fa-plus'),
						$('<i />').addClass('fa fa-minus')
					);
				}
				if ($el.hasClass('active')) {
					$el.find('> p').addClass('preview-active');
					$el.find('> .toggle-content').slideDown(self.options.duration);
				}
				self.events($el);
			});
			if (self.options.isAccordion) { self.options.duration = self.options.duration / 2; }
			return this;
		},
		events: function($el) {
			var self = this,
				previewParCurrentHeight = 0,
				previewParAnimateHeight = 0,
				toggleContent = null;
			$el.find('> label').click(function(e) {
				var $this = $(this),
					parentSection = $this.parent(),
					parentWrapper = $this.parents('.toggle'),
					previewPar = null,
					closeElement = null;
				if (self.options.isAccordion && typeof(e.originalEvent) != 'undefined') {
					closeElement = parentWrapper.find('.toggle.active > label');
					if (closeElement[0] == $this[0]) { return; }
				}
				parentSection.toggleClass('active');
				if (parentSection.find('> p').get(0)) {
					previewPar = parentSection.find('> p');
					previewParCurrentHeight = previewPar.css('height');
					previewPar.css('height', 'auto');
					previewParAnimateHeight = previewPar.css('height');
					previewPar.css('height', previewParCurrentHeight);
				}
				toggleContent = parentSection.find('> .toggle-content');
				if (parentSection.hasClass('active')) {
					$(previewPar).animate({
						height: previewParAnimateHeight
					}, self.options.duration, function() {
						$(this).addClass('preview-active');
					});
					toggleContent.slideDown(self.options.duration, function() {
						if (closeElement) {
							closeElement.trigger('click');
						}
					});
				} else {
					$(previewPar).animate({
						height: 0
					}, self.options.duration, function() {
						$(this).removeClass('preview-active');
					});
					toggleContent.slideUp(self.options.duration);
				}
			});
		}
	};
	$.extend(theme, {
		PluginToggle: PluginToggle
	});
	$.fn.themePluginToggle = function(opts) {
		return this.map(function() {
			var $this = $(this);
			if ($this.data(instanceName)) {
				return $this.data(instanceName);
			} else {
				return new PluginToggle($this, opts);
			}
		});
	}
}).apply(this, [window.theme, jQuery]);


// Validation
(function(theme, $) {
	theme = theme || {};
	$.extend(theme, {
		PluginValidation: {
			defaults: {
				validator: {
					highlight: function(element) {
						$(element)
							.parent()
							.removeClass('has-success')
							.addClass('has-error');
					},
					success: function(element) {
						$(element)
							.parent()
							.removeClass('has-error')
							.addClass('has-success')
							.find('label.error')
							.remove();
					},
					errorPlacement: function(error, element) {
						if (element.attr('type') == 'radio' || element.attr('type') == 'checkbox') {
							error.appendTo(element.parent().parent());
						} else {
							error.insertAfter(element);
						}
					}
				},
				validateCaptchaURL: 'php/contact-form-verify-captcha.php'
			},
			initialize: function(opts) {
				initialized = true;
				this.setOptions(opts).build();
				return this;
			},
			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts);
				return this;
			},
			build: function() {
				var self = this;
				if (!($.isFunction($.validator))) { return this; }
				self.addMethods();
				self.setMessageGroups();
				$.validator.setDefaults(self.options.validator);
				return this;
			},
			addMethods: function() {
				var self = this;
				$.validator.addMethod('captcha', function(value, element, params) {
					var captchaValid = false;
					$.ajax({
						url: self.options.validateCaptchaURL,
						type: 'POST',
						async: false,
						dataType: 'json',
						data: { captcha: $.trim(value) },
						success: function(data) {
							if (data.response == 'success') { captchaValid = true; }
						}
					});
					if (captchaValid) { return true; }
				}, '');
			},
			setMessageGroups: function() {
				$('.checkbox-group[data-msg-required], .radio-group[data-msg-required]').each(function() {
					var message = $(this).data('msg-required');
					$(this).find('input').attr('data-msg-required', message);
				});
			}
		}
	});
	theme.PluginValidation.initialize();
}).apply(this, [window.theme, jQuery]);

// Video Background
/*
(function(theme, $) {
	theme = theme || {};
	var instanceName = '__videobackground';
	var PluginVideoBackground = function($el, opts) {
		return this.initialize($el, opts);
	};
	PluginVideoBackground.defaults = {
		overlay: true,
		volume: 1,
		playbackRate: 1,
		muted: true,
		loop: true,
		autoplay: true,
		position: '50% 50%',
		posterType: 'detect'
	};
	PluginVideoBackground.prototype = {
		initialize: function($el, opts) {
			this.$el = $el;
			this.setData().setOptions(opts).build();
			return this;
		},
		setData: function() {
			this.$el.data(instanceName, this);
			return this;
		},
		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginVideoBackground.defaults, opts, {
				path: this.$el.data('video-path'),
				wrapper: this.$el
			});
			return this;
		},
		build: function() {
			if (!($.isFunction($.fn.vide)) || (!this.options.path)) { return this; }
			if (this.options.overlay) { this.options.wrapper.prepend($('<div />').addClass('video-overlay')); }
			this.options.wrapper.vide(this.options.path, this.options);
			return this;
		}
	};
	$.extend(theme, { PluginVideoBackground: PluginVideoBackground });
	$.fn.themePluginVideoBackground = function(opts) {
		return this.map(function() {
			var $this = $(this);
			if ($this.data(instanceName)) { return $this.data(instanceName); } else { return new PluginVideoBackground($this, opts); }
		});
	}
}).apply(this, [window.theme, jQuery]);
*/




// Word Rotate
(function(theme, $) {
	theme = theme || {};
	var instanceName = '__wordRotate';
	var PluginWordRotate = function($el, opts) {
		return this.initialize($el, opts);
	};
	PluginWordRotate.defaults = {
		delay: 2000
	};
	PluginWordRotate.prototype = {
		initialize: function($el, opts) {
			if ( $el.data( instanceName ) ) {
				return this;
			}
			this.$el = $el;
			this.setData().setOptions(opts).build();
			return this;
		},
		setData: function() {
			this.$el.data(instanceName, this);
			return this;
		},
		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginWordRotate.defaults, opts, {
				wrapper: this.$el
			});
			return this;
		},
		build: function() {
			var $el = this.options.wrapper,
				itemsWrapper = $el.find(".word-rotate-items"),
				items = itemsWrapper.find("> span"),
				firstItem = items.eq(0),
				firstItemClone = firstItem.clone(),
				itemHeight = firstItem.height(),
				currentItem = 1,
				currentTop = 0;
			itemsWrapper.append(firstItemClone);
			$el
				.height(itemHeight)
				.addClass("active");
			setInterval(function() {
				currentTop = (currentItem * itemHeight);
				itemsWrapper.animate({
					top: -(currentTop) + "px"
				}, 300, "easeOutQuad", function() {
					currentItem++;
					if(currentItem > items.length) {
						itemsWrapper.css("top", 0);
						currentItem = 1;
					}
				});
			}, this.options.delay);
			return this;
		}
	};
	$.extend(theme, {
		PluginWordRotate: PluginWordRotate
	});
	$.fn.themePluginWordRotate = function(opts) {
		return this.map(function() {
			var $this = $(this);
			if ($this.data(instanceName)) {
				return $this.data(instanceName);
			} else {
				return new PluginWordRotate($this, opts);
			}
		});
	}
}).apply(this, [ window.theme, jQuery ]);


// Nav
(function(theme, $) {
	theme = theme || {};
	var initialized = false;
	$.extend(theme, {
		Nav: {
			defaults: {
				wrapper: $('#mainMenu'),
				mobileMenuScroll: true,
				fixParentItems: true
			},
			initialize: function($wrapper, opts) {
				if (initialized) {
					return this;
				}
				initialized = true;
				this.$wrapper = ($wrapper || this.defaults.wrapper);
				this
					.setOptions(opts)
					.build()
					.events();
				return this;
			},
			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts, this.$wrapper.data('plugin-options'));
				return this;
			},
			build: function() {
				this.responsiveNavFixes();
				this.megaMenu();
				this.mobileMenuScroll();
				this.fixParentItems();
				return this;
			},
			events: function() {
				var self = this;
				$('.mobile-redirect').on('click', function() {
					if ($(window).width() < 991) {
						self.location = $(this).attr('href');
					}
				});
				$('[data-hash]').on('click', function(e) {
					e.preventDefault();
					var header = $('#header'),
						headerHeight = header.height(),
						target = $(this).attr('href'),
						topGap = 0;
					if ($(window).width() > 991) {
						topGap = (headerHeight + 50);
					} else {
						topGap = 30;
					}
					$('html, body').animate({
						scrollTop: $(target).offset().top - topGap
					}, 600, 'easeOutQuad');
					return this;
				});
				return this;
			},
			responsiveNavFixes: function() {
				var self = this,
					addActiveClass = false;
				self.$wrapper.find('.dropdown-toggle[href]:not([href=#])').each(function() {
					$(this)
						.addClass('disabled')
						.parent()
						.prepend(
							$('<a />')
								.addClass('dropdown-toggle extra')
								.attr('href', '#')
								.append(
									$('<i />')
										.addClass('fa fa-angle-down')
								)
						);
				});
				self.$wrapper.find('li.dropdown > a:not(.disabled), li.dropdown-submenu > a:not(.disabled)').on('click', function(e) {
					e.preventDefault();
					if ($(window).width() > 991) {
						return this;
					}
					addActiveClass = $(this).parent().hasClass('resp-active');
					self.$wrapper.find('.resp-active').removeClass('resp-active');
					if (!addActiveClass) {
						$(this).parents('li').addClass('resp-active');
					}
					return this;
				});
			},
			megaMenu: function() {
				$(document).on('click', '.mega-menu .dropdown-menu', function(e) {
					e.stopPropagation()
				});
			},
			mobileMenuScroll: function() {
				var self = this;
				this.$wrapper.find('> li > a:not(.disabled)').on('click', function() {
					if ($(window).width() < 991 && self.options.mobileMenuScroll && !$('body').hasClass('sticky-menu-active') && !$('#header').hasClass('fixed')) {
						$('html, body').animate({
							scrollTop: $(this).offset().top
						}, 600, 'easeOutQuad');
					}
				});
			},
			fixParentItems: function() {
				if (!this.options.fixParentItems) {
					return this;
				}
				this.$wrapper.find('> li.dropdown').each(function() {
					if (!$(this).find('ul').get(0)) {
						$(this).removeClass('dropdown');
						$(this).find('.dropdown-toggle').removeClass('dropdown-toggle');
					}
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);



// Search
(function(theme, $) {
	theme = theme || {};
	var initialized = false;
	$.extend(theme, {
		Search: {
			defaults: {
				wrapper: $('#searchForm')
			},
			initialize: function($wrapper, opts) {
				if (initialized) {
					return this;
				}
				initialized = true;
				this.$wrapper = ($wrapper || this.defaults.wrapper);
				this
					.setOptions(opts)
					.build();
				return this;
			},
			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts, this.$wrapper.data('plugin-options'));
				return this;
			},
			build: function() {
				if (!($.isFunction($.fn.validate))) {
					return this;
				}
				this.$wrapper.validate({
					errorPlacement: function(error, element) {}
				});
				return this;
			}
		}
	});
}).apply(this, [window.theme, jQuery]);


$(function() {
  // http://jquery.eisbehr.de/lazy/example_basic-usage
    var loadedElements = 0;
    $('.lazy').lazy({
            effect: 'fadeIn',
	    effectTime: 3000,
            threshold: 0,
	    visibleOnly: true,
	    afterLoad: function(element) {
		    loadedElements++;
		    if (window.console) console.info('Element "' + loadedElements + '" was loaded successfully');
	    },
	    onError: function(element) {
		    if (window.console) console.log('Error loading Element ' + element.data('src'));
	    },
	    onFinishedAll: function() {
		if(!this.config("autoDestroy"))
		    this.destroy();
	    },
	    
	    youtubeLoader: function(element) {
                var url = 'https://www.youtube.com/embed/',
                    frame = $('<iframe />');
		frame.attr('width', '100%');
		frame.attr('height', '100%');
		frame.attr('frameborder', 0);
		frame.attr('allowfullscreen', true);
		frame.attr('src', url + element.data("video"));
		element.append(frame).load();
            },
	    
	    
	    
	    
    });
});
