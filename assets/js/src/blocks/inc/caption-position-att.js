/**
 * WordPress dependencies
 */
import { createHigherOrderComponent } from '@wordpress/compose';
import { Fragment } from '@wordpress/element';
import { InspectorControls } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { PanelBody, SelectControl } from '@wordpress/components';
import { addFilter } from '@wordpress/hooks';

/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * Creates an allow list of components
 */
const enableSidebarSelectOnBlocks = [
	'core/image',
	'core/media-text',
];

/**
 * Declare our custom attribute
 * Appends the custom attribute to the core image block
 *
 * @link https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#blocks-registerblocktype
 */
function addCaptionAttribute( settings, name, attributes ) {
	if ( ! enableSidebarSelectOnBlocks.includes( name ) ) {
		return settings;
	}

	const imgAttributes = settings.attributes;
	const newAttribute = {
		captionPosition: { type: 'string' },
	};

	settings.attributes = Object.assign( imgAttributes, newAttribute );

	return settings;
}
addFilter(
	'blocks.registerBlockType',
	'custom-attributes/set-sidebar-select-attribute',
	addCaptionAttribute
);

/**
 * Add Custom Select to Image Sidebar
 */
const withSidebarSelect = createHigherOrderComponent(
	( BlockEdit ) => {
		return ( props ) => {
			// console.log(props)

			// If current block is not allowed
			if ( ! enableSidebarSelectOnBlocks.includes( props.name ) ) {
				return (
					<BlockEdit { ...props } />
				);
			}

			const { attributes, setAttributes } = props;
			const { captionPosition } = attributes;

			return (
				<Fragment>
					<BlockEdit { ...props } />
					<InspectorControls>
						<PanelBody
							title={ __( 'Image Caption Position', 'wp-rig' ) }
						>
							<SelectControl
								label={ __( 'Caption Position', 'wp-rig' ) }
								value={ captionPosition }
								options={ [
									{
										label: __( 'None' ),
										value: '',
									},
									{
										label: __( 'Top Left' ),
										value: 'top-left',
									},
									{
										label: __( 'Top Right' ),
										value: 'top-right',
									},
									{
										label: __( 'Bottom Left' ),
										value: 'bottom-left',
									},
									{
										label: __( 'Bottom Right' ),
										value: 'bottom-right',
									},
								] }
								onChange={ ( value ) => {
									setAttributes( {
										captionPosition: value,
									} );
								} }
							/>
						</PanelBody>
					</InspectorControls>
				</Fragment>
			);
		};
	},
	'withSidebarSelect'
);

addFilter(
	'editor.BlockEdit',
	'custom-attributes/with-sidebar-select',
	withSidebarSelect
);

/**
 * Add custom class to block in Edit
 */
const withSidebarSelectProp = createHigherOrderComponent( ( BlockListBlock ) => {
	return ( props ) => {
		// If current block is not allowed
		if ( ! enableSidebarSelectOnBlocks.includes( props.name ) ) {
			return (
				<BlockListBlock { ...props } />
			);
		}

		const { attributes } = props;
		const { captionPosition } = attributes;

		if ( captionPosition ) {
			return <BlockListBlock { ...props } className={ 'has-option-' + captionPosition } />;
		}
		return <BlockListBlock { ...props } />;
	};
}, 'withSidebarSelectProp' );

addFilter(
	'editor.BlockListBlock',
	'custom-attributes/with-sidebar-select-prop',
	withSidebarSelectProp
);

/**
 * Save our custom attribute
 */
const saveSidebarSelectAttribute = ( extraProps, blockType, attributes ) => {
	// Do nothing if it's another block than our defined ones.
	if ( enableSidebarSelectOnBlocks.includes( blockType.name ) ) {
		const { captionPosition } = attributes;
		if ( captionPosition ) {
			extraProps.className = classnames( extraProps.className, 'has-option-' + captionPosition );
		}
	}

	return extraProps;
};

addFilter(
	'blocks.getSaveContent.extraProps',
	'custom-attributes/save-sidebar-select-attribute',
	saveSidebarSelectAttribute
);
