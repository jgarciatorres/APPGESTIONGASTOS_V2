/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.defaultLanguage  = 'es';
	config.language = 'es';
	config.skin = 'moonocolor';
	config.embed_provider = '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}';
	config.exportPdf_tokenUrl = '';
	// config.extraPlugins = 'grid,gallery';
	config.removePlugins = 'flash,image,blockimagepaste,exportpdf,autosave';
	// config.uiColor = '#AADC6E';
};
