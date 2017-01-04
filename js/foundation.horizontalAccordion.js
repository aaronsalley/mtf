'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

!function ($) {

  /**
   * horizontalAccordion module.
   * @module foundation.accordion
   * @requires foundation.util.keyboard
   * @requires foundation.util.motion
   */

  var horizontalAccordion = function () {
    /**
     * Creates a new instance of an accordion.
     * @class
     * @fires horizontalAccordion#init
     * @param {jQuery} element - jQuery object to make into an accordion.
     * @param {Object} options - a plain object with settings to override the default options.
     */
    function horizontalAccordion(element, options) {
      _classCallCheck(this, horizontalAccordion);

      this.$element = element;
      this.options = $.extend({}, horizontalAccordion.defaults, this.$element.data(), options);

      this._init();

      Foundation.registerPlugin(this, 'horizontalAccordion');
      Foundation.Keyboard.register('horizontalAccordion', {
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


    _createClass(horizontalAccordion, [{
      key: '_init',
      value: function _init() {
	    var accordionItem = this.options.accordionItem,
	    	tabContent = this.options.tabContent,
	    	element = this.$element;
	    	
        this.$element.attr('role', 'tablist');
        this.$tabs = this.$element.children(accordionItem);
        
        this.$tabs.each(function (idx, el) {
          var $el = $(el),
              $content = $el.children(tabContent),
              id = $content[0].id || Foundation.GetYoDigits(6, 'accordion'),
              linkId = el.id || id + '-label';
		  		  
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
          this.down($initActive, true);
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
            $elem.children('a').off('click.zf.accordion keydown.zf.accordion').on('click.zf.accordion', function (e) {
              e.preventDefault();
              _this.toggle($tabContent);
            }).on('keydown.zf.accordion', function (e) {
              Foundation.Keyboard.handleKey(e, 'horizontalAccordion', {
                toggle: function () {
                  _this.toggle($tabContent);
                },
                next: function () {
                  var $a = $elem.next().find('a').focus();
                  if (!_this.options.multiExpand) {
                    $a.trigger('click.zf.accordion');
                  }
                },
                previous: function () {
                  var $a = $elem.prev().find('a').focus();
                  if (!_this.options.multiExpand) {
                    $a.trigger('click.zf.accordion');
                  }
                },
                handled: function () {
                  e.preventDefault();
                  e.stopPropagation();
                }
              });
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
        if ($target.parent().hasClass('is-active')) {
          this.up($target);
        } else {
          this.down($target);
        }
      }

      /**
       * Opens the accordion tab defined by `$target`.
       * @param {jQuery} $target - horizontalAccordion pane to open (`.accordion-content`).
       * @param {Boolean} firstTime - flag to determine if reflow should happen.
       * @fires horizontalAccordion#down
       * @function
       */

    }, {
      key: 'down',
      value: function down($target, firstTime) {
        var _this2 = this,
			a = $target.parent().children('[role=tab]').outerWidth(),
			b = _this2.$element.children(_this2.options.accordionItem).length - 1;
		
        $target.attr('aria-hidden', false).parent(_this2.options.tabContent).addBack().parent().addClass('is-active');

        if (!this.options.multiExpand && !firstTime) {
          var $currentActive = this.$element.children('.is-active').children(_this2.options.tabContent);
          if ($currentActive.length) {
            this.up($currentActive.not($target));
          }
        }
        
        this.$element.children('.is-active').width(_this2.$element.width() - a*b);
        this.$element.children('.is-active').children(_this2.options.tabContent).width(_this2.$element.width() - a*(b+2));

        $target.slideDown(this.options.slideSpeed, function () {
          /**
           * Fires when the tab is done opening.
           * @event horizontalAccordion#down
           */
          _this2.$element.trigger('down.zf.accordion', [$target]);
        });

        $('#' + $target.attr('aria-labelledby')).attr({
          'aria-expanded': true,
          'aria-selected': true
        });
      }

      /**
       * Closes the tab defined by `$target`.
       * @param {jQuery} $target - horizontalAccordion tab to close (`.accordion-content`).
       * @fires horizontalAccordion#up
       * @function
       */

    }, {
      key: 'up',
      value: function up($target) {
        var $aunts = $target.parent().siblings(),
            _this = this;

        if (!this.options.allowAllClosed && !$aunts.hasClass('is-active') || !$target.parent().hasClass('is-active')) {
          return;
        }

        // Foundation.Move(this.options.slideSpeed, $target, function(){
        $target.slideUp(_this.options.slideSpeed, function () {
          /**
           * Fires when the tab is done collapsing up.
           * @event horizontalAccordion#up
           */
          _this.$element.trigger('up.zf.accordion', [$target]);
        });
        // });

        $target.attr('aria-hidden', true).parent().removeClass('is-active');
        this.$element.children().removeAttr('style');

        $('#' + $target.attr('aria-labelledby')).attr({
          'aria-expanded': false,
          'aria-selected': false
        });
      }

      /**
       * Destroys an instance of an accordion.
       * @fires horizontalAccordion#destroyed
       * @function
       */

    }, {
      key: 'destroy',
      value: function destroy() {
        this.$element.find(this.options.tabContent).stop(true).slideUp(0).css('display', '');
        this.$element.find('a').off('.zf.accordion');

        Foundation.unregisterPlugin(this);
      }
    }]);

    return horizontalAccordion;
  }();

  horizontalAccordion.defaults = {
    /**
     * Amount of time to animate the opening of an accordion pane.
     * @option
     * @example 250
     */
    slideSpeed: 250,
    /**
     * Allow the accordion to have multiple open panes.
     * @option
     * @example false
     */
    multiExpand: false,
    /**
     * Allow the accordion to close all panes.
     * @option
     * @example false
     */
    allowAllClosed: false,
    accordionItem: '[data-accordion-item]',
    tabContent: '[data-tab-content]'
  };

  // Window exports
  Foundation.plugin(horizontalAccordion, 'horizontalAccordion');
}(jQuery);