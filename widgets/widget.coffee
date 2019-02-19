### Widgets ###

$doc = $ document

### Widget Form ###
$doc.on 'focusin', '.input', (e) ->
    $this = $ this
    $this.removeClass 'error'
    $doc.find(".input-error[for=#{$this.attr 'id'}]").remove()

### Widget RowView ###
$doc.on 'click', '*[data-rowview-confirm]', (e) -> confirm $(this).attr 'data-rowview-confirm'

'END Widgets'