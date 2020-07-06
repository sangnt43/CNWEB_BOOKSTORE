/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
var base_url = document.querySelector("meta[name='baseUrl']").getAttribute("content");

CKEDITOR.editorConfig = function(config) {
    config.toolbarGroups = [
        { name: 'document', groups: ['mode', 'document', 'doctools'] },
        { name: 'clipboard', groups: ['clipboard', 'undo'] },
        { name: 'links', groups: ['links'] },
        { name: 'insert', groups: ['insert'] },
        { name: 'tools', groups: ['tools'] },
        { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph'] },
        { name: 'styles', groups: ['styles'] },
        { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
        { name: 'colors', groups: ['colors'] },
        { name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing'] },
        { name: 'forms', groups: ['forms'] },
        { name: 'others', groups: ['others'] },
        { name: 'about', groups: ['about'] }
    ];

    config.filebrowserBrowseUrl = base_url + '/public/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = base_url + '/public/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = base_url + '/public/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = base_url + '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = base_url + '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = base_url + '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

    config.removeButtons = 'Source,Save,NewPage,Preview,Print,Replace,Find,SelectAll,Scayt,Form,Radio,Checkbox,TextField,Textarea,Select,Button,ImageButton,HiddenField,CreateDiv,Language,Flash,About';
};