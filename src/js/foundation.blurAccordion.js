'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

!function ($) {

  /**
   * blurAccordion module.
   * @module foundation.accordion
   * @requires foundation.util.keyboard
   * @requires foundation.util.motion
   */

  var blurAccordion = function () {
    /**
     * Creates a new instance of an accordion.
     * @class
     * @fires blurAccordion#init
     * @param {jQuery} element - jQuery object to make into an accordion.
     * @param {Object} options - a plain object with settings to override the default options.
     */
    function blurAccordion(element, options) {
      _classCallCheck(this, blurAccordion);

      this.$element = element;
      this.options = $.extend({}, blurAccordion.defaults, this.$element.data(), options);
      this.$tabs = this.$element.children(this.options.accordionItem);

      this._init();

      Foundation.registerPlugin(this, 'blurAccordion');
      Foundation.Keyboard.register('blurAccordion', {
        'ENTER': 'toggle',
        'SPACE': 'toggle',
        'ARROW_DOWN': 'next',
        'ARROW_UP': 'previous'
      });
    }

    /**
     * Initializes the accordion by animating the preset active pane(s).
     * @private
     */

    _createClass(blurAccordion, [{
      key: '_init',
      value: function _init() {
	    var accordionItem = this.options.accordionItem,
	    	tabContent = this.options.tabContent,
	    	element = this.$element;
	    	
        this.$element.attr('role', 'tablist');

        this.$tabs.each(function (idx, el) {
          var $el = $(el),
              $content = $el.children(tabContent),
              id = $content[0].id || Foundation.GetYoDigits(6, 'accordion'),
              linkId = el.id || id + '-label',
              tabs = element.children(accordionItem);
          
          $el.width(element.width()/tabs.length);
          
          $el.find('a:first').attr({
            'aria-controls': id,
            'role': 'tab',
            'id': linkId,
            'aria-expanded': false,
            'aria-selected': false
          });

          $content.attr({ 'role': 'tabpanel', 'aria-labelledby': linkId, 'aria-hidden': true, 'id': id });
        });
        
        var $initActive = this.$element.find('.is-active').children(tabContent);
        if ($initActive.length) {
          this.$element.find('.is-active').removeClass('is-active');
        }
        this._events();
      }

      /**
       * Adds event handlers for items within the accordion.
       * @private
       */

    }, {
      key: '_events',
      value: function _events() {
        var _this = this;

        this.$tabs.each(function () {
          var $elem = $(this);

          var $tabContent = $elem.children(_this.options.tabContent);
          if ($tabContent.length) {
            $elem.off('click.zf.accordion keydown.zf.accordion').on('mouseenter mouseleave click.zf.accordion', function (e) {
              e.preventDefault();
              _this.toggle($tabContent);
            }).on('keydown.zf.accordion', function (e) {
              Foundation.Keyboard.handleKey(e, 'blurAccordion', {
                toggle: function () {
                  _this.toggle($tabContent);
                },
                next: function () {
                  var $a = $elem.next().find('a').focus();
                  $a.trigger('click.zf.accordion');
                },
                previous: function () {
                  var $a = $elem.prev().find('a').focus();
                  $a.trigger('click.zf.accordion');
                },
                handled: function () {
                  e.preventDefault();
                  e.stopPropagation();
                }
              })
            });
	      }
        });
      }

      /**
       * Toggles the selected content pane's open/close state.
       * @param {jQuery} $target - jQuery object of the pane to toggle (`.accordion-content`).
       * @function
       */

    }, {
      key: 'toggle',
      value: function toggle($target) {
        if ($target.parent().siblings().hasClass('blur')) {
          this.up($target);
        } else {
          this.down($target);
        }
      }

      /**
       * Opens the accordion tab defined by `$target`.
       * @param {jQuery} $target - blurAccordion pane to open (`.accordion-content`).
       * @param {Boolean} firstTime - flag to determine if reflow should happen.
       * @fires blurAccordion#down
       * @function
       */

    }, {
      key: 'down',
      value: function down($target, firstTime) {
        var _this = this,
        	shrink = _this.options.shrink,
        	tabs = _this.$tabs;
        
        $target.parent().siblings().addClass('blur').width($target.parent().width()-shrink);
        $target.parent().addClass('is-active').width($target.parent().width()+(shrink*tabs.length));
        
        _this.$element.trigger('down.zf.accordion', [$target]);

        $('#' + $target.attr('aria-labelledby')).attr({
          'aria-expanded': true,
          'aria-selected': true
        });
      }

      /**
       * Closes the tab defined by `$target`.
       * @param {jQuery} $target - blurAccordion tab to close (`.accordion-content`).
       * @fires blurAccordion#up
       * @function
       */

    }, {
      key: 'up',
      value: function up($target) {
        var _this = this,
        	tabs = _this.$tabs,
	    	element = _this.$element;
	    	
        _this.$element.trigger('up.zf.accordion', [$target]);
          
        tabs.each(function (idx, el) {
          var $el = $(el)
          
          $el.width(element.width()/tabs.length);
        });

        $target.parent().siblings().removeClass('blur');
        $target.parent().removeClass('is-active');

        $('#' + $target.attr('aria-labelledby')).attr({
          'aria-expanded': false,
          'aria-selected': false
        });
      }

      /**
       * Destroys an instance of an accordion.
       * @fires blurAccordion#destroyed
       * @function
       */

    }, {
      key: 'destroy',
      value: function destroy() {
        Foundation.unregisterPlugin(this);
      }
    }]);

    return blurAccordion;
  }();

  blurAccordion.defaults = {
    /**
     * Amount of time to animate the opening of an accordion pane.
     * @option
     * @example 250
     */
    slideSpeed: 250,
    shrink: 150,
    accordionItem: '[data-accordion-item]',
    tabContent: '[data-tab-content]'
  };

  // Window exports
  Foundation.plugin(blurAccordion, 'blurAccordion');
}(jQuery);