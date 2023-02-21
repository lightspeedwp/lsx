/**
 * WordPress components that create the necessary UI elements for the block
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-components/
 */
import { TextControl } from '@wordpress/components';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Properties passed to the function.
 * @param {Object}   props.attributes    Available block attributes.
 * @param {Function} props.setAttributes Function that updates individual attributes.
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	const postType   = useSelect(
		( select ) => select( 'core/editor' ).getCurrentPostType(),
		[]
	);
	const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );

	let priceVal = attributes.message;
	if ( undefined !== meta[ 'price' ] ) {
		priceVal = meta[ 'price' ];
	}

	console.log(postType);

	const updatepriceVal = ( newValue ) => {
		setMeta( { ...meta, price: newValue } );
		setAttributes( { message: newValue } );
    };

	return (
		<div { ...blockProps }>
			<TextControl
				value={ priceVal }
				onChange={ updatepriceVal }

				/*
				onChange={ 
					( val ) => {
						//editPost( { meta: { price: val } } );
						setAttributes( { message: val } )
					}				
				}
				*/
				//onChange={ ( val ) => setAttributes( { message: val } ) }
			/>
		</div>
	);
}
