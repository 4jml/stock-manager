$(function() {
	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();

		if ($(window).width() <= 992) {
			$('.row-offcanvas').toggleClass('active');
			$('.left-side').removeClass("collapse-left");
			$(".right-side").removeClass("strech");
			$('.row-offcanvas').toggleClass("relative");
		}
		else {
			$('.left-side').toggleClass("collapse-left");
			$(".right-side").toggleClass("strech");
		}
	});

	$("[data-toggle='tooltip']").tooltip();

	$("[data-widget='collapse']").click(function() {
		var box = $(this).parents(".box").first();
		var bf = box.find(".box-body, .box-footer");
		if (!box.hasClass("collapsed-box")) {
			box.addClass("collapsed-box");
			bf.slideUp();
		} else {
			box.removeClass("collapsed-box");
			bf.slideDown();
		}
	});

	$('.btn-group[data-toggle="btn-toggle"]').each(function() {
		var group = $(this);
		$(this).find(".btn").click(function(e) {
			group.find(".btn.active").removeClass("active");
			$(this).addClass("active");
			e.preventDefault();
		});

	});

	$("[data-widget='remove']").click(function() {
		var box = $(this).parents(".box").first();
		box.slideUp();
	});

	function _fix() {
		var height = $(window).height() - $("body > .header").height();
		$(".wrapper").css("min-height", height + "px");
		var content = $(".wrapper").height();
		if (content > height)
			$(".left-side, html, body").css("min-height", content + "px");
		else {
			$(".left-side, html, body").css("min-height", height + "px");
		}
	}

	function fix_sidebar() {
		if (!$("body").hasClass("fixed")) {
			return;
		}
	}
	_fix();
	fix_sidebar();
	$(".wrapper").resize(function() {
		_fix();
		fix_sidebar();
	});

	$(".sidebar .treeview").tree();
});

/*
 * SIDEBAR MENU
 * ------------
 * This is a custom plugin for the sidebar menu. It provides a tree view.
 * 
 * Usage:
 * $(".sidebar).tree();
 * 
 * Note: This plugin does not accept any options. Instead, it only requires a class
 *       added to the element that contains a sub-menu.
 *       
 * When used with the sidebar, for example, it would look something like this:
 * <ul class='sidebar-menu'>
 *      <li class="treeview active">
 *          <a href="#>Menu</a>
 *          <ul class='treeview-menu'>
 *              <li class='active'><a href=#>Level 1</a></li>
 *          </ul>
 *      </li>
 * </ul>
 * 
 * Add .active class to <li> elements if you want the menu to be open automatically
 * on page load. See above for an example.
 */
 (function($) {
 	"use strict";

 	$.fn.tree = function() {

 		return this.each(function() {
 			var btn = $(this).children("a").first();
 			var menu = $(this).children(".treeview-menu").first();
 			var isActive = $(this).hasClass('active');

			//initialize already active menus
			if (isActive) {
				menu.show();
				btn.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down");
			}
			//Slide open or close the menu on link click
			btn.click(function(e) {
				e.preventDefault();
				if (isActive) {
					//Slide up to close menu
					menu.slideUp();
					isActive = false;
					btn.children(".fa-angle-down").first().removeClass("fa-angle-down").addClass("fa-angle-left");
					btn.parent("li").removeClass("active");
				} else {
					//Slide down to open menu
					menu.slideDown();
					isActive = true;
					btn.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down");
					btn.parent("li").addClass("active");
				}
			});

			/* Add margins to submenu elements to give it a tree look */
			menu.find("li > a").each(function() {
				var pad = parseInt($(this).css("margin-left")) + 10;

				$(this).css({"margin-left": pad + "px"});
			});

		});

};


}(jQuery));