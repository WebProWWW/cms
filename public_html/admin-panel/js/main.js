/*
 * @author Timur Valiyev
 * @link https://webprowww.github.io
 */

"use strict";
var Loader;

Loader = (function() {
  class Loader {
    done(data) {}

    progress(e) {}

    fail(textStatus) {}

    always() {}

    constructor() {
      if ((typeof app !== "undefined" && app !== null) && (app.csrf != null)) {
        this.csrf = app.csrf;
      }
      this.xhr = new XMLHttpRequest;
      this.xhr.responseType = 'json';
      this.$loaderHtml = $('#js-loader-html');
      this.$debugMsg = this.$loaderHtml.find('.js-loader-debug');
    }

    delay(ms, callBack = function() {}) {
      return setTimeout(callBack, ms);
    }

    state(type) {
      var $error, $progress, $success;
      $progress = this.$loaderHtml.find('.js-loader-progress');
      $success = this.$loaderHtml.find('.js-loader-success');
      $error = this.$loaderHtml.find('.js-loader-error');
      switch (type) {
        case 'progress':
          $progress.removeClass('d-none');
          $success.addClass('d-none');
          return $error.addClass('d-none');
        case 'error':
          $progress.addClass('d-none');
          $success.addClass('d-none');
          return $error.removeClass('d-none');
        case 'success':
          $progress.addClass('d-none');
          $success.removeClass('d-none');
          return $error.addClass('d-none');
        case 'hide':
          $progress.addClass('d-none');
          $success.addClass('d-none');
          return $error.addClass('d-none');
      }
    }

    postJson(action, data, callBackData = {}) {
      if (this.process) {
        return false;
      }
      this.data = callBackData;
      this.process = true;
      this.progress();
      this.state('progress');
      if (this.csrf != null) {
        $.extend(data, data, {
          [`${this.csrf.csrfParam}`]: this.csrf.csrfToken
        });
      }
      $.ajax({
        url: action,
        method: 'post',
        data: data,
        dataType: 'json'
      }).done((msg) => {
        if (this.debug) {
          console.log(msg);
          this.$debugMsg.text(msg.message);
        }
        this.state((function() {
          switch (String(msg.status)) {
            case '0':
              return 'error';
            case '200':
              return 'success';
            default:
              return 'success';
          }
        })());
        return this.done(msg);
      }).always(() => {
        return this.delay(1000, () => {
          this.$el.find('#js-loader-html').remove();
          this.$el.removeClass('js-loader-wrapper');
          this.state('hide');
          this.process = false;
          return this.always();
        });
      }).fail((jqXHR, textStatus, errorThrown) => {
        if (this.debug) {
          console.log(errorThrown);
          this.$debugMsg.text(textStatus);
        }
        this.state('error');
        return this.fail(textStatus);
      });
      return true;
    }

    uploadFormData(action, formData) {
      if (this.process) {
        return false;
      }
      this.process = true;
      if (this.csrf != null) {
        formData.append(`${this.csrf.csrfParam}`, this.csrf.csrfToken);
      }
      this.xhr.open('post', action, true);
      this.xhr.upload.onprogress = (e) => {
        return this.progress(e);
      };
      this.xhr.onerror = (e) => {
        this.process = false;
        this.always();
        return this.fail('Error');
      };
      this.xhr.onload = (e) => {
        this.process = false;
        this.always();
        return this.done(this.xhr.response);
      };
      return this.xhr.send(formData);
    }

    appendTo($el) {
      if (this.process) {
        return false;
      }
      this.$el = $el;
      return this.$el.append(this.$loaderHtml);
    }

  };

  Loader.prototype.$loaderHtml = $({});

  Loader.prototype.$debugMsg = $({});

  Loader.prototype.$el = $({});

  Loader.prototype.csrf = null;

  Loader.prototype.data = {};

  Loader.prototype.debug = false;

  Loader.prototype.process = false;

  Loader.prototype.xhr = null;

  return Loader;

}).call(this);

