<template>
    <div class="calendar__wrapper">
        <div class="card">
            <div class="card-header">
                <div class="text-sm text-muted mb-1">
                    {{ calendar.calendar_year }}
                </div>
                <div class="h5 mb-0">
                    {{ calendar.calendar_day }}
                </div>
            </div>
            <div class="card-body">
                <FullCalendar defaultView="dayGridMonth" :plugins="calendar.calendarPlugins" :events="calendar.events"></FullCalendar>
            </div>
        </div>
    </div>
</template>
<script>
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import moment from 'moment'
    export default {
        components:{
            FullCalendar
        },
        data(){
            return{
                calendar:{
                    calendarPlugins: [ dayGridPlugin ],
                    calendar_year: moment().format("YYYY"),
                    calendar_day: moment().format("dddd, MMM D"),
                    events: [
                        {
                            title: "Call with Dave",
                            start: "2020-05-18",
                            end: "2020-05-18",
                            className: "bg-danger"
                        },
                        {
                            title: "Lunch meeting",
                            start: "2020-05-21",
                            end: "2020-05-22",
                            className: "bg-warning"
                        },
                        {
                            title: "All day conference",
                            start: "2020-05-29",
                            end: "2020-05-29",
                            className: "bg-success"
                        },
                        {
                            title: "Meeting with Mary",
                            start: "2020-05-01",
                            end: "2020-05-01",
                            className: "bg-info"
                        },
                        {
                            title: "Winter Hackaton",
                            start: "2020-05-03",
                            end: "2020-05-03",
                            className: "bg-danger"
                        },
                        {
                            title: "Digital event",
                            start: "2020-05-07",
                            end: "2020-05-09",
                            className: "bg-warning"
                        },
                    ]
                },
            }
        }

    }
</script>
