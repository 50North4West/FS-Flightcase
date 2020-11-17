var IngamePanelCustomPanelLoaded = false;
document.addEventListener('beforeunload', function () {
    IngamePanelCustomPanelLoaded = false;
}, false);

class IngamePanelCustomPanel extends HTMLElement {
  constructor() {
      super();
  }
}
  window.customElements.define("ingamepanel-flightcase", IngamePanelCustomPanel);
  checkAutoload();