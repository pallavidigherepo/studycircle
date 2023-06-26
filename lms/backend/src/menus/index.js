import dom from "@left4code/tw-starter/dist/js/dom";

// Setup side menu
const findActiveMenu = (subMenu, route) => {
  let match = false;
  subMenu.forEach((item) => {
    // Added a new condition to check whether parent value == item.pageName
    if ((item.pageName === route.name && !item.ignore) ||
        (item.pageName === route.meta.parent)) {
      match = true;
    } else if (!match && item.subMenu) {
      match = findActiveMenu(item.subMenu, route);
    }
  });
  return match;
};

const nestedMenu = (menu, route) => {
  menu.forEach((item, key) => {

    if (typeof item !== "string") {
      let menuItem = menu[key];
      let pageAllowed = false;
      if (item.allowedPages) {
        pageAllowed = item.allowedPages.includes(item.pageName);
      } else {
        pageAllowed = false;
      }

      menuItem.active =
        // Code adding to show menu active for main menu's create, edit and show
        (((item.pageName === route.meta.parent && pageAllowed) || item.pageName === route.name) ||
          (item.subMenu && findActiveMenu(item.subMenu, route))) &&
        !item.ignore;

      if (item.subMenu) {
        menuItem.activeDropdown = findActiveMenu(item.subMenu, route);
        menuItem = {
          ...item,
          ...nestedMenu(item.subMenu, route),
        };
      }
    }
  });

  return menu;
};

const linkTo = (menu, router, event) => {
  if (menu.subMenu) {
    menu.activeDropdown = !menu.activeDropdown;
  } else {
    event.preventDefault();
    router.push({
      name: menu.pageName,
    });
  }
};

const enter = (el, done) => {
  dom(el).slideDown(300);
};

const leave = (el, done) => {
  dom(el).slideUp(300);
};

export { nestedMenu, linkTo, enter, leave };
