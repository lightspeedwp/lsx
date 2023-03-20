import { createElement } from "@wordpress/element";

/**
 * WordPress dependencies
 */
import { Path, SVG } from '@wordpress/primitives';
export const FiveColumnIcon = () => createElement(SVG, {
  width: "48",
  height: "48",
  viewBox: "0 0 48 48",
  version: "1.1"
}, createElement(Path, {
  d: "M39,12H9c-1.1,0-2,0.9-2,2v20c0,1.1,0.9,2,2,2h30c1.1,0,2-0.9,2-2V14C41,12.9,40.1,12,39,12z M9,14h4.4v20H9V14z M15.4,34V14h4.4v20H15.4z M21.8,34V14h4.4v20H21.8z M28.2,14h4.4v20h-4.4V14z M39,34h-4.4V14H39V34z"
}));