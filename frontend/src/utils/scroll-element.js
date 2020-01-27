/* eslint-disable no-param-reassign */

// Make non-window element usage to work on IE
// For window object, IE supports window.scrollTo(top, left)
const scrollElement = (element, top, left) => {
  if (element) {
    if (!HTMLElement.prototype.scrollTo) {
      element.scrollTop = top;
      element.scrollLeft = left;
    } else {
      element.scrollTo(top, left);
    }
  }
};

export default scrollElement;
