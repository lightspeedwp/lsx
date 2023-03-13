/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */

/**
 * Internal dependencies
 */
import metadata from './block.json';

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
