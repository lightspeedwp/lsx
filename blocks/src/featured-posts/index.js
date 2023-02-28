/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */

/**
 * Internal dependencies
 */
import metadata from './block.json';
import { addFilter } from '@wordpress/hooks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';


/**
 * Register our Related Posts variation.
 */
wp.blocks.registerBlockVariation( 'core/query', {
    name: metadata.name,
    title: metadata.title,
    description: metadata.description,
    isActive: ( { namespace, query } ) => {
        return (
            namespace === metadata.name
        );
    },
    attributes: {
        namespace: metadata.name,
        query: {
            perPage: 9,
            pages: 0,
            offset: 0,
            postType: 'post',
            order: 'rand',
            orderBy: 'date',
            author: '',
            search: '',
            exclude: [],
            sticky: '',
            inherit: false,
			relatedPosts: true
        },
    },
	providesContext: {
		queryId: 'queryId',
		query: 'query',
		displayLayout: 'displayLayout',
		identifier: 'namespace'
	},
    scope: [ 'inserter' ],
	allowedControls: [ 'postType' ],
    }
);

const isFeaturedPostsVariation = ( props ) => {
    const {
        attributes: { namespace }
    } = props;

    return namespace && namespace === metadata.name;
};

const LSXFeaturedPostsControls = ( { props: {
    attributes,
    setAttributes
} } ) => {
    const { query } = attributes;

    return (
        <PanelBody title="Query">
            <SelectControl
                label="Count"
                value={ query.perPage }
                options={ [
                    { value: 1,  label: "1" },
                    { value: 2,  label: "2" },
                    { value: 3,  label: "3" },
                    { value: 4,  label: "4" },
                    { value: 5,  label: "5" },
                    { value: 6,  label: "6" },
                    { value: 7,  label: "7" },
                    { value: 8,  label: "8" },
                    { value: 9,  label: "9" }
                ] }
                onChange={ ( value ) => {
                    setAttributes( {
                        query: {
                            ...query,
                            perPage: value
                        }
                    } );
                } }
            />
        </PanelBody>
    );
};

export const withLSXFeaturedPostsControls = ( BlockEdit ) => ( props ) => {

    return isFeaturedPostsVariation( props ) ? (
        <>
            <BlockEdit {...props} />
            <InspectorControls>
                <LSXFeaturedPostsControls props={props} />
            </InspectorControls>
        </>
    ) : (
        <BlockEdit {...props} />
    );
};

addFilter( 'editor.BlockEdit', 'core/query', withLSXFeaturedPostsControls );
