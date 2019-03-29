/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    config.filebrowserBrowseUrl = 'http://mamaBlog/modules/kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = 'http://mamaBlog/modules/kcfinder/browse.php?opener=ckeditor&type=images';
    config.filebrowserFlashBrowseUrl = 'http://mamaBlog/modules/kcfinder/browse.php?opener=ckeditor&type=flash';
    config.filebrowserUploadUrl = 'http://mamaBlog/modules/kcfinder/upload.php?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl = 'http://mamaBlog/modules/kcfinder/upload.php?opener=ckeditor&type=images';
    config.filebrowserFlashUploadUrl = 'http://mamaBlog/modules/kcfinder/upload.php?opener=ckeditor&type=flash';
};
