<script>
import MainLayout from "@pages/Vendor/Core/Backend/Layouts/MainLayout/MainLayout.vue";

export default {
    layout: (h, page) => h(MainLayout, {
        title: "calendars",
        bc: [{label: "calendars"}]
    }, () => page)
};
</script>
<script setup>
import { computed, ref } from "vue";
import { Link } from "@inertiajs/vue3";
import Table from "@core/Components/Table.vue";
import Select from "@core/Components/Select.vue";
import { isSmaller, breakpointsListeners } from "@core/Mixins/breakpoints";

breakpointsListeners();

const props = defineProps(["calendars", "day"]);
const selectedDay = ref(props.day);
const weekday = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
const today = weekday[new Date().getDay()];

const weekdayOptions = weekday.map(wd => {
    return {label: wd, id: wd.toLowerCase()};
});

// const calendarItems = computed(() => {
//     return props.calendars.data.filter(cal => cal.day === selectedDay.value);
// });

const calendarItems = computed(() => {
    let items = props.calendars.data.filter(cal => cal.day === selectedDay.value);
    let on_air = false;
    if (today === selectedDay.value) {
        for (let i = 0; i < items.length; i++) {
            if (i + 1 < items.length) {
                const today = new Date();
                const todayIso = today.toISOString().split("T")[0];
                const calTime = new Date(`${todayIso}  ${items[i].time}`).getTime();
                const calNextTime = new Date(`${todayIso}  ${items[i + 1].time}`).getTime();
                if (calTime < today.getTime() && calNextTime > today.getTime()) {
                    on_air = true;
                }
            } else {
                on_air = true;
            }
            items[i] = {...items[i], on_air};
            if (on_air) break;
        }
    }

    return items;
});

const fileTime = new Date("1980-02-20 " + "04:50:00").getTime();
const nowTime = new Date().getTime();
</script>
<template>
    <div class="flex justify-between my-0 items-center h-14 rounded-lg overflow-hidden my-6">
        <span class="text-skin-base  font-medium text-xl">{{ __("calendars_list") }}</span>
        <Link :href="route('admin.broadcast-schedule.calendars.create', {day: selectedDay})"
              as="button"
              class="btn btn-success text-sm"
              type="button">{{ __("create") }}
        </Link>
    </div>
    <Select v-if="isSmaller('lg')"
            v-model="selectedDay"
            :options="weekdayOptions"
            class="mb-2"
            translate-label/>
    <ul v-else
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-7 gap-1 days-menu">
        <li v-for="day in weekday"
            :class="{'bg-skin-foreground font-bold': day === selectedDay}"
            @click="selectedDay = day">
            {{ __(day) }}
        </li>
    </ul>
    <div class="w-full
                    bg-skin-foreground
                    overflow-hidden
                    shadow
                    border-0 lg:border lg:border-t-0 border-gray-300 dark:border-gray-800
                    text-skin-base
                    rounded-lg lg:rounded-none lg:rounded-b-lg
                    mb-20">
        <Table v-if="calendarItems"
               :columns="[{name: 'image', show: 'md', class: 'text-center'}, {name: 'time', class: 'text-center', tdClass: 'font-bold'}, {name: 'name'}, {name: 'highlight', class: 'text-center', show: 'lg'}]"
               :data="calendarItems"
               delete-route="admin.broadcast-schedule.calendars.destroy"
               divide-x
               edit-route="admin.broadcast-schedule.calendars.edit"
               even
               search-route="admin.broadcast-schedule.calendars.index">
            <template #col-content-image="{item}">
                <div class="flex justify-center">
                    <img :alt="item.title"
                         :src="item.image"
                         class="h-16 w-16 rounded-full">
                </div>
            </template>
            <template #col-content-time="{item}">
                <span :class="{'text-red-400 font-bold' : item.on_air}">{{ item.time }}</span>
            </template>
            <template #col-content-highlight="{item}">
                <div v-if="item.highlight"
                     class="flex justify-center">
                    <svg aria-hidden="true"
                         class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.5"
                         viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46"
                              stroke-linecap="round"
                              stroke-linejoin="round"></path>
                    </svg>
                </div>
                <span v-else></span>
            </template>
        </Table>
    </div>
</template>
<style scoped>
.days-menu li {
    @apply text-center text-sm cursor-pointer lg:mb-0 border lg:border-b-0 border-gray-300 dark:border-gray-800 z-10 px-4 py-2 rounded lg:rounded-b-none;
}
</style>
