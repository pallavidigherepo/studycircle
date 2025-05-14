<script setup>
import { ref, reactive, computed, watch, onMounted } from 'vue'
import Layout from '@/layouts/main.vue'
import PageHeader from '@/components/page-header.vue'
import simpleBar from 'simplebar-vue'

// import moment from 'moment'
import flatPickr from 'vue-flatpickr-component'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin, { Draggable } from '@fullcalendar/interaction'
import bootstrapPlugin from '@fullcalendar/bootstrap'
import listPlugin from '@fullcalendar/list'
import multiMonthPlugin from '@fullcalendar/multimonth'

import { INITIAL_EVENTS, categories } from './utils'
import { layoutComputed } from '@/state/helpers'
import { CalendarIcon } from '@zhuowenli/vue-feather-icons'

const fullCalendar = ref(null)

const calendarOptions = reactive({
  timeZone: 'local',
  droppable: true,
  navLinks: true,
  plugins: [
    dayGridPlugin,
    timeGridPlugin,
    interactionPlugin,
    bootstrapPlugin,
    listPlugin,
    multiMonthPlugin,
  ],
  themeSystem: 'bootstrap',
  headerToolbar: {
    left: 'prev,next today',
    center: 'title',
    right: 'multiMonthYear,dayGridMonth,timeGridWeek,timeGridDay,listMonth'
  },
  windowResize: () => {
    getInitialView()
  },
  initialView: 'multiMonthYear',
  initialEvents: INITIAL_EVENTS,
  editable: true,
  selectable: true,
  selectMirror: true,
  dayMaxEvents: true,
  weekends: true,
  dateClick: dateClicked,
  eventClick: editEventDetails,
  eventsSet: handleEvents
})

const submitted = ref(false)
const currentEvents = ref([])
const dataEdit = ref(false)
const showModal = ref(false)
const eventModal = ref(false)
const newEventData = ref({})
const edit = ref({})

const event = reactive({
  title: '',
  date: '',
  location: '',
  description: '',
  type: '',
  calendardates: ''
})

const config = {
  wrap: true,
  altFormat: 'M j, Y',
  altInput: true,
  dateFormat: 'd M, Y',
  mode: 'range'
}

const timeConfig = {
  enableTime: false,
  altInput: true,
  dateFormat: 'Z',
  altFormat: 'd M, Y',
  mode: 'range'
}

const selectedLocale = ref('en')
const selectedDirection = ref('ltr')

function formatDate(date) {
  const d = new Date(date)
  const options = { day: '2-digit', month: 'long', year: 'numeric' }
  return d.toLocaleDateString(undefined, options)
}

function dateStamp(start, end) {
  return end == null ? formatDate(start) : `${formatDate(start)} - ${formatDate(end)}`
}

function formatTime(params) {
  const date = new Date(params)
  let hour = date.getHours()
  let minute = date.getMinutes() || '00'
  const timeFormat = hour >= 12 ? 'PM' : 'AM'
  hour = hour % 12 || 12
  minute = minute < 10 ? '0' + minute : minute
  return `${hour}:${minute} ${timeFormat}`
}

function timeStamp(start, end) {
  return formatTime(start) === formatTime(end) ? 'Full day event' : `${formatTime(start)} - ${formatTime(end)}`
}

function deleteEvent() {
  edit.value.remove()
  eventModal.value = false
  showModal.value = false
}

function dateClicked(info) {
  Object.assign(event, { title: '', date: '', location: '', description: '', type: '', calendardates: '' })
  newEventData.value = info
  showModal.value = true
  dataEdit.value = false
}

function editEventDetails(info) {
  edit.value = info.event
  event.title = edit.value.title
  event.type = edit.value.classNames
  event.date = dateStamp(edit.value.start, edit.value.end)
  event.location = edit.value.extendedProps.location
  event.description = edit.value.extendedProps.description
  event.calendardates = moment(edit.value.start).toISOString() + ' to ' + moment(edit.value.end || edit.value.start).toISOString()
  dataEdit.value = true
  eventModal.value = true
}

function handleSubmit() {
  submitted.value = true
  if (event.title && event.calendardates && event.location && event.description && event.type) {
    const [startDate, endDate] = event.calendardates.split(" ").filter(item => item !== "to")

    if (dataEdit.value) {
      edit.value.setProp('title', event.title)
      edit.value.setProp('classNames', event.type)
      edit.value.setStart(startDate)
      edit.value.setEnd(endDate)
      edit.value.setExtendedProp('location', event.location)
      edit.value.setExtendedProp('description', event.description)
    } else {
      fullCalendar.value.getApi().addEvent({
        id: Math.floor(Math.random() * 100 + 1),
        title: event.title,
        start: startDate,
        end: endDate,
        classNames: event.type,
        extendedProps: {
          department: 'All Day Event',
          location: event.location,
          description: event.description
        }
      })
    }
    showModal.value = false
  }
}

function getInitialView() {
  if (window.innerWidth >= 768 && window.innerWidth < 1200) return 'timeGridWeek'
  if (window.innerWidth <= 768) return 'listMonth'
  return 'dayGridMonth'
}

