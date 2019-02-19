"use strict"
#=include ./lib/Loader.coffee

do ->
  #=include ./../../../modules/site/backend/module.coffee
do ->
  #=include ./../../../modules/blog/backend/module.coffee
do ->
  #=include ./../../../widgets/widget.coffee
do ->
    $doc = $ document
    $sortableContent = $ '*[data-sortable]'
    loader = new Loader

    class AceEditor
        constructor: (block, @$textarea) ->
            editor = ace.edit block
            editor.session.setMode "ace/mode/html"
            editor.setTheme "ace/theme/dracula"
            editor.session.setValue @$textarea.val()
            editor.session.on 'change', (delta) =>
                @$textarea.val editor.getValue()



    sortableEnable = () -> $sortableContent.sortable 'enable'
    sortableDisable = () -> $sortableContent.sortable 'disable'

    $sortableContent.sortable
        stop: (e, ui) ->
            $this = $ this
            action = String $this.attr 'data-sortable'
            $items = $this.find '*[data-sortable-item]'
            orders = []
            $items.each (i, item) ->
                $item = $ item
                itemId = Number $item.attr 'data-sortable-item'
                itemIndex = Number $item.index()
                orders[itemIndex] = itemId
            loader.debug = true
            loader.appendTo ui.item
            loader.postJson action, {orders}

    sortableDisable()

    $doc.on 'mouseenter mouseleave', '.js-sortable-btn', (e) ->
        sortableEnable() if e.type is 'mouseenter'
        sortableDisable() if e.type is 'mouseleave'

    $doc.on 'click', '.js-prevent', (e) -> e.preventDefault(); off

    $('*[data-ace]').each (i, block) ->
        new AceEditor block, $ "##{$(block).attr 'data-ace'}"

    $('*[data-tinymce]').each (i, textarea) ->
        tinymce.init
            selector: "##{$(textarea).attr 'data-tinymce'}"
            menubar: off
            height: 500
            plugins: "link, code"
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | link | code'

    # $.fancybox.open src:'#page-block-type-list'

    $doc.on 'change', '*[data-tab-item]', (e) ->
        $this = $ this
        $content = $ "#{$this.attr 'data-tab-item'}"
        $content.siblings().removeClass 'active'
        $content.addClass 'active'
        on

    $('*[data-tab-item]').each (i, item) ->
        $item = $ item
        $content = $ "#{$item.attr 'data-tab-item'}"
        if $item.is ':checked' then $content.addClass 'active' else $content.removeClass 'active'
        on

    on