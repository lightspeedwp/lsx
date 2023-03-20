import { createElement } from "@wordpress/element";

/**
 * WordPress dependencies
 */
import { Path, SVG } from '@wordpress/primitives';
export const FourColumnIcon = () => createElement(SVG, {
  width: "48",
  height: "48",
  viewBox: "0 0 48 48",
  version: "1.1"
}, createElement(Path, {
  d: "M39,12H9c-1.1,0-2,0.9-2,2v20c0,1.1,0.9,2,2,2h30c1.1,0,2-0.9,2-2V14C41,12.9,40.1,12,39,12z M9,14h6v20H9V14z M17,34V14h6v20H17z M25,34V14h6v20H25z M39,34h-6V14h6V34z"
}));