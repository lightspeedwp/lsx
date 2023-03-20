import { createElement } from "@wordpress/element";

/**
 * WordPress dependencies
 */
import { Path, SVG } from '@wordpress/primitives';
export const SixColumnIcon = () => createElement(SVG, {
  width: "48",
  height: "48",
  viewBox: "0 0 48 48",
  version: "1.1"
}, createElement(Path, {
  d: "M39,12H9c-1.1,0-2,0.9-2,2v20c0,1.1,0.9,2,2,2h30c1.1,0,2-0.9,2-2V14C41,12.9,40.1,12,39,12z M33.7,14v20h-3.3V14H33.7z M9,14h3.3v20H9V14z M14.3,34V14h3.3v20H14.3z M19.7,34V14H23v20H19.7z M25,14h3.3v20H25V14z M39,34h-3.3V14H39V34z"
}));