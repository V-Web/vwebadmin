imgpath = '';

function openModal(a) {
	$imgInput = jQuery(a).parent().prev();
	$imgNode = jQuery(a).children().children();
	var m = jQuery(a).closest('.slide-image, .slide-thumb, .ls-image-uploader').find('input:eq(1)').val().match(/\/.*images\/(.*)\//);
	var folder = m ? m[1] : imgpath;
	SqueezeBox.open('index.php?option=com_media&view=images&tmpl=component&folder='+ folder +'&e_name=image', {
		handler: 'iframe',
		size: {x:800, y:653},
		onOpen: function() {
			jQuery(window).on('beforeunload.mediamanager', function() { return 'Do you want to leave this site?\nChanges you made may not be saved!' });
			var iframe = jQuery('#sbox-window iframe')[0];
			iframe.onload = function() {
				var doc = iframe.contentDocument || iframe.contentWindow.document;
				if (doc.querySelector('input[name=username]')) { // session expired
					SqueezeBox.close();
					return LayerSlider.adminLogin('Please login at the following popup window.');
				} else { // session doesn't expired
					jQuery(window).off('.mediamanager');
				}
				doc.documentElement.style.overflowY = doc.body.style.overflowY = 'hidden';
				// hide unnessesry fields
				var $a = jQuery('label[for=f_align]', doc);
				if ($a.parent().is('td')) {	// J!2.5
					$a.parent().css('display', 'none').next().css('display', 'none').next().css('display', 'none');
					if ($imgInput.attr('name') == 'background')
						jQuery('#f_title', doc).parent().parent().css('display', 'none');
					jQuery('label[for=f_caption]', doc).parent().css('display', 'none').next().css('display', 'none').next().css('display', 'none');
				} else {	// J!3.X
					$a.parent().parent().css('display', 'none');
					if ($imgInput.attr('name') == 'background')
						jQuery('#f_title', doc).parent().parent().css('display', 'none');
					jQuery('#f_caption', doc).parent().parent().css('display', 'none');
					jQuery('#f_caption_class', doc).parent().parent().css('display', 'none');
				}
				// add transparent bg
				var imgframe = doc.getElementById('imageframe');
				imgframe.onload = function() {
					jQuery('<style>')
						.html('.img-preview .height-50, .item a {background: #ccc url(data:image/svg+xml;base64,'+
							'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0'+
							'PSIxNiI+PHJlY3QgZmlsbD0iI2ZmZiIgd2lkdGg9IjgiIGhlaWdodD0iOCIvPjxyZWN0IGZpbGw9'+
							'IiNmZmYiIHdpZHRoPSI4IiBoZWlnaHQ9IjgiIHg9IjgiIHk9IjgiLz48L3N2Zz4=) repeat !important}')
						.appendTo((imgframe.contentDocument || imgframe.contentWindow.document).head);
				};
				imgframe.onload();
			};
		}
	});
}

function jInsertEditorText(tag, name) {
	var $tag = jQuery(tag),
			$tr = $imgInput.parents('tr'),
			alt = $tag.attr('alt'),
			title = $tag.attr('title');
	imgpath = $tag.attr('src').match(/images\/?(.*)\//)[1] || '';
	$imgInput.val(joomla_base_url + $tag.attr('src'));
	$imgNode.attr('src', joomla_base_url + $tag.attr('src'));
	if (alt) $tr.find('input[name$=alt]').val(alt);
	if (title) $tr.find('input[name=title]').val(title);
	LayerSlider.willGeneratePreview( jQuery('.ls-box.active').index() );
}

ajaxsaveurl = 'index.php?option=com_layer_slider&view=slider&task=save_slider';
ajaxgeneratorurl = 'index.php?option=com_layer_slider&view=slider&task=get_dynamiccontent';
ajaxfilterurl = 'index.php?option=com_layer_slider&view=slider&task=get_dynamicfilters';

(function($) {

	$.fn.inputsToObj = function() {
		var obj = {};
		this.find('input, select, textarea').each(function() {
			obj[this.name] = this.type == 'checkbox' ? this.checked : this.value;
		});
		return obj;
	};

	$.fn.objToInputs = function(obj, trigger) {
		var $input, prop;
		for (prop in obj) {
			$input = this.find('[name="'+prop+'"]');
			if (typeof obj[prop] == 'boolean') {
				if ($input[0].checked != obj[prop]) $input.next().click();
			} else {
				$input.val(obj[prop]);
			}
		}
		trigger && $input.trigger("keyup");
	};

	$.ui.draggable.prototype.options.delay = 100;
	$.ui.sortable.prototype.options.delay = 100;

	function onEndActive() { $(this).removeClass('active') }

	$(document).on('click', '.copy[data-storage]', function() {
		var $this = $(this).addClass('active');
		clearTimeout(onEndActive.copyTimeout);
		onEndActive.copyTimeout = setTimeout(onEndActive.bind(this), 500);
		var obj = $this.closest('table').inputsToObj();
		delete obj.top, delete obj.left;
		localStorage[ $this.data('storage') ] = JSON.stringify(obj);

	}).on('click', '.paste[data-storage]', function() {
		var $this = $(this).addClass('active');
		var storage = $this.data('storage');
		clearTimeout(onEndActive.pasteTimeout);
		onEndActive.pasteTimeout = setTimeout(onEndActive.bind(this), 500);
		if (localStorage[storage]) {
			$this.closest('table').objToInputs(JSON.parse(localStorage[storage]), true);
			if (storage == 'lsStyle') {
				$this.closest('table').find('.ls-colorpicker').keyup();
				LayerSlider.generatePreview( jQuery('.ls-box.active').index() );
			}
		} else {
			alert("There is nothing to paste!");
		}

	// Pick transformOrigin
	}).on('click', '.ls-sublayer-options .dashicons-admin-post:not(.active)', function(event) {
		event.stopPropagation();
		var $this = jQuery(this).addClass('active');
		var $origin = $this.next();
		var $picker = jQuery('<div>').addClass('ls-origin-picker').appendTo('.ls-layer-box.active .ls-preview-wrapper');

		$picker.on('click', function(e) {
			var o = $picker.offset();
			var x = e.pageX - o.left;
			var y = e.pageY - o.top;
			var p = LS_Sublayer.position();
			var ox = (x - p.left) / LS_Sublayer.outerWidth();
			var oy = (y - p.top) / LS_Sublayer.outerHeight();
			$origin.val([
				Math.round(ox * 1000) / 10 + '%',
				Math.round(oy * 1000) / 10 + '%',
				$origin.val().split(/\s+/)[2] || ''
			].join(' ').trim());
			$origin.trigger('input');
		});

		jQuery(document).one('click', function() {
			jQuery('.ls-origin-picker').remove();
			jQuery('.dashicons-admin-post.active').removeClass('active');
		});

		var origin = $('.ls-layer-box.active .sublayerprop[name='+ $origin.attr('name') +']');
		LS_Sublayer.parent().children().each(function(i, sl) {
			var o = origin.eq(i).val().split(/\s+/);
			if (o.length > 1) {
				var x = o[0] == 'left' ? '0' : (o[0] == 'right' ? '100%' : o[0]);
				var y = o[1] == 'top' ? '0' : (o[1] == 'bottom' ? '100%' : o[1]);
				var $sl = jQuery(sl);
				var p = $sl.position();
				x = x.indexOf('%') < 0 ? parseInt(x) : parseFloat(x) / 100 * $sl.outerWidth();
				y = y.indexOf('%') < 0 ? parseInt(y) : parseFloat(y) / 100 * $sl.outerHeight();
				if (x != NaN && y != NaN) {
					jQuery('<div>')
						.addClass('ls-origin-point' + (sl == LS_Sublayer[0] ? ' ls-origin-active' : ''))
						.css({left: p.left + x, top: p.top + y})
						.appendTo($picker);
				}
			}
		});
	});

})(jQuery);


jQuery(function($) {

	LS_Uploader = $('<iframe>')
		.css({ position: 'absolute', display: 'none' })
		.appendTo(document.body)
		.attr('src', 'index.php?option=com_layer_slider&view=media&tmpl=component')

	// register event after first load
	LS_Uploader.one('load', function() {
		LS_Uploader.on('load.ls', function() {
			var $cont = LS_Uploader.contents().find('#system-message-container');

			// check for successfuly uploaded images
			$cont.find('.mediaok').each(function() {
				$('.ls-layer-box.active .ls-add-sublayer').click(); // trigger Add new layer
				LS_SublayerTr.find('input[name=image]').val(this.innerHTML)
					.next().find('img').attr('src', this.innerHTML);
				LS_SublayerTr.find('.ls-sublayer-title').val(this.innerHTML.match(/[^/]+$/)[0]);
				LS_SublayerTr.find('.ls-left').val(previewDropX);
				LS_SublayerTr.find('.ls-top').val(previewDropY);
				previewDropX += 10;
				previewDropY += 10;
				LayerSlider.generatePreview( jQuery('.ls-box.active').index() );
			});

			// check for errors
			var errorMsg = $.map($cont.find('.mediaerr'), function(el) {
				return el.innerHTML;
			});

			LS_Preview.removeClass('ls-dragover');
			LS_Uploader.hide();
			if (errorMsg.length) alert(errorMsg.join('\n'));
		});
	});

	// highlight dropable zone
	LS_Preview = $();
	$(document.body).on('dragover.ls', function(e) {
		var $preview = $(e.target).closest('.ls-preview');
		if ($preview.length) {
			LS_Preview = $preview.addClass('ls-draghover');
			var offset = LS_Preview.offset();
			LS_Uploader.css({
				width: LS_Preview.width(),
				height: LS_Preview.height(),
				left: offset.left,
				top: offset.top,
				opacity: 0,
				zIndex: 100000,
				border: 'none',
				display: 'block'
			});
		} else {
			LS_Preview.removeClass('ls-draghover');
			LS_Uploader.hide();
		}
		$('.ls-layer-box.active .ls-preview').addClass('ls-dragover');
		e.preventDefault();
	}).on('dragleave.ls drop.ls', function(e) {
		if (e.type == 'drop' || !$(e.target).closest('.ls-preview').length) {
			$('.ls-layer-box.active .ls-preview').removeClass('ls-draghover ls-dragover');
			LS_Uploader.hide();
			e.preventDefault();
		}
	});

	// INIT HELP
	$('#screen-meta').on('click', '.contextual-help-tabs a', function(e) {
		var $this = $(this);
		$('#screen-meta .active').removeClass('active');
		$this.addClass('active');
		$($this.attr('href')).addClass('active');
		e.preventDefault();
	});
	// init first tab
	$('.contextual-help-tabs a:first, .help-tab-content:first').addClass('active');
	$('.show-settings').on("click", function(e) {
		$($(this).attr('href')).slideToggle(250);
		e.preventDefault();
	});
});
