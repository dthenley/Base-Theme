/**
 * WordPress dependencies
 */
import { createHigherOrderComponent } from '@wordpress/compose';
import { Fragment } from '@wordpress/element';
import { InspectorControls } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { PanelBody, SelectControl } from '@wordpress/components';
import { addFilter } from '@wordpress/hooks';

function addCoverToBlock(settings, name, attributes) {
	/**
	 * Checking to see if block is cover block
	 */
	if (name !== 'core/cover') {
		return settings;
	}

	/**
	 * Adding a div element after the cover block to style however
	 */

	return settings;
}

addFilter(
	'blocks.registerBlockType',
	'custom-attributes/add-cover-style',
	addCoverToBlock
);