(function() {
  /* Module Site (backend) */
  var $doc, arren, arrru, cyrToLat;
  $doc = $(document);
  arrru = [',', '/', '_', ' ', 'Я', 'я', 'Ю', 'ю', 'Ч', 'ч', 'Ш', 'ш', 'Щ', 'щ', 'Ж', 'ж', 'А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е', 'Ё', 'ё', 'З', 'з', 'И', 'и', 'Й', 'й', 'К', 'к', 'Л', 'л', 'М', 'м', 'Н', 'н', 'О', 'о', 'П', 'п', 'Р', 'р', 'С', 'с', 'Т', 'т', 'У', 'у', 'Ф', 'ф', 'Х', 'х', 'Ц', 'ц', 'Ы', 'ы', 'Ь', 'ь', 'Ъ', 'ъ', 'Э', 'э'];
  arren = ['-', '-', '-', '-', 'Ya', 'ya', 'Yu', 'yu', 'Ch', 'ch', 'Sh', 'sh', 'Sh', 'sh', 'Zh', 'zh', 'A', 'a', 'B', 'b', 'V', 'v', 'G', 'g', 'D', 'd', 'E', 'e', 'E', 'e', 'Z', 'z', 'I', 'i', 'J', 'j', 'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n', 'O', 'o', 'P', 'p', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 'F', 'f', 'H', 'h', 'C', 'c', 'Y', 'y', '`', '`', '\'', '\'', 'E', 'e'];
  cyrToLat = function(text) {
    var i, j, len, reg, v;
    for (i = j = 0, len = arrru.length; j < len; i = ++j) {
      v = arrru[i];
      reg = new RegExp(v, "g");
      text = text.replace(reg, arren[i]);
    }
    return text.replace(/[-]{2,}/gim, '-').replace(/\n/gim, '').toLowerCase();
  };
  $doc.on('focusout', 'input[data-page-cyrlat]', function(e) {
    var $targetInput, $this;
    $this = $(this);
    $targetInput = $(`#${$this.attr('data-page-cyrlat')}`);
    if ($targetInput.val().length) {
      return false;
    }
    $targetInput.val(cyrToLat($this.val()));
    return true;
  });
  return 'END Module Site (backend)';
})();

(function() {})();

(function() {
  /* Widgets */
  var $doc;
  $doc = $(document);
  /* Widget Form */
  $doc.on('focusin', '.input', function(e) {
    var $this;
    $this = $(this);
    $this.removeClass('error');
    return $doc.find(`.input-error[for=${$this.attr('id')}]`).remove();
  });
  /* Widget RowView */
  $doc.on('click', '*[data-rowview-confirm]', function(e) {
    return confirm($(this).attr('data-rowview-confirm'));
  });
  return 'END Widgets';
})();

(function() {
  var $doc, $sortableContent, AceEditor, loader, sortableDisable, sortableEnable;
  $doc = $(document);
  $sortableContent = $('*[data-sortable]');
  loader = new Loader;
  AceEditor = class AceEditor {
    constructor(block, $textarea) {
      var editor;
      this.$textarea = $textarea;
      editor = ace.edit(block);
      editor.session.setMode("ace/mode/html");
      editor.setTheme("ace/theme/dracula");
      editor.session.setValue(this.$textarea.val());
      editor.session.on('change', (delta) => {
        return this.$textarea.val(editor.getValue());
      });
    }

  };
  sortableEnable = function() {
    return $sortableContent.sortable('enable');
  };
  sortableDisable = function() {
    return $sortableContent.sortable('disable');
  };
  $sortableContent.sortable({
    stop: function(e, ui) {
      var $items, $this, action, orders;
      $this = $(this);
      action = String($this.attr('data-sortable'));
      $items = $this.find('*[data-sortable-item]');
      orders = [];
      $items.each(function(i, item) {
        var $item, itemId, itemIndex;
        $item = $(item);
        itemId = Number($item.attr('data-sortable-item'));
        itemIndex = Number($item.index());
        return orders[itemIndex] = itemId;
      });
      loader.debug = true;
      loader.appendTo(ui.item);
      return loader.postJson(action, {orders});
    }
  });
  sortableDisable();
  $doc.on('mouseenter mouseleave', '.js-sortable-btn', function(e) {
    if (e.type === 'mouseenter') {
      sortableEnable();
    }
    if (e.type === 'mouseleave') {
      return sortableDisable();
    }
  });
  $doc.on('click', '.js-prevent', function(e) {
    e.preventDefault();
    return false;
  });
  $('*[data-ace]').each(function(i, block) {
    return new AceEditor(block, $(`#${$(block).attr('data-ace')}`));
  });
  $('*[data-tinymce]').each(function(i, textarea) {
    return tinymce.init({
      selector: `#${$(textarea).attr('data-tinymce')}`,
      menubar: false,
      height: 500,
      plugins: "link, code, paste",
      toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | link | code',
      paste_as_text: true
    });
  });
  // $.fancybox.open src:'#page-block-type-list'
  $doc.on('change', '*[data-tab-item]', function(e) {
    var $content, $this;
    $this = $(this);
    $content = $(`${$this.attr('data-tab-item')}`);
    $content.siblings().removeClass('active');
    $content.addClass('active');
    return true;
  });
  $('*[data-tab-item]').each(function(i, item) {
    var $content, $item;
    $item = $(item);
    $content = $(`${$item.attr('data-tab-item')}`);
    if ($item.is(':checked')) {
      $content.addClass('active');
    } else {
      $content.removeClass('active');
    }
    return true;
  });
  return true;
})();
