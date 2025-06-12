// // modules/layout.js
import { defineStore } from 'pinia';

export const useLayoutStore = defineStore('layout', {
  state: () => ({
    mode: 'light',
    preloader: 'enable',
    layoutType: 'vertical',
    layoutWidth: 'fluid',
    position: 'fixed',
    topbar: 'light',
    sidebarSize: 'lg',
    sidebarView: 'default',
    sidebarColor: 'dark',
    sidebarImage: 'img-1',
    visibility: 'show',
    layoutTheme: 'default',
    themeColor: 'default',
    bodybg: 'none',
    dataSidebarUserShow: false
  }),
  actions: {
    changeMode({ mode }) { this.mode = mode },
    changePreloader({ preloader }) { this.preloader = preloader },
    changeLayoutType({ layoutType }) { this.layoutType = layoutType },
    changeLayoutWidth({ layoutWidth }) { this.layoutWidth = layoutWidth },
    changePosition({ position }) { this.position = position },
    changeTopbar({ topbar }) { this.topbar = topbar },
    changeSidebarSize({ sidebarSize }) { this.sidebarSize = sidebarSize },
    changeSidebarView({ sidebarView }) { this.sidebarView = sidebarView },
    changeSidebarColor({ sidebarColor }) { this.sidebarColor = sidebarColor },
    changeSidebarImage({ sidebarImage }) { this.sidebarImage = sidebarImage },
    changeVisibility({ visibility }) { this.visibility = visibility },
    changeThemes({ layoutTheme }) { this.layoutTheme = layoutTheme },
    changeThemesColor({ themeColor }) { this.themeColor = themeColor },
    changeBodybg({ bodybg }) { this.bodybg = bodybg }
  }
});
