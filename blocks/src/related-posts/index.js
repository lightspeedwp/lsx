/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import metadata from './block.json';

console.log(metadata);

wp.blocks.registerBlockVariation(
	'core/group',
	{
		name: metadata.name,
		title: metadata.title,
		attributes: {
			align: 'full'
		},
		isDefault: true
	}
);
