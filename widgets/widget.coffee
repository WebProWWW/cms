### Widgets ###

$doc = $ document

### Widget Form ###

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


### Widget RowView ###
$doc.on 'click', '*[data-rowview-confirm]', (e) -> confirm $(this).attr 'data-rowview-confirm'

'END Widgets'