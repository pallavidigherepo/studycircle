import { defineStore } from 'pinia';

export const useLayoutStore = defineStore('layout', {
  state: () => ({
    layoutType: 'vertical',
    sidebarSize: 'default',
    layoutWidth: 'fluid',
    topbar: 'light',
    mode: 'light',
    position: 'fixed',
    sidebarView: 'default',
    sidebarColor: 'light',
    sidebarImage: 'none',
    visibility: true,
  }),

  actions: {
    changeLayoutType(type) {
      this.layoutType = type;
    },
    changeSidebarSize(size) {
      this.sidebarSize = size;
    },
    changeLayoutWidth(width) {
      this.layoutWidth = width;
    },
    changeTopbar(topbar) {
      this.topbar = topbar;
    },
    changeMode(mode) {
      this.mode = mode;
    },
    changePosition(position) {
      this.position = position;
    },
    changeSidebarView(view) {
      this.sidebarView = view;
    },
    changeSidebarColor(color) {
      this.sidebarColor = color;
    },
    changeSidebarImage(image) {
      this.sidebarImage = image;
    },
    changeVisibility(status) {
      this.visibility = status;
    },
  }
});