function toggleModal() {
  showModal.value = true
  dataEdit.value = false
  submitted.value = false
  Object.assign(event, { title: '', date: '', location: '', description: '', type: '', calendardates: '' })
}

function editbtn() {
  showModal.value = true
  eventModal.value = false
}

function cancelbtn() {
  showModal.value = false
  eventModal.value = true
}

function changeLocale() {
  fullCalendar.value.getApi().setOption('locale', selectedLocale.value)
}

function changeDirection() {
  fullCalendar.value.getApi().setOption('direction', selectedDirection.value)
}

function selectEvents(e) {
  const check = document.querySelectorAll('.input-filter')
  if (e.target.checked) {
    check.forEach((item) => (item.checked = true))
    calendarOptions.events = currentEvents.value
  } else {
    check.forEach((item) => (item.checked = false))
    calendarOptions.events = []
  }
}

function selectCategory() {
  const check = document.querySelectorAll('.input-filter')
  const checked = document.querySelectorAll('.input-filter:checked')
  const selectAll = document.querySelector('.select-all')
  const selected = Array.from(checked).map(item => item.getAttribute('data-value'))

  selectAll.checked = check.length === checked.length

  calendarOptions.events = currentEvents.value.filter(event => selected.includes(event.extendedProps.category.toLowerCase()))
}

function handleEvents(events) {
  currentEvents.value = [...events].reverse()
}

const layoutType = computed(() => layoutComputed.layoutType.value)

watch(layoutType, (newVal, oldVal) => {
  if (newVal !== oldVal) {
    // optional layout change logic
  }
})

onMounted(() => {
  new Draggable(document.getElementById("external-events"), {
    itemSelector: ".external-event",
    eventData: function (eventEl) {
      return {
        title: eventEl.innerText,
        start: new Date(),
        className: eventEl.getAttribute("data-class")
      }
    }
  })
})
</script>

