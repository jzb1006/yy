define(['jquery'], function($) {
	var form = {};
	
	form.init = function() {
		var modal_form = $('form.form-modal');
		var form_modal;
		if (modal_form.length > 0) {
			var form_modal = modal_form.parents('.modal');
			form_modal.on("hidden", function() {
				modal_form.resetForm()
			})
		}
		var form_validate = $('form.form-validate');
		if (form_validate.length > 0) {
			var validate_rule = {
				errorElement: 'span',
				errorClass: 'help-block-validate',
				focusInvalid: true,
				highlight: function(element) {
					var parent = $(element).data('parent') || '';
					if (parent) {
						$(parent).addClass('has-error')
					} else {
						$(element).closest('.form-group').addClass('has-error')
					}
				},
				onkeyup: function(element) {
					$(element).valid()
				},
				onfocusout: function(element) {
					$(element).valid()
				},
				success: function(element) {
					var parent = $(element).data('parent') || '';
					if (parent) {
						$(parent).removeClass('has-error')
					} else {
						$(element).closest('.form-group').removeClass('has-error')
					}
				},
				errorPlacement: function(error, element) {
					var group = element.parents(".input-group");
					group.length > 0 ? group.after(error) : element.after(error)
				},
				submitHandler: function(form) {
					var cansubmit = true;
					if ($(".form-editor-group").length > 0) {
						$(".form-editor-group").each(function() {
							var input = $(this).find(".form-editor-input");
							if (input.attr('data-rule-required') && $.trim(input.val()) == '') {
								$(this).find(".form-editor-btn").trigger('click');
								input.focus().blur().focus();
								cansubmit = false;
								return false
							}
						})
					}
					if (!cansubmit) {
						return
					}
					var submit_button = $("input[type='submit']", form);
					var buttontype = 'input';
					var html = [];
					
					submit_button.each(function(index) {
						var but = $(this);
						html[index] = but.val()
						console.log('aaa',submit_button)
					});
					if (submit_button.length <= 0) {
						submit_button = $("button[type='submit']", form);
						buttontype = 'button';
						html[0] = submit_button.html()
					}
					if ($(form).attr('stop') == '1') {
						return
					}
					var confirm = submit_button.data('confirm') || submit_button.data('confirm');
					console.log('confirm',confirm)
					var handler = function() {
							if (buttontype == 'button') {
								submit_button.html('<i class="fa fa-spinner fa-spin"></i> ' + tip.lang.processing)
							} else {
								submit_button.val(tip.lang.processing)
							}
							var timeout = 1000 * 3600;
							submit_button.attr('disabled', true);
							$(form).ajaxSubmit({

								timeout: timeout,
								dataType: "json",
								success: function(a) {
					
									if (a.result.url) {
										a.result.url = a.result.url.replace(/&amp;/ig, "&");
										a.result.url = a.result.url.replace('??', "&not")
									}
									if (a.status != 1) {
										submit_button.removeAttr('disabled');
										submit_button.each(function(index) {
											buttontype == 'button' ? $(this).html(html[index]) : $(this).val(html[index])
										});
										form_modal && form_modal.modal("hide"), tip.msgbox.err(a.result.message || a.result || tip.lang.error, a.result.url)
									} else {
										tip.msgbox.suc(a.result.message || tip.lang.success, a.result.url)
									}
								},
								error: function(a) {
									

									submit_button.removeAttr('disabled');
									submit_button.each(function(index) {
										buttontype == 'button' ? $(this).html(html[index]) : $(this).val(html[index])
									});
									form_modal && form_modal.modal("hide");
									tip.msgbox.err(tip.lang.error)
								}
							});
							return false
						};
					if (confirm) {
						tip.confirm(confirm, handler)
					} else {
						handler()
					}
				}
			};
			myrequire(['jquery.form', 'jquery.validate'], function() {
				var cnmsg = {
					required: "??????????????????",
					remote: "??????????????????",
					email: "????????????????????????????????????",
					url: "????????????????????????",
					date: "????????????????????????",
					dateISO: "???????????????????????? (ISO).",
					number: "?????????????????????",
					digits: "?????????????????????",
					creditcard: "??????????????????????????????",
					equalTo: "???????????????????????????",
					accept: "??????????????????????????????????????????",
					maxlength: $.validator.format("?????????????????????????????? {0} ????????????"),
					minlength: $.validator.format("?????????????????????????????? {0} ????????????"),
					rangelength: $.validator.format("??????????????????????????? {0} ??? {1} ??????????????????"),
					range: $.validator.format("????????????????????? {0} ??? {1} ????????????"),
					max: $.validator.format("???????????????????????? {0} ??????"),
					min: $.validator.format("???????????????????????? {0} ??????")
				};
				$.extend($.validator.messages, cnmsg);
				$.validator.addMethod("chinese", function(value, element) {
					var chinese = /^[\u4e00-\u9fa5]+$/;
					return this.optional(element) || (chinese.test(value))
				}, "??????????????????"), $.validator.methods.url = function(value, element) {
					return this.optional(element) || /^((http|https|ftp):\/\/)?(\w(\:\w)?@)?([0-9a-z_-]+\.)*?([a-z]{2,6}(\.[a-z]{2})?(\:[0-9]{2,6})?)((\/[^?#<>\/\\*":]*)+(\?[^#]*)?(#.*)?)?$/i.test(value)
				};
				form_validate.each(function() {
					var form = jQuery(this);
					form.validate(validate_rule)
				});
			})
		}
	};
	return form
})