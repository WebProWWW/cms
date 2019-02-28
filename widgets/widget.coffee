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



### Widget RowView ###
$doc.on 'click', '*[data-rowview-confirm]', (e) -> confirm $(this).attr 'data-rowview-confirm'

'END Widgets'