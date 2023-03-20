
import { FourColumnIcon, FiveColumnIcon, SixColumnIcon } from './icons';

wp.blocks.registerBlockVariation( 'core/columns', {
    name: 'four-columns-equal-split',
	description: 'Four columns; equal split',
	title: '25/25/25/25',
	isDefault: false,
	innerBlocks: [['core/column'], ['core/column'], ['core/column'], ['core/column']],
	icon: FourColumnIcon,
	scope: ['block']
} );


/**
 * 5 Column Equal Split
 */

wp.blocks.registerBlockVariation( 'core/columns', {
    name: 'five-columns-equal-split',
	description: 'Five columns; equal split',
	title: '20/20/20/20/20',
	isDefault: false,
	innerBlocks: [['core/column'], ['core/column'], ['core/column'], ['core/column'], ['core/column']],
	icon: FiveColumnIcon,
	scope: ['block']
} );

/**
 * 6 Column Equal Split
 */

wp.blocks.registerBlockVariation( 'core/columns', {
    name: 'six-columns-equal-split',
	description: 'Six columns; equal split',
	title: '16/16/16/...',
	isDefault: false,
	innerBlocks: [['core/column'], ['core/column'], ['core/column'], ['core/column'], ['core/column'], ['core/column']],
	icon: SixColumnIcon,
	scope: ['block']
} );
