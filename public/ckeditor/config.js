CKEDITOR.editorConfig = function( config ) {

    // Toolbar groups configuration
    config.toolbarGroups = [
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
        { name: 'links' },
        { name: 'insert' },
        { name: 'forms' },
        { name: 'tools' },
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'others' },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
        { name: 'styles' },
        { name: 'colors' },
        { name: 'about' }
    ];

    config.addButtons = 'Underline,Subscript,Superscript';

    // Set common block elements
    config.format_tags = 'p;h1;h2;h3;h4;h5;h6;pre';

    // Simplify dialog windows
    config.removeDialogTabs = 'link:advanced';

    // Add extra plugins
    config.extraPlugins = 'justify,mathjax,preview';

    // Set editor height
    config.height = 500;

    // MathJax configuration
    config.mathJaxLib = 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.3/MathJax.js?config=TeX-AMS_HTML';

};