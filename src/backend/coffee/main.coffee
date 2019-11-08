"use strict"

$doc = $ document

$doc.on 'click', '.js-prevent', (e) ->
    e.preventDefault()
    off

###
$doc = $ document
arrru = [',','/','_',' ','Я','я','Ю','ю','Ч','ч','Ш','ш','Щ','щ','Ж','ж','А','а','Б','б','В','в','Г','г','Д','д','Е','е','Ё','ё','З','з','И','и','Й','й','К','к','Л','л','М','м','Н','н', 'О','о','П','п','Р','р','С','с','Т','т','У','у','Ф','ф','Х','х','Ц','ц','Ы','ы','Ь','ь','Ъ','ъ','Э','э']
arren = ['-','-','-','-','Ya','ya','Yu','yu','Ch','ch','Sh','sh','Sh','sh','Zh','zh','A','a','B','b','V','v','G','g','D','d','E','e','E','e','Z','z','I','i','J','j','K','k','L','l','M','m','N','n', 'O','o','P','p','R','r','S','s','T','t','U','u','F','f','H','h','C','c','Y','y','`','`','\'','\'','E', 'e']

cyrToLat = (text) ->
    for v, i in arrru
        reg = new RegExp v, "g"
        text = text.replace reg, arren[i]
    text.replace(/[-]{2,}/gim, '-').replace(/\n/gim, '').toLowerCase()

$doc.on 'focusout', 'input[data-page-cyrlat]', (e) ->
    $this = $ this
    $targetInput = $ "##{$this.attr 'data-page-cyrlat'}"
    return off if $targetInput.val().length
    $targetInput.val cyrToLat $this.val()
    on


loader = new Loader

$doc.on 'focusin', '.input', (e) ->
    $this = $ this
    $this.removeClass 'error'
    $doc.find(".input-error[for=#{$this.attr 'id'}]").html ''

$doc.on 'submit', 'form[data-ajax]', (e) ->
    e.preventDefault()
    return off if loader.process
    $this = $ this
    options = $.parseJSON $this.attr 'data-ajax'
    loader.appendTo $this.find '.js-ajax-loading'
    loader.done = (data) ->
        if Number(data.formValidateStatus) is 1
            if options.onSuccess is 'refresh'
                window.location.reload()
        else if Number(data.formValidateStatus) is 0
            if options.onErrorValidate is 'addErrors'
                for inputId, errors of data.errors
                    $input = $ "##{inputId}"
                    $doc.find(".input-error[for=#{inputId}]").html errors[0]
                    $input.addClass 'error'
    loader.postJson options.action, $(this).serialize()
    off




class ListItem

    constructor: (@input, @$parent, @single) ->
        if @input.files? and @input.files.length
            reader = new FileReader
            reader.onload = @addItem
            reader.readAsDataURL @input.files[0]

    addItem: (e) =>
        $removeBtn = $ '''
            <span class="imglist-remove">
                <i class="fas fa-times fa-fw"></i>
            </span>
        '''
        $item = $ """
            <div class="imglist-item">
                <img class="imglist-new-img" width="110" height="110" src="#{e.target.result}">
            </div>
        """
        $removeBtn.on 'click', (e) -> $(this).closest('.imglist-item').remove()
        $item.append [ $removeBtn, $(@input) ]
        @$parent.find('.imglist-item').remove() if @single
        @$parent.prepend $item



$doc.on 'click', '.js-form-image-add', (e) ->
    e.preventDefault()
    $this = $ this
    $parent = $this.closest '.js-form-images'
    $fileInput = $ """<input class="d-none" type="file" accept="image/*" name="#{$this.attr('data-input-name')}">"""
    singleItem = $this.attr('data-single-file')?
    $fileInput.one 'change', (e) -> new ListItem this, $parent, singleItem
    $fileInput.trigger 'click'
    off


$doc.on 'click', '*[data-rowview-confirm]', (e) -> confirm $(this).attr 'data-rowview-confirm'









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
        plugins: "link, code, paste, lists"
        toolbar: 'undo redo | bold italic | numlist bullist | alignleft aligncenter alignright | link | code'
        paste_as_text: on

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

###