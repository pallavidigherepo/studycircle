import Chart from './chart/Main.vue'
//import GoogleMapLoader from './google-map-loader/Main.vue'
import Highlight from './highlight/Main.vue'
import Litepicker from './litepicker/Main.vue'
import Tippy from './tippy/Main.vue'
import TippyContent from './tippy-content/Main.vue'
import TailSelect from './tail-select/Main.vue'
import LoadingIcon from './loading-icon/Main.vue'
import TinySlider from './tiny-slider/Main.vue'
//import CKEditor from './ckeditor/Main.vue'
import Dropzone from './dropzone/Main.vue'
import FullCalendar from './calendar/Main.vue'
import FullCalendarDraggable from './calendar/Draggable.vue'
import * as featherIcons from '@zhuowenli/vue-feather-icons'

import ThePageHeader from '@/components/UI/ThePageHeader.vue'
import TheAddNewButton from '@/components/UI/TheAddNewButton.vue'
import BaseSearchCard from '@/components/UI/BaseSearchCard.vue'
import TheBaseDataListCard from '@/components/UI/TheBaseDataListCard.vue'
import TheBaseCard from '@/components/UI/TheBaseCard.vue'
import TheBaseHeaderCard from '@/components/UI/TheBaseHeaderCard.vue'
import TheBaseCrudTable from '@/components/UI/TheBaseCrudTable.vue'
import BaseRowCard from '@/components/UI/BaseRowCard.vue'
import Loading from '@/components/UI/Loading.vue'
import Pagination from '@/components/UI/Pagination.vue';
import ExportModal from '@/components/UI/ExportModal.vue';
import ImportModal from '@/components/UI/ImportModal.vue';
import AddDropdown from '@/components/UI/AddDropdown.vue';

export default app => {
  app.component('Chart', Chart)
  //app.component('GoogleMapLoader', GoogleMapLoader)
  app.component('Highlight', Highlight)
  app.component('Litepicker', Litepicker)
  app.component('Tippy', Tippy)
  app.component('TippyContent', TippyContent)
  app.component('TailSelect', TailSelect)
  app.component('LoadingIcon', LoadingIcon)
  app.component('TinySlider', TinySlider)
  app.component('Dropzone', Dropzone)
  //app.component('CKEditor', CKEditor)
  app.component('FullCalendar', FullCalendar)
  app.component('FullCalendarDraggable', FullCalendarDraggable)
  
  app.component('ThePageHeader', ThePageHeader)
  app.component('TheAddNewButton', TheAddNewButton)
  app.component('BaseSearchCard', BaseSearchCard)
  app.component('TheBaseDataListCard', TheBaseDataListCard)
  app.component('TheBaseCard', TheBaseCard)
  app.component('TheBaseHeaderCard', TheBaseHeaderCard)
  app.component('TheBaseCrudTable', TheBaseCrudTable)
  app.component('BaseRowCard', BaseRowCard)  
  app.component('Notification', Notification)
  app.component('Loading', Loading)
  app.component('Pagination', Pagination)
  app.component('ExportModal', ExportModal)
  app.component('ImportModal', ImportModal)
  app.component('AddDropdown', AddDropdown)
  
  
  for (const [key, icon] of Object.entries(featherIcons)) {
    icon.props.size.default = '24'
    app.component(key, icon)
  }
}
