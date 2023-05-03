<script setup>
import { onBeforeMount, onMounted, ref, toRefs, watch } from "vue";
import { __ } from "@core/Mixins/translations";

const props = defineProps(["selectedDay"]);
const {selectedDay} = toRefs(props);

const emit = defineEmits(["update:selectedDay"]);

const weekDays = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
const today = weekDays[new Date().getDay()];
const items = ref([]);
const weekDayOptions = weekDays.map(wd => {
    return {label: __(wd), id: wd.toLowerCase()};
});

function loadCalendar(day = null) {
    if (!day) {
        day = today;
        emit("update:selectedDay", today);
    }
    axios.get(route("api.v1.broadcast-schedule.calendars.day", {day: selectedDay.value})).then(response => {
        items.value = response.data.data;
    }).catch(response => {

    });
}

onMounted(() => {
    watch(selectedDay, value => {
        loadCalendar(value);
    });
 })

onBeforeMount(() => {
    loadCalendar();
});
</script>
<template>
    <slot :items="items"
          :loadCalendar="loadCalendar"
          :selectedDay="selectedDay"
          :weekDays="weekDays"
          :weekDaysOptions="weekDayOptions"></slot>
</template>
<style scoped></style>
