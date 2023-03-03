const el = wp.element.createElement;

/**
 * 4 Column Equal Split
 */
const fourColumnsIcon = el('svg', { width: 48, height: 48 },
  el('path', { d: "M41 14a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h30a2 2 0 0 0 2-2V14zM28.5 34h-9V14h9v20zm2 0V14H39v20h-8.5zm-13 0H9V14h8.5v20z" } )
);

wp.blocks.registerBlockVariation( 'core/columns', {
    name: 'four-columns-equal-split',
	description: 'Four columns; equal split',
	title: '25/25/25/25',
	isDefault: false,
	innerBlocks: [['core/column'], ['core/column'], ['core/column'], ['core/column']],
	icon: fourColumnsIcon,
	scope: ['block']
} );


/**
 * 5 Column Equal Split
 */
const fiveColumnsIcon = el('svg', { width: 48, height: 48 },
  el('path', { d: "M41 14a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h30a2 2 0 0 0 2-2V14zM28.5 34h-9V14h9v20zm2 0V14H39v20h-8.5zm-13 0H9V14h8.5v20z" } )
);

wp.blocks.registerBlockVariation( 'core/columns', {
    name: 'five-columns-equal-split',
	description: 'Five columns; equal split',
	title: '20/20/20/20/20',
	isDefault: false,
	innerBlocks: [['core/column'], ['core/column'], ['core/column'], ['core/column'], ['core/column']],
	icon: fiveColumnsIcon,
	scope: ['block']
} );

/**
 * 6 Column Equal Split
 */

const sixColumnsIcon = el('svg', { width: 48, height: 48 },
  el('path', { d: "M41 14a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h30a2 2 0 0 0 2-2V14zM28.5 34h-9V14h9v20zm2 0V14H39v20h-8.5zm-13 0H9V14h8.5v20z" } )
);

wp.blocks.registerBlockVariation( 'core/columns', {
    name: 'six-columns-equal-split',
	description: 'Six columns; equal split',
	title: '16/16/16/...',
	isDefault: false,
	innerBlocks: [['core/column'], ['core/column'], ['core/column'], ['core/column'], ['core/column'], ['core/column']],
	icon: sixColumnsIcon,
	scope: ['block']
} );