<template>
    <Layout>
        <PageHeader title="Month Grid" pageTitle="Apps" />

        <BRow>
            <BCol cols="12">
                <BRow>
                    <BCol xl="3">
                        <BCard no-body class="card-h-100">
                            <BCardBody>
                                <BButton variant="primary" class="w-100" id="btn-new-event" @click="showModal = true">
                                    <i class="mdi mdi-plus"></i> Create New Event
                                </BButton>

                                <div id="external-events">
                                    <br />
                                    <p class="text-muted">
                                        Drag and drop your event or click in the calendar
                                    </p>
                                    <div class="external-event fc-event bg-success-subtle text-success"
                                        data-class="bg-success-subtle">
                                        <i class="mdi mdi-checkbox-blank-circle me-2"></i>New Event Planning
                                    </div>
                                    <div class="external-event fc-event bg-info-subtle text-info"
                                        data-class="bg-info-subtle">
                                        <i class="mdi mdi-checkbox-blank-circle me-2"></i>Meeting
                                    </div>
                                    <div class="external-event fc-event bg-warning-subtle text-warning"
                                        data-class="bg-warning-subtle">
                                        <i class="mdi mdi-checkbox-blank-circle me-2"></i>Generating Reports
                                    </div>
                                    <div class="external-event fc-event bg-danger-subtle text-danger"
                                        data-class="bg-danger-subtle">
                                        <i class="mdi mdi-checkbox-blank-circle me-2"></i>Create New theme
                                    </div>
                                </div>
                            </BCardBody>
                        </BCard>
                        <div>
                            <h5 class="mb-1">Upcoming Events</h5>
                            <p class="text-muted">Don't miss scheduled events</p>
                            <simpleBar class="upcoming-events pe-2 me-n1 mb-3" data-simplebar="init" style="height: 400px">
                                <BCard no-body class="mb-3" v-for="event in currentEvents" :key="event.id">
                                    <BCardBody>
                                        <div class="d-flex mb-3">
                                            <div class="flex-grow-1">
                                                <i
                                                    :class="`mdi mdi-checkbox-blank-circle me-2 ${event.classNames}`"></i><span
                                                    class="fw-medium">{{ dateStamp(event.start, event.end) }}</span>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <BBadge tag="small" variant="primary-subtle"
                                                    class="bg-primary-subtle text-primary ms-auto">{{
                                                        timeStamp(event.start, event.end)
                                                    }}</BBadge>
                                            </div>
                                        </div>
                                        <h6 class="card-title fs-16">{{ event.title }}</h6>
                                        <p class="text-muted text-truncate-two-lines mb-0">{{ (event.extendedProps &&
                                            event.extendedProps.description) ?
                                            event.extendedProps.description : "N.A."
                                        }}</p>
                                    </BCardBody>
                                </BCard>
                            </simpleBar>
                        </div>
                        <BCard no-body>
                            <BCardBody class="bg-info-subtle">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <CalendarIcon class="text-info icon-dual-info"></CalendarIcon>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-15">Welcome to your Calendar!</h6>
                                        <p class="text-muted mb-0">
                                            Event that applications book will appear here. Click on an
                                            event to see the details and manage applicants event.
                                        </p>
                                    </div>
                                </div>
                            </BCardBody>
                        </BCard>
                    </BCol>
                    <BCol xl="9">
                        <BCard no-body class="card-h-100">
                            <BCardBody>
                                <FullCalendar ref="fullCalendar" :options="calendarOptions" />
                            </BCardBody>
                        </BCard>
                    </BCol>
                </BRow>
                <div style="clear: both"></div>
            </BCol>
        </BRow>

        <BModal v-model="showModal" :title="this.dataEdit ? this.eventTitle : 'Add Event'" body-class="p-4"
            header-class="p-3 bg-info-subtle" hide-footer class="v-modal-custom" centered="">
            <form @submit.prevent="handleSubmit">
                <div class="text-end" v-if="this.dataEdit">
                    <BLink href="#" class="btn btn-sm btn-subtle-primary" id="edit-event-btn" @click="cancelbtn">
                        Cancel</BLink>
                </div>
                <BRow>
                    <BCol cols="12">
                        <div class="mb-3">
                            <label for="name" class="form-label">Event Name</label>
                            <input id="name" v-model="event.title" type="text" class="form-control"
                                placeholder="Insert Event name" :class="{ 'is-invalid': submitted && !event.title }" />
                        </div>
                    </BCol>
                    <BCol cols="12">
                        <div class="mb-3">
                            <label class="form-label">Event Date</label>
                            <div class="input-group">
                                <flat-pickr placeholder="Select date" v-model="event.calendardates" :config="timeConfig"
                                    class="form-control flatpickr-input" id="caledate"
                                    :class="{ 'is-invalid': submitted && !event.calendardates }"></flat-pickr>
                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                            </div>
                        </div>
                    </BCol>
                    <BCol cols="12">
                        <div class="mb-3">
                            <label for="event-location" class="form-label">Location</label>
                            <div>
                                <input type="text" v-model="event.location" class="form-control" name="event-location"
                                    id="event-location" placeholder="Event location"
                                    :class="{ 'is-invalid': submitted && !event.location }">
                            </div>
                        </div>
                    </BCol>
                    <BCol cols="12">
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" v-model="event.description" id="event-description"
                                placeholder="Enter a description" rows="3" spellcheck="false"
                                :class="{ 'is-invalid': submitted && !event.description }"></textarea>
                        </div>
                    </BCol>
                    <BCol cols="12">
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select v-model="event.type" class="form-control" name="type"
                                :class="{ 'is-invalid': submitted && !event.type }">
                                <option v-for="option in categories" :key="option.backgroundColor"
                                    :value="`${option.value}`">
                                    {{ option.name }}
                                </option>
                            </select>
                        </div>
                    </BCol>
                </BRow>

                <div class="text-end pt-3">
                    <BButton class="ms-1" variant="subtle-danger" @click="deleteEvent" v-if="this.dataEdit">Delete</BButton>
                    <BButton type="submit" variant="success" class="ms-1">
                        {{ this.dataEdit ? "Update Event" : "Add Event" }}
                    </BButton>
                </div>
            </form>
        </BModal>

        <BModal v-model="eventModal" :title="event.title" hide-footer body-class="p-4"
            header-class="p-3 bg-info-subtle" class="v-modal-custom" centered>
            <div class="text-end">
                <BLink href="#" class="btn btn-sm btn-subtle-primary" id="edit-event-btn" @click="editbtn">Edit</BLink>
            </div>
            <div class="event-details">
                <div class="d-flex mb-2">
                    <div class="flex-grow-1 d-flex align-items-center">
                        <div class="flex-shrink-0 me-3"> <i class="ri-calendar-event-line text-muted fs-16"></i> </div>
                        <div class="flex-grow-1">
                            <h6 class="d-block fw-semibold mb-0" id="event-start-date-tag">
                                {{ event.date }}
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="flex-shrink-0 me-3"> <i class="ri-time-line text-muted fs-16"></i> </div>
                    <div class="flex-grow-1">
                        <h6 class="d-block fw-semibold mb-0">
                            <span id="event-timepicker1-tag"></span> - <span id="event-timepicker2-tag"></span>
                        </h6>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="flex-shrink-0 me-3"> <i class="ri-map-pin-line text-muted fs-16"></i> </div>
                    <div class="flex-grow-1">
                        <h6 class="d-block fw-semibold mb-0">
                            <span id="event-location-tag">
                                {{ event.location || "No Location" }}
                            </span>
                        </h6>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0 me-3"> <i class="ri-discuss-line text-muted fs-16"></i> </div>
                    <div class="flex-grow-1">
                        <p class="d-block text-muted mb-0" id="event-description-tag">
                            {{ event.description || "N.A." }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="hstack gap-2 justify-content-end">
                <BButton variant="subtle-danger" id="btn-delete-event" @click="deleteEvent">
                    <i class="ri-close-line align-bottom"></i> Delete
                </BButton>
            </div>
        </BModal>
    </Layout>
</template>