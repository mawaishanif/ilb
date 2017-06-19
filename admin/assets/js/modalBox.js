
jQuery.fn.hasAttr = function(name) {  
	return this.attr(name) !== undefined;
};

function disableBodyScroll(){
	var $html = jQuery('html');
	var windowWidth = window.innerWidth;

	if (!windowWidth)
	{
		var documentElementRect = document.documentElement.getBoundingClientRect();
		windowWidth = documentElementRect.right - Math.abs(documentElementRect.left);
	}

	var isOverflowing = document.body.clientWidth < windowWidth;


	  // measuring Scrollbar
	  var $body = jQuery('body');
	  var scrollDiv = document.createElement('div');
	  scrollDiv.className = 'scrollbar-measure';

	  $body.append(scrollDiv);
	  var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
	  $body[0].removeChild(scrollDiv);


  	// disabling BodyScroll
  	$html.css('overflow', 'hidden');
  	$body.css('overflow', 'hidden');
  	if (isOverflowing) {$html.css('padding-right', scrollbarWidth);$body.css('padding-right', scrollbarWidth);}
  }



  function enableBodyScroll () {
  	// enabling BodyScroll
  	jQuery('html').css({ 'overflow': '', 'padding-right': '' });
  	jQuery('body').css({ 'overflow': '', 'padding-right': '' });
  }

  function modal(selector) {
  	if (jQuery(selector).length !== 0) {
  		jQuery(selector).click(function (e) {
  			e.preventDefault();
  			if(!jQuery(this).hasAttr('data-target') || jQuery(this).attr('data-target') == "" ) {
				//target didn't have DATA-TARGET attribute or it is EMPTY, so i'm doing nothing!
				return;
			}

			var overlay = jQuery('#modal-overlay'), modalWrapper, targetID, target, modal, header, close, body;
			if (overlay.length == 0)
			{
				overlay = jQuery('<div id="modal-overlay"></div>').addClass('display-none');
				jQuery('body').prepend(overlay);
			}
			overlay.addClass('modal-overlay');
			targetID = jQuery(this).attr('data-target');
			target = jQuery('body').find(targetID);

			var modal_box = document.querySelector(targetID);

			Array.from(document.body.children).forEach(child =>{
				if (child != modal_box)
					child.inert = true;
			})
			modal = target.find('.modal');
			header = target.find('.modal-header');
			close = target.find('.close');
			body = target.find('.modal-body');
			modalWrapper = target.find('.modal-wrapper>div');

			overlay.removeClass('display-none');
			target.removeClass('display-none');
			target.addClass('modal-opened');
			disableBodyScroll();

			function modalCSS () {
				if (jQuery(window).width() > 868) {
					modal.css({
						'width' : '90% ',
						'maxWidth': ' 75.13rem'
					});
				}else{
					modal.css({
						'width' : '90%'
					});
				}
				modal.css({
					'marginTop': '3%',
					'marginBottom': '3%'
				});
			}
			modalCSS();


			jQuery(window).resize(function () {
				modalCSS();
			});

			function stoplistener() {
				close.off('click.modal');
				jQuery(document).off('keyup.modal');
				target.off('click.modal');
				jQuery(window).off('resize.modal');
			}

			function modalClose() {
				if (target.hasClass('modal-opened')) {
					overlay.addClass('display-none');
					target.removeClass('modal-opened');
					enableBodyScroll();
					stoplistener();
					var modal_box = document.querySelector(targetID);

					Array.from(document.body.children).forEach(child =>{
						if (child != modal_box)
							child.inert = false;
					})
				}
			}

			close.on('click.modal', function (e) {
				e.preventDefault();
				modalClose();
			});

			jQuery(document).on('keyup.modal', function (e) {
				if (e.keyCode === 27) {
					modalClose();
				}
			});

			jQuery(modalWrapper).click(function (e) {
				if (e.target.className === "" && e.target.nodeName === "DIV") {
					modalClose();
				}
			});

		});
  	}
  	return;
  }