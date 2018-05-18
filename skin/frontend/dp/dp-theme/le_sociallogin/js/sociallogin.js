function showLESocialPopup(url, width, height){
    var screenX = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft;
    var screenY = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop;
    var outerWidth = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.body.clientWidth;
    var outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22);
    var left = parseInt(screenX + ((outerWidth - width) / 2), 10);
    var top = parseInt(screenY + ((outerHeight - height) / 2.5), 10);
    var settings = (
        'width=' + width +
            ',height=' + height +
            ',left=' + left +
            ',top=' + top
        );
    var newwindow = window.open(url, '', settings);
    if (window.focus) {
        newwindow.focus()
    }
    return false;
}
