### Module Site (backend) ###
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
'END Module Site (backend)'